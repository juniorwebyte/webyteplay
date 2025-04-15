<?php

$paid_and_pending = $pending_numbers + $paid_numbers;
$available = (int) $qty_numbers - $paid_and_pending;
$percent = ($paid_and_pending * 100) / $qty_numbers;
$enable_share = $_settings->info("enable_share");
$enable_groups = $_settings->info("enable_groups");
$telegram_group_url = $_settings->info("telegram_group_url");
$whatsapp_group_url = $_settings->info("whatsapp_group_url");
$max_discount = 0;


if ($available < $min_purchase) {
    $min_purchase = $available;
}

$enable_cpf = $_settings->info("enable_cpf");

if ($enable_cpf == 1) {
    $search_type = "search_orders_by_cpf";
} else {
    $search_type = "search_orders_by_phone";
}

echo '<div id="overlay">' .
    "\r\n" .
    '  <div class="cv-spinner">' .
    "\r\n" .
    '    <span class="spinner"></span>' .
    "\r\n" .
    " </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    "<style>" .
    "\r\n" .
    '.carousel,.carousel-inner,.carousel-item{position:relative}#overlay,.carousel-item{width:100%;display:none}@media (min-width:1200px){h3{font-size:1.75rem}}p{margin-top:0;margin-bottom:1rem}img{vertical-align:middle}button{border-radius:0;margin:0;font-family:inherit;font-size:inherit;line-height:inherit;text-transform:none}button:focus:not(:focus-visible){outline:0}[type=button],button{-webkit-appearance:button}.form-control-color:not(:disabled):not([readonly]),.form-control[type=file]:not(:disabled):not([readonly]),[type=button]:not(:disabled),[type=reset]:not(:disabled),[type=submit]:not(:disabled),button:not(:disabled){cursor:pointer}::-moz-focus-inner{padding:0;border-style:none}::-webkit-datetime-edit-day-field,::-webkit-datetime-edit-fields-wrapper,::-webkit-datetime-edit-hour-field,::-webkit-datetime-edit-minute,::-webkit-datetime-edit-month-field,::-webkit-datetime-edit-text,::-webkit-datetime-edit-year-field{padding:0}::-webkit-inner-spin-button{height:auto}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-color-swatch-wrapper{padding:0}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}::file-selector-button{font:inherit;-webkit-appearance:button}.container-fluid{--bs-gutter-x:1.5rem;--bs-gutter-y:0;width:100%;padding-right:calc(var(--bs-gutter-x) * .5);padding-left:calc(var(--bs-gutter-x) * .5);margin-right:auto;margin-left:auto}.form-control::file-selector-button{padding:.375rem .75rem;margin:-.375rem -.75rem;-webkit-margin-end:.75rem;margin-inline-end:.75rem;color:#212529;background-color:#e9ecef;pointer-events:none;border:0 solid;border-inline-end-width:1px;border-radius:0;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border-color:inherit}.form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button{background-color:#dde0e3}.form-control:hover:not(:disabled):not([readonly])::file-selector-button{background-color:#dde0e3}.form-control-sm::file-selector-button{padding:.25rem .5rem;margin:-.25rem -.5rem;-webkit-margin-end:.5rem;margin-inline-end:.5rem}.form-control-lg::file-selector-button{padding:.5rem 1rem;margin:-.5rem -1rem;-webkit-margin-end:1rem;margin-inline-end:1rem}.form-floating>.form-control-plaintext:not(:-moz-placeholder-shown),.form-floating>.form-control:not(:-moz-placeholder-shown){padding-top:1.625rem;padding-bottom:.625rem}.form-floating>.form-control:not(:-moz-placeholder-shown)~label{opacity:.65;transform:scale(.85) translateY(-.5rem) translateX(.15rem)}.input-group>.form-control:not(:focus).is-valid,.input-group>.form-floating:not(:focus-within).is-valid,.input-group>.form-select:not(:focus).is-valid,.was-validated .input-group>.form-control:not(:focus):valid,.was-validated .input-group>.form-floating:not(:focus-within):valid,.was-validated .input-group>.form-select:not(:focus):valid{z-index:3}.input-group>.form-control:not(:focus).is-invalid,.input-group>.form-floating:not(:focus-within).is-invalid,.input-group>.form-select:not(:focus).is-invalid,.was-validated .input-group>.form-control:not(:focus):invalid,.was-validated .input-group>.form-floating:not(:focus-within):invalid,.was-validated .input-group>.form-select:not(:focus):invalid{z-index:4}.btn:focus-visible{color:var(--bs-btn-hover-color);background-color:var(--bs-btn-hover-bg);border-color:var(--bs-btn-hover-border-color);outline:0;box-shadow:var(--bs-btn-focus-box-shadow)}.btn-check:focus-visible+.btn{border-color:var(--bs-btn-hover-border-color);outline:0;box-shadow:var(--bs-btn-focus-box-shadow)}.btn-check:checked+.btn:focus-visible,.btn.active:focus-visible,.btn.show:focus-visible,.btn:first-child:active:focus-visible,:not(.btn-check)+.btn:active:focus-visible{box-shadow:var(--bs-btn-focus-box-shadow)}.btn-link:focus-visible{color:var(--bs-btn-color)}.carousel-inner{width:100%;overflow:hidden}.carousel-inner::after{display:block;clear:both;content:""}.carousel-item{float:left;margin-right:-100%;-webkit-backface-visibility:hidden;backface-visibility:hidden;transition:transform .6s ease-in-out}.carousel-item.active{display:block}.carousel-control-next,.carousel-control-prev{position:absolute;top:0;bottom:0;z-index:1;display:flex;align-items:center;justify-content:center;width:15%;padding:0;color:#fff;text-align:center;background:0 0;border:0;opacity:.5;transition:opacity .15s}.carousel-control-next:focus,.carousel-control-next:hover,.carousel-control-prev:focus,.carousel-control-prev:hover{color:#fff;text-decoration:none;outline:0;opacity:.9}.carousel-control-prev{left:0}.carousel-control-next{right:0}.carousel-control-next-icon,.carousel-control-prev-icon{display:inline-block;width:2rem;height:2rem;background-repeat:no-repeat;background-position:50%;background-size:100% 100%}.carousel-control-prev-icon{background-image:url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'%23fff\'%3e%3cpath d=\'M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z\'/%3e%3c/svg%3e")}.carousel-control-next-icon{background-image:url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'%23fff\'%3e%3cpath d=\'M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z\'/%3e%3c/svg%3e")}.carousel-indicators{position:absolute;right:0;bottom:0;left:0;z-index:2;display:flex;justify-content:center;padding:0;margin-right:15%;margin-bottom:1rem;margin-left:15%;list-style:none}.carousel-indicators [data-bs-target]{box-sizing:content-box;flex:0 1 auto;width:30px;height:3px;padding:0;margin-right:3px;margin-left:3px;text-indent:-999px;cursor:pointer;background-color:#fff;background-clip:padding-box;border:0;border-top:10px solid transparent;border-bottom:10px solid transparent;opacity:.5;transition:opacity .6s}@media (prefers-reduced-motion:reduce){.form-control::file-selector-button{transition:none}.carousel-control-next,.carousel-control-prev,.carousel-indicators [data-bs-target],.carousel-item{transition:none}}.carousel-indicators .active{opacity:1}.visually-hidden-focusable:not(:focus):not(:focus-within){position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}.d-block{display:block!important}.mt-3{margin-top:1rem!important}.sorteio_sorteioShare__247_t{position:fixed;bottom:120px;right:12px;display:-moz-box;display:flex;-moz-box-orient:vertical;-moz-box-direction:normal;flex-direction:column}.top-compradores{display:flex;flex-wrap:wrap;margin-bottom:20px;margin-top:20px}.comprador{margin-right:3px;margin-bottom:8px;border:1px solid #198754;padding:22px;text-align:center;margin-left:10px;background:#fff;border-radius:6px;min-width:160px}.ranking{margin-bottom:5px;font-weight:700;font-size:18px}.customer-details{text-transform:uppercase;font-weight:700;font-size:14px}#overlay{position:fixed;top:0;height:100%;background:rgba(0,0,0,.6);z-index:99999999}.cv-spinner{height:100%;display:flex;justify-content:center;align-items:center}.spinner{width:40px;height:40px;border:4px solid #ddd;border-top:4px solid #2e93e6;border-radius:50%;animation:.8s linear infinite sp-anime}@keyframes sp-anime{100%{transform:rotate(360deg)}}.is-hide{display:none}.numero-template{background-color:#37495d;border-radius:5px;margin-bottom:5px;text-align:center;-webkit-user-select:none;-moz-user-select:none;user-select:none;padding:8px;color:#fff;position:relative;transition:background-color .3s ease-in-out;cursor:pointer}.numero-template.numero-template-selected{background-color:#343a40}.sorteio-numeros-selecionados{box-shadow:0 0 10px rgba(0,0,0,.35);transition:opacity .3s ease-in-out,bottom .3s ease-in-out;background-color:var(--incrivel-cardBg);color:#171717;padding:15px 10px 10px;pointer-events:none;border-radius:10px;min-height:96px;max-width:600px;position:-webkit-sticky;position:sticky;margin:0 auto;bottom:-110px;opacity:0;width:90%;z-index:999}.sorteio-numeros-selecionados.sorteio-numeros-selecionados-open{pointer-events:auto;bottom:10px;opacity:1}.loading{padding:10px;border-radius:4px;background-color:#cff4fc;color:#056388;text-align:center}.tooltp::before{content:attr(data-nome);position:absolute;top:-25px;left:50%;transform:translateX(-50%);padding:5px;background-color:#000;color:#fff;font-size:12px;border-radius:3px;opacity:0;visibility:hidden;transition:opacity .3s,visibility .3s}.tooltp:hover::before{opacity:1;visibility:visible}@media only screen and (max-width:600px){.custom-image{height:310px!important}}@media only screen and (min-width:768px){.custom-image{height:450px!important}}' .
    "\r\n" .
    "</style>" .
    "\r\n\r\n" .
    '<div class="container app-main">' .
    "\r\n" .
    '<div class="campanha-header mb-2">' .
    "\r\n" .
    '   <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR pointer custom-highlight-card">' .
    "\r\n" .
    '   <div class="custom-badge-display">' .
    "\r\n" .
    "      ";

