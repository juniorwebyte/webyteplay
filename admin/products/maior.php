<?php

// Get the parameters from the request
$horainicial = isset($_GET['horainicial']) ? $_GET['horainicial'] : '';
$horafinal = isset($_GET['horafinal']) ? $_GET['horafinal'] : '';
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';

$major = [];
$minor = [];

// Prepare the base SQL query
$sql = "SELECT * FROM order_list WHERE product_id = ?";

// Add the date filtering if both horainicial and horafinal are provided
if (!empty($horainicial) && !empty($horafinal)) {
    $sql .= " AND date_created BETWEEN ? AND ?";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if (!empty($horainicial) && !empty($horafinal)) {
    $stmt->bind_param('sss', $product_id, $horainicial, $horafinal);
} else {
    $stmt->bind_param('s', $product_id);
}

$stmt->execute();
$result = $stmt->get_result();

// Loop through the results and calculate the major and minor values
while ($row = $result->fetch_assoc()) {
    $order_numbers .= $row['order_numbers'] . ',';

}

if (!empty($order_numbers)) {
    $order_numbers = rtrim($order_numbers, ',');
    $order_numbers = explode(',', $order_numbers);
    $order_numbers = array_filter($order_numbers);

    $stmt = $conn->prepare('SELECT o.customer_id, c.firstname, c.lastname, o.date_created,c.phone
                        FROM order_list o
                        INNER JOIN customer_list c ON o.customer_id = c.id
                        WHERE FIND_IN_SET(?, order_numbers) AND product_id = ? AND status = 2');
    $order_number = max($order_numbers); // Ensure $order_numbers is an array or list
    $stmt->bind_param('si', $order_number, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) { // Check if a row is fetched
        $major['cota'] = $order_number;
        $major['winner'] = $row['firstname'] . ' ' . $row['lastname'];
        $major['date_created'] = date('d/m/Y H:i:s', strtotime($row['date_created']));
        $major['phone'] = $row['phone'];
    }

    $stmt = $conn->prepare('SELECT o.customer_id, c.firstname, c.lastname, o.date_created, c.phone
                        FROM order_list o
                        INNER JOIN customer_list c ON o.customer_id = c.id
                        WHERE FIND_IN_SET(?, order_numbers) AND product_id = ? AND status = 2');
    $order_number = min($order_numbers); // Ensure $order_numbers is an array or list
    $stmt->bind_param('si', $order_number, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) { // Check if a row is fetched
        $minor['cota'] = $order_number;
        $minor['winner'] = $row['firstname'] . ' ' . $row['lastname'];
        $minor['date_created'] = date('d/m/Y H:i:s', strtotime($row['date_created']));
        $minor['phone'] = $row['phone'];
    }

}

// Close the statement and connection
$stmt->close();

?>


<style>
    .mt-3 {
    margin-top: 1rem !important;
}

.alert-danger {
    --bs-alert-color: #992342;
    --bs-alert-bg: #ffd8e2;
    --bs-alert-border-color: #ffc4d4;
}
.alert {
    --bs-alert-bg: transparent;
    --bs-alert-padding-x: 1.25rem;
    --bs-alert-padding-y: 0.75rem;
    --bs-alert-margin-bottom: 1rem;
    --bs-alert-color: inherit;
    --bs-alert-border-color: transparent;
    --bs-alert-border: 1px solid var(--bs-alert-border-color);
    --bs-alert-border-radius: 10px;
    position: relative;
    padding: var(--bs-alert-padding-y) var(--bs-alert-padding-x);
    margin-bottom: var(--bs-alert-margin-bottom);
    color: var(--bs-alert-color);
    background-color: var(--bs-alert-bg);
    border: var(--bs-alert-border);
    border-radius: var(--bs-alert-border-radius);
}
.mt-3 {
    margin-top: .75rem;
}
@media (min-width: 640px) {
    .alert {
        grid-auto-flow: column;
        grid-template-columns: auto minmax(auto, 1fr);
        justify-items: start;
        text-align: start;
    }
}
.alert {
    display: grid;
    width: 100%;
    grid-auto-flow: row;
    align-content: flex-start;
    align-items: center;
    justify-items: center;
    gap: 1rem;
    text-align: center;
    border-radius: var(--rounded-box, 1rem);
    border-width: 1px;
    --tw-border-opacity: 1;
    border-color: var(--fallback-b2, oklch(var(--b2) / var(--tw-border-opacity)));
    padding: 1rem;
    --tw-text-opacity: 1;
    color: var(--fallback-bc, oklch(var(--bc) / var(--tw-text-opacity)));
    --alert-bg: var(--fallback-b2, oklch(var(--b2)/1));
    --alert-bg-mix: var(--fallback-b1, oklch(var(--b1)/1));
    background-color: #ffd8e2;
}
    .hr {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), #343a40, rgba(0, 0, 0, 0));
        margin-block: 4px !important;
    }

    .mb-1 {
        margin-bottom: 0.25rem !important;
    }

    .pt-1 {
        padding-top: 0.25rem !important;
    }

    .lessons__category {
        margin-bottom: 16px;

        background: green;

        display: inline-block;
        padding: 8px 8px 6px;
        border-radius: 4px;
        font-size: 1.2rem;
        text-align: center;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
        color: #FCFCFD;
    }

    .maior,.menor {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column
    }

    .mt-1 {
        margin-top: 0.25rem !important;
    }
    .my-3 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }
    .my-4 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}
