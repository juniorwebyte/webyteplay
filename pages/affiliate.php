<?php

require_once './settings.php';

if (!$_settings->userdata('is_affiliate')) {
    echo '<script>alert(\'Você não tem permissão para acessar essa página\'); ' . "\r\n" . '    location.replace(\'/\');</script>';
    exit();
}

if ($_settings->userdata('id') != '') {
    $qry = $conn->query('SELECT * FROM `customer_list` where id = \'' . $_settings->userdata('id') . '\'');

    if (0 < $qry->num_rows) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }
    }
} else {
    echo '<script>alert(\'Você não tem permissão para acessar essa página\'); ' . "\r\n" . '    location.replace(\'/\');</script>';
    exit();
}

$orders = $conn->query("SELECT amount_paid, amount_pending FROM referral WHERE customer_id = '{$_settings->userdata('id')}' LIMIT 10");
$orders2 = $conn->query("SELECT COUNT(id) FROM order_list WHERE referral_id = '{$_settings->userdata('id')}'");

if ($orders2->num_rows > 0) {
    $rowOrder = $orders2->fetch_assoc();
    $quantity = $rowOrder['COUNT(id)'];
}

if ($orders->num_rows > 0) {
    $row = $orders->fetch_assoc();
    $amount_paid = $row['amount_paid'];
    $amount_pending = $row['amount_pending'];
}
?>
<style>
    .style-0 {
        background: rgb(36, 39, 49) none repeat scroll 0% 0% / auto padding-box border-box;
        position: relative;
        margin-bottom: 68px;
        padding: 16px;
        border-radius: 24px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px 0px 68px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-1 {
        display: flex;
        -webkit-box-align: end;
        align-items: flex-end;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-2 {
        -webkit-box-flex: 1;
        flex-grow: 1;
        padding-right: 20px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px 20px 0px 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-3 {
        font-size: 18px;
        line-height: 23.9999px;
        font-family: Poppins, sans-serif;
        font-weight: 500;
        margin-bottom: 12px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px 0px 12px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-4 {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        margin-bottom: 8px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px 0px 8px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    https: //unityexchange.design/ref?tranmautritam

    .style-5 {
        font-size: 32px;
        line-height: 38.4px;
        letter-spacing: -1px;
        font-family: Poppins, sans-serif;
        font-weight: 600;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-6 {
        background: rgb(255, 159, 56) none repeat scroll 0% 0% / auto padding-box border-box;
        margin-left: 20px;
        display: block;
        padding: 6px 19px;
        border-radius: 16px;
        font-size: 16px;
        line-height: 20px;
        font-weight: 600;
        color: rgb(255, 255, 255);
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px 0px 0px 20px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-7 {
        color: rgb(128, 129, 145);
        font-size: 24px;
        line-height: 31.9999px;
        font-family: Poppins, sans-serif;
        font-weight: 500;
        margin-top: 2px;
        box-sizing: border-box;
        outline: rgb(128, 129, 145) none 0px;
        margin: 2px 0px 0px;
        padding: 0px;
        border: 0px none rgb(128, 129, 145);
        vertical-align: baseline;
    }

    .style-8 {
        position: static;
        flex-shrink: 0;
        width: calc(50% - 12px);
        right: 32px;
        left: 640px;
        bottom: 64px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-9 {
        margin-bottom: 16px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-10 {
        margin-bottom: 8px;
        font-size: 12px;
        line-height: 16px;
        font-weight: 500;
        color: rgb(128, 129, 145);
        box-sizing: border-box;
        outline: rgb(128, 129, 145) none 0px;
        padding: 0px;
        border: 0px none rgb(128, 129, 145);
        vertical-align: baseline;
    }

    .style-11 {
        width: 65%;
        background: rgb(108, 93, 211) none repeat scroll 0% 0% / auto padding-box border-box;
        height: 12px;
        border-radius: 6px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-12 {
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-13 {
        margin-bottom: 8px;
        font-size: 12px;
        line-height: 16px;
        font-weight: 500;
        color: rgb(128, 129, 145);
        box-sizing: border-box;
        outline: rgb(128, 129, 145) none 0px;
        padding: 0px;
        border: 0px none rgb(128, 129, 145);
        vertical-align: baseline;
    }

    .style-14 {
        width: 100%;
        background: rgb(53, 93, 255) none repeat scroll 0% 0% / auto padding-box border-box;
        height: 12px;
        border-radius: 6px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-15 {
        max-width: 100%;
        margin-top: 50px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 50px 0px 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-16 {
        display: flex;
        margin: -24px -12px 0px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-17 {
        border: 1px solid rgba(228, 228, 228, 0.1);
        display: flex;
        -webkit-box-flex: 0;
        flex: 0 0 calc(33% - 24px);
        width: calc(33% - 24px);
        margin: 0px 12px 24px;
        padding: 16px 4px;
        border-radius: 16px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        vertical-align: baseline;
        text-align: center;

    }

    .style-18 {
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        padding: 0px;

        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-19 {
        max-width: 100%;
        vertical-align: middle;
        box-sizing: border-box;
        border: 0px none rgb(255, 255, 255);
        margin: 0px;
        padding: 0px;
    }

    .style-20 {
        -webkit-box-flex: 1;
        flex-grow: 1;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-21 {
        margin-bottom: 4px;
        font-size: 12px;
        line-height: 16px;
        font-weight: 500;
        color: rgb(128, 129, 145);
        box-sizing: border-box;
        outline: rgb(128, 129, 145) none 0px;
        padding: 0px;
        border: 0px none rgb(128, 129, 145);
        vertical-align: baseline;
    }

    .style-22 {
        font-size: 18px;
        line-height: 23.9999px;
        font-family: Poppins, sans-serif;
        font-weight: 500;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-23 {
        margin-top: 12px;
        font-weight: 600;
        color: rgb(79, 191, 103);
        box-sizing: border-box;
        outline: rgb(79, 191, 103) none 0px;
        padding: 0px;
        border: 0px none rgb(79, 191, 103);
        vertical-align: baseline;
    }

    .style-24 {
        border: 1px solid rgba(228, 228, 228, 0.1);
        display: flex;
        -webkit-box-flex: 0;
        flex: 0 0 calc(33% - 24px);
        width: calc(33% - 24px);
        margin: 0px 12px 24px;
        padding: 16px 4px;
        text-align: center;
        border-radius: 16px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        vertical-align: baseline;
    }

    .style-25 {
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-26 {
        max-width: 100%;
        vertical-align: middle;
        box-sizing: border-box;
        border: 0px none rgb(255, 255, 255);
        margin: 0px;
        padding: 0px;
    }

    .style-27 {
        -webkit-box-flex: 1;
        flex-grow: 1;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-28 {
        margin-bottom: 4px;
        font-size: 12px;
        line-height: 16px;
        font-weight: 500;
        color: rgb(128, 129, 145);
        box-sizing: border-box;
        outline: rgb(128, 129, 145) none 0px;
        padding: 0px;
        border: 0px none rgb(128, 129, 145);
        vertical-align: baseline;
    }

    .style-29 {
        font-size: 18px;
        line-height: 23.9999px;
        font-family: Poppins, sans-serif;
        font-weight: 500;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-30 {
        margin-top: 12px;
        font-weight: 600;
        color: rgb(79, 191, 103);
        box-sizing: border-box;
        outline: rgb(79, 191, 103) none 0px;
        padding: 0px;
        border: 0px none rgb(79, 191, 103);
        vertical-align: baseline;
    }

    .style-31 {
        display: none;
        position: absolute;
        top: 32px;
        right: 32px;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
        vertical-align: baseline;
    }

    .style-32 {
        margin-right: 6px;
        background: rgb(53, 93, 255) none repeat scroll 0% 0% / auto padding-box border-box;
        color: rgb(255, 255, 255);
        min-width: 114px;
        height: 48px;
        padding: 0px 24px;
        border-radius: 12px;
        font-family: Inter, sans-serif;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease 0s;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        border: 0px none rgb(255, 255, 255);
        cursor: pointer;
    }

    .style-33 {
        font-size: 16px;
        margin-right: 8px;
        display: inline-block;
        vertical-align: middle;
        width: 1em;
        height: 16px;
        fill: rgb(255, 255, 255);
        box-sizing: border-box;
    }

    .style-34 {
        box-sizing: border-box;
    }

    .style-35 {
        display: inline-block;
        vertical-align: middle;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
    }

    .style-36 {
        border-color: rgba(228, 228, 228, 0.1);
        color: rgb(255, 255, 255);
        min-width: 114px;
        height: 48px;
        padding: 0px 24px;
        border-radius: 12px;
        font-family: Inter, sans-serif;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease 0s;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        cursor: pointer;
    }

    .style-37 {
        fill: rgb(255, 255, 255);
        font-size: 16px;
        margin-right: 8px;
        display: inline-block;
        vertical-align: middle;
        width: 1.06em;
        height: 16px;
        box-sizing: border-box;
    }

    .style-38 {
        box-sizing: border-box;
    }

    .style-39 {
        display: inline-block;
        vertical-align: middle;
        box-sizing: border-box;
        outline: rgb(255, 255, 255) none 0px;
        margin: 0px;
        padding: 0px;
        border: 0px none rgb(255, 255, 255);
    }


    .g-4,
    .gx-4 {
        --bs-gutter-x: 1.5rem;
    }

    .mb-2 {
        margin-bottom: .5rem !important;
    }

    .col-1,
    .col-auto {
        -moz-box-flex: 0;
        flex: 0 0 auto;
    }

    .col-auto {
        width: auto;
    }

    .position-relative {
        position: relative !important;
    }

    .avatar {
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        border-radius: 50rem;
        height: 48px;
        width: 48px;
        transition: all .2s ease-in-out;
    }

    .avatar-xl {
        width: 74px !important;
        height: 74px !important;
    }

    .border-radius-lg {
        border-radius: .75rem !important;
    }

    .shadow-sm {
        -webkit-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        -moz-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .img {
        border: none;
    }

    .img {
        display: block;
        max-width: 100%;
        vertical-align: bottom;
        height: 100%;
        border-radius: 16px
    }
	.relative {
    position: relative;
}

.mb-6 {
    margin-bottom: 1.5rem;
}
.w-full {
    width: 100%;
}
.overflow-hidden {
    overflow: hidden;
}
.rounded-3xl {
    border-radius: 1.5rem;
}
#customers {
    border-collapse: collapse;
    width: 100%;
}
#customers td, #customers tr, #customers th {
    border-bottom: 1px solid hsla(0, 0%, 100%, .16) !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    background-color: transparent !important;
}
#customers td, #customers tr, #customers th {
    border-bottom: 1px solid hsla(0, 0%, 100%, .16) !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    background-color: transparent !important;
}
#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04aa6d;
    color: white;
}
#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}
</style>

<main>
    <div class="container app-main">

        <div class="style-0">
            <div class="style-1">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img class="img" src="<?php echo validate_image($avatar); ?>">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?php echo $firstname . ' ' . $lastname; ?> </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                <?php echo formatPhoneNumber($phone); ?> </p>
                            </p>
                        </div>
                    </div>

                </div>


            </div>
            <div class="style-15">
                <div class="style-16">
                    <div class="style-17">
                        <div class="style-20">
                            <div class="style-21"> Retirado</div>
                            <div class="style-23">R$<?= number_format($amount_paid, 2, ',', '.') ?></div>
                        </div>
                    </div>
                    <div class="style-24">
                        <div class="style-27">
                            <div class="style-28">Saldo</div>
                            <div class="style-30">R$<?= number_format($amount_pending, 2, ',', '.') ?></div>
                        </div>
                    </div>
                    <div class="style-24">
                        <div class="style-27">
                            <div class="style-28">Indicações</div>
                            <div class="style-30"><?= $quantity ?></div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div
                style="margin-top:24px !important; position:relative;margin-bottom:48px;padding:32px;border-radius:16px;background:rgba(0, 0, 0, 0) radial-gradient(103.03% 103.03% at 0% 0%, rgb(208, 128, 255) 0%, rgb(108, 93, 211) 100%) repeat scroll 0% 0% / auto padding-box border-box;color:rgb(255, 255, 255);box-sizing:border-box;outline:rgb(255, 255, 255) none 0px;margin:0px 0px 48px;border:0px none rgb(255, 255, 255);vertical-align:baseline;">
                <div
                    style="font-size:18px;line-height:23.9999px;font-family:Poppins, sans-serif;font-weight:500;max-width:380px;margin-bottom:24px;box-sizing:border-box;outline:rgb(255, 255, 255) none 0px;margin:0px 0px 8px;padding:0px;border:0px none rgb(255, 255, 255);vertical-align:baseline;">
                    Convide seus amigos e ganhe por cada venda!</div>
                <div
                    style="color:rgb(255, 255, 255);margin-bottom:16px;font-size:12px;line-height:16px;font-weight:500;box-sizing:border-box;outline:rgb(255, 255, 255) none 0px;margin:0px 0px 16px;padding:0px;border:0px none rgb(255, 255, 255);vertical-align:baseline;">
                    Compartilhe seu Link</div>
                <div
                    style="position:relative;box-sizing:border-box;outline:rgb(255, 255, 255) none 0px;margin:0px;padding:0px;border:0px none rgb(255, 255, 255);vertical-align:baseline;">
                    <input disabled id="affiliate_url" type="text" value="<?php echo BASE_REF . '?&ref=' . $id; ?>"
                        style="box-shadow:rgba(255, 255, 255, 0.5) 0px 0px 0px 2px;padding-right:8px;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box;color:rgb(255, 255, 255);width: 100%;padding:8px 56px 8px 8px;border-radius:8px;font-family:Inter, sans-serif;font-size:14px;font-weight:600;transition:all 0.2s ease 0s;box-sizing:border-box;outline:rgb(255, 255, 255) none 0px;margin:0px;border:0px none rgb(255, 255, 255);appearance:none;" />
                    <button id="copy"
                        style="background:white; border-top-right-radius:8px; border-bottom-right-radius:8px; padding:8px; position:absolute;top:0px;right:0px;bottom:0px;font-size:0px;font-family:Inter, sans-serif;-webkit-tap-highlight-color:rgba(0, 0, 0, 0);box-sizing:border-box;outline:rgb(0, 0, 0) none 0px;margin:0px;border:0px none rgb(0, 0, 0);cursor:pointer;">

                        <svg style="font-size:14px;transition:opacity 0.2s ease 0s;width: 1em;height:14px;fill:rgb(108, 93, 211);box-sizing:border-box;"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard" viewBox="0 0 16 16">
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                        </svg>
                    </button>
                </div>
            </div>



            <section style="border: 2px solid hsla(0, 0%, 100%, .16);"
                class=" rounded-3xl overflow-hidden w-full relative  mb-6 mt-6 p-4">





                <div class="row justify-content-between w-100 align-items-center mt-4">
                    <div class="col">
                        <div class="app-title">
                            <h1>Últimas referências</h1>
                        </div>
                    </div>
                </div>


                <table id="customers">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Comissão</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$uid = intval($uid); // Garantir que $uid seja um número inteiro
$query = "SELECT o.product_name, o.status, o.total_amount, o.date_created, r.percentage 
          FROM order_list o 
          INNER JOIN referral r ON o.referral_id = r.referral_code 
          WHERE o.status <> 3";

$orders = $conn->query($query);
        while ($row = $orders->fetch_assoc()) {
            $status = $row['status'];
            $product = $row['product_name'];
            $percentage = $row['percentage'];
            $amount = $row['total_amount'];
            $date = $row['date_created'];
        ?>
                        <tr
                            style="
                        border-bottom: 1px solid #ddd;
                    
                        ">
                            <th class="small" scope="row"><?= $product ?> </th>
                            <td class="small">R$<?= number_format(($amount * $percentage) / 100, 2, ',', '.') ?></td>
                            <td class="small">
                                <?= date('d-m-Y', strtotime($date)) . ' às ' . date('H:i', strtotime($date)) ?></td>
                            <td class="small">
                                <?= $status == 1 ? 'Pendente' : 'Aprovado' ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </section>

        </div>

    </div>
	<script>

		$(document).ready(function() {
			var button = $("#copy");
			button.on("click", function() {
				console.log("click");
				var copyText = $("#affiliate_url");
		
				// Selecionar o texto do elemento
				copyText.select();
				copyText[0].setSelectionRange(0, 99999); // Para dispositivos móveis
		
				// Copiar o texto selecionado para a área de transferência
				document.execCommand("copy");
		
				// Usar a API Clipboard para garantir a cópia (opcional)
				navigator.clipboard.writeText(copyText.val()).then(function() {
					alert("Link copiado: " + copyText.val());
				}, function(err) {
					console.error('Erro ao copiar texto: ', err);
				});
			});
		});
		</script>
	
</main>