if ($status_display == 1) {
    echo '         <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>' .
        "\r\n" .
        "      ";
}

echo "      ";

if ($status_display == 2) {
    echo '         <span class="badge bg-dark blink font-xsss mobile badge-status-1">Corre que está acabando!</span>' .
        "\r\n" .
        "      ";
}

echo "      ";

if ($status_display == 3) {
    echo '         <span class="badge bg-dark font-xsss mobile badge-status-3">Aguarde a campanha!</span>' .
        "\r\n" .
        "      ";
}

echo "      ";

if ($status_display == 4) {
    echo '         <span class="badge bg-dark font-xsss">Concluído</span>' .
        "\r\n" .
        "      ";
}

echo "      ";

if ($status_display == 5) {
    echo '         <span class="badge bg-dark font-xsss">Em breve!</span>' .
        "\r\n" .
        "      ";
}

echo "      ";

if ($status_display == 6) {
    echo '         <span class="badge bg-dark font-xsss">Aguarde o sorteio!</span>' .
        "\r\n" .
        "      ";
}

echo "   </div>" .
    "\r\n" .
    '   <div class="SorteioTpl_imagemContainer__2-pl4 col-auto">' .
    "\r\n" .
    '      <div id="carouselSorteio640d0a84b1fef407920230311" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel">' .
    "\r\n" .
    '         <div class="carousel-inner">' .
    "\r\n" .
    "            ";
$image_gallery = isset($image_gallery) ? $image_gallery : "";
if ($image_gallery != "[]" && !empty($image_gallery)) {
    $image_gallery = json_decode($image_gallery, true);
    array_unshift($image_gallery, $image_path);
    echo "               ";
    $slide = 0;

    foreach ($image_gallery as $image) {
        ++$slide;
        echo '                  <div class="custom-image carousel-item ';

        if ($slide == 1) {
            echo "active";
        }

        echo '">' . "\r\n" . '                     <img alt="';
        echo isset($name) ? $name : "";
        echo '" src="';
        echo BASE_URL;
        echo $image;
        echo '" decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI">' .
            "\r\n" .
            "                  </div>" .
            "\r\n" .
            "               ";
    }

    echo "            ";
} else {
    echo '               <div class="custom-image carousel-item active">' .
        "\r\n" .
        '                  <img src="';
    echo validate_image(isset($image_path) ? $image_path : "");
    echo '" alt="';
    echo isset($name) ? $name : "";
    echo '" class="SorteioTpl_imagem__2GXxI" style="width:100%">' .
        "\r\n" .
        "               </div>" .
        "\r\n" .
        "            ";
}

echo "         </div>" . "\r\n" . "      </div>" . "\r\n" . "      ";
if ($image_gallery != "[]" && !empty($image_gallery)) {
    echo '         <button class="carousel-control-prev" type="button"' .
        "\r\n" .
        '            data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="prev">' .
        "\r\n" .
        '            <span class="carousel-control-prev-icon"></span>' .
        "\r\n" .
        "         </button>" .
        "\r\n" .
        '         <button class="carousel-control-next" type="button"' .
        "\r\n" .
        '            data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="next">' .
        "\r\n" .
        '            <span class="carousel-control-next-icon"></span>' .
        "\r\n" .
        "         </button>" .
        "\r\n" .
        "      ";
}

echo "   </div>" .
    "\r\n" .
    '   <div class="SorteioTpl_info__t1BZr custom-content-wrapper ';
echo $status_display != "4" && $status_display != "5"
    ? "custom-content-wrapper-details"
    : "";
echo '">' . "\r\n" . '      <h1 class="SorteioTpl_title__3RLtu">';
echo isset($name) ? $name : "";
echo "</h1>" .
    "\r\n" .
    '      <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">';
echo isset($subtitle) ? $subtitle : "";
echo "</p>" . "\r\n" . "      ";
if ($status_display != "4" && $status_display != "5") {
    echo '         <div class="btn btn-sm btn-success box-shadow-08 w-100" data-bs-toggle="modal" data-bs-target="#modal-consultaCompras">' .
        "\r\n" .
        '            <i class="bi bi-cart"></i> Ver meus números' .
        "\r\n" .
        "         </div>" .
        "\r\n" .
        "      ";
}

echo "   </div>" . "\r\n" . "   </div>" . "\r\n" . "   </div>" . "\r\n\r\n";

if ($status == "1") {
    echo '<div class="campanha-preco porApenas font-xs d-flex align-items-center justify-content-center mt-2 mb-2 font-weight-500">' .
        "\r\n" .
        '   <div class="item d-flex align-items-center font-xs me-2">' .
        "\r\n" .
        "      ";

    if (!empty($date_of_draw)) {
        echo '         <span class="ms-2 me-1">Campanha</span>' .
            "\r\n" .
            '         <div class="tag btn btn-sm bg-white bg-opacity-50 font-xss box-shadow-08">' .
            "\r\n" .
            "            ";
        $dataFormatada = date("d/m/y", strtotime($date_of_draw));
        $horaFormatada = date("H\\hi", strtotime($date_of_draw));
        $date_of_draw = $dataFormatada . " às " . $horaFormatada;
        echo $date_of_draw;
        echo " " . "\r\n" . "         </div>" . "\r\n" . "      ";
    }

    echo "   </div>" .
        "\r\n" .
        '   <div class="item d-flex align-items-center font-xs">' .
        "\r\n" .
        '      <div class="me-1">por apenas</div>' .
        "\r\n" .
        '      <div class="tag btn btn-sm bg-cor-primaria text-cor-primaria-link box-shadow-08">R$ ';
    echo isset($price) ? format_num($price, 2) : "";
    echo "</div>" . "\r\n" . "   </div>" . "\r\n" . "</div>" . "\r\n";
}

echo "\r\n";

