<?php


$root_dir = $_SERVER['DOCUMENT_ROOT'];
require_once $root_dir . '/settings.php';
$license_key = $_settings->info('license');
$status = '';
$url = '';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 0);
curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'api_key=225A632C-7B598C64-74403549-BDF93958&license_code=' . $license_key);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
$response = json_decode(curl_exec($curl));



?>