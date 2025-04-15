<?php


require_once '../settings.php';
require_once 'inc/header.php';

	$page = (isset($_GET['page']) ? $_GET['page'] : 'home');


$session = $_SESSION['userdata'];
if (($session['firstname'] == '') || $session['lastname'] == '' || $session['username'] == '' || $session['date_added'] == '') {
	exit();
}
if (!file_exists($page . '.php') && !is_dir($page)) {
	include 'pages/404.php';
	exit();
}
else if (is_dir($page)) {
	include $page . '/index.php';
}
else {
	include $page . '.php';
}

require_once 'inc/footer.php';

?>