if (!empty($draw_number)) {
    echo "   ";
    $winners_qty = 5;
    $draw_number = isset($draw_number) ? $draw_number : "";
    if ($winners_qty && $draw_number) {
        $draw_winner = json_decode($draw_winner, true);
        $draw_number = json_decode($draw_number, true);
        $winners = [];

        foreach ($draw_winner as $qty_index => $name) {
            foreach ($draw_number as $amount_index => $number) {
                $query = $conn->query(
                    'SELECT CONCAT(firstname, \' \', lastname) as name, avatar FROM customer_list WHERE phone = \'' .
                        $name .
                        '\''
                );
                $rowCustomer = $query->fetch_assoc();

                if ($qty_index === $amount_index) {
                    $winners[$qty_index] = [
                        "name" => $rowCustomer["name"],
                        "number" => $number,
                        "image" => $rowCustomer["avatar"]
                            ? validate_image($rowCustomer["avatar"])
                            : BASE_URL . "assets/img/avatar.png",
                    ];
                }
            }
        }
    }

    echo "      ";
    $count = 0;

    foreach ($winners as $winner) {
        ++$count;
        echo "\r\n" .
            '         <div class="app-card card bg-success text-white mb-2">' .
            "\r\n" .
            '            <div class="card-body">' .
            "\r\n" .
            '               <div class="row align-items-center">' .
            "\r\n" .
            '                  <div class="col-auto">' .
            "\r\n" .
            '                     <div class="rounded-pill" style="width: 56px; height: 56px; position: relative; overflow: hidden;">' .
            "\r\n" .
            '                        <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">' .
            "\r\n" .
            '                           <img alt="';
        echo $winner["name"];
        echo '" src="';
        echo $winner["image"];
        echo '" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">' .
            "\r\n" .
            "                           <noscript></noscript>" .
            "\r\n" .
            "                        </div>" .
            "\r\n" .
            "                     </div>" .
            "\r\n" .
            "                  </div>" .
            "\r\n" .
            '                  <div class="col">' .
            "\r\n" .
            '                     <h5 class="mb-0" style="text-transform: uppercase;">';
        echo $count;
        echo "º - ";
        echo $winner["name"];
        echo '&nbsp;<i class="bi bi-check-circle text-white-50"></i></h5>' .
            "\r\n" .
            '                     <div class="text-white-50"><small>Ganhador(a) com a cota ';
        echo $winner["number"];
        echo "</small></div>" .
            "\r\n" .
            "                  </div>" .
            "\r\n" .
            "               </div>" .
            "\r\n" .
            "            </div>" .
            "\r\n" .
            "         </div>" .
            "\r\n" .
            "      ";
    }

    echo "\r\n";
}

echo "\r\n";

if ($description) {
    echo '   <div class="app-card card font-xs mb-2 sorteio_sorteioDesc__TBYaL">' .
        "\r\n" .
        '      <div class="card-body sorteio_sorteioDescBody__3n4ko">' .
        "\r\n" .
        "         ";
    echo blockHTML($description);
    echo "      </div>" . "\r\n" . "   </div>" . "\r\n";
}

echo "\r\n";
$discount_qty = isset($discount_qty) ? $discount_qty : "";
$discount_amount = isset($discount_amount) ? $discount_amount : "";
if ($discount_qty && $discount_amount && $enable_discount == 1) {
    $discount_qty = json_decode($discount_qty, true);
    $discount_amount = json_decode($discount_amount, true);
    $discounts = [];

    foreach ($discount_qty as $qty_index => $qty) {
        foreach ($discount_amount as $amount_index => $amount) {
            if ($qty_index === $amount_index) {
                $discounts[$qty_index] = ["qty" => $qty, "amount" => $amount];
            }
        }
    }

    if (isset($discounts)) {
        $max_discount = count($discounts);
    } else {
        $max_discount = 0;
    }

    if ($status == "1") {
        echo '<div class="app-promocao-numeros mb-2">' .
            "\r\n" .
            '   <div class="app-title mb-2">' .
            "\r\n" .
            "      <h1>📣 Promoção</h1>" .
            "\r\n" .
            '      <div class="app-title-desc">Compre mais barato!</div>' .
            "\r\n" .
            "   </div>" .
            "\r\n" .
            '   <div class="app-card card">' .
            "\r\n" .
            '      <div class="card-body pb-1">' .
            "\r\n" .
            '         <div class="row px-2">' .
            "\r\n" .
            "         ";
        $count = 0;

        foreach ($discounts as $discount) {
            echo '            <div class="col-auto px-1 mb-2">' .
                "\r\n" .
                "               ";

            if ($user_id) {
                echo '                  <button onclick="qtyRaffle(\'';
                echo $discount["qty"];
                echo '\', true);" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss">' .
                    "\r\n" .
                    "               ";
            } else {
                echo '                  <span id="add_to_cart"></span>' .
                    "\r\n" .
                    '                  <button data-bs-toggle="modal" data-bs-target="#loginModal" onclick="qtyRaffle(\'';
                echo $discount["qty"];
                echo '\', true);" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss">' .
                    "\r\n" .
                    "               ";
            }

            echo '               <span class="font-weight-500">' .
                "\r\n" .
                '                  <b class="font-weight-600"><span id="discount_qty_';
            echo $count;
            echo '">';
            echo $discount["qty"];
            echo '</span></b> <small>por R$</small> <span class="font-weight-600"><span id="discount_amount_';
            echo $count;
            echo '" style="display:none">';
            echo $discount["amount"];
            echo "</span>" . "\r\n" . "                  ";
            $discount_price = $price * $discount["qty"] - $discount["amount"];
            echo number_format($discount_price, 2, ",", ".");
            echo "</span></span></button>" .
                "\r\n" .
                "            </div>" .
                "\r\n" .
                "            ";
            ++$count;
        }

        echo "         </div>" .
            "\r\n" .
            "      </div>" .
            "\r\n" .
            "   </div>" .
            "\r\n" .
            "</div>" .
            "\r\n";
    }
}

echo "\r\n";
if ($enable_sale == 1 && $enable_discount == 0 && $status == "1") {
    echo '  <div class="app-promocao-numeros mb-2">' .
        "\r\n" .
        '   <div class="app-title mb-2">' .
        "\r\n" .
        "      <h1>📣 Promoção</h1>" .
        "\r\n" .
        '      <div class="app-title-desc">Compre mais barato!</div>' .
        "\r\n" .
        "   </div>" .
        "\r\n" .
        '   <div class="app-card card">' .
        "\r\n" .
        '      <div class="card-body pb-1">' .
        "\r\n" .
        '         <div class="row px-2">' .
        "\r\n" .
        '            <div class="col-auto px-1 mb-2">' .
        "\r\n" .
        '               <button onclick="qtyRaffle(\'';
    echo $sale_qty;
    echo '\', false);" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">Comprando' .
        "\r\n" .
        '                  <b class="font-weight-600"><span>';
    echo $sale_qty;
    echo ' cotas</span></b> sai por apenas<small> R$</small> <span class="font-weight-600">' .
        "\r\n" .
        "                     ";
    echo number_format($sale_price, 2, ",", ".");
    echo "</span> cada</span></button>" .
        "\r\n" .
        "               </div>" .
        "\r\n" .
        "            </div>" .
        "\r\n" .
        "         </div>" .
        "\r\n" .
        "      </div>" .
        "\r\n" .
        "   </div>" .
        "\r\n";
}

echo " " . "\r\n\r\n";

