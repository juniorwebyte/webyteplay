<?php


require_once 'settings.php';
require_once 'pages/inc/header.php';
require_once 'pages/inc/set-custom-style.php';

if ($_settings->chk_flashdata('success')) {
	echo '<script>' . "\r\n" . '  $(function(){' . "\r\n" . '    alert_toast("';
	echo $_settings->flashdata('success');
	echo '",\'success\')' . "\r\n" . '  })' . "\r\n" . '</script>' . "\r\n";
}

echo "\r\n";
$page = (isset($_GET['p']) ? $_GET['p'] : 'pages/home');
if (!file_exists($page . '.php') && !is_dir($page)) {
	include '404.php';
}
else if (is_dir($page)) {
	include $page . '/index.php';
}
else {
	include $page . '.php';
}

echo "\r\n";
require_once 'pages/inc/footer.php';

?>