</style>
<main class="h-full pb-16 overflow-y-auto">
<div class="container px-6 mx-auto grid col-md-8 col-8">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Maior e Menor cota <a href="./?page=products/manage_product" id="create_new"></a>
    </h2>
    <div class="hr"></div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="<?php echo !$major['cota'] || !$minor['cota'] ? 'hidden' : '' ?> ">

            <div class="maior">
                <h2 class="my-4 text-xl text-center font-semibold text-gray-700 dark:text-gray-200">
                    Menor cota
                </h2>
                <div class="category-green lessons__category"><?php echo $minor['cota'] ?></div>
                <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px">
                    <?php echo $minor['winner'] ?>
                </span>
                <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8">
                    <?php echo $minor['date_created'] ?>
                </span>
                <a href="https://api.whatsapp.com/send?phone=55<?php echo $minor['phone'] ?>&text=Ol%C3%A1%2C%20voc%C3%AA%20%C3%A9%20o%20ganhador%20da%20menor%20cota%20da%20campanha%20<?php echo $minor['cota'] ?>%20"
                target="_blank"
                 style="background: #FCFCFD;
                  border-radius: 8px;
                  gap: 4px;
                  display: flex;
                    justify-content: center;
                    align-items: center;

                 "
                class="mt-4 px-5 py-2">
                    <span class="text-gray-700 dark:text-gray-700 flex  rounded-lg items-center"

                    >
                                            Falar com o ganhador

                    </span>
                    <span style="padding: 4px">
                        <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                          </svg>
                    </span>
                </a>
            </div>
            <div class="hr my-3"></div>

            <div class="menor">
                <h2 class="my-4 text-xl text-center font-semibold text-gray-700 dark:text-gray-200">
                    Maior cota
                </h2>
                <div class="category-green lessons__category"><?php echo $major['cota'] ?></div>
                <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px">
                    <?php echo $major['winner'] ?>
                </span>
                <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8">
                    <?php echo $major['date_created'] ?>
                </span>
                <a href="https://api.whatsapp.com/send?phone=55<?php echo $major['phone'] ?>"
                    target="_blank"
                 style="background: #FCFCFD;
                  border-radius: 8px;
                  gap: 4px;
                  display: flex;
                    justify-content: center;
                    align-items: center;

                 "
                class="mt-4 px-5 py-2">
                    <span class="text-gray-700 dark:text-gray-700 flex  rounded-lg items-center"

                    >
                                            Falar com o ganhador

                    </span>
                    <span style="padding: 4px">
                        <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                          </svg>
                    </span>
                </a>
            </div>
        </div>


        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Escolha a Campanha
            </span>
            <select id="product_id" name="product_id" style="border-radius: 0.5rem;"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                <?php $qry = $conn->query("SELECT * FROM product_list");