if (0 < $enable_ranking) {
    echo '   <div class="app-title mb-2">' .
        "\r\n" .
        "      <h1>🏆 Ranking</h1>" .
        "\r\n" .
        "      ";

    if ($ranking_message) {
        echo '      <br><div class="app-title-desc">';
        echo $ranking_message;
        echo "</div>" . "\r\n" . "   ";
    }

    echo "   </div>" .
        "\r\n" .
        "   " .
        "\r\n" .
        '   <div class="app-card top-compradores" style="padding: 20 0 10 10;border-radius:10px;margin-top:0px;margin-bottom:10px;">' .
        "\r\n" .
        "      ";
    $today = date("Y-m-d");

    if ($ranking_type == 1) {
        $requests = $conn->query(
            "\r\n" .
                "            SELECT c.firstname, SUM(o.quantity) AS total_quantity" .
                "\r\n" .
                "            FROM order_list o" .
                "\r\n" .
                "            INNER JOIN customer_list c ON o.customer_id = c.id" .
                "\r\n" .
                "            WHERE o.product_id = " .
                $id .
                " AND o.status = 2" .
                "\r\n" .
                "            GROUP BY o.customer_id" .
                "\r\n" .
                "            ORDER BY total_quantity DESC" .
                "\r\n" .
                "            LIMIT " .
                $ranking_qty .
                "\r\n" .
                "         "
        );
    } else {
        $requests = $conn->query(
            "\r\n" .
                "            SELECT c.firstname, SUM(o.quantity) AS total_quantity" .
                "\r\n" .
                "            FROM order_list o" .
                "\r\n" .
                "            INNER JOIN customer_list c ON o.customer_id = c.id" .
                "\r\n" .
                "            WHERE o.product_id = " .
                $id .
                " AND o.status = 2" .
                "\r\n" .
                '            AND o.date_created BETWEEN \'' .
                $today .
                ' 00:00:00\' AND \'' .
                $today .
                ' 23:59:59\'' .
                "\r\n" .
                "            GROUP BY o.customer_id" .
                "\r\n" .
                "            ORDER BY total_quantity DESC" .
                "\r\n" .
                "            LIMIT " .
                $ranking_qty .
                "\r\n" .
                "         "
        );
    }

    $count = 0;

    while ($row = $requests->fetch_assoc()) {
        ++$count;

        if ($count == 1) {
            $medal = "🥇";
        } elseif ($count == 2) {
            $medal = "🥈";
        } elseif ($count == 3) {
            $medal = "🥉";
        } else {
            $medal = "👤";
        }

        echo "      " .
            "\r\n" .
            '      <div class="item-content flex-column" style="max-width:32.7%;min-width:32.7%;">' .
            "\r\n" .
            '         <div class="text-center customer-details" style="border:1px solid;padding:10px;border-radius:5px;margin:5px;">' .
            "\r\n" .
            '            <span style="font-size:20px;">';
        echo $medal;
        echo "</span><br>" .
            "\r\n" .
            '            <span class="ganhador-name">';
        echo $row["firstname"];
        echo "</span>" . "\r\n" . "            ";

        if ($enable_ranking_show == 1) {
            echo '               <p class="font-xss mb-0">';
            echo $row["total_quantity"];
            echo " COTAS</p>" . "\r\n" . "            ";
        }

        echo "         </div>" . "\r\n" . "      </div>" . "\r\n" . "   ";
    }

    echo "      " . "\r\n" . "   </div>" . "\r\n\r\n";
}

echo "\r\n";
if ($status == "1" && $cotas_premiadas) {
    echo '   <div class="app-promocao-numeros mb-2">' .
        "\r\n" .
        '   <div class="app-title mb-2">' .
        "\r\n" .
        "      <h1>🔥 Cotas premiadas</h1>" .
        "\r\n" .
        '      <div class="app-title-desc">Achou ganhou!</div>' .
        "\r\n" .
        "   </div>" .
        "\r\n" .
        '   <div class="app-card card font-xs mb-2 sorteio_sorteioDesc__TBYaL">' .
        "\r\n" .
        '      <div class="card-body">' .
        "\r\n" .
        "         ";
    echo $cotas_premiadas_descricao;
    echo "      </div>" . "\r\n" . "   </div>" . "\r\n" . "</div>" . "\r\n";
}

echo "\r\n";
if ($status_display < "3" && (int) $percent < 100 && $status == "1") {
    echo '   <div class="app-title mb-2">' .
        "\r\n\r\n" .
        "      <h1>⚡ Cotas</h1>" .
        "\r\n" .
        '      <div class="app-title-desc">Escolha sua sorte</div>' .
        "\r\n" .
        "   </div>" .
        "\r\n";
}

if ($status == "1") {
    echo '<div class="campanha-seletor mb-2">' .
        "\r\n" .
        '   <div class="d-flex justify-content-between font-weight-600">' .
        "\r\n" .
        '      <div onclick="loadNumbers(1)" class="seletor-item rounded d-flex justify-content-between box-shadow-08 font-xs">' .
        "\r\n" .
        '         <div class="nome bg-white rounded-start text-dark p-2">Livres</div>' .
        "\r\n" .
        '         <div class="num bg-cota text-white p-2 rounded-end">';
    echo $available;
    echo "</div>" .
        "\r\n" .
        "      </div>" .
        "\r\n" .
        '      <div onclick="loadNumbers(2)" class="seletor-item rounded d-flex justify-content-between box-shadow-08 font-xs">' .
        "\r\n" .
        '         <div class="nome bg-white rounded-start text-dark p-2">Reservados</div>' .
        "\r\n" .
        '         <div class="num bg-info text-white p-2 rounded-end">';
    echo $pending_numbers;
    echo "</div>" .
        "\r\n" .
        "      </div>" .
        "\r\n" .
        '      <div onclick="loadNumbers(3)" class="seletor-item rounded d-flex justify-content-between box-shadow-08 font-xs">' .
        "\r\n" .
        '         <div class="nome bg-white rounded-start text-dark p-2">Pagos</div>' .
        "\r\n" .
        '         <div class="num bg-success text-white p-2 rounded-end">';
    echo $paid_numbers;
    echo "</div>" .
        "\r\n" .
        "      </div>" .
        "\r\n" .
        "   </div>" .
        "\r\n" .
        "</div>" .
        "\r\n";
}

echo "\r\n" .
    '<div class="campanha-buscas">' .
    "\r\n" .
    '   <div class="row row-gutter-sm">' .
    "\r\n" .
    '      <div class="col">' .
    "\r\n" .
    '         <div class="mb-2">' .
    "\r\n" .
    "          ";
if (0 < $percent && $enable_progress_bar == 1) {
    echo '            <div class="progress mb-2">' .
        "\r\n" .
        '               <div class="progress-bar bg-info progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' .
        "\r\n" .
        '               <div class="progress-bar bg-success progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow="';
    echo number_format($percent, 1, ".", "");
    echo '" aria-valuemin="0" aria-valuemax="';
    echo $qty_numbers;
    echo '" style="width: ';
    echo number_format($percent, 1, ".", "");
    echo '%;">';
    echo number_format($percent, 1, ".", "");
    echo "%</div>" . "\r\n" . "            </div>" . "\r\n" . "         ";
}

echo "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    "</div>" .
    "\r\n\r\n";

if ($status_display == "6") {
    echo '<div class="alert alert-warning font-xss mb-2 mt-2">Todos os números já foram reservados ou pagos</div>' .
        "\r\n";
}

echo "\r\n";
if ((int) $percent < 100 && $status == "1") {
    echo '  <div class="loading-message"></div>' .
        "\r\n" .
        '  <div class="numeros-list row row-cols-6 row-gutter-sm">' .
        "\r\n" .
        "</div>" .
        "\r\n";
}

echo "</div>" .
    "\r\n" .
    '<div class="modal fade" id="modal-consultaCompras">' .
    "\r\n" .
    '   <div class="modal-dialog modal-md">' .
    "\r\n" .
    '      <div class="modal-content">' .
    "\r\n" .
    '         <form id="consultMyNumbers">' .
    "\r\n" .
    '            <div class="modal-header">' .
    "\r\n" .
    '               <h6 class="modal-title">Consulta de compras</h6>' .
    "\r\n" .
    '               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' .
    "\r\n" .
    "            </div>" .
    "\r\n" .
    '            <div class="modal-body">' .
    "\r\n" .
    '               <div class="form-group">' .
    "\r\n" .
    "               ";

if ($enable_cpf != 1) {
    echo '                  <label class="form-label">Informe seu telefone</label>' .
        "\r\n" .
        '                  <div class="input-group mb-2">' .
        "\r\n" .
        '                     <input onkeyup="formatarTEL(this);" maxlength="15" class="form-control" aria-label="Número de telefone" maxlength="15" id="phone" name="phone" required="" value="">' .
        "\r\n" .
        '                     <button class="btn btn-secondary" type="submit" id="button-addon2">' .
        "\r\n" .
        '                        <div class=""><i class="bi bi-check-circle"></i></div>' .
        "\r\n" .
        "                     </button>" .
        "\r\n" .
        "                  </div>" .
        "\r\n" .
        "               ";
} else {
    echo '                  <label class="form-label">Informe seu CPF</label>' .
        "\r\n" .
        '                  <div class="input-group mb-2">' .
        "\r\n" .
        '                     <input name="cpf" class="form-control" id="cpf" value="" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required>' .
        "\r\n" .
        '                     <button class="btn btn-secondary" type="submit" id="button-addon2">' .
        "\r\n" .
        '                        <div class=""><i class="bi bi-check-circle"></i></div>' .
        "\r\n" .
        "                     </button>" .
        "\r\n" .
        "                  </div>" .
        "\r\n" .
        "               ";
}

