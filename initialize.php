<?php
$date_expirate = '9999-99-99';

if ($date_expirate == date('Y-m-d')) {
?>
    <div style="width: 100vw; height: 100vh; display: flex; justify-content: center; align-items: center;flex-direction: column;">

        <h1>Pagamento não identificado!</h1>
        <div>
            <span>Entre em contato com o adminstrador do site.</span>
        </div>
    </div>

<?php

} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(1);
    if (!defined('BASE_URL')) define('BASE_URL', 'https://rifa1.gestorcontas.com.br/');
    if (!defined('BASE_REF')) define('BASE_REF', 'https://rifa1.gestorcontas.com.br');
    if (!defined('base_url')) define('base_url', 'https://rifa1.gestorcontas.com.br/');
    if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');

    if (!defined('BASE_APP')) define('BASE_APP', str_replace('\\', '/', __DIR__) . '/');
    if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
    if (!defined('DB_USERNAME')) define('DB_USERNAME', 'rifa1gestor');
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', 'rifa1gestor');
    if (!defined('DB_NAME')) define('DB_NAME', 'rifa1gestor');
}

?>