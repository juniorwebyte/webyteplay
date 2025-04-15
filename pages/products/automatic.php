<?php

$string = isset($tipo_auto_cota) ? $tipo_auto_cota : '';
$numbers = [];
if (!empty($string)) {
    $numbers = explode(',', $string);
};
$cotas_reservadas = count($numbers);

if (substr($string, -1) == ',') {
    $cotas_reservadas--;
}


$paid_and_pending = $pending_numbers + $paid_numbers;
$total_reservadas = $paid_numbers;

if ($status_auto_cota == 0) {
    $cotas_reservadas = 0;
}

$available = (int) $qty_numbers - $paid_and_pending - $cotas_reservadas;
$percent = (($paid_and_pending + $cotas_reservadas) * 100) / $qty_numbers;
$enable_share = $_settings->info('enable_share');
$enable_groups = $_settings->info('enable_groups');
$telegram_group_url = $_settings->info('telegram_group_url');
$whatsapp_group_url = $_settings->info('whatsapp_group_url');
$support_number = $_settings->info('phone');
$theme = $_settings->info('theme');
$bgTheme = "";
$textTheme = "";
if ($theme == 1) {
    $bgTheme = "bg-white";
    $textTheme = "text-dark";
} else if ($theme == 2) {
    $bgTheme = "bg-dark";
    $textTheme = "text-light";
} else if ($theme == 3) {
    $bgTheme = "bg-secondary";
    $textTheme = "text-light";
} else if ($theme == 4) {
    $bgTheme = "bg-primary-custom";
    $textTheme = "text-light";
} else if ($theme == 5) {
    $bgTheme = "bg-dark";
    $textTheme = "text-light";
}



$max_discount = 0;
if ($available < $min_purchase) {
    $min_purchase = $available;
}
$enable_cpf = $_settings->info('enable_cpf');

if ($enable_cpf == 1) {
    $search_type = 'search_orders_by_cpf';
} else {
    $search_type = 'search_orders_by_phone';
}

$major = [];
$minor = [];

// Prepare the base SQL query
$sql = 'SELECT * FROM order_list WHERE product_id = ?';

// Prepare and execute the query
$stmt = $conn->prepare($sql);

$stmt->bind_param('s', $id);

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
    $stmt->bind_param('si', $order_number, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Check if a row is fetched
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
    $stmt->bind_param('si', $order_number, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Check if a row is fetched
        $minor['cota'] = $order_number;
        $minor['winner'] = $row['firstname'] . ' ' . $row['lastname'];
        $minor['date_created'] = date('d/m/Y H:i:s', strtotime($row['date_created']));
        $minor['phone'] = $row['phone'];
    }
}

// Close the statement and connection
$stmt->close();
?>