while ($row = $qry->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php echo $product_id == $row['id'] ? 'selected' : ''; ?>><?php echo $row['name']; ?></option>
                <?php endwhile;?>

            </select>
        </label>




        <label class="block mt-4 text-sm">
            <span class="text-gray-700  mb-1 dark:text-gray-400">Início</span>
            <input type="datetime-local" name="horainicial" id="horainicial"
                class="form-input  mt-1  pl-3 pr-8 block w-full  text-sm border-[1px]  dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700  focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray font-medium leading-5  py-2 rounded-lg">
        </label>
        <input required="" id="type" value="order" name="type" hidden="">

        <label class="block mt-4 text-sm">
            <span class="text-gray-700  mb-1 dark:text-gray-400">Final</span>
            <input type="datetime-local" name="horafinal" id="horafinal"
                class="form-input mt-1 pl-3 pr-8 block w-full  text-sm border-[1px]  dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700  focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray font-medium leading-5  py-2 rounded-lg">
        </label>

                <?php if ($product_id && !$minor['cota'] && !$major['cota']) {?>
                    <div style="grid-auto-flow: column;grid-template-columns: auto minmax(auto, 1fr);justify-items:start;text-align:start;box-sizing:border-box;border:1.25px solid rgb(255, 196, 212);border-width:1.25px;border-style:solid;border-color:rgb(255, 196, 212);margin-top:16px;--bs-alert-color: #992342;--bs-alert-bg: #ffd8e2;--bs-alert-border-color: #ffc4d4;--bs-alert-padding-x: 1.25rem;--bs-alert-padding-y: 0.75rem;--bs-alert-margin-bottom: 1rem;--bs-alert-border: 1px solid #ffc4d4;--bs-alert-border-radius: 10px;position:relative;padding:12px 20px;margin-bottom:16px;color:rgb(153, 35, 66);background-color:rgb(255, 216, 226);border-radius:10px;display:grid;width: 100%;align-content:flex-start;place-items:center start;gap:16px;--alert-bg: 1/1));--alert-bg-mix: 1/1));scrollbar-color:rgb(153, 35, 66) rgba(0, 0, 0, 0);">
    <p style="box-sizing:border-box;border:0px solid rgb(213, 214, 215);margin:0px;border-width:0px;border-style:solid;border-color:rgb(213, 214, 215);font-size:14px;margin-top:0px;margin-bottom:0px;scrollbar-color:rgb(153, 35, 66) rgba(0, 0, 0, 0);"> Não foi possível localizar cotas</p>
</div>
      <?php }?>





        <div id="actions" class="" style="margin-top:30px;">
            <button id="gerar"
                class="px-5 py-2 w-full font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">
                Buscar cotas
            </button>

        </div>





    </div>

    </main>



    <script>
        function get_cotas() {
            var product_id = $('#product_id').val();
            var horainicial = $('#horainicial').val();
            var horafinal = $('#horafinal').val();

            var url =
                `/admin/?page=products/maior&product_id=${product_id}&horainicial=${horainicial}&horafinal=${horafinal}`;
            window.location.href = url;
        }

        $('#gerar').on('click', function() {
            get_cotas();
        })


        $(document).ready(function() {
            $('#product_id').val('<?php echo $product_id; ?>')
            $('#horainicial').val('<?php echo $horainicial; ?>')
            $('#horafinal').val('<?php echo $horafinal; ?>')

        })
    </script>