echo "               </div>" .
    "\r\n" .
    "            </div>" .
    "\r\n" .
    "         </form>" .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    "<!-- Modal checkout -->" .
    "\r\n" .
    '<div class="modal fade" id="modal-checkout">' .
    "\r\n" .
    '   <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">' .
    "\r\n" .
    '      <div class="modal-content rounded-0">' .
    "\r\n" .
    '         <span class="d-none">Usuário não autenticado</span>' .
    "\r\n" .
    '         <div class="modal-header">' .
    "\r\n" .
    '            <h5 class="modal-title">Checkout</h5>' .
    "\r\n" .
    '            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' .
    "\r\n" .
    "         </div>" .
    "\r\n" .
    '         <div class="modal-body checkout">' .
    "\r\n" .
    '            <div class="alert alert-info p-2 mb-2 font-xs"><i class="bi bi-check-circle"></i> Você está adquirindo<span class="font-weight-500">&nbsp;<span id="qty_cotas"></span> cotas</span><span>&nbsp;da ação entre amigos</span><span class="font-weight-500">&nbsp;';
echo isset($name) ? $name : "";
echo "</span>,<span>&nbsp;seus números serão gerados</span><span>&nbsp;assim que concluir a compra.</span></div>" .
    "\r\n" .
    '            <div class="mb-3">' .
    "\r\n" .
    '               <div class="card app-card">' .
    "\r\n" .
    '                  <div class="card-body">' .
    "\r\n" .
    '                     <div class="row align-items-center">' .
    "\r\n" .
    '                        <div class="col-auto">' .
    "\r\n" .
    '                           <div class="rounded-pill p-1 bg-white box-shadow-08" style="width: 56px; height: 56px; position: relative; overflow: hidden;">' .
    "\r\n" .
    '                              <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">' .
    "\r\n" .
    '                                 <img src="';
echo validate_image($_settings->userdata("avatar"));
echo '" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">' .
    "\r\n" .
    "                                 <noscript></noscript>" .
    "\r\n" .
    "                              </div>" .
    "\r\n" .
    "                           </div>" .
    "\r\n" .
    "                        </div>" .
    "\r\n" .
    '                        <div class="col">' .
    "\r\n" .
    '                           <h5 class="mb-1">';
echo $_settings->userdata("firstname");
echo " ";
echo $_settings->userdata("lastname");
echo "</h5>" .
    "\r\n" .
    '                           <div class="text-muted"><small>';
echo formatPhoneNumber($_settings->userdata("phone"));
echo "</small></div>" .
    "\r\n" .
    "                        </div>" .
    "\r\n" .
    '                        <div class="col-auto"><i class="bi bi-chevron-compact-right"></i></div>' .
    "\r\n" .
    "                     </div>" .
    "\r\n" .
    "                  </div>" .
    "\r\n" .
    "               </div>" .
    "\r\n" .
    "            </div>" .
    "\r\n" .
    '            <button id="place_order" data-id="';
echo $_SESSION["ref"] ? $_SESSION["ref"] : "";
echo '" class="btn btn-success w-100 mb-2">Concluir reserva <i class="bi bi-arrow-right-circle"></i></button>' .
    "\r\n" .
    '            <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none w-100 my-2"><a href="';
echo BASE_URL . "logout?" . $_SERVER["REQUEST_URI"];
echo '">Utilizar outra conta</a></button>' .
    "\r\n\r\n\r\n\r\n\r\n" .
    "         </div>" .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    "<!-- Modal checkout -->" .
    "\r\n\r\n\r\n" .
    "<!-- Modal Aviso -->" .
    "\r\n" .
    '<button id="aviso_sorteio" data-bs-toggle="modal" data-bs-target="#modal-aviso" class="btn btn-success w-100 py-2" style="display:none"></button>' .
    "\r\n" .
    '<div class="modal fade" id="modal-aviso">' .
    "\r\n" .
    '   <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">' .
    "\r\n" .
    '      <div class="modal-content rounded-0">' .
    "\r\n" .
    '         <div class="modal-header">' .
    "\r\n" .
    '            <h5 class="modal-title">Aviso</h5>' .
    "\r\n" .
    '            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' .
    "\r\n" .
    "         </div>" .
    "\r\n" .
    '         <div class="modal-body checkout">' .
    "\r\n" .
    '            <div class="alert alert-danger p-2 mb-2 font-xs aviso-content">' .
    "\r\n\r\n\r\n" .
    "            </div>" .
    "\r\n" .
    "         </div>" .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    "<!-- Modal Aviso -->" .
    "\r\n\r\n\r\n" .
    '<div class="modal fade" id="modal-indique">' .
    "\r\n" .
    '   <div class="modal-dialog modal-dialog-centered modal-lg">' .
    "\r\n" .
    '      <div class="modal-content">' .
    "\r\n" .
    '         <div class="modal-header">' .
    "\r\n" .
    '            <h5 class="modal-title">Indique e ganhe!</h5>' .
    "\r\n" .
    '            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' .
    "\r\n" .
    "         </div>" .
    "\r\n" .
    '         <div class="modal-body text-center">Faça login para ter seu link de indicao, e ganhe at 0,00% de créditos nas compras aprovadas!</div>' .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "</div>" .
    "\r\n" .
    '<div class="sorteio-numeros-selecionados">' .
    "\r\n" .
    '   <div class="row row-gutter-sm align-items-center sorteio_sorteioCheckoutInfo__uriIE">' .
    "\r\n" .
    '      <div class="col-12">' .
    "\r\n" .
    '         <div class="row row-gutter-sm row-cols-4 cotas-checkout" style="min-height: 40px;">' .
    "\r\n\r\n" .
    "         </div>" .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    '      <div class="col-12">' .
    "\r\n" .
    '         <input type="hidden" class="qty" value="0">' .
    "\r\n" .
    '         <span class="addNumero"></span>' .
    "\r\n" .
    '         <span class="removeNumero"></span>' .
    "\r\n" .
    "         ";

if ($user_id) {
    echo '            <button id="add_to_cart" data-bs-toggle="modal" data-bs-target="#modal-checkout" class="btn btn-success w-100 py-3">' .
        "\r\n" .
        "            ";
} else {
    echo '               <span id="add_to_cart"></span>' .
        "\r\n" .
        '               <button data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-success w-100 py-3">' .
        "\r\n" .
        "               ";
}

echo '               <div class="row align-items-center" style="line-height: 85%;">' .
    "\r\n" .
    '                  <div class="col pe-0 text-nowrap"><i class="bi bi-check2-circle me-1"></i><span>Quero participar</span></div>' .
    "\r\n" .
    '                  <div class="col pe-0 text-nowrap price-mobile">' .
    "\r\n" .
    '                     <span id="total">R$ ' .
    "\r\n" .
    "                        ";

if (isset($price)) {
    $price_total = $price * $min_purchase;
    echo format_num($price_total, 2);
}

echo "                     " .
    "\r\n" .
    "                     </span>" .
    "\r\n" .
    "                  </div>" .
    "\r\n" .
    "               </div>" .
    "\r\n" .
    "            </button>" .
    "\r\n" .
    "         </div>" .
    "\r\n" .
    "      </div>" .
    "\r\n" .
    "   </div>" .
    "\r\n" .
    "   ";

