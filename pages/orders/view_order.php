<?php
function leowp_format_luck_numbers($client_lucky_numbers, $raffle_total_numbers, $class, $opt, $type_of_draw)
{
    $bichos = array();
    if ($type_of_draw == 3) {
        $bichos = array(
            "00" => "Avestruz",
            "01" => "Águia",
            "02" => "Burro",
            "03" => "Borboleta",
            "04" => "Cachorro",
            "05" => "Cabra",
            "06" => "Carneiro",
            "07" => "Camelo",
            "08" => "Cobra",
            "09" => "Coelho",
            "10" => "Cavalo",
            "11" => "Elefante",
            "12" => "Galo",
            "13" => "Gato",
            "14" => "Jacaré",
            "15" => "Leão",
            "16" => "Macaco",
            "17" => "Porco",
            "18" => "Pavão",
            "19" => "Peru",
            "20" => "Touro",
            "21" => "Tigre",
            "22" => "Urso",
            "23" => "Veado",
            "24" => "Vaca"
        );
    }
    if ($type_of_draw == 4) {
        $bichos = array(
            "00" => "Avestruz M1",
            "01" => "Avestruz M2",
            "02" => "Águia M1",
            "03" => "Águia M2",
            "04" => "Burro M1",
            "05" => "Burro M2",
            "06" => "Borboleta M1",
            "07" => "Borboleta M2",
            "08" => "Cachorro M1",
            "09" => "Cachorro M2",
            "10" => "Cabra M1",
            "11" => "Cabra M2",
            "12" => "Carneiro M1",
            "13" => "Carneiro M2",
            "14" => "Camelo M1",
            "15" => "Camelo M2",
            "16" => "Cobra M1",
            "17" => "Cobra M2",
            "18" => "Coelho M1",
            "19" => "Coelho M2",
            "20" => "Cavalo M1",
            "21" => "Cavalo M2",
            "22" => "Elefante M1",
            "23" => "Elefante M2",
            "24" => "Galo M1",
            "25" => "Galo M2",
            "26" => "Gato M1",
            "27" => "Gato M2",
            "28" => "Jacaré M1",
            "29" => "Jacaré M2",
            "30" => "Leão M1",
            "31" => "Leão M2",
            "32" => "Macaco M1",
            "33" => "Macaco M2",
            "34" => "Porco M1",
            "35" => "Porco M2",
            "36" => "Pavão M1",
            "37" => "Pavão M2",
            "38" => "Peru M1",
            "39" => "Peru M2",
            "40" => "Touro M1",
            "41" => "Touro M2",
            "42" => "Tigre M1",
            "43" => "Tigre M2",
            "44" => "Urso M1",
            "45" => "Urso M2",
            "46" => "Veado M1",
            "47" => "Veado M2",
            "48" => "Vaca M1",
            "49" => "Vaca M2"
        );
    }

    if ($client_lucky_numbers) {
        foreach ($client_lucky_numbers as $client_lucky_number) {
            if (!empty($client_lucky_number)) {
                $size = strlen($client_lucky_number);
                if ($type_of_draw == 3 || $type_of_draw == 4) {
                    $bicho_name = $bichos[$client_lucky_number];
                    echo '<span style="border-radius: 5px !important; display: inline-block; padding: 5px; border-radius:2px; margin: 4px;"  class=" ' . $class . ' me-1 alert-success">' . $bicho_name . '</span>';
                } else {
                    $output = ($type_of_draw == 3 || $type_of_draw == 4) ? $bichos[$client_lucky_number] : $client_lucky_number;
                    if ($opt == true) {
                        echo '<span style="border-radius: 5px !important; display: inline-block; padding: 5px; border-radius:2px; margin: 4px;" class=" ' . $class . ' me-1 wd-' . $size . '">' . $output . '</span>';
                    } else {
                        echo '' . $output . '<span class="comma-hide">,</span>';
                    }
                }
            }
        }
    } else {
        echo '...';
    }
};



$orderitem = $conn->query("SELECT * FROM `order_list` where order_token = '{$_GET['id']}'");

$orderitem = $orderitem->fetch_assoc();

$product = $conn->query("SELECT cotas_premiadas, type_of_draw, cotas_premiadas_premios, roleta, box FROM `product_list` where id = '{$orderitem['product_id']}'");
$product = $product->fetch_assoc();
$type_of_draw = $product['type_of_draw'];
$cotas_p = $product['cotas_premiadas'];
$cotas_premiadas_premios = $product['cotas_premiadas_premios'];
$tipo_roleta = $product['roleta'];
$tipo_box = $product['box'];
$deserialized = [];
$pairs = explode(',', $cotas_premiadas_premios);
foreach ($pairs as $pair) {
    [$key, $value] = explode(':', $pair, 2);
    $deserialized[$key] = $value;
}
$cotas_array = $deserialized;
$cotas_premiadas = explode(',', $cotas_p);
$my_numbers = 0;
$my_numbers = $orderitem['order_numbers'];
$my_numbers = explode(',', $my_numbers);

// Inicialize a página atual com base no parâmetro da URL ou padrão para 1
$current_page = 1;
if (isset($_GET['p']) && $_GET['pg'] > 0) {
    $current_page = intval($_GET['pg']);
}

// Defina o limite de itens por página
$limit = 100;

// Calcule o offset para array_slice
$offset = ($current_page - 1) * $limit;

// Faça o slicing do array com base no offset e limite
$sliced_numbers = array_slice($my_numbers, $offset, $limit);





$pagstar = $_settings->info('pagstar') == 1 ? true : false;
$pay2m = $_settings->info('pay2m') == 1 ? true : false;



