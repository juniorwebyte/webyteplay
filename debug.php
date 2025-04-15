<?php

require_once('gateway/phpqrcode/qrlib.php');
require_once('gateway/funcoes_pix.php');
$next_client_id = '7d4bom4r7g1f053v1rcd1o3edg';
$next_client_secret = '1pfggbqb5ivupiunogtbjo4t9v265mn5u12gpp0m40o03gm5250b';
// $tokenEzze = $ezzepay_client_id . ":" . $ezzepay_client_secret;
// $client_credentials = base64_encode($tokenEzze);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://oauth2.nextpayments.com.br/oauth2/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=' . $next_client_id . '&client_secret=' . $next_client_secret . '',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
    ),
));

$response = curl_exec($curl);

curl_close($curl);


$result = json_decode($response);

$token = $result->access_token;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.nextpayments.com.br/pix/generate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
        "externalId": "215214445",
        "amount": 10,
        "customer": {
            "name": "teste coutinho",
            "document": "08352570021",
            "email": "admin245120@gmail.com",
            "mobilePhone": "64992750425"
        }
        }',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token . ''
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$result = json_decode($response, true);
//$pix_qrcode = $result['base64image'];
$pix_code = $result['pixCopyPaste'];
$payment_method = 'nextpay';
$codePIXID = $result['id'];

$px = decode_brcode($pix_code);
$monta_pix = montaPix($px);
ob_start();
QRCode::png($monta_pix, NULL, 'M', 5);
$imageString = base64_encode(ob_get_contents());
ob_end_clean();
$pix_qrcode = $imageString;

echo $pix_qrcode;die;