if ($enable_groups == 1) {
    echo '      <div class="sorteio_sorteioShare__247_t">' .
        "\r\n" .
        '         <div class="campanha-share d-flex mb-1 justify-content-between align-items-center">' .
        "\r\n" .
        "            ";

    if ($enable_share == 1) {
        echo '               <div class="item d-flex align-items-center">' .
            "\r\n" .
            '                  <a href="https://www.facebook.com/sharer/sharer.php?u=';
        echo BASE_URL;
        echo "campanha/";
        echo $slug;
        echo '" target="_blank">' .
            "\r\n" .
            '                     <div alt="Compartilhe no Facebook" class="sorteio_sorteioShareLinkFacebook__2McKU" style="margin-right:5px;">' .
            "\r\n" .
            '                        <i class="bi bi-facebook"></i>' .
            "\r\n" .
            "                     </div>" .
            "\r\n" .
            "                  </a>" .
            "\r\n\r\n" .
            '                  <a href="https://t.me/share/url?url=';
        echo BASE_URL;
        echo "campanha/";
        echo $slug;
        echo "text=";
        echo $name;
        echo '" target="_blank">' .
            "\r\n" .
            '                     <div alt="Compartilhe no Telegram" class="sorteio_sorteioShareLinkTelegram__3a2_s" style="margin-right:5px;">' .
            "\r\n" .
            '                        <i class="bi bi-telegram"></i>' .
            "\r\n" .
            "                     </div>" .
            "\r\n" .
            "                  </a>" .
            "\r\n\r\n" .
            '                  <a href="https://www.twitter.com/share?url=';
        echo BASE_URL;
        echo "campanha/";
        echo $slug;
        echo '" target="_blank">' .
            "\r\n" .
            '                     <div alt="Compartilhe no Twitter" class="sorteio_sorteioShareLinkTwitter__1E4XC" style="margin-right:5px;">' .
            "\r\n" .
            '                        <i class="bi bi-twitter"></i>' .
            "\r\n" .
            "                     </div>" .
            "\r\n" .
            "                  </a>" .
            "\r\n\r\n" .
            '                  <a href="https://api.whatsapp.com/send/?text=';
        echo $name;
        echo "%21%21%3A+";
        echo BASE_URL;
        echo "campanha/";
        echo $slug;
        echo '&type=custom_url&app_absent=0" target="_blank"><div alt="Compartilhe no WhatsApp" class="sorteio_sorteioShareLinkWhatsApp__2Vqhy"><i class="bi bi-whatsapp"></i></div></a>' .
            "\r\n" .
            "               </div>" .
            "\r\n" .
            "            ";
    }

    echo "         </div>" . "\r\n" . "         ";

    if ($whatsapp_group_url) {
        echo '            <a href="';
        echo $whatsapp_group_url;
        echo '" target="_blank">   ' .
            "\r\n" .
            '               <div class="whatsapp-grupo">' .
            "\r\n" .
            '                  <div class="btn btn-sm btn-success mb-1 w-100"><i class="bi bi-whatsapp"></i> Grupo</div>' .
            "\r\n" .
            "               </div>" .
            "\r\n" .
            "            </a>" .
            "\r\n" .
            "         ";
    }

    echo "         ";

    if ($telegram_group_url) {
        echo '            <a href="';
        echo $telegram_group_url;
        echo '" target="_blank">' .
            "\r\n" .
            '               <div class="telegram-grupo">' .
            "\r\n" .
            '                  <div class="btn btn-sm btn-info btn-block text-white mb-1 w-100"><i class="bi bi-telegram"></i> Telegram</div>' .
            "\r\n" .
            "               </div>" .
            "\r\n" .
            "            </a>" .
            "\r\n" .
            "         ";
    }

    echo "      </div>" . "\r\n" . "   ";
}

echo "</div>" .
    "\r\n\r\n" .
    "<script>" .
    "\r\n" .
    ' $(function(){' .
    "\r\n" .
    '  $(\'#add_to_cart\').click(function(){' .
    "\r\n" .
    "   add_cart();" .
    "\r\n" .
    "})" .
    "\r\n" .
    '  $(\'#place_order\').click(function(){' .
    "\r\n" .
    '   var ref = $(this).attr(\'data-id\');' .
    "\r\n" .
    "   place_order(ref);" .
    "\r\n" .
    "})" .
    "\r\n\r\n" .
    '  $(".addNumero").click(function() {' .
    "\r\n" .
    '     let value = parseInt($(".qty").val());' .
    "\r\n" .
    "     value++;" .
    "\r\n" .
    '     $(".qty").val(value);' .
    "\r\n\r\n" .
    "     calculatePrice(value);" .
    "\r\n\r\n" .
    "  })" .
    "\r\n\r\n" .
    '  $(".removeNumero").click(function() {' .
    "\r\n" .
    '     let value = parseInt($(".qty").val());' .
    "\r\n" .
    "     if (value <= 1) {" .
    "\r\n" .
    "      value = 0;" .
    "\r\n" .
    "   } else {" .
    "\r\n" .
    "      value--;" .
    "\r\n" .
    "   }" .
    "\r\n" .
    '   $(".qty").val(value);' .
    "\r\n" .
    "   calculatePrice(value);" .
    "\r\n" .
    "})" .
    "\r\n\r\n" .
    '  function place_order($ref){' .
    "\r\n" .
    '   $(\'#overlay\').fadeIn(300);' .
    "\r\n" .
    '   var sessao = sessionStorage.getItem(\'valores\');' .
    "\r\n" .
    "   var valores = sessao ? JSON.parse(sessao) : [];" .
    "\r\n" .
    "   " .
    "\r\n" .
    '   $.ajax({' .
    "\r\n" .
    '    url:_base_url_+\'class/Main.php?action=place_order_process\',' .
    "\r\n" .
    '    method:\'POST\',' .
    "\r\n" .
    '    data:{ref: $ref, product_id: parseInt("';
echo isset($id) ? $id : "";
echo '"), numbers: valores},' .
    "\r\n" .
    '    dataType:\'json\',' .
    "\r\n" .
    "    error:err=>{" .
    "\r\n" .
    "     console.log(err)          " .
    "\r\n" .
    "  }," .
    "\r\n" .
    "  success:function(resp){" .
    "\r\n" .
    '          if(resp.status == \'success\'){ ' .
    "\r\n" .
    "           location.replace(resp.redirect)" .
    "\r\n" .
    '          } else if (resp.status == \'pay2m\') {' .
    "\r\n" .
    "          alert(resp.error);" .
    "\r\n" .
    "          location.replace(resp.redirect)" .
    "\r\n" .
    "        } else{" .
    "\r\n" .
    "            alert(resp.error);" .
    "\r\n" .
    "            location.reload();" .
    "\r\n" .
    "         }" .
    "\r\n" .
    "      } " .
    "\r\n\r\n" .
    "})" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    "})" .
    "\r\n" .
    " function formatCurrency(total) {" .
    "\r\n" .
    '  var decimalSeparator = \',\';' .
    "\r\n" .
    '  var thousandsSeparator = \'.\';' .
    "\r\n\r\n" .
    "  var formattedTotal = total.toFixed(2); // Define 2 casas decimais" .
    "\r\n" .
    "  " .
    "\r\n" .
    "  // Substitui o ponto pelo separador decimal desejado" .
    "\r\n" .
    '  formattedTotal = formattedTotal.replace(\'.\', decimalSeparator);' .
    "\r\n" .
    "  " .
    "\r\n" .
    "  // Formata o separador de milhar" .
    "\r\n" .
    "  var parts = formattedTotal.split(decimalSeparator);" .
    "\r\n" .
    "  parts[0] = parts[0].replace(/\\B(?=(\\d{3})+(?!\\d))/g, thousandsSeparator);" .
    "\r\n" .
    "  " .
    "\r\n" .
    "  // Retorna o valor formatado" .
    "\r\n" .
    "  return parts.join(decimalSeparator);" .
    "\r\n" .
    "}" .
    "\r\n\r\n\r\n\r\n" .
    "function calculatePrice(qty){   " .
    "\r\n" .
    '  let price = \'';
echo $price;
echo '\'; ' . "\r\n" . '  let enable_sale = parseInt(\'';
echo $enable_sale;
echo '\');' . "\r\n" . '  let sale_qty = parseInt(\'';
echo $sale_qty;
echo '\');' . "\r\n" . '  let sale_price = \'';
echo $sale_price;
echo '\';' . "\r\n\r\n" . '  let available = parseInt(\'';
echo $available;
echo '\');' .
    "\r\n" .
    "  let total = price * qty;  " .
    "\r\n" .
    '  var max = parseInt(\'';