<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style2.css">
<style>
    .hr {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), #343a40, rgba(0, 0, 0, 0));
        margin-block: 4px;
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

    .maior,
    .menor {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column
    }

    .hidden {
        display: none !important;
    }


    .skeleton {
        background-color: #343a40;
        border-radius: 0.2rem;
        font-weight: 600;
        animation: blink 1s infinite;
        cursor: pointer;
        width: 98%;
        height: 12px;
        margin: 6px;


    }

    #overlay,
    .carousel-item {
        width: 100%;
        display: none
    }


    .visually-hidden-focusable:not(:focus):not(:focus-within) {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border: 0 !important
    }

    .d-block {
        display: block !important
    }

    .mt-3 {
        margin-top: 1rem !important
    }

    .sorteio_sorteioShare__247_t {
        position: fixed;
        bottom: 120px;
        right: 12px;
        display: -moz-box;
        display: flex;
        -moz-box-orient: vertical;
        -moz-box-direction: normal;
        flex-direction: column
    }

    .top-compradores {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
        margin-top: 20px
    }

    .comprador {
        margin-right: 3px;
        margin-bottom: 8px;
        border: 1px solid #198754;
        padding: 22px;
        text-align: center;
        margin-left: 10px;
        background: #fff;
        border-radius: 6px;
        min-width: 160px
    }

    .ranking {
        margin-bottom: 5px;
        font-weight: 700;
        font-size: 18px
    }

    .customer-details {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 14px
    }

    #overlay {
        position: fixed;
        top: 0;
        height: 100%;
        background: rgba(0, 0, 0, .8);
        z-index: 99999999
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #ddd;
        border-top: 4px solid <?= $color ?>;
        border-radius: 50%;
        animation: .8s linear infinite sp-anime
    }

    @keyframes sp-anime {
        100% {
            transform: rotate(360deg)
        }
    }

    .is-hide {
        display: none
    }

    @media only screen and (max-width:600px) {
        .custom-image {
            height: 350px !important
        }
    }

    @media only screen and (min-width:768px) {
        .custom-image {
            height: 450px !important
        }
    }

    .btn-primary {
        background-color: #7e3af2;
        border-color: #7e3af2;
    }

    .btn-primary:hover {
        background-color: #7e3af2;
        border-color: #7e3af2;
        opacity: 0.8;
    }

    .btn-primary:focus {
        background-color: #7e3af2;
        border-color: #7e3af2;
    }

    .bg-app-primary-latte {
        --tw-bg-opacity: 1;
        background-color: rgb(245 242 235 /1);
    }

    .rounded-3xl {
        border-radius: 1.5rem;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    .w-full {
        width: 100%;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .relative {
        position: relative;
    }

    .w-\[400px\] {
        width: 400px;
    }

    .aspect-square {
        aspect-ratio: 1 / 1;
    }

    .z-0 {
        z-index: 0;
    }

    .-right-\[160px\] {
        right: -160px;
    }

    .-top-\[40px\] {
        top: -40px;
    }

    .absolute {
        position: absolute;
    }

    .w-\[150px\] {
        width: 150px;
    }

    .bottom-0 {
        bottom: 0;
    }

    .right-0 {
        right: 0;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .flex-col {
        flex-direction: column;
    }

    .flex {
        display: flex;
    }

    .z-10 {
        z-index: 10;
    }

    .top-0 {
        top: 0;
    }

    .text-app-primary-blue {
        --tw-text-opacity: 1;
        color: rgb(40 128 254 / var(--tw-text-opacity));
    }

    .font-bold {
        font-weight: 700;
    }

    .text-base {
        font-size: 1rem;
        line-height: 1.5rem;
    }

    .text-app-neutral-dark-1 {
        --tw-text-opacity: 1;
        color: rgb(3 29 39 / var(--tw-text-opacity));
    }

    .font-bold {
        font-weight: 700;
    }

    .text-base {
        font-size: 1rem;
        line-height: 1.5rem;
    }

    .mb-3 {
        margin-bottom: .75rem;
    }

    .px-3 {
        padding-left: .75rem;
        padding-right: .75rem;
    }

    .bg-app-neutral-dark-1 {
        --tw-bg-opacity: 1;
        background-color: rgb(3 29 39 / var(--tw-bg-opacity));
    }

    .rounded-2xl {
        border-radius: 1rem;
    }

    .justify-around {
        justify-content: space-around;
    }

    .items-center {
        align-items: center;
    }

    .w-fit {
        width: -moz-fit-content;
        width: fit-content;
    }

    .h-4 {
        height: 1rem;
    }

    .inline {
        display: inline;
    }

    .ml-1 {
        margin-left: .25rem;
    }
</style>
<style>
    .carousel,
    .carousel-inner,
    .carousel-item {
        position: relative;
    }

    #overlay,
    .carousel-item {
        width: 100%;
        display: none;
    }

    @media (min-width: 1200px) {
        h3 {
            font-size: 1.75rem;
        }
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    img {
        vertical-align: middle;
    }

    button {
        border-radius: 0;
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        text-transform: none;
    }

    button:focus:not(:focus-visible) {
        outline: 0;
    }

    [type=button],
    button {
        -webkit-appearance: button;
    }

    .form-control-color:not(:disabled):not([readonly]),
    .form-control[type=file]:not(:disabled):not([readonly]),
    [type=button]:not(:disabled),
    [type=reset]:not(:disabled),
    [type=submit]:not(:disabled),
    button:not(:disabled) {
        cursor: pointer;
    }

    ::-moz-focus-inner {
        padding: 0;
        border-style: none;
    }

    ::-webkit-datetime-edit-day-field,
    ::-webkit-datetime-edit-fields-wrapper,
    ::-webkit-datetime-edit-hour-field,
    ::-webkit-datetime-edit-minute,
    ::-webkit-datetime-edit-month-field,
    ::-webkit-datetime-edit-text,
    ::-webkit-datetime-edit-year-field {
        padding: 0;
    }

    ::-webkit-inner-spin-button {
        height: auto;
    }

    ::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    ::-webkit-color-swatch-wrapper {
        padding: 0;
    }

    ::-webkit-file-upload-button {
        font: inherit;
        -webkit-appearance: button;
    }

    ::file-selector-button {
        font: inherit;
        -webkit-appearance: button;
    }

    .container-fluid {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        width: 100%;
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
        margin-right: auto;
        margin-left: auto;
    }

    .form-control::file-selector-button {
        padding: .375rem .75rem;
        margin: -.375rem -.75rem;
        -webkit-margin-end: .75rem;
        margin-inline-end: .75rem;
        color: #212529;
        background-color: #e9ecef;
        pointer-events: none;
        border: 0 solid;
        border-inline-end-width: 1px;
        border-radius: 0;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        border-color: inherit;
    }

    .form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button {
        background-color: #dde0e3;
    }

    .form-control:hover:not(:disabled):not([readonly])::file-selector-button {
        background-color: #dde0e3;
    }

    .form-control-sm::file-selector-button {
        padding: .25rem .5rem;
        margin: -.25rem -.5rem;
        -webkit-margin-end: .5rem;
        margin-inline-end: .5rem;
    }

    .form-control-lg::file-selector-button {
        padding: .5rem 1rem;
        margin: -.5rem -1rem;
        -webkit-margin-end: 1rem;
        margin-inline-end: 1rem;
    }

    .form-floating>.form-control-plaintext:not(:-moz-placeholder-shown),
    .form-floating>.form-control:not(:-moz-placeholder-shown) {
        padding-top: 1.625rem;
        padding-bottom: .625rem;
    }

    .form-floating>.form-control:not(:-moz-placeholder-shown)~label {
        opacity: .65;
        transform: scale(.85) translateY(-.5rem) translateX(.15rem);
    }

    .input-group>.form-control:not(:focus).is-valid,
    .input-group>.form-floating:not(:focus-within).is-valid,
    .input-group>.form-select:not(:focus).is-valid,
    .was-validated .input-group>.form-control:not(:focus):valid,
    .was-validated .input-group>.form-floating:not(:focus-within):valid,
    .was-validated .input-group>.form-select:not(:focus):valid {
        z-index: 3;
    }

    .input-group>.form-control:not(:focus).is-invalid,
    .input-group>.form-floating:not(:focus-within).is-invalid,
    .input-group>.form-select:not(:focus).is-invalid,
    .was-validated .input-group>.form-control:not(:focus):invalid,
    .was-validated .input-group>.form-floating:not(:focus-within):invalid,
    .was-validated .input-group>.form-select:not(:focus):invalid {
        z-index: 4;
    }

    .btn:focus-visible {
        color: var(--bs-btn-hover-color);
        background-color: var(--bs-btn-hover-bg);
        border-color: var(--bs-btn-hover-border-color);
        outline: 0;
        box-shadow: var(--bs-btn-focus-box-shadow);
    }

    .btn-check:focus-visible+.btn {
        border-color: var(--bs-btn-hover-border-color);
        outline: 0;
        box-shadow: var(--bs-btn-focus-box-shadow);
    }

    .btn-check:checked+.btn:focus-visible,
    .btn.active:focus-visible,
    .btn.show:focus-visible,
    .btn:first-child:active:focus-visible,
    :not(.btn-check)+.btn:active:focus-visible {
        box-shadow: var(--bs-btn-focus-box-shadow);
    }

    .btn-link:focus-visible {
        color: var(--bs-btn-color);
    }

    .carousel-inner {
        width: 100%;
        overflow: hidden;
    }

    .carousel-inner::after {
        display: block;
        clear: both;
        content: "";
    }

    .carousel-item {
        float: left;
        margin-right: -100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        transition: transform .6s ease-in-out;
    }

    .carousel-item.active {
        display: block;
    }

    .carousel-control-next,
    .carousel-control-prev {
        position: absolute;
        top: 0;
        bottom: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 15%;
        padding: 0;
        color: #fff;
        text-align: center;
        background: 0 0;
        border: 0;
        opacity: .5;
        transition: opacity .15s;
    }

    .carousel-control-next:focus,
    .carousel-control-next:hover,
    .carousel-control-prev:focus,
    .carousel-control-prev:hover {
        color: #fff;
        text-decoration: none;
        outline: 0;
        opacity: .9;
    }

    .carousel-control-prev {
        left: 0;
    }

    .carousel-control-next {
        right: 0;
    }

    .carousel-control-next-icon,
    .carousel-control-prev-icon {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        background-repeat: no-repeat;
        background-position: 50%;
        background-size: 100% 100%;
    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
    }

    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .carousel-indicators {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 2;
        display: flex;
        justify-content: center;
        padding: 0;
        margin-right: 15%;
        margin-bottom: 1rem;
        margin-left: 15%;
        list-style: none;
    }

    .carousel-indicators [data-bs-target] {
        box-sizing: content-box;
        flex: 0 1 auto;
        width: 30px;
        height: 3px;
        padding: 0;
        margin-right: 3px;
        margin-left: 3px;
        text-indent: -999px;
        cursor: pointer;
        background-color: #fff;
        background-clip: padding-box;
        border: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        opacity: .5;
        transition: opacity .6s;
    }

    @media (prefers-reduced-motion: reduce) {
        .form-control::file-selector-button {
            transition: none;
        }

        .carousel-control-next,
        .carousel-control-prev,
        .carousel-indicators [data-bs-target],
        .carousel-item {
            transition: none;
        }
    }

    .carousel-indicators .active {
        opacity: 1;
    }

    .visually-hidden-focusable:not(:focus):not(:focus-within) {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border: 0 !important;
    }

    .d-block {
        display: block !important;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .sorteio_sorteioShare__247_t {
        position: fixed;
        bottom: 120px;
        right: 12px;
        display: flex;
        flex-direction: column;
    }

    .top-compradores {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .comprador {
        margin-right: 3px;
        margin-bottom: 8px;
        border: 1px solid #198754;
        padding: 22px;
        text-align: center;
        margin-left: 10px;
        background: #fff;
        border-radius: 6px;
        min-width: 160px;
    }

    .ranking {
        margin-bottom: 5px;
        font-weight: 700;
        font-size: 18px;
    }

    .customer-details {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 14px;
    }

    #overlay {
        position: fixed;
        top: 0;
        height: 100%;
        background: rgba(0, 0, 0, .8);
        z-index: 99999999;
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #ddd;
        border-top: 4px solid #2e93e6;
        border-radius: 50%;
        animation: .8s linear infinite sp-anime;
    }

    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }

    .is-hide {
        display: none;
    }

    @media only screen and (max-width: 600px) {
        .custom-image {
            height: 350px !important;
        }
    }

    @media only screen and (min-width: 768px) {
        .custom-image {
            height: 450px !important;
        }
    }

    .animation-r {
        transition: 0.5s ease-in-out;
    }

    .accordion-collapse {
        transition: 0.7s ease-in-out !important;
    }

    .rotate {
        transform: rotate(405deg);
    }
</style>


<div id="overlay">
    <div class="cv-spinner">
        <div class="card" style="border:none; padding:10px;background: transparent;color: #fff !important;font-weight: 800;">
            <span class="spinner mb-2" style="align-self:center;"></span>
            <div class="text-center font-xs">
                Estamos gerando seu pedido, aguarde...
            </div>
        </div>
    </div>
</div>
<div class="container app-main">
    <div class="campanha-header SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR pointer custom-highlight-card">
        <div style="bottom: 96px !important; " class="custom-badge-display">
            <?php
            if ($status_display == 1) { ?>
                <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
            <?php }
            if ($status_display == 2) { ?>
                <span class="badge bg-dark blink font-xsss mobile badge-status-1">Corre que está acabando!</span>
            <?php }
            if ($status_display == 3) { ?>
                <span class="badge bg-dark font-xsss mobile badge-status-3">Aguarde a campanha!</span>
            <?php }
            if ($status_display == 4) { ?>
                <span class="badge bg-dark font-xsss">Concluído</span>
            <?php }
            if ($status_display == 5) { ?>
                <span class="badge bg-dark font-xsss">Em breve!</span>
            <?php }
            if ($status_display == 6) { ?>
                <span class="badge bg-dark font-xsss">Aguarde o sorteio!</span>
            <?php }
            ?>
        </div>
        <div class="SorteioTpl_imagemContainer__2-pl4 col-auto">
            <div id="carouselSorteio640d0a84b1fef407920230311" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <?php
                    $image_gallery = isset($image_gallery) ? $image_gallery : '';
                    if ($image_gallery != '[]' && !empty($image_gallery)) {
                        $image_gallery = json_decode($image_gallery, true);
                        array_unshift($image_gallery, $image_path);
                        $slide = 0;

                        foreach ($image_gallery as $image) {
                            ++$slide;
                    ?>
                            <div class="custom-image carousel-item <?= ($slide == 1) ? 'active' : '' ?>">
                                <?php
                                // if ($slide == 1) {
                                //     echo 'active';
                                // }
                                ?>
                                <img alt="<?php isset($name) ? $name : '' ?>" src=" <?= BASE_URL ?> <?= $image ?>" decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI">
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="custom-image carousel-item active">
                            <img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="<?= isset($name) ? $name : '' ?>"
                                class="SorteioTpl_imagem__2GXxI" style="width:100%">
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
            <?php

            if ($image_gallery != '[]' && !empty($image_gallery)) { ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            <?php } ?>


        </div>
        <div class="SorteioTpl_info__t1BZr custom-content-wrapper <?php echo $status_display != '4' && $status_display != '5' ? 'custom-content-wrapper-details' : ''; ?>">
            <h1 class="SorteioTpl_title__3RLtu"><?php echo isset($name) ? $name : ''; ?></h1>
            <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">
                <?= isset($subtitle) ? $subtitle : '' ?>
            </p>
            <?php
            if ($status_display != '4' && $status_display != '5') {
            ?>
                <div class="btn btn-sm btn-warning box-shadow-08 w-100" data-bs-toggle="modal" data-bs-target="#modal-consultaCompras">
                    <i class="bi bi-cart"></i> Ver meus números
                </div>
            <?php } ?>

        </div>
    </div>
    <div class="campanha-buscas mt-2">
        <div class="row row-gutter-sm">
            <div class="col">
                <div>
                    <?php
                    if (0 < $percent && $enable_progress_bar == 1) { ?>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            <div class="progress-bar bg-success progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow=" <?= number_format($percent, 1, '.', '') ?>"
                                aria-valuemin="0" aria-valuemax="<?= $qty_numbers ?>" style="width: <?= number_format($percent, 1, '.', '') ?>%">

                                <?= number_format($percent, 1, '.', ''); ?>%</div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php




    if ($status_display == '6') { ?>
        <div class="alert alert-warning font-xss mb-2 mt-2">Todos os números já foram reservados ou pagos</div>
        <?php  }

    $discount_qty = isset($discount_qty) ? $discount_qty : '';
    $discount_amount = isset($discount_amount) ? $discount_amount : '';
    if ($available > 0 && $discount_qty && $discount_amount && $enable_discount == 1) {
        $discount_qty = json_decode($discount_qty, true);
        $discount_amount = json_decode($discount_amount, true);

        $discounts = [];

        foreach ($discount_qty as $qty_index => $qty) {
            foreach ($discount_amount as $amount_index => $amount) {
                if ($qty_index === $amount_index) {
                    $discounts[$qty_index] = ['qty' => $qty, 'amount' => $amount];
                }
            }
        }

        if (isset($discounts)) {
            $max_discount = count($discounts);
        } else {
            $max_discount = 0;
        }


        if ($status == '1') { ?>
            <div class="campanha-preco porApenas font-xs d-flex align-items-center justify-content-center mt-2 mb-2 font-weight-500">
                <div class="item d-flex align-items-center font-xs me-2">
                    <?php
                    if (!empty($date_of_draw)) { ?>
                        <span class="ms-2 me-1">Campanha</span>
                        <div class="tag btn btn-sm bg-white bg-opacity-50 font-xss box-shadow-08">
                            <?php
                            $dataFormatada = date('d/m/y', strtotime($date_of_draw));
                            $horaFormatada = date('H\\hi', strtotime($date_of_draw));
                            $date_of_draw = $dataFormatada . ' às ' . $horaFormatada;
                            echo $date_of_draw;
                            ?>
                        </div>
                    <?php  } ?>

                </div>
                <div class="item d-flex align-items-center font-xs">
                    <div class="me-1"><i class="bi bi-ticket"></i></div>
                    <div class="me-1">por apenas</div>
                    <div class="tag btn btn-sm bg-cor-primaria text-cor-primaria-link box-shadow-08">R$ <?= isset($price) ? format_num($price, 2) : '' ?>
                    </div>
                </div>
            </div>
        <?php
        }


        if ($available > 0 && $enable_sale == 1 && $enable_discount == 0 && $status == '1') { ?>
            <div class="app-promocao-numeros mb-2">
                <div class="app-title mb-2">
                    <?php if (!$roleta && !$box) { ?>
                        <h1>📣 Promoção</h1>
                    <?php } else if ($roleta) { ?>
                        <h1>🎯 Roleta Premiada</h1>
                    <?php } else if ($box) { ?>
                        <h1>🎁 Caixa Premiada</h1>
                    <?php
                    }
                    ?>
                    <div class="app-title-desc">prêmios instantâneos</div>
                </div>
                <div class="app-card card">
                    <div class="card-body pb-1">
                        <div class="row px-2">
                            <div class="col-auto px-1 mb-2">
                                <button onclick="qtyRaffle(<?= $sale_qty ?>, false)" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss">
                                    <span class="font-weight-500">Comprando<b class="font-weight-600"><span><?= $sale_qty ?> cotas</span>
                                        </b> sai por apenas<small> R$</small>
                                        <span class="font-weight-600"><?= number_format($sale_price, 2, ',', '.') ?>
                                        </span> cada</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }


    if ($available > 0 && $status == '1') {

        ?>

        <div class="app-vendas-express mb-2">
            <div class="card <?= $bgTheme ?>">
                <div class="card-body">
                    <div class="text-center">
                        <p class="font-xs">Quanto mais comprar, maiores são as suas chances de ganhar!</p>
                    </div>
                    <div class="numeros-select d-flex align-items-center justify-content-center flex-column">
                        <div class="vendasExpressNumsSelect v2">
                            <div onclick="qtyRaffle(<?= $qty_select_1 ?>,false)" class="item mb-2">
                                <div class="item-content bg-warning text-dark flex-column p-2">
                                    <h3 class="mb-0 text-dark"><small class="item-content-plus text-dark font-xsss">+</small><?= $qty_select_1 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>
                            <div onclick="qtyRaffle(<?= $qty_select_2 ?>, false)" class="item mb-2" style="position: relative;">
                                <div class="bg-warning text-dark px-3 py-1 rounded" style="position: absolute; top: -10px;font-size: 12px;">
                                    Mais popular
                                </div>
                                <div class="item-content bg-dark text-warning flex-column p-2">
                                    <h3 class="mb-0 text-warning"><small class="item-content-plus text-warning font-xsss">+</small><?= $qty_select_2 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>
                            <div onclick="qtyRaffle(<?= $qty_select_3 ?>, false)" class="item mb-2">
                                <div class="item-content bg-warning text-dark flex-column p-2">
                                    <h3 class="mb-0 text-dark"><small class="item-content-plus text-dark font-xsss">+</small><?= $qty_select_3 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>
                            <div onclick="qtyRaffle(<?= $qty_select_4 ?>, false)" class="item mb-2">
                                <div class="item-content bg-warning text-dark flex-column p-2">
                                    <h3 class="mb-0 text-dark"><small class="item-content-plus text-dark font-xsss">+</small><?= $qty_select_4 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>
                            <div onclick="qtyRaffle(<?= $qty_select_5 ?>, false)" class="item mb-2">
                                <div class="item-content bg-warning text-dark flex-column p-2">
                                    <h3 class="mb-0 text-dark"><small class="item-content-plus text-dark font-xsss">+</small><?= $qty_select_5 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>
                            <div onclick="qtyRaffle(<?= $qty_select_6 ?>, false)" class="item mb-2">
                                <div class="item-content bg-warning text-dark flex-column p-2">
                                    <h3 class="mb-0 text-dark"><small class="item-content-plus text-dark font-xsss">+</small><?= $qty_select_6 ?></h3>
                                    <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex w-100 justify-content-center align-items-center">

                            <div class="vendasExpressNums" style="width: 200px;">
                                <div class="d-flex align-items-center justify-content-center font-xss p-1">
                                    <div class="left pointer">
                                        <div class="removeNumero numeroChange"><i class="bi bi-dash-circle"></i></div>
                                    </div>
                                    <div class="center w-50">
                                        <input class="form-control text-center qty" readonly value="<?= isset($min_purchase) ? $min_purchase : '' ?>" aria-label="Quantidade de números" placeholder="<?= isset($min_purchase) ? $min_purchase : '' ?>">

                                    </div>
                                    <div class="right pointer">
                                        <div class="addNumero numeroChange"><i class="bi bi-plus-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div id="total" class="fs-5 fw-bold text-nowrap">R$
                                <?php

                                if (isset($price)) {
                                    $price_total = $price * $min_purchase;
                                    echo format_num($price_total, 2);
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($user_id) { ?>
                <button id="add_to_cart" data-bs-toggle="modal" data-bs-target="#modal-checkout" class="btn btn-dark text-warning w-100 mt-3 mb-2">

                <?php } else { ?>
                    <span id="add_to_cart"></span>
                    <button data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-dark text-warning w-100 mt-3 mb-2">
                    <?php } ?>
                    <div class="d-flex align-items-center justify-content-center gap-2 fs-4">
                        <i class="bi bi-ticket"></i>
                        <div class="">Participar</div>
                    </div>
                    </button>
                <?php

            }
            if ($description) {
                ?>
                    <div class="accordion mb-2" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-warning w-100 fs-6 btn-descricao d-flex align-items-center justify-content-center gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                                    <div class="animation-r"><i class="bi bi-plus-circle"></i></div>
                                    <div>Descrição/Regulamento</div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body <?= $bgTheme ?>">
                                    <?= blockHTML($description) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
            }
            if ($available > 0 && $status == '1' && $enable_discount == 1) { ?>

                    <div class="app-promocao-numeros mb-2">
                        <div class="app-title mb-2">
                            <?php if (!$roleta && !$box) { ?>
                                <h1>📣 Promoção</h1>
                            <?php } else if ($roleta) { ?>
                                <h1>🎯 Roleta Premiada</h1>
                            <?php } else if ($box) { ?>
                                <h1>🎁 Caixa Premiada</h1>
                            <?php
                            }
                            ?>
                            
                            <div class="app-title-desc">Compre mais barato!</div>
                            
                        </div>
                        <div class="card <?= $bgTheme ?>">
                            <div class="card-body pb-1">
                                <div class="">
                                    <?php
                                    $count = 0;

                                    foreach ($discounts as $discount) {
                                        if (!$roleta && !$box) { ?>

                                            <div class="px-1 mb-2">
                                                <?php

                                                if ($user_id) { ?>
                                                    <button onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn btn-warning w-100 btn-sm py-0 px-2 text-nowrap font-xss">
                                                    <?php } else { ?>
                                                        <span id="add_to_cart"></span>
                                                        <button data-bs-toggle="modal" data-bs-target="#loginModal" onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn btn-warning w-100  text-nowrap font-xss">

                                                        <?php  } ?>

                                                        <span class="font-weight-500">
                                                            <b class="font-weight-600">
                                                                <span class="fs-6" id="discount_qty_<?= $count ?>"><?= $discount['qty'] ?></span>
                                                            </b>
                                                            <small>bilhetes por </small> <span class="font-weight-600 fs-6"><span id="discount_amount_<?= $count ?>" style="display:none">
                                                                    <?= $discount['amount'] ?>
                                                                </span>
                                                                <?php
                                                                $discount_price = $price * $discount['qty'] - $discount['amount'];
                                                                echo 'R$ ' . number_format($discount_price, 2, ',', '.');
                                                                ?>

                                                            </span>
                                                        </span>
                                                        </button>
                                            </div>
                                        <?php } else if ($roleta) { ?>
                                            <div class="mb-1">
                                                <?php if ($user_id) { ?>
                                                    <button onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn w-100 text-center mb-1 lh-1 bg-gradient-yellow text-white">
                                                    <?php } else { ?>
                                                        <span id="add_to_cart"></span>
                                                        <button data-bs-toggle="modal" data-bs-target="#loginModal" onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn w-100 text-center bg-gradient-yellow mb-1 text-white">
                                                        <?php } ?>
                                                        <div class="row mb-1 font-xs">
                                                            <div class="col pe-0 ps-0">
                                                                <div><span class="fs-6" id="discount_qty_<?= $count ?>"><?= $discount['qty'] ?></span> Títulos</div>
                                                                <div class="opacity-75 font-xs"><small>por R$ </small>
                                                                    <span id="discount_amount_<?= $count ?>" style="display:none">
                                                                        <?= $discount['amount'] ?>
                                                                    </span>
                                                                    <?php
                                                                    $discount_price = $price * $discount['qty'] - $discount['amount'];
                                                                    echo 'R$ ' . number_format($discount_price, 2, ',', '.');
                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div>Recebe <?= $discount['qty'] ?></div>

                                                                <div class="font-xs">Roletas Instantâneas</div>
                                                            </div>
                                                            <div class="col-auto" style="font-size: 30px;">🎯</div>
                                                        </div>
                                                        </button>
                                                    </button>

                                                <?php } else if ($box) { ?>
                                                    <div class="mb-1">
                                                        <?php if ($user_id) { ?>
                                                            <div onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn w-100 text-center lh-1 bg-gradient-yellow text-white">
                                                            <?php } else { ?>
                                                                <div data-bs-toggle="modal" data-bs-target="#loginModal" onclick="qtyRaffle(<?= $discount['qty'] ?>, true)" class="btn w-100 text-center lh-1 bg-gradient-yellow text-white">
                                                                <?php } ?>
                                                                <div class="row mb-1 font-xs">
                                                                    <div class="col pe-0 ps-0">
                                                                        <div><span class="fs-6" id="discount_qty_<?= $count ?>"><?= $discount['qty'] ?></span> Títulos</div>
                                                                        <div class="opacity-75 font-xs"><small>por R$ </small>
                                                                            <span id="discount_amount_<?= $count ?>" style="display:none">
                                                                                <?= $discount['amount'] ?>
                                                                            </span>
                                                                            <?php
                                                                            $discount_price = $price * $discount['qty'] - $discount['amount'];
                                                                            echo 'R$ ' . number_format($discount_price, 2, ',', '.');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div>Recebe <?= $discount['qty'] ?></div>
                                                                        <div class="font-xs">Caixas Instantâneas</div>
                                                                    </div>
                                                                    <div class="col-auto" style="font-size:30px">🎁</div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    <?php
                                                    ++$count;
                                                }
                                                    ?>
                                                    </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <?php

            }



            if (!empty($draw_number)) {
                $winners_qty = 5;
                $draw_number = isset($draw_number) ? $draw_number : '';
                if ($winners_qty && $draw_number) {
                    $draw_winner = json_decode($draw_winner, true);
                    $draw_number = json_decode($draw_number, true);
                    $winners = [];

                    foreach ($draw_winner as $qty_index => $name) {
                        foreach ($draw_number as $amount_index => $number) {
                            $query = $conn->query('SELECT CONCAT(firstname, \' \', lastname) as name, avatar FROM customer_list WHERE phone = \'' . $name . '\'');
                            $rowCustomer = $query->fetch_assoc();

                            if ($qty_index === $amount_index) {
                                $winners[$qty_index] = [
                                    'name' => $rowCustomer['name'],
                                    'number' => $number,
                                    'image' => $rowCustomer['avatar'] ? validate_image($rowCustomer['avatar']) : BASE_URL . 'assets/img/avatar.png',
                                ];
                            }
                        }
                    }
                }

                $count = 0;

                foreach ($winners as $winner) {
                    ++$count;
        ?>
            <div class="app-card card bg-success text-white mb-2 mt-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="rounded-pill" style="width: 56px; height: 56px; position: relative; overflow: hidden;">
                                <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                                    <img alt="<?= $winner['name'] ?>" src="<?= $winner['image'] ?>" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                    <noscript></noscript>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mb-0" style="text-transform: uppercase;">
                                <?= $count ?>º - <?= $winner['name'] ?><i class="bi bi-check-circle text-white-50"></i>
                            </h5>
                            <div class="text-white-50"><small>Ganhador(a) com a cota <?= $winner['number'] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php

                }
            }



    ?>
    <div class="modal fade" id="modal-consultaCompras">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="consultMyNumbers">
                    <div class="modal-header">
                        <h6 class="modal-title">Consulta de compras</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php

                            if ($enable_cpf != 1) {
                            ?>
                                <label class="form-label">Informe seu telefone</label>
                                <div class="input-group mb-2">
                                    <input onkeyup="formatarTEL(this);" maxlength="15" class="form-control" aria-label="Número de telefone" maxlength="15" id="phone" name="phone" required="" value="">
                                    <button class="btn btn-secondary" type="submit" id="button-addon2">
                                        <div class=""><i class="bi bi-check-circle"></i></div>
                                    </button>
                                </div>
                            <?php
                            } else { ?>
                                <label class="form-label">Informe seu CPF</label>
                                <div class="input-group mb-2">
                                    <input name="cpf" class="form-control" id="cpf" value="" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required>
                                    <button class="btn btn-secondary" type="submit" id="button-addon2">
                                        <div class=""><i class="bi bi-check-circle"></i></div>
                                    </button>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal checkout -->
    <div class="modal fade" id="modal-checkout">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
            <div class="modal-content rounded-0">
                <span class="d-none">Usuário não autenticado</span>
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body checkout">
                    <div class="alert alert-info p-2 mb-2 font-xs"><i class="bi bi-check-circle"></i> Você está adquirindo<span class="font-weight-500">&nbsp;<span id="qty_cotas"></span> cotas</span><span>&nbsp;da ação entre amigos</span><span class="font-weight-500">&nbsp;<?= isset($name) ? $name : '' ?>
                        </span>,<span>&nbsp;seus números serão gerados</span><span>&nbsp;assim que concluir a compra.</span></div>
                    <div class="mb-3">
                        <div class="card app-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="rounded-pill p-1 bg-white box-shadow-08" style="width: 56px; height: 56px; position: relative; overflow: hidden;">
                                            <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                                                <img src="<?= validate_image($_settings->userdata('avatar')) ?>" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                                <noscript></noscript>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mb-1"><?= $_settings->userdata('firstname') ?> <?= $_settings->userdata('lastname') ?></h5>
                                        <div>
                                            <small><?= formatPhoneNumber($_settings->userdata('phone')) ?></small>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-compact-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="place_order" data-id="<?= $_SESSION['ref'] ? $_SESSION['ref'] : '' ?>" class="btn btn-success w-100 mb-2">
                        Concluir reserva <i class="bi bi-arrow-right-circle"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none w-100 my-2"><a href="<?= BASE_URL . 'logout?' . $_SERVER['REQUEST_URI'] ?>">Utilizar outra conta</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal checkout -->
    <!-- Modal Aviso -->
    <button id="aviso_sorteio" data-bs-toggle="modal" data-bs-target="#modal-aviso" class="btn btn-success w-100 py-2" style="display:none"></button>
    <div class="modal fade" id="modal-aviso">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body checkout">
                    <div class="alert alert-danger p-2 mb-2 font-xs aviso-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Aviso -->
    <div class="modal fade" id="modal-indique">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Indique e ganhe!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">Faça login para ter seu link de indicao, e ganhe at 0,00% de créditos nas compras aprovadas!</div>
            </div>
        </div>
    </div>
    <?php
    if ($enable_groups == 1) {
    ?>
        <div class="sorteio_sorteioShare__247_t" style="z-index:10;">
            <div class="campanha-share d-flex mb-1 justify-content-between align-items-center">
                <?php

                if ($enable_share == 1) { ?>

                    <div class="item d-flex align-items-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= BASE_URL ?>campanha/<?= $slug ?>" target="_blank">
                            <div alt="Compartilhe no Facebook" class="sorteio_sorteioShareLinkFacebook__2McKU" style="margin-right:5px;">
                                <i class="bi bi-facebook"></i>
                            </div>
                        </a>
                        <a href="https://t.me/share/url?url=<?= BASE_URL ?>campanha/<?= $slug ?>" text='<?= $name ?>' target="_blank">
                            <div alt="Compartilhe no Telegram" class="sorteio_sorteioShareLinkTelegram__3a2_s" style="margin-right:5px;">
                                <i class="bi bi-telegram"></i>
                            </div>
                        </a>
                        <a href="https://www.twitter.com/share?url=<?= BASE_URL ?>campanha/<?= $slug ?>" target="_blank">
                            <div alt="Compartilhe no Twitter" class="sorteio_sorteioShareLinkTwitter__1E4XC" style="margin-right:5px;">
                                <i class="bi bi-twitter"></i>
                            </div>
                        </a>
                        <a href="https://api.whatsapp.com/send/?text=<?= $name ?>%21%21%3A+<?= BASE_URL ?>campanha/<?= $slug ?>&type=custom_url&app_absent=0" target="_blank">
                            <div alt="Compartilhe no WhatsApp" class="sorteio_sorteioShareLinkWhatsApp__2Vqhy"><i class="bi bi-whatsapp"></i></div>
                        </a>
                    </div>
                <?php
                }

                ?>
            </div>
            <?php

            if ($whatsapp_group_url) {
            ?>
                <a href="<?= $whatsapp_group_url ?>" target="_blank">
                    <div class="whatsapp-grupo">
                        <div class="btn btn-sm btn-success mb-1 w-100"><i class="bi bi-whatsapp"></i> Grupo</div>
                    </div>
                </a>
            <?php
            }


            if ($telegram_group_url) {
            ?>
                <a href="<?= $telegram_group_url ?>" target="_blank">
                    <div class="telegram-grupo">
                        <div class="btn btn-sm btn-danger btn-block text-white mb-1 w-100"><i class="bi bi-instagram"></i> Seguir</div>
                    </div>
                </a>
            <?php
            }


            if ($support_number) { ?>
                <a href="https://api.whatsapp.com/send?phone=55<?= $support_number ?>" target="_blank">
                    <div class="suporte">
                        <div class="btn btn-sm btn-warning mb-1 w-100"><i class="bi bi-headset"></i></i> Suporte</div>
                    </div>
                </a>
            <?php
            }

            ?>
        </div> <?php
            }

                ?>




    <?php
    if ($available > 0 && $status == '1') {
        if ($cotas_premiadas) {
            $cotas_premiada = explode(',', $cotas_premiadas);
    ?>
            <div class="my-3">
                <div class="app-title mb-2">
                    <?php if (!$roleta && !$box) { ?>
                        <h1>🔥 Titulos Premiados</h1>
                    <?php } else if ($roleta) { ?>
                        <h1>🎯 Titulos Premiados</h1>
                    <?php } else if ($box) { ?>
                        <h1>🎁 Titulos Premiados</h1>
                    <?php
                    }
                    ?>

                    <br>
                    <div class="app-title-desc">Título instantâneo</div>
                </div>
                <div class="app-card card">
                    <div class="card-body pb-1">
                        <div id="cotas-container" class=" <?= $bgTheme . " " . $textTheme ?> " style="padding:4px;max-height: auto !important;">
                            <div class="skeleton"></div>
                            <div class="hr"></div>
                            <div class="skeleton"></div>
                            <div class="hr"></div>
                            <div class="skeleton"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    if (0 < $enable_ranking) { ?>
        <div class="app-title mb-2">
            <h1>🏆 Ranking</h1>
            <?php
            if ($ranking_message) {
            ?>
                <br>
                <div class="app-title-desc"><?= $ranking_message ?></div>

            <?php
            }
            ?>
        </div>
        <div class="card <?= $bgTheme ?> flex-row top-compradores" style="padding: 20 0 10 10;border-radius:10px;margin-top:0px;margin-bottom:10px;">
            <?php
            $today = date('Y-m-d');

            if ($ranking_type == 1) {
                $requests = $conn->query("\r\n" . ' SELECT c.firstname, SUM(o.quantity) AS total_quantity' . "\r\n" . ' FROM order_list o' . "\r\n" . ' INNER JOIN customer_list c ON o.customer_id = c.id' . "\r\n" . ' WHERE o.product_id = ' . $id . ' AND o.status = 2' . "\r\n" . ' GROUP BY o.customer_id' . "\r\n" . ' ORDER BY total_quantity DESC' . "\r\n" . ' LIMIT ' . $ranking_qty . "\r\n" . ' ');
            } else {
                $requests = $conn->query("\r\n" . ' SELECT c.firstname, SUM(o.quantity) AS total_quantity' . "\r\n" . ' FROM order_list o' . "\r\n" . ' INNER JOIN customer_list c ON o.customer_id = c.id' . "\r\n" . ' WHERE o.product_id = ' . $id . ' AND o.status = 2' . "\r\n" . ' AND o.date_created BETWEEN \'' . $today . ' 00:00:00\' AND \'' . $today . ' 23:59:59\'' . "\r\n" . ' GROUP BY o.customer_id' . "\r\n" . ' ORDER BY total_quantity DESC' . "\r\n" . ' LIMIT ' . $ranking_qty . "\r\n" . ' ');
            }

            $count = 0;

            while ($row = $requests->fetch_assoc()) {
                ++$count;

                if ($count == 1) {
                    $medal = '🥇';
                } elseif ($count == 2) {
                    $medal = '🥈';
                } elseif ($count == 3) {
                    $medal = '🥉';
                } else {
                    $medal = '👤';
                }

            ?>
                <div class="item-content flex-column" style="max-width:32.7%;min-width:32.7%;">
                    <div class="text-center customer-details" style="border:1px solid;padding:10px;border-radius:5px;margin:5px;">
                        <span style="font-size:20px;"><?= $medal ?>
                        </span><br>
                        <span class="ganhador-name"><?= $row['firstname'] ?>
                        </span>
                        <?php
                        if ($enable_ranking_show == 1) {
                        ?>
                            <p class="font-xss mb-0"><?= $row['total_quantity'] ?> COTAS</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>
    <?php
    }
    if ($quantidade_auto_cota == 1): ?>
        <div class=" app-title mb-2" style="margin-top:16px">
            <h1 style="display:flex; align-items:center;gap:.75rem; margin-left:4px">
                <div class="sc-3f9a15f1-28  line">
                    <span style="line-height: 0.9; " class="{{ $color }}  h-8 w-8 inline-block "><svg
                            xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </span>
                </div> Maior e menor cota
            </h1>
        </div>

        <div class="card <?= $bgTheme ?> sc-3f9a15f1-2 eAApiE bottom-container rounded-3xl w-full relative  mb-6 mt-6" style="border: 2px solid hsla(0, 0%, 100%, .16); padding: .5rem .5rem 1.5rem .5rem;">
            <div class="card-body ">
                <div class="text-center">Geral</div>
                <div class="d-flex justify-content-evenly align-items-center gap-2 text-center">
                    <div class="maior">
                        <h4 style="text-align:center; font-size: 1em !important; margin-block:1rem"><strong>Menor cota</strong></h4>
                        <div class="category-green btn btn-warning mb-2" id="minor-cota">
                            <div class="skeleton" style="width: 100%; display: inline-flex; height: 100%; border-radius: 10px; background-color: inherit !important;"></div>
                        </div>
                        <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px" id="minor-winner">
                            <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                        </span>
                        <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8" id="minor-date">
                            <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                        </span>
                    </div>
                    <div class="menor">
                        <h4 style="text-align:center; font-size: 1em !important; margin-block:1rem"><strong>Maior cota</strong></h4>
                        <div class="category-green btn btn-warning mb-2" id="major-cota">
                            <div class="skeleton"
                                style="width: 100%; display: inline-flex; height: 100%; border-radius: 10px; background-color: inherit !important;"></div>
                        </div>
                        <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px" id="major-winner">
                            <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                        </span>
                        <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8" id="major-date">
                            <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                        </span>
                    </div>
                </div>
                <?php if ($quantidade_auto_cota_diario == 1): ?>
                    <div style="height: 1px !important" class="hr my-3"></div>
                    <div class="text-center">Hoje</div>
                    <div class="d-flex justify-content-evenly align-items-center gap-2 text-center">
                        <div class="maior">
                            <h4 style="text-align:center; font-size: 1em !important; margin-block:1rem"><strong>Menor cota</strong></h4>
                            <div class="category-green btn btn-warning mb-2" id="minor-cota_today">
                                <div class="skeleton" style="width: 100%; display: inline-flex; height: 100%; border-radius: 10px; background-color: inherit !important;"></div>
                            </div>
                            <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px" id="minor-winner_today">
                                <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                            </span>
                            <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8" id="minor-date_today">
                                <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                            </span>
                        </div>
                        <div class="menor">
                            <h4 style="text-align:center; font-size: 1em !important; margin-block:1rem"><strong>Maior cota</strong></h4>
                            <div class="category-green btn btn-warning mb-2" id="major-cota_today">
                                <div class="skeleton"
                                    style="width: 100%; display: inline-flex; height: 100%; border-radius: 10px; background-color: inherit !important;"></div>
                            </div>
                            <span class="text-gray-700 dark:text-gray-400 mb-1" style="font-size: 16px" id="major-winner_today">
                                <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                            </span>
                            <span class="text-gray-700 dark:text-gray-400" style="font-size: 12px; opacity:0.8" id="major-date_today">
                                <div class="skeleton" style="display: inline-flex; width:  100% !important; min-width:75px"></div>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    <?php endif;
    ?>

    <?= $_settings->userdata('is_affiliate') == 1 ? "afiliado" : "" ?>
    <?php if ($status == '1' && $_settings->userdata('is_affiliate') == 1) {
    ?>
        <section style="margin-top: 20px;background-color:#0f121a " class=" rounded-3xl flex overflow-hidden w-full relative mb-6 bg-app-primary-latte">
            <div class="top-0 px-6 xl:px-12 py-6 xl:py-10 z-10 flex flex-col w-full items-center">
                <p style="color:white; margin-bottom:8px" class="font-bold text-base md:text-[32px] ">
                    Compartilhe com seus amigos
                </p>
                <p class="font-bold  md:text-[24px] " style="color:#157347; font-size:0.75rem; margin-bottom:16px ">
                    Ganhe comissões por cada venda!
                </p>
                <?php if ($_settings->userdata('id')) { ?>
                    <div data-bs-toggle="modal" data-bs-target="#modal-afiliado"
                        style="background-color:#157347; border-color:#157347;cursor:pointer;pointer-events:all; margin-inline:auto"
                        class="rounded-2xl py-2 px-3 text-caption bg-app-neutral-dark-1  hover:bg-app-neutral-dark-3 active:bg-app-neutral-dark-2  text-app-neutral-light-1 flex justify-around items-center  w-fit ">
                    <?php } else { ?>
                        <button data-bs-toggle="modal" data-bs-target="#loginModal"
                            style="background-color:#157347;color:#fff; border-color:#157347;cursor:pointer;pointer-events:all; "
                            class="rounded-2xl py-2 px-3 text-caption bg-app-neutral-dark-1  hover:bg-app-neutral-dark-3 active:bg-app-neutral-dark-2  text-app-neutral-light-1 flex justify-around items-center  w-fit ">
                        <?php } ?>


                        <p class="font-bold" style="margin-bottom:0">
                            <?php if ($_settings->userdata('id')) { ?>
                                Gerar link
                            <?php } else { ?>
                                Faça login para aproveitar
                            <?php } ?>
                        </p>
                        </button>
                    </div>
        </section>
    <?php
    } ?>
    <div style="color:#fff;max-height:100%" class="modal fade" tabindex="-1" id="modal-cotas">
        <div class="modal-dialog cotas">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="sc-3f9a15f1-13 byugCZ" style="gap:12px">
                        <div class="sc-3f9a15f1-28 kfFTzL line">🔥</div>
                        <h5 style="font-size: 1.3em !important;color: rgba(var(--incrivel-rgbaInvert), 0.9);padding-right: 5px;font-weight: 600;margin: 0;" class="sc-3f9a15f1-14 jQlWTy">Cotas premiadas</h5>
                    </div>
                    <button type="button" class=" btn btn-link text-dark menu-mobile--button pe-0 font-lgg"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body" style="padding: 4px">
                    <div class="cotas_modal" style="padding:4px; height:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-afiliado" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div style="justify-content: space-between" class="modal-header">
                    <button style="z-index:99999999999999" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="congrats__details">
                    <div class="congrats__title h1">
                        Quase lá!
                    </div>
                    <div class="congrats__content" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">
                        Compartilhe seu link com todo mundo!
                        <button data-bs-toggle="modal" data-bs-target="#modal-afiliado-link"
                            style="background-color:#157347;color:#fff; border-color:#157347;cursor:pointer;pointer-events:all; margin-block: 10px;"
                            class="rounded-2xl py-2 px-3 text-caption bg-app-neutral-dark-1  hover:bg-app-neutral-dark-3 active:bg-app-neutral-dark-2  text-app-neutral-light-1 flex justify-around items-center  w-fit ">
                            <span class="text-caption">Compartilhar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-afiliado-link" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div style="justify-content: space-between" class="modal-header">
                    <button style="z-index:99999999999999" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center; margin-top: -25px; " class="congrats__title h1">
                        Link gerado!
                    </div>
                    <div class="congrats__content" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">
                        Agora é só compartilhar!
                        <div class="share__field mt-4">
                            <input id="affiliate_url" class="share__input" type="text" name="site" disabled
                                value="<?php echo BASE_REF . '?&ref=' . $id; ?>">
                            <button class="share__copy" onclick="copyPix()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-copy icon icon-copy" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                </svg>
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(function() {
        $('.btn-descricao').click(function() {
            $('.animation-r').toggleClass('rotate')
        })
        $('#add_to_cart').click(function() {
            add_cart();
        })
        $('#place_order').click(function() {
            var ref = $(this).attr("data-id");
            place_order(ref);
        })
        $(".addNumero").click(function() {
            let value = parseInt($(".qty").val());
            value++;
            $(".qty").val(value);
            calculatePrice(value);
        })
        $(".removeNumero").click(function() {
            let value = parseInt($(".qty").val());
            if (value <= 1) {
                value = 1;
            } else {
                value--;
            }
            $(".qty").val(value);
            calculatePrice(value);
        })

        function place_order($ref) {
            $("#overlay").fadeIn(300);
            $.ajax({
                url: _base_url_ + 'class/Main.php?action=place_order_process',
                method: 'POST',
                data: {
                    ref: $ref,
                    product_id: parseInt("<?= isset($id) ? $id : '' ?>")
                },
                dataType: 'json',
                error: err => {
                    console.error(err)
                },
                success: function(resp) {
                    console.log(resp)
                    if (resp.status == 'success') {
                        location.replace(resp.redirect)
                    } else if (resp.status == 'pay2m') {
                        alert(resp.error);
                        location.replace(resp.redirect)
                    } else {
                        alert(resp.error);
                        location.reload();
                    }
                }
            })
        }
    })

    function formatCurrency(total) {
        var decimalSeparator = ',';
        var thousandsSeparator = '.';
        var formattedTotal = total.toFixed(2); // Define 2 casas decimais
        // Substitui o ponto pelo separador decimal desejado
        formattedTotal = formattedTotal.replace('.', decimalSeparator);
        // Formata o separador de milhar
        var parts = formattedTotal.split(decimalSeparator);
        parts[0] = parts[0].replace(/\\B(?=(\\d{3})+(?!\\d))/g, thousandsSeparator);
        // Retorna o valor formatado
        return parts.join(decimalSeparator);
    }

    function calculatePrice(qty) {
        let price = '<?= $price ?>'
        let enable_sale = parseInt(<?= $enable_sale ?>);
        let sale_qty = parseInt(<?= $sale_qty ?>);
        let sale_price = <?= $sale_price ?>;
        let available = parseInt(<?= $available ?>);
        let total = price * qty;
        var max = parseInt(<?= isset($max_purchase) ? $max_purchase : '' ?>);
        var min = parseInt(<?= isset($min_purchase) ? $min_purchase : '' ?>);
        if (qty > available) {
            //calculatePrice(available);   
            //alert(\'Há apenas : \' + available + \' cotas disponíveis no momento.\');
            $('.aviso-content').html('Restam apenas ' + available + ' cotas disponíveis no momento.');
            $('#aviso_sorteio').click();
            $(".qty").val(available);
            //total = price * available;
            //$(\'#total\').html(\'R$ \'+formatCurrency(total)+\'\');
            calculatePrice(available);
            return;
        }
        if (qty < min) {
            // calculatePrice(min);   
            //alert(\'A quantidade mínima de cotas é de: \' + min + \'\');
            $('.aviso-content').html('A quantidade mínima de cotas é de: ' + min + '');
            //$(\'#aviso_sorteio\').click();
            $(".qty").val(min);
            total = price * min;
            calculatePrice(min);
            //$(\'#total\').html(\'R$ \'+formatCurrency(total)+\'\');
            return;
        }

        if (qty > max) {
            //alert(\'A quantidade máxima de cotas é de: \' + max + \'\');
            $('.aviso-content').html('A quantidade máxima de cotas é de: ' + max + '');
            //$(\'#aviso_sorteio\').click();
            $(".qty").val(max);
            total = price * max;
            calculatePrice(max);
            //$(\'#total\').html(\'R$ \'+formatCurrency(total)+\'\');
            return;
        }
        // Desconto acumulativo
        var qtd_desconto = parseInt(<?= $max_discount ?>);
        let dropeDescontos = [];
        for (i = 0; i < qtd_desconto; i++) {
            dropeDescontos[i] = {
                qtd: parseInt($(`#discount_qty_${i}`).text()),
                vlr: parseFloat($(`#discount_amount_${i}`).text())
            };
        }
        //console.log(dropeDescontos);
        var drope_desconto_qty = null;
        var drope_desconto = null;
        for (i = 0; i < dropeDescontos.length; i++) {
            if (qty >= dropeDescontos[i].qtd) {
                drope_desconto_qty = dropeDescontos[i].qtd;
                drope_desconto = dropeDescontos[i].vlr;
            }
        }
        var drope_desconto_aplicado = total;
        var desconto_acumulativo = false;
        var quantidade_de_numeros = drope_desconto_qty;
        var valor_do_desconto = drope_desconto;


        <?php
        if ($enable_cumulative_discount == 1) {
        ?>
            desconto_acumulativo = true;
        <?php
        }
        ?>
        if (desconto_acumulativo && qty >= quantidade_de_numeros) {
            var multiplicador_do_desconto = Math.floor(qty / quantidade_de_numeros);
            drope_desconto_aplicado = total - (valor_do_desconto * multiplicador_do_desconto);
        }
        // Aplicar desconto normal quando desconto acumulativo estiver desativado' .
        if (!desconto_acumulativo && qty >= drope_desconto_qty) {
            drope_desconto_aplicado = total - valor_do_desconto;
        }
        if (parseInt(qty) >= parseInt(drope_desconto_qty)) {
            $('#total').html('R$ ' + formatCurrency(drope_desconto_aplicado));
        } else {
            if (enable_sale == 1 && qty >= sale_qty) {
                total_sale = qty * sale_price;
                $('#total').html('De <strike>R$ ' + formatCurrency(total) + '</strike> por R$ ' + formatCurrency(total_sale));
            } else {
                $('#total').html('R$ ' + formatCurrency(total));
            }
        }
        //Fim desconto acumulativo
    }

    function qtyRaffle(qty, opt) {
        qty = parseInt(qty);
        let value = parseInt($(".qty").val());
        let qtyTotal = (value + qty);
        if (opt === true) {
            qtyTotal = (qtyTotal - value);
        }
        $(".qty").val(qtyTotal);
        calculatePrice(qtyTotal);
    }

    function add_cart() {
        let qty = $('.qty').val();
        $('#qty_cotas').text(qty);
        $.ajax({
            url: _base_url_ + "class/Main.php?action=add_to_card",
            method: "POST",
            data: {
                product_id: "<?= isset($id) ? $id : '' ?>",
                qty: qty
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert("[PP01] - An error occured.", 'error');

            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    //location.reload();
                } else if (!!resp.msg) {
                    alert(resp.msg, 'error');
                } else {
                    alert("[PP02] - An error occured.", 'error');
                }
            }
        })
    }
    $(document).ready(function() {
        $('.qty').on('keyup', function() {
            var value = parseInt($(this).val());
            var min = parseInt(<?= isset($min_purchase) ? $min_purchase : '' ?>);
            var max = parseInt(<?= isset($max_purchase) ? $max_purchase : '' ?>);
            if (value < min) {
                calculatePrice(min);
                //alert(\'A quantidade mínima de cotas é de: \' + min + \'\');
                $('.aviso-content').html('A quantidade mínima de cotas é de: ' + min + '');
                $('#aviso_sorteio').click();
                $(".qty").val(min);
            }
            if (value > max) {
                calculatePrice(max);
                //alert(\'A quantidade máxima de cotas é de: \' + max + \'\');
                $('.aviso-content').html('A quantidade máxima de cotas é de: ' + max + '');
                $('#aviso_sorteio').click();
                $(".qty").val(max);
            }
        });
    });
    $(document).ready(function() {
        $('#consultMyNumbers').submit(function(e) {
            e.preventDefault()
            var tipo = "<?= $search_type ?>"

            $.ajax({
                url: _base_url_ + "class/Main.php?action=" + tipo,
                method: 'POST',
                type: 'POST',
                data: new FormData($(this)[0]),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                error: err => {
                    console.log(err)
                    alert('An error occurred')
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        location.href = (resp.redirect)
                    } else {
                        alert('Nenhum registro de compra foi encontrado')
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>
<script>
    function copyPix() {
        var copyText = document.getElementById("affiliate_url");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        document.execCommand("copy");
        navigator.clipboard.writeText(copyText.value);

        alert("Link copiado com sucesso");
    };
    $(document).ready(function() {

        var cotas_array = '<?php echo isset($cotas_premiadas_premios) ? $cotas_premiadas_premios : ''; ?>';
        var product_id = parseInt("<?php echo isset($id) ? $id : ''; ?>");
        var cotas_premiadas = "<?php echo isset($cotas_premiadas) ? $cotas_premiadas : ''; ?>";
        var $quantidade_auto_cota = "<?php echo isset($quantidade_auto_cota) ? $quantidade_auto_cota : ''; ?>";
        $.ajax({
            url: _base_url_ + "class/Main.php?action=load_cotas",

            method: 'POST',
            data: {
                product_id: product_id,
                cotas_premiadas: cotas_premiadas,
                cotas_array: cotas_array,
                quantidade_auto_cota: $quantidade_auto_cota
            },
            success: function(response) {
                var cotas = response.split('<div class="hr"></div>');
                var cotas_premiadas = cotas.slice(0, 3).join('<div class="hr"></div>');
                $('#cotas-container').html(cotas_premiadas);
                $('.cotas_modal').html(response);

            },
            error: function() {
                $('#cotas-container').html('<p>Erro ao carregar as cotas.</p>');
            }
        });


        var raffle = parseInt("<?php echo isset($id) ? $id : ''; ?>");

        $.ajax({
            url: _base_url_ + "class/Main.php?action=search_raffle_smallest_and_largest_number",
            method: 'POST',
            data: {
                raffle: raffle
            },
            success: function(response) {

                var data = JSON.parse(response);
                console.log(data)

                if (data.status == 'success') {
                    $('#major-cota').html(data.major.cota);
                    $('#major-winner').html(data.major.name);
                    $('#major-date').html(data.major.date);

                    $('#minor-cota').html(data.minor.cota);
                    $('#minor-winner').html(data.minor.name);
                    $('#minor-date').html(data.minor.date);

                }

            },
            error: function() {}
        });
        $.ajax({
            url: _base_url_ + "class/Main.php?action=search_raffle_smallest_and_largest_number_today",
            method: 'POST',
            data: {
                raffle: raffle
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data)

                if (data.status == 'success') {
                    $('#major-cota_today').html(data.major.cota);
                    $('#major-winner_today').html(data.major.name);
                    $('#major-date_today').html(data.major.date);

                    $('#minor-cota_today').html(data.minor.cota);
                    $('#minor-winner_today').html(data.minor.name);
                    $('#minor-date_today').html(data.minor.date);

                }

            },
            error: function() {}
        });
    });
</script>