echo $_GET['pg'];

$whatsapp =  $_settings->info('phone');

$enable_hide_numbers = $_settings->info('enable_hide_numbers');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT *  from `order_list` where order_token = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
        $customer_id = $customer_id;
    } else {
        echo "<script>alert('Você não tem permissão para acessar essa página.'); 
   location.replace('/');</script>";
        exit;
    }
} else {
    echo "<script>alert('Você não tem permissão para acessar essa página.'); 
   location.replace('/');</script>";
    exit;
}
?>

<style>
    .wd-1 {
        width: 35px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-2 {
        width: 36px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-3 {
        width: 42px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-4 {
        width: 48px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-5 {
        width: 60px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-6 {
        width: 66px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-7 {
        width: 72px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-8 {
        width: 78px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-9 {
        width: 84px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }

    .wd-10 {
        width: 90px !important;
        letter-spacing: 0.2px;
        text-align: center;
        white-space: nowrap;

    }
</style>
<div class="app-main container">
    <div class="compra-status">
        <?php if ($status == '1') { ?>
            <div class="app-alerta-msg mb-2">
                <i class="app-alerta-msg--icone bi bi-check-circle text-warning"></i>
                <div class="app-alerta-msg--txt">
                    <h3 class="app-alerta-msg--titulo">Aguardando Pagamento!</h3>
                    <p>Finalize o pagamento</p>
                </div>
            </div>
        <?php } ?>

        <?php if ($status == '2') { ?>
            <div class="app-alerta-msg mb-2">
                <i class="app-alerta-msg--icone bi bi-check-circle text-success"></i>
                <div class="app-alerta-msg--txt">
                    <h3 class="app-alerta-msg--titulo">Compra Aprovada!</h3>
                    <p>Agora é só torcer!</p>
                </div>
            </div>
        <?php } ?>

        <?php if ($status == '3') { ?>
            <div class="app-alerta-msg mb-2">
                <i style="color:red" class="app-alerta-msg--icone bi bi-x-circle"></i>
                <div class="app-alerta-msg--txt">
                    <h3 class="app-alerta-msg--titulo">Pedido cancelado!</h3>
                    <p>O prazo para pagamento do seu pedido expirou.</p>
                </div>
            </div>
        <?php } ?>

        <hr class="my-2">
    </div>
    <?php if ($status == '1') { ?>
        <div class="compra-pagamento">
            <div class="pagamentoQrCode text-center">
                <div class="pagamento-rapido">
                    <div class="app-card card rounded-top rounded-0 shadow-none border-bottom">
                        <div class="card-body">
                            <div class="pagamento-rapido--progress">
                                <div class="d-flex justify-content-center align-items-center mb-1 font-md">
                                    <div><small>Você tem</small></div>
                                    <div class="mx-1"><b class="font-md" id="tempo-restante"></b></div>
                                    <div><small>para pagar</small></div>
                                </div>
                                <div class="progress bg-dark bg-opacity-50">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="barra-progresso"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="app-card card rounded-bottom rounded-0 rounded-bottom b-1 border-dark mb-2">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <div class="col-12 text-start">
                                <div class="mb-1"><span class="badge bg-success badge-xs">1</span><span class="font-xs"> Copie o código PIX abaixo.</span></div>
                                <div class="input-group mb-2">
                                    <input id="pixCopiaCola" type="text" class="form-control" value="<?= $pix_code; ?>">
                                    <div class="input-group-append">
                                        <button onclick="copyPix()" class="app-btn btn btn-success rounded-0 rounded-end">Copiar</button>
                                    </div>
                                </div>
                                <div class="mb-2"><span class="badge bg-success">2</span> <span class="font-xs">Abra o app do seu banco e escolha a opção PIX, como se fosse fazer uma transferência.</span></div>
                                <p><span class="badge bg-success">3</span> <span class="font-xs">Selecione a opção PIX cópia e cola, cole a chave copiada e confirme o pagamento.</span></p>
                            </div>
                            <div class="col-12 my-2">
                                <p class="alert alert-warning p-2 font-xss" style="text-align: justify; margin-bottom:0.5rem !important">Este pagamento só pode ser realizado dentro do tempo, após este período, caso o pagamento não for confirmado os números voltam a ficar disponíveis.</p>
                                <!-- <?php if ($txid > 0) { ?>
                                    <p class="alert alert-danger p-2 font-xss" style="text-align: justify;"><i class="bi bi-exclamation-circle"></i> Este pagamento possui uma taxa adicional de <?= $txid ?>%.</p>
                                <?php } ?> -->
                            </div>

                        </div>
                        <div style="background-image: url('../assets/img/bg-btn-qr.png'); text-align: center;"><input id="btmqr" class="btn-qr" type="button" value="Mostrar QR Code"></div>
                        <div id="exibeqr" style="display: none; margin-top:24px; margin-bottom:24px; align-items:center" class="row justify-content-center">

                            <div class="col-6 pb-3">
                                <div style="text-align: left; font-size:0.9rem !important" class="font-xss">
                                    <h5><i class="bi bi-qr-code"></i> QR Code</h5>
                                    <div>Acesse o APP do seu banco e escolha a opção <strong>pagar com QR Code,</strong> escaneie o código ao lado e confirme o pagamento.</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-block text-center">
                                    <div id="img-qrcode" class="d-inline-block bg-white rounded"><img style="width:200px; height:200px" src=" <?php echo $pagstar == false && $pay2m == false ? 'data:image/png;base64,' : '' ?><?= $pix_qrcode ?>" class="img-fluid"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="detalhes-compra">
        <div class="compra-sorteio mb-2">
            <?php

            $order_items = $conn->query("SELECT o.*, p.name as product, p.price, p.qty_numbers, p.status_display, p.subtitle, p.image_path, p.slug, p.type_of_draw, p.cotas_premiadas_descricao FROM `order_list` o inner join product_list p on o.product_id = p.id where o.id = '{$id}' ");
            while ($row = $order_items->fetch_assoc()) :

                $gt += $row['price'] * $row['quantity'];
            ?>

                <div class="SorteioTpl_sorteioTpl__2s2Wu   pointer">
                    <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">
                        <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                            <img alt="Pop 110i 2022 0km" src="<?= validate_image($row['image_path']) ?>" decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                            <noscript></noscript>
                        </div>
                    </div>

                    <div class="SorteioTpl_info__t1BZr">
                        <h1 class="SorteioTpl_title__3RLtu"><a href="/campanha/<?= $row['slug'] ?>"><?= $row['product'] ?></a></h1>
                        <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom: 1px;"><?php echo isset($row['subtitle']) ? $row['subtitle'] : ''; ?></p>
                        <?php if ($row['status_display'] == 1) { ?>
                            <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
                        <?php } ?>
                        <?php if ($row['status_display'] == 2) { ?>
                            <span class="badge bg-dark blink font-xsss mobile badge-status-1">Corre que está acabando!</span>
                        <?php } ?>
                        <?php if ($row['status_display'] == 3) { ?>
                            <span class="badge bg-dark font-xsss mobile badge-status-3">Aguarde o sorteio!</span>
                        <?php } ?>
                        <?php if ($row['status_display'] == 4) { ?>
                            <span class="badge bg-dark font-xsss">Concluído</span>
                        <?php } ?>

                    </div>
                </div>

        </div>

        <?php
                $cards = '';

                // Verificar o status de pagamento na tabela 'order_list'
                $stmt_status = $conn->prepare('SELECT status, roleta FROM order_list WHERE id = ?');
                $stmt_status->bind_param('s', $id);
                $stmt_status->execute();
                $result_status = $stmt_status->get_result();
                $row_status = $result_status->fetch_assoc();

                // Verifica se o status da ordem é 'pago'
                if ($row_status['status'] == 2 && $row['type_of_draw'] == 1) {

                    // String para armazenar os números premiados encontrados
                    $numeros_premiados = [];

                    // Iterar sobre cada número comprado e verificar se algum deles é o número premiado

                    foreach ($cotas_premiadas as $num) {
                        if (empty($num)) {
                            continue;
                        } // Pula elementos vazios

                        $stmt = $conn->prepare("SELECT * FROM order_list WHERE FIND_IN_SET(?, order_numbers) AND id = $id");
                        $stmt->bind_param('s', $num);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Adiciona o número ao array de números premiados
                            $numeros_premiados[] = $num;
                        }
                    }

                    if (!empty($numeros_premiados)) {
                        $quantidade_premiados = count($numeros_premiados);
                        $numeros_encontrados = implode(', ', $numeros_premiados);
                        $numeros_encontrados = rtrim($numeros_encontrados, ', ');

                        ob_start();
                        foreach ($numeros_premiados as $num) {
                            $prize = explode(':', $cotas_array[$num]);
                            $prize = $prize[0]; ?>

                        <div class="d-flex" style="align-items: center; justify-content:flex-start;gap:12px; margin-block:4px; max-width:100%; overflow:hidden">
                            <div style="background-color:#387f57; color:white !important; border-radius:6px; min-width:37px; width:fit-content !important;font-size:0.9rem !important;line-height:1 !important; padding:6px 8px !important;font-weight:900 !important " class="font-xs text-dark"><?= (stripos($num, ',') !== false ? str_replace(',', '', $num) : $num) ?> </div>
                            <div style="font-weight: bold;line-height: 1;color: #387f57 !important;font-size: 0.85rem;opacity: 1 !important; text-wrap:nowrap !important; text-overflow:ellipsis; max-width:100%  "> <?= $prize ?></div>
                        </div>
                        <?php
                            }
                            $output = ob_get_clean();
                            if ($row_status['roleta'] > 0) {
                                for ($i = 0; $i < $roleta; $i++) {
                        ?>

                        <div class="achouacota<?= $i ?> d-none detalhes app-card-winner card mb-2 " style="background: rgb(25, 135, 84); color: rgb(255, 255, 255); opacity: 1;">
                            <div class="card-body ">
                                <span style="color:#387f57; font-size:1.5rem; font-weight:900">🥳Você foi Contemplado Parabéns!🥳</span>
                                <div class="font-xs mb-2 text-dark">
                                    <div class="pt-1 opacity-75 font-xs text-dark">Sua compra possui <strong>' . $quantidade_premiados . ' título(s) <br> contemplado(s)</strong> na modalidade <br> <strong>Premiação instantânea:</strong>
                                    </div>
                                    <div style="align-items:center; justify-content:center; gap:8px; margin-block:16px" class="">' . $output . '</div>
                                    <div style="color:#387f57 !important; font-size:0.9rem !important; margin-block:0 !important; opacity: 1 !important; font-weight: 500 !important;" class=" opacity-75 font-xs text-dark">
                                        Em breve, nossa equipe entrará em contato com você para realizar a entrega do prêmio.!
                                    </div>
                                    <a href="https://wa.me/' . $whatsapp . '" target="_blank" style="z-index: 1001; position: relative;" class="" id="wpp_btn">
                                        <i style="margin-right:4px" class="bi bi-whatsapp"></i> Falar com o suporte
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class=" card mb-2 card-girar<?= $i ?>">
                            <div class="card-body">
                                <div class="roleta-premiada--giros">
                                    <p class="opacity-50 font-xs mb-1">Você tem (1) giro(s) disponíveis:</p>
                                    <div class="lista font-xs">
                                        <div class="roleta-premiada--item d-flex py-2 px-3 rounded-2
                                                    mb-1 text-white text-center pointer
                                                    bg-gradient-cyan
                                                    font-weight-600 justify-content-between"><span><i class="bi bi-play-circle-fill"></i> Giro de Roleta 🪄</span><span class="badge text-bg-light bg-opacity-75 text-uppercase btn-giragira">Girar!</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="roleta-premiada--roda<?= $i ?>" class="roleta-premiada--roda d-none" style="opacity: 1; scale: 1;">
                            <div id="wheelOfFortune<?= $i ?>">
                                <audio id="spinAudio<?= $i ?>" src="/roleta.mp3" preload="true"></audio>
                                <canvas id="wheel<?= $i ?>" width="350" height="350" style="transform: rotate(-1.5708rad);"></canvas>
                                <div id="spin<?= $i ?>" style="background: rgb(40, 63, 151); color: rgb(255, 255, 255); cursor: pointer;">Girar</div>
                            </div>
                        </div>
                        <?php
                                }
                            } else {

                        ?>
                        <div class="achouacota d-none detalhes app-card-winner card mb-2 " style="background: rgb(25, 135, 84); color: rgb(255, 255, 255); opacity: 1;">
                            <div class="card-body ">
                                <span style="color:#387f57; font-size:1.5rem; font-weight:900">🥳Você foi Contemplado Parabéns!🥳</span>
                                <div class="font-xs mb-2 text-dark">
                                    <div class="pt-1 opacity-75 font-xs text-dark">Sua compra possui <strong>' . $quantidade_premiados . ' título(s) <br> contemplado(s)</strong> na modalidade <br> <strong>Premiação instantânea:</strong>
                                    </div>
                                    <div style="align-items:center; justify-content:center; gap:8px; margin-block:16px" class="">' . $output . '</div>
                                    <div style="color:#387f57 !important; font-size:0.9rem !important; margin-block:0 !important; opacity: 1 !important; font-weight: 500 !important;" class=" opacity-75 font-xs text-dark">
                                        Em breve, nossa equipe entrará em contato com você para realizar a entrega do prêmio.!
                                    </div>
                                    <a href="https://wa.me/' . $whatsapp . '" target="_blank" style="z-index: 1001; position: relative;" class="" id="wpp_btn">
                                        <i style="margin-right:4px" class="bi bi-whatsapp"></i> Falar com o suporte
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        $quantidade_premiados = count($numeros_premiados);
                        $numeros_encontrados = implode(', ', $numeros_premiados);
                        $numeros_encontrados = rtrim($numeros_encontrados, ', ');
                        $roletaOpen = false;
                        if (isset($cotas_p) && !empty($cotas_p)) {
                            if ($tipo_roleta) {
                                if ($roleta > 0) {
                                    for ($i = 0; $i < $roleta; $i++) {

                            ?>
                            <div class=" card mb-2 card-girar<?= $i ?>">
                            <div class="card-body">
                                <div class="roleta-premiada--giros">
                                    <p class="opacity-50 font-xs mb-1">Você tem (1) giro(s) disponíveis:</p>
                                    <div class="lista font-xs">
                                        <div class="roleta-premiada--item d-flex py-2 px-3 rounded-2
                                                        mb-1 text-white text-center pointer
                                                        bg-gradient-cyan
                                                        font-weight-600 justify-content-between"><span><i class="bi bi-play-circle-fill"></i> Giro de Roleta 🪄</span><span class="badge text-bg-light bg-opacity-75 text-uppercase btn-giragira<?= $i ?>">Girar!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        <div class="card mb-2 card-perdeu<?= $i ?> d-none">
                            <div class="card-body">
                                <div class="roleta-premiada--giros">
                                    <p class="opacity-50 font-xs mb-1">Você tem (1) giro(s) disponíveis:</p>
                                    <div class="lista font-xs">
                                        <div class="roleta-premiada--item d-flex py-2 px-3 rounded-2
                                                            mb-1 text-white text-center pointer
                                                            bg-gradient-pink
                                                            font-weight-600 justify-content-between"><span><i class="bi bi-play-circle-fill"></i> Giro de Roleta 🪄</span><span class="badge text-bg-light bg-opacity-75 text-uppercase">Aberta</span></div>
                                        <div class="mb-2">
                                            <div class="row justify-content-center align-items-center py-2">
                                                <div class="col-auto pe-0">
                                                    <h1><i class="bi bi-emoji-frown text-danger"></i></h1>
                                                </div>
                                                <div class="col-auto">
                                                    <p class="mb-1">Não foi dessa vez</p>
                                                    <p class="font-xs"><b>sua roleta não premiou</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="roleta-premiada--roda<?= $i ?>" class="roleta-premiada--roda d-none" style="opacity: 1; scale: 1;">
                            <div id="wheelOfFortune<?= $i ?>" class="wheelOfFortune">
                                <audio id="spinAudio<?= $i ?>" src="/roleta.mp3" preload="true"></audio>
                                <audio id="spinAudio-audio-ganhou<?= $i ?>" src="/roleta-ganhou.wav" preload="auto"></audio>
                                <audio id="spinAudio-audio-perdeu<?= $i ?>" src="/roleta-perdeu.wav" preload="auto"></audio>
                                <canvas id="wheel<?= $i ?>" width="350" height="350" style="transform: rotate(-1.5708rad);"></canvas>
                                <div id="spin<?= $i ?>" class="spin" style="background: rgb(40, 63, 151); color: rgb(255, 255, 255); cursor: pointer;">Girar</div>
                            </div>
                        </div>
                        <?php
                                            }
                                        } else {

                        ?>

                            <div class="card mb-2 card-perdeu d-none">
                                <div class="card-body">
                                    <div class="roleta-premiada--giros">
                                        <p class="opacity-50 font-xs mb-1">Você tem (1) giro(s) disponíveis:</p>
                                        <div class="lista font-xs">
                                            <div class="roleta-premiada--item d-flex py-2 px-3 rounded-2
                                                                    mb-1 text-white text-center pointer
                                                                    bg-gradient-pink
                                                                    font-weight-600 justify-content-between"><span><i class="bi bi-play-circle-fill"></i> Giro de Roleta 🪄</span><span class="badge text-bg-light bg-opacity-75 text-uppercase">Aberta</span></div>
                                            <div class="mb-2">
                                                <div class="row justify-content-center align-items-center py-2">
                                                    <div class="col-auto pe-0">
                                                        <h1><i class="bi bi-emoji-frown text-danger"></i></h1>
                                                    </div>
                                                    <div class="col-auto">
                                                        <p class="mb-1">Não foi dessa vez</p>
                                                        <p class="font-xs">sua <b>roleta não premiou</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                                            }
                                        } else if ($tipo_box) {
                                            for ($i = 0; $i < $roleta; $i++) {

                        ?>
                <div id="card-caixa" class="card card-caixa-abrir<?= $i ?> mb-2">
                    <audio id="caixa-audio-abrindo<?= $i ?>" src="/caixa-abrindo.mp3" preload="auto"></audio>
                    <audio id="caixa-audio-ganhou<?= $i ?>" src="/roleta-ganhou.wav" preload="auto"></audio>
                    <audio id="caixa-audio-perdeu<?= $i ?>" src="/roleta-perdeu.wav" preload="auto"></audio>
                    <div class="card-body">
                        <div class="caixa-premiada--giros">
                            <p class="opacity-50 font-xs mb-1">Você tem (1) caixa(s) disponíveis:</p>
                            <div class="lista font-xs">
                                <div>
                                    <div id="video-67644fc481cbe850420241219" class="caixaPremiada_video__3oQjY" style="pointer-events: none; opacity: 0;">

                                    </div>
                                    <div class="caixa-premiada--item d-flex py-2 px-3 rounded-2 mb-1 text-white text-center pointer bg-gradient-yellow
                                    font-weight-600 justify-content-between" id="video-67644fc481cbe850420241219-btn"><span>
                                            <i class="bi bi-gift-fill"></i> Caixa premiada 🎁</span>
                                        <span class="badge text-bg-light bg-opacity-75 text-uppercase btn-abrircaixa<?= $i ?>">Abrir!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="card-caixa" class="card card-caixa-perdeu<?= $i ?> d-none mb-2 ">
                    <audio id="caixa-audio-abrindo" src="/caixa-abrindo.mp3" preload="auto"></audio>
                    <audio id="caixa-audio-ganhou" src="/roleta-ganhou.wav" preload="auto"></audio>
                    <audio id="caixa-audio-perdeu" src="/roleta-perdeu.wav" preload="auto"></audio>
                    <div class="card-body">
                        <div class="caixa-premiada--giros">
                            <p class="opacity-50 font-xs mb-1">Você tem (1) caixa<!-- -->(s)<!-- --> disponíveis<!-- -->:</p>
                            <div class="lista font-xs">
                                <div>
                                    <div class="caixa-premiada--item d-flex py-2 px-3 rounded-2 mb-1 text-white text-center pointer bg-gradient-pink font-weight-600 justify-content-between" id="video-67644fc481cbe850420241219-btn"><span><i class="bi bi-gift-fill"></i> Caixa premiada 🎁</span><span class="badge text-bg-light bg-opacity-75 text-uppercase">Aberta</span></div>
                                    <div class="mb-2">
                                        <div class="row justify-content-center align-items-center py-2">
                                            <div class="col-1 px-0"></div>
                                            <div class="col-auto ps-0">
                                                <h1><i class="bi bi-box text-danger"></i></h1>
                                            </div>
                                            <div class="col">
                                                <p class="my-1">Não foi dessa vez</p>
                                                <p class="font-xs my-1">sua <b>caixa premiada</b> veio vazia 🥲</p>
                                            </div>
                                            <div class="col-1 px-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area-box<?= $i ?>"></div>
<?php

                                }
                            }
                        } else {
                            $cards = "";
                        }
                    }
                }
?>

<div style="opacity: 1!important; color:#000" class="detalhes app-card card mb-2">
    <div class="card-body font-xs">
        <div class="font-xs opacity-75 mb-2 border-bottom-rgba text-dark d-flex justify-content-between">
            <div>
                <i class="bi bi-info-circle"></i> Detalhes da sua compra&nbsp;
                <div class="pt-1 opacity-50 mb-1">
                    <?= isset($order_token) ? $order_token : '' ?>
                </div>
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1">

            <div class="result font-xs text-dark" style="text-transform: uppercase;">
                <?php
                $customerQuery = $conn->query("SELECT firstname, lastname, phone FROM `customer_list` WHERE id = '{$customer_id}'");

                if ($customerQuery && $customerQuery->num_rows > 0) {
                    $customer = $customerQuery->fetch_assoc();
                    $firstname = $customer['firstname'];
                    $lastname = $customer['lastname'];
                    $phone = $customer['phone'];
                }
                $firstname = ucwords($firstname);
                $lastname = ucwords($lastname);
                echo $firstname . ' ' . $lastname . '';
                ?>
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1">
            <div class="title me-1 text-dark">
                <i class="bi bi-check-circle"></i> Transação
            </div>
            <div class="result font-xs text-dark">
                <?= $id ?>
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1">
            <div class="title me-1 text-dark"><i class="bi bi-phone"></i> Telefone</div>
            <div class="result font-xs text-dark">
                <?= formatPhoneNumber($phone) ?>
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1">
            <div class="title me-1 text-dark"><i class="bi bi-calendar-week"></i> Data/Hora</div>
            <div class="result font-xs text-dark"><?php echo date('d-m-Y H:i', strtotime($date_created)); ?>
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1">
            <div class="title me-1 text-dark">
                <i class="bi bi-card-list"></i>
                <?= $quantity ?> Cota(s)
            </div>
        </div>
        <div class="item d-flex align-items-baseline mb-1 pb-1 border-bottom-rgba">
            <div class="title me-1 mb-1 text-dark">
                <i class="bi bi-wallet2"></i> Valor
            </div>
            <div class="result font-xs text-dark">R$
                <?= number_format($total_amount, 2, ',', '.') ?>
            </div>
        </div>
        <div class="item  align-items-baseline container">
            <?php if ($type_of_draw == 1 && $status == 1 && $enable_hide_numbers == 1) {
                    echo ' <div style="margin-left:-12px" class="title font-weight-500 me-1">                       <i class="bi me-1 bi-card-list"></i> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                               Cotas:</div>';
                } ?>
            <div class="result font-xs  row" data-nosnippet="true" style="overflow:hidden; gap:4px;">
                <?php
                if ($type_of_draw > 2) {
                    echo leowp_format_luck_numbers($my_numbers, $row['qty_numbers'], $class = 'alert-success', $opt = true, $type_of_draw);
                } elseif ($type_of_draw == 1 && $status == 1 && $enable_hide_numbers == 1) {
                    echo '            <p class="alert alert-warning p-2 mt-2 font-xss" style="text-align: justify; margin-bottom:0.5rem !important">As cotas serão geradas após o pagamento.</p>
       ';
                } else {
                    echo leowp_format_luck_numbers($sliced_numbers, $limit, $class = 'alert-success ', $opt = true, $type_of_draw);

                ?>
            </div>
            <div style="margin-top: 16px">

                <?php
                    // Calcule o número total de páginas
                    $total_pages = ceil(count($my_numbers) / $limit);
                    if ($total_pages > 1) {
                ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?&p<?php echo $current_page - 1; ?>">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            // Calcule o número total de páginas

                            // Mostre a página anterior, atual e próxima
                            if ($current_page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?&pg=' . ($current_page - 1) . '" >' . ($current_page - 1) . '</a></li>';
                            }
                            echo '<li class="page-item active"><a class="page-link" href="?&pg=' . $current_page . '" >' . $current_page . '</a></li>';

                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';

                            ?>
                            <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?&pg=<?php echo $current_page + 1; ?>">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php
                    }
                ?>
            </div>
        </div>
    <?php    } ?>
    <div class="item d-flex align-items-baseline mb-1 pb-1 border-bottom-rgba border-1"></div>
    <?php echo $mensagem; ?>
    </div>
</div>
    </div>
</div>
</div>


<?php
            endwhile;
?>

<script>
    $("#btmqr").on('click', (function() {
        if (document.getElementById('exibeqr').style.display == 'flex') {
            document.getElementById('exibeqr').style.display = 'none';
            document.getElementById('btmqr').value = "Mostrar QR Code";
        } else {
            document.getElementById('exibeqr').style.display = "flex";
            document.getElementById('btmqr').value = "Ocultar QR Code";
        }
    }));

    function copyPix() {
        var copyText = document.getElementById("pixCopiaCola");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        document.execCommand("copy");
        navigator.clipboard.writeText(copyText.value);

        alert("Chave pix 'Copia e Cola' copiada com sucesso!");
    }
    $(document).ready(function() {
        var tempoInicial = parseInt('<?= $order_expiration; ?>');
        var token = '<?= isset($order_token) ? $order_token : '' ?>';
        var progressoMaximo = 100;
        var tempoRestante;

        if (localStorage.getItem(token)) {
            tempoRestante = parseInt(localStorage.getItem(token));
        } else {
            tempoRestante = tempoInicial * 60;
            localStorage.setItem(token, tempoRestante);
        }

        var intervalo = setInterval(function() {
            var minutos = Math.floor(tempoRestante / 60);
            var segundos = tempoRestante % 60;
            var tempoFormatado = minutos.toString().padStart(2, '0') + ':' + segundos.toString().padStart(2, '0');
            $('#tempo-restante').text(tempoFormatado);
            var progresso = ((tempoInicial * 60 - tempoRestante) / (tempoInicial * 60)) * progressoMaximo;
            $('#barra-progresso').css('width', progresso + '%').attr('aria-valuenow', progresso);
            tempoRestante--;
            localStorage.setItem(token, tempoRestante);
            if (tempoRestante < 0) {
                clearInterval(intervalo);
                localStorage.removeItem(token);
            }
        }, 1000);

        <?php if ($status == 1) { ?>
            setInterval(function() {
                var check = {
                    order_token: '<?= $order_token ?>',
                };
                $.ajax({
                    type: 'POST',
                    url: _base_url_ + "class/Main.php?action=check_order",
                    dataType: 'json',
                    data: check,

                    success: function(resp) {
                        console.log(resp.status);
                        if (resp.status == '2') {
                            window.location.reload();
                        }
                    },
                });
            }, 3000);
        <?php } ?>

    });
</script>

<?php
$partes = array_slice(explode(":", $cotas_premiadas_premios), 0, 18);
// Inicializar um array para os prêmios
$prizes = [];
$totalPrizes = (count($partes) / 2); // Número total de prêmios

// Determinar quantos "Perdeu" serão adicionados, no máximo 3
$numPerdeu = min(3, ceil($totalPrizes / 2)); // No máximo 3 "Perdeu"

// Adiciona o primeiro "Perdeu"
$prizes[] = "Perdeu"; 

// Agora, adicionamos os prêmios e distribuímos o "Perdeu"
$perdeuCount = 1; // Já temos 1 "Perdeu"
$prizeIndex = 0; // Contador de prêmios

for ($i = 1; $i < count($partes); $i += 2) { 
    // Pega o valor do prêmio
    $prize = $partes[$i];

    // Adiciona o prêmio ao array $prizes
    $prizes[] = $prize;
    
    // Adiciona "Perdeu" após 3 prêmios
    if ($perdeuCount < $numPerdeu && (($prizeIndex + 1) % 3 == 0)) {
        $prizes[] = "Perdeu";
        $perdeuCount++;
    }

    $prizeIndex++;
}



// Exibir o resultado final


for ($i = 0; $i < $roleta; $i++) {

    if ($tipo_roleta) {
?>
        <script>
            $(document).ready(function() {

                $('.btn-giragira<?= $i ?>').click(function() {
                    $('#roleta-premiada--roda<?= $i ?>').removeClass('d-none')
                })
                const canvas<?= $i ?> = document.getElementById('wheel<?= $i ?>');
                const ctx<?= $i ?> = canvas<?= $i ?>.getContext('2d');
                const spinButton<?= $i ?> = document.getElementById('spin<?= $i ?>');
                const spinAudio<?= $i ?> = document.getElementById('spinAudio<?= $i ?>');
                const spinPerdeu<?= $i ?> = document.getElementById('spinAudio-audio-perdeu<?= $i ?>');
                const spinGanhou<?= $i ?> = document.getElementById('spinAudio-audio-ganhou<?= $i ?>');

                // Prêmios da roleta
                const prizes<?= $i ?> = <?php echo json_encode($prizes); ?>;

                // Função para desenhar a roleta
                function drawWheel<?= $i ?>() {
                    const numPrizes<?= $i ?> = prizes<?= $i ?>.length;
                    const anglePerPrize<?= $i ?> = (2 * Math.PI) / numPrizes<?= $i ?>;
                    const radius<?= $i ?> = canvas<?= $i ?>.width / 2 * 0.95; // Aumentando o tamanho da roleta (95% do tamanho do canvas)

                    // Limpar o canvas antes de desenhar novamente
                    ctx<?= $i ?>.clearRect(0, 0, canvas<?= $i ?>.width, canvas<?= $i ?>.height);

                    // Mover o ponto de origem para o centro da roleta
                    ctx<?= $i ?>.translate(canvas<?= $i ?>.width / 2, canvas<?= $i ?>.height / 2); // Movendo a origem para o centro

                    // Desenhar os segmentos da roleta
                    for (let i = 0; i < numPrizes<?= $i ?>; i++) {
                        ctx<?= $i ?>.beginPath();
                        ctx<?= $i ?>.moveTo(0, 0); // Começar do centro
                        ctx<?= $i ?>.arc(0, 0, radius<?= $i ?>, i * anglePerPrize<?= $i ?>, (i + 1) * anglePerPrize<?= $i ?>); // Desenha o arco

                        // Verifica se o prêmio é "Perdeu"
                        const isPerdeu = prizes<?= $i ?>[i] === "Perdeu";

                        // Define a cor de fundo: se for "Perdeu", fica vermelho; caso contrário, usa a cor alternada
                        ctx<?= $i ?>.fillStyle = isPerdeu ? '#ff0000' : (i % 2 === 0 ? '#0543ac' : '#ffcc00');
                        ctx<?= $i ?>.fill();

                        // Adicionar o texto do prêmio nas bordas da roleta
                        const prizeAngle<?= $i ?> = i * anglePerPrize<?= $i ?> + anglePerPrize<?= $i ?> / 2; // Posição do texto
                        const textRadius<?= $i ?> = radius<?= $i ?> - 50; // Aumentando a distância do texto para o centro (ajustado para dentro do arco)
                        const textX<?= $i ?> = textRadius<?= $i ?> * Math.cos(prizeAngle<?= $i ?>);
                        const textY<?= $i ?> = textRadius<?= $i ?> * Math.sin(prizeAngle<?= $i ?>);

                        ctx<?= $i ?>.save();
                        ctx<?= $i ?>.translate(textX<?= $i ?>, textY<?= $i ?>); // Transladar para a posição correta
                        ctx<?= $i ?>.rotate(prizeAngle<?= $i ?> + Math.PI / 2); // Rotaciona o texto para ficar reto

                        // Colocar o texto na vertical
                        ctx<?= $i ?>.rotate(Math.PI / 2); // Rotaciona o texto 90 graus para ficar vertical

                        // Deslocar o texto um pouco mais para dentro (padding-left)
                        const paddingLeft<?= $i ?> = 20; // Ajuste o valor conforme necessário para o "padding-left"
                        ctx<?= $i ?>.translate(paddingLeft<?= $i ?>, 0); // Aplicando o deslocamento no eixo X

                        ctx<?= $i ?>.textAlign = 'center';
                        ctx<?= $i ?>.fillStyle = '#fff';
                        ctx<?= $i ?>.font = '20px Arial'; // Aumentando a fonte e deixando em negrito
                        ctx<?= $i ?>.fillText(prizes<?= $i ?>[i], 0, 0);
                        ctx<?= $i ?>.restore();
                    }

                    // Restaurar a origem do canvas para o canto superior esquerdo
                    ctx<?= $i ?>.setTransform(1, 0, 0, 1, 0, 0); // Resetando a transformação
                }

                // Função para girar a roleta e sempre cair no índice 0
                function spinWheel<?= $i ?>() {
                    const numPrizes<?= $i ?> = prizes<?= $i ?>.length;
                    const spinAngleStart<?= $i ?> = Math.random() * 5 + 10; // Velocidade inicial do giro
                    const spinTimeTotal<?= $i ?> = 5; // Aumentado para fazer o giro mais devagar

                    // Calcular o ângulo de rotação necessário para que a roleta pare no índice 0
                    // A roleta deve girar um número de voltas + o ângulo para o índice 0
                    <?php if (!empty($numeros_premiados)): ?>
                        const rotations<?= $i ?> = Math.floor(Math.random() * 5) + 5.1; // 5 voltas completas aleatórias
                    <?php else: ?>
                        const rotations<?= $i ?> = Math.floor(Math.random() * 5) + 4.68; // 5 voltas completas aleatórias
                    <?php endif ?>
                    const targetAngle<?= $i ?> = rotations<?= $i ?> * 2 * Math.PI + (2 * Math.PI) / numPrizes<?= $i ?> * 0; // Gira até o índice 0

                    // Iniciar o áudio
                    spinAudio<?= $i ?>.play();

                    // Usar transform: rotate() diretamente no CSS para rotação
                    $('#wheel<?= $i ?>').css('transition', 'transform ' + spinTimeTotal<?= $i ?> + 's ease-out');
                    $('#wheel<?= $i ?>').css('transform', 'rotate(' + targetAngle<?= $i ?> + 'rad)'); // Aplicar a rotação usando CSS

                    // Parar a roleta e mostrar o prêmio depois que a rotação for concluída
                    setTimeout(() => {
                        const prizeIndex<?= $i ?> = 0; // O índice 0 é "Perdeu tudo"
                        $('#roleta-premiada--roda<?= $i ?>').addClass('d-none')
                        <?php if (!empty($numeros_premiados)): ?>
                            $('.achouacota').removeClass('d-none')
                            spinGanhou<?= $i ?>.play()
                        <?php else: ?>
                            $('.card-perdeu<?= $i ?>').removeClass('d-none')
                            spinPerdeu<?= $i ?>.play()
                        <?php endif ?>
                        $('.card-girar<?= $i ?>').addClass('d-none')
                        var check = {
                            order_token: '<?= $order_token ?>',
                            roleta: '<?= $roleta ?>'
                        };
                        $.ajax({
                            type: 'POST',
                            url: _base_url_ + "class/Main.php?action=att_roleta",
                            dataType: 'json',
                            data: check,
                            success: function(resp) {
                                console.log(resp)
                            },
                        });
                    }, spinTimeTotal<?= $i ?> * 1200); // Aguarda o tempo da rotação para mostrar o prêmio
                }

                // Desenhar a roleta inicialmente
                drawWheel<?= $i ?>();

                // Adicionar evento de clique no botão "Girar"
                spinButton<?= $i ?>.addEventListener('click', spinWheel<?= $i ?>);

            })
        </script>
    <?php } ?>
    <?php if ($tipo_box) { ?>
        <script>
            $(document).ready(function() {
                $('.btn-abrircaixa<?= $i ?>').click(function() {
                    const caixaAudio<?= $i ?> = document.getElementById('caixa-audio-abrindo<?= $i ?>');
                    const caixaPerdeu<?= $i ?> = document.getElementById('caixa-audio-perdeu<?= $i ?>');
                    const caixaGanhou<?= $i ?> = document.getElementById('caixa-audio-ganhou<?= $i ?>');
                    caixaAudio<?= $i ?>.play();
                    $('.area-box<?= $i ?>').append(`<div class="caixabox" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);background: #00000052;width: 100%;height: 100%;z-index: 9999;display: flex;justify-content: center;align-items: center;">
                <img src="<?= BASE_URL ?>uploads/caixa-abrindo.gif" alt="">
            </div>`)


                    setTimeout(() => {
                        $('.area-box<?= $i ?>').addClass('d-none')
                        $('.card-caixa-abrir<?= $i ?>').addClass('d-none')
                        <?php if (!empty($numeros_premiados)): ?>
                            $('.achouacota').removeClass('d-none')
                            caixaGanhou<?= $i ?>.play()
                        <?php else: ?>
                            caixaPerdeu<?= $i ?>.play();

                            $('.card-caixa-perdeu<?= $i ?>').removeClass('d-none')
                        <?php endif ?>
                        var check = {
                            order_token: '<?= $order_token ?>',
                            roleta: '<?= $roleta ?>'
                        };
                        $.ajax({
                            type: 'POST',
                            url: _base_url_ + "class/Main.php?action=att_roleta",
                            dataType: 'json',
                            data: check,
                            success: function(resp) {
                                console.log(resp)

                            },
                        });
                    }, 4000);
                })
            })
        </script>
    <?php } ?>
<?php } ?>