echo isset($max_purchase) ? $max_purchase : "";
echo '\');' . "\r\n" . '  var min = parseInt(\'';
echo isset($min_purchase) ? $min_purchase : "";
echo '\');' .
    "\r\n\r\n" .
    "  if (qty > available) {" .
    "\r\n" .
    '     $(\'.aviso-content\').html(\'Restam apenas \' + available + \' cotas disponíveis no momento.\');' .
    "\r\n" .
    '     $(\'#aviso_sorteio\').click();' .
    "\r\n" .
    '     $(".qty").val(available);' .
    "\r\n" .
    "     calculatePrice(available); " .
    "\r\n" .
    "     return; " .
    "\r\n" .
    "  } " .
    "\r\n\r\n" .
    "  if (qty < min) {" .
    "\r\n" .
    '     $(".qty").val(0);' .
    "\r\n" .
    '     $(\'.sorteio-numeros-selecionados\').removeClass(\'sorteio-numeros-selecionados-open\');' .
    "\r\n" .
    "     return; " .
    "\r\n" .
    "  } " .
    "\r\n\r\n" .
    "  if(qty > max){" .
    "\r\n" .
    '    //alert(\'A quantidade máxima de cotas é de: \' + max + \'\');' .
    "\r\n" .
    '   $(\'.aviso-content\').html(\'A quantidade máxima de cotas é de: \' + max + \'\');' .
    "\r\n" .
    '   //$(\'#aviso_sorteio\').click();' .
    "\r\n" .
    '   $(".qty").val(max); ' .
    "\r\n" .
    "   total = price * max;" .
    "\r\n" .
    "   calculatePrice(max);" .
    "\r\n" .
    '   //$(\'#total\').html(\'R$ \'+formatCurrency(total)+\'\');' .
    "\r\n" .
    "   return;" .
    "\r\n" .
    "}" .
    "\r\n" .
    "// Desconto acumulativo" .
    "\r\n" .
    'var qtd_desconto = parseInt(\'';
echo $max_discount;
echo '\');' .
    "\r\n\r\n" .
    "let dropeDescontos = [];" .
    "\r\n" .
    "for (i = 0; i < qtd_desconto; i++) {" .
    "\r\n" .
    "  dropeDescontos[i] = {" .
    "\r\n" .
    '    qtd: parseInt($(`#discount_qty_${i}`).text()),' .
    "\r\n" .
    '    vlr: parseFloat($(`#discount_amount_${i}`).text())' .
    "\r\n" .
    " };" .
    "\r\n" .
    "}" .
    "\r\n" .
    "//console.log(dropeDescontos);" .
    "\r\n\r\n" .
    "var drope_desconto_qty = null;" .
    "\r\n" .
    "var drope_desconto = null;" .
    "\r\n\r\n" .
    "for (i = 0; i < dropeDescontos.length; i++) {" .
    "\r\n" .
    "  if (qty >= dropeDescontos[i].qtd) {" .
    "\r\n" .
    "    drope_desconto_qty = dropeDescontos[i].qtd;" .
    "\r\n" .
    "    drope_desconto = dropeDescontos[i].vlr;" .
    "\r\n" .
    " }" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    "var drope_desconto_aplicado = total;" .
    "\r\n" .
    "var desconto_acumulativo = false;" .
    "\r\n" .
    "var quantidade_de_numeros = drope_desconto_qty;" .
    "\r\n" .
    "var valor_do_desconto = drope_desconto;" .
    "\r\n\r\n";

if ($enable_cumulative_discount == 1) {
    echo "  desconto_acumulativo = true;" . "\r\n";
}

echo "\r\n" .
    "if (desconto_acumulativo && qty >= quantidade_de_numeros) {" .
    "\r\n" .
    "  var multiplicador_do_desconto = Math.floor(qty / quantidade_de_numeros);" .
    "\r\n" .
    "  drope_desconto_aplicado = total - (valor_do_desconto * multiplicador_do_desconto);" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    "// Aplicar desconto normal quando desconto acumulativo estiver desativado" .
    "\r\n" .
    "if (!desconto_acumulativo && qty >= drope_desconto_qty) {" .
    "\r\n" .
    "  drope_desconto_aplicado = total - valor_do_desconto;" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    "if (parseInt(qty) >= parseInt(drope_desconto_qty)) {" .
    "\r\n" .
    '  $(\'#total\').html(\'De <strike>R$ \' + formatCurrency(total) + \'</strike> por R$ \' + formatCurrency(drope_desconto_aplicado));' .
    "\r\n" .
    "} else {" .
    "\r\n" .
    "   if(enable_sale == 1 && qty >= sale_qty){" .
    "\r\n" .
    "     total_sale = qty * sale_price;" .
    "\r\n\r\n" .
    '     $(\'#total\').html(\'De <strike>R$ \' + formatCurrency(total) + \'</strike> por R$ \' + formatCurrency(total_sale));' .
    "\r\n" .
    "  }else{" .
    "\r\n" .
    '    $(\'#total\').html(\'R$ \' + formatCurrency(total));  ' .
    "\r\n" .
    " }" .
    "\r\n\r\n" .
    "}" .
    "\r\n" .
    "//Fim desconto acumulativo" .
    "\r\n\r\n" .
    "}" .
    "\r\n\r\n" .
    "function qtyRaffle(qty, opt) {" .
    "\r\n" .
    "  qty = parseInt(qty);" .
    "\r\n" .
    '  let value = parseInt($(".qty").val());  ' .
    "\r\n" .
    "  let qtyTotal = (value + qty);" .
    "\r\n" .
    "  if(opt === true){" .
    "\r\n" .
    "   qtyTotal = (qtyTotal - value);" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    '$(".qty").val(qtyTotal);' .
    "\r\n" .
    "calculatePrice(qtyTotal);  " .
    "\r\n\r\n" .
    "}" .
    "\r\n" .
    "function add_cart(){" .
    "\r\n" .
    '  let qty = $(\'.qty\').val();    ' .
    "\r\n" .
    '  $(\'#qty_cotas\').text(qty);' .
    "\r\n" .
    '  $.ajax({' .
    "\r\n" .
    '   url:_base_url_+"class/Main.php?action=add_to_card",' .
    "\r\n" .
    '   method:"POST",' .
    "\r\n" .
    '   data:{product_id: "';
echo isset($id) ? $id : "";
echo '", qty: qty},' .
    "\r\n" .
    '   dataType:"json",' .
    "\r\n" .
    "   error:err=>{" .
    "\r\n" .
    "    console.log(err)" .
    "\r\n" .
    '    alert("[PP07] - An error occured.",\'error\');' .
    "\r\n" .
    " }," .
    "\r\n" .
    " success:function(resp){" .
    "\r\n" .
    '    if(typeof resp== \'object\' && resp.status == \'success\'){' .
    "\r\n\t\t\t\t\t" .
    "//location.reload();" .
    "\r\n" .
    "    }else if(!!resp.msg){" .
    "\r\n" .
    '     alert(resp.msg,\'error\');' .
    "\r\n" .
    "  }else{" .
    "\r\n" .
    '     alert("[PP08] - An error occured.",\'error\');' .
    "\r\n" .
    "  }" .
    "\r\n" .
    "}" .
    "\r\n" .
    "})" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    '//$(document).ready(function() {' .
    "\r\n\r\n" .
    '   sessionStorage.removeItem(\'valores\');' .
    "\r\n" .
    '   //$(\'.cota\').on(\'click\', function() {' .
    "\r\n" .
    '   $(\'.numeros-list\').on(\'click\', \'.cota\', function() {   ' .
    "\r\n" .
    '    var pendingNumbers = $(this).find(\'.bg-info\');' .
    "\r\n" .
    '    var paidNumbers = $(this).find(\'.bg-success\');    ' .
    "\r\n" .
    "    if(pendingNumbers.length == 0 && paidNumbers.length == 0){" .
    "\r\n" .
    '    var divNumero = $(this).find(\'.numero-template\');' .
    "\r\n" .
    "    var valor = divNumero.text();" .
    "\r\n" .
    '    var cota = divNumero.data(\'cota\');' .
    "\r\n" .
    '    var sessao = sessionStorage.getItem(\'valores\');' .
    "\r\n" .
    "    var valores = sessao ? JSON.parse(sessao) : [];" .
    "\r\n" .
    "    var index = valores.indexOf(cota.toString());" .
    "\r\n" .
    "    " .
    "\r\n" .
    "    if (index === -1) {" .
    "\r\n" .
    "     valores.push(cota);" .
    "\r\n" .
    '     divNumero.addClass(\'numero-template-selected\').removeClass(\'bg-cota\');' .
    "\r\n" .
    '     var clonedDiv = $(this).clone();' .
    "\r\n" .
    '     clonedDiv.find(\'.numero-template\').text(cota);' .
    "\r\n" .
    '     clonedDiv.appendTo(\'.cotas-checkout\');' .
    "\r\n" .
    '     $(".addNumero").click();' .
    "\r\n" .
    '     if (!$(\'.sorteio-numeros-selecionados\').hasClass(\'sorteio-numeros-selecionados-open\')) {' .
    "\r\n" .
    '      $(\'.sorteio-numeros-selecionados\').addClass(\'sorteio-numeros-selecionados-open\');' .
    "\r\n" .
    "   }" .
    "\r\n" .
    "} else {" .
    "\r\n" .
    "  valores.splice(index, 1);" .
    "\r\n" .
    '  divNumero.addClass(\'bg-cota\').removeClass(\'numero-template-selected\');' .
    "\r\n" .
    '  $(\'.cotas-checkout\').find(\'.numero-template:contains(\' + cota + \')\').parent().remove();' .
    "\r\n" .
    '  $(".removeNumero").click();' .
    "\r\n\r\n" .
    '  $(\'.cota\').filter(function() {' .
    "\r\n" .
    '   return $(this).find(\'.numero-template\').text() === cota;' .
    "\r\n" .
    '}).find(\'.numero-template\').addClass(\'bg-cota\').removeClass(\'numero-template-selected\');' .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    'sessionStorage.setItem(\'valores\', JSON.stringify(valores.map(String)));' .
    "\r\n" .
    "}" .
    "\r\n" .
    "});" .
    "\r\n\r\n" .
    '   $(\'.cotas-checkout\').on(\'click\', \'.cota\', function() {' .
    "\r\n" .
    '    var valor = $(this).find(\'.numero-template\').text();' .
    "\r\n" .
    '    var sessao = sessionStorage.getItem(\'valores\');' .
    "\r\n" .
    "    var valores = sessao ? JSON.parse(sessao) : [];" .
    "\r\n" .
    "    var index = valores.indexOf(valor.toString());" .
    "\r\n\r\n" .
    "    if (index !== -1) {" .
    "\r\n" .
    "     valores.splice(index, 1);" .
    "\r\n" .
    '     $(\'.cota\').filter(function() {' .
    "\r\n" .
    '      return $(this).find(\'.numero-template\').text() === valor;' .
    "\r\n" .
    '   }).find(\'.numero-template\').addClass(\'bg-cota\').removeClass(\'numero-template-selected\');' .
    "\r\n" .
    "  }" .
    "\r\n" .
    '  $(".removeNumero").click();' .
    "\r\n" .
    '  $(this).remove();' .
    "\r\n" .
    '  sessionStorage.setItem(\'valores\', JSON.stringify(valores.map(String)));' .
    "\r\n\r\n" .
    '  $(\'.cota\').filter(function() {' .
    "\r\n" .
    '     return $(this).find(\'.numero-template\').data(\'cota\') === valor;' .
    "\r\n" .
    '  }).find(\'.numero-template\').addClass(\'bg-cota\').removeClass(\'numero-template-selected\');' .
    "\r\n" .
    "});" .
    "\r\n\r\n" .
    '   $(\'.cota .numero-template\').each(function() {' .
    "\r\n" .
    '    var cota = $(this).text();' .
    "\r\n" .
    '    $(this).data(\'cota\', cota);' .
    "\r\n" .
    " });" .
    "\r\n\r\n" .
    "//});   " .
    "\r\n\r\n\r\n\r\n" .
    "//Lista numeros" .
    "\r\n" .
    "var loadingNumbers = false; " .
    "\r\n" .
    "function loadNumbers(status) {" .
    "\r\n" .
    "  if (loadingNumbers) {" .
    "\r\n" .
    "    return; " .
    "\r\n" .
    "  }" .
    "\r\n\r\n" .
    "  loadingNumbers = true; " .
    "\r\n" .
    '  var classe = (status === 1) ? \'bg-cota\' : (status === 2) ? \'tooltp bg-info\' : (status === 3) ? \'tooltp bg-success\' : \'\';' .
    "\r\n" .
    '  var numerosList = $(\'.numeros-list\');' .
    "\r\n" .
    '  var mgsList = $(\'.loading-message\');' .
    "\r\n" .
    "  numerosList.empty();" .
    "\r\n" .
    '  var loadingMessage = $(\'<p class="loading">\').html(\'<span class="d-inline-block spin-animation me-2"><i class="bi bi-arrow-repeat"></i></span> Carregando números...\').appendTo(mgsList);' .
    "\r\n\r\n" .
    '  $.ajax({' .
    "\r\n" .
    '    url: _base_url_ + "class/Main.php?action=load_numbers",' .
    "\r\n" .
    '    type: \'POST\',' .
    "\r\n" .
    '    data: { status: status, id: "';
echo isset($id) ? $id : "";
echo '" },' .
    "\r\n" .
    '    dataType: \'json\',' .
    "\r\n" .
    "    success: function(response) {" .
    "\r\n" .
    'if (response.status === \'success\') {' .
    "\r\n" .
    "  var numeros = response.numeros;" .
    "\r\n" .
    "  var nomes = response.nomes;" .
    "\r\n" .
    "  var numerosNomes = {};" .
    "\r\n" .
    "  for (var i = 0; i < numeros.length; i++) {" .
    "\r\n" .
    "    var numero = numeros[i];" .
    "\r\n" .
    "    var nome = nomes[i];" .
    "\r\n" .
    "    numerosNomes[numero] = nome;" .
    "\r\n" .
    "  }" .
    "\r\n" .
    "  numeros.sort(function(a, b) {" .
    "\r\n" .
    "    return a - b;" .
    "\r\n" .
    "  });" .
    "\r\n\r\n" .
    "  for (var i = 0; i < numeros.length; i++) {" .
    "\r\n" .
    "    var numero = numeros[i];" .
    "\r\n" .
    "    var nome = numerosNomes[numero];" .
    "\r\n" .
    '    var divCota = $(\'<div>\').addClass(\'col cota\');' .
    "\r\n" .
    '    var divNumero = $(\'<div>\').addClass(\'numero-template \' + classe).attr(\'data-cota\', numero).attr(\'data-nome\', nome).text(numero);' .
    "\r\n\r\n" .
    "    divNumero.appendTo(divCota);" .
    "\r\n" .
    "    divCota.appendTo(numerosList);" .
    "\r\n" .
    "  }" .
    "\r\n" .
    "} else {" .
    "\r\n" .
    '        //alert(\'Ocorreu um erro ao consultar os números por status.\');' .
    "\r\n" .
    "      }" .
    "\r\n" .
    "    }," .
    "\r\n" .
    "    error: function() {" .
    "\r\n" .
    '      alert(\'Ocorreu um erro na requisição Ajax.\');' .
    "\r\n" .
    "    }," .
    "\r\n" .
    "    complete: function() {" .
    "\r\n" .
    "      loadingMessage.remove();" .
    "\r\n" .
    "      loadingNumbers = false;" .
    "\r\n" .
    "    }" .
    "\r\n" .
    "  });" .
    "\r\n" .
    "}" .
    "\r\n\r\n" .
    "//Fim lista números" .
    "\r\n\r\n" .
    '$(document).ready(function(){' .
    "\r\n" .
    "   loadNumbers(1);" .
    "\r\n" .
    '  $(\'#consultMyNumbers\').submit(function(e){' .
    "\r\n" .
    "    e.preventDefault()" .
    "\r\n" .
    '    var tipo = "';
echo $search_type;
echo '";' .
    "\r\n" .
    '    $.ajax({' .
    "\r\n" .
    '      url:_base_url_+"class/Main.php?action=" + tipo,' .
    "\r\n" .
    '      method:\'POST\',' .
    "\r\n" .
    '      type:\'POST\',' .
    "\r\n" .
    '      data:new FormData($(this)[0]),' .
    "\r\n" .
    '      dataType:\'json\',' .
    "\r\n" .
    "      cache:false," .
    "\r\n" .
    "      processData:false," .
    "\r\n" .
    "      contentType: false," .
    "\r\n" .
    "      error:err=>{" .
    "\r\n" .
    "        console.log(err)" .
    "\r\n" .
    '        alert(\'An error occurred\')' .
    "\r\n\r\n" .
    "     }," .
    "\r\n" .
    "     success:function(resp){" .
    "\r\n" .
    '        if(resp.status == \'success\'){' .
    "\r\n" .
    "         location.href = (resp.redirect)                                    " .
    "\r\n" .
    "      }else{" .
    "\r\n" .
    '       alert(\'Nenhum registro de compra foi encontrado\')' .
    "\r\n" .
    "       console.log(resp)" .
    "\r\n" .
    "    }" .
    "\r\n" .
    " }" .
    "\r\n" .
    "})" .
    "\r\n" .
    " })" .
    "\r\n" .
    "})" .
    "\r\n" .
    "</script>";
