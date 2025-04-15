<?php


function strcasecmp_utf8($str1, $str2)
{
	return strcasecmp(mb_strtolower($str1, 'UTF-8'), mb_strtolower($str2, 'UTF-8'));
}

$status = (isset($_GET['status']) ? $_GET['status'] : '');
$stat_arr = ['Pending Orders', 'Packed Orders', 'Our for Delivery', 'Completed Order'];
$product_id = (isset($_GET['product_id']) ? $_GET['product_id'] : '');
$status_id = (isset($_GET['status_id']) ? $_GET['status_id'] : '');
$order = trim((isset($_GET['order']) ? $_GET['order'] : ''));
$order_number = trim((isset($_GET['order_number']) ? $_GET['order_number'] : ''));
$customer_phone = (isset($_GET['customer_phone']) ? $_GET['customer_phone'] : '');
$start_date = (isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-6 days')));
$end_date = (isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d'));
$tod = '';

if ($product_id) {
	$qry = $conn->query('SELECT type_of_draw FROM `product_list` WHERE id = ' . $product_id);

	if (0 < $qry->num_rows) {
		$row = $qry->fetch_assoc();
		$tod = $row['type_of_draw'];
	}
}

echo "\r\n" . '<style>' . "\r\n" . '.order_numbers{white-space:normal}tr.text-gray-700.dark\\:text-gray-400{vertical-align:text-bottom}.exportar-contatos{display:inline-block;margin-bottom:10px}@media all and (max-width:40em){.filtro-busca{display:block!important}}span#approve-payment{background:#2271b1;padding:6px;display:inline-block;margin-top:6px;border-radius:4px;color:#fff;cursor:pointer}td.px-4.py-3.text-sm {max-width: 240px;text-wrap: pretty;}@media only screen and (max-width:600px){.fb-2{margin-top:10px;width:100%}}@media only screen and (max-width:600px){.fb-2{margin-top:10px;width:100%}}' . "\r\n" . '</style>' . "\r\n\r\n" . '<main class="h-full pb-16 overflow-y-auto">' . "\r\n\t" . '<div class="container grid px-6 mx-auto">' . "\r\n\t\t" . '<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">' . "\r\n\t\t" . 'Pedidos <a href="./?page=orders/create_order" id="create_new"><button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t" . 'Cadastrar novo' . "\r\n\t\t" . '</button></a>' . "\r\n\t" . '</h2>' . "\r\n\t" . '<form action="" id="filter-form" style="margin-bottom:10px" method="GET">' . "\r\n\t\t" . '<div class="flex filtro-busca">' . "\r\n\t\t\t" . '<select name="product_id" id="product_id" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . '<option value="">Todos as campanhas</option>' . "\r\n\t\t\t\t";
$qry = $conn->query('SELECT * FROM `product_list`');

while ($row = $qry->fetch_assoc()) {
	echo "\t\t\t\t\t" . '<option value="';
	echo $row['id'];
	echo '" ';

	if ($product_id == $row['id']) {
		echo 'selected';
	}

	echo '>';
	echo $row['name'];
	echo '</option>' . "\r\n\t\t\t\t";
}

echo "\t\t\t" . '</select>' . "\r\n\t\t\t" . '<select name="status_id" id="status_id" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . '<option value="">Todos os status</option>' . "\r\n\t\t\t\t" . '<option value="2" ';

if ($status_id == '2') {
	echo 'selected';
}

echo '>Pago</option>' . "\r\n\t\t\t\t" . '<option value="1" ';

if ($status_id == '1') {
	echo 'selected';
}

echo '>Pendente</option>' . "\r\n\t\t\t\t" . '<option value="3" ';

if ($status_id == '3') {
	echo 'selected';
}

echo '>Cancelado</option>' . "\r\n\t\t\t" . '</select>' . "\r\n\r\n\t\t\t" . '<input name="order" id="order" value="';
echo $order;
echo '" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Pedido">' . "\r\n\t\t\t\r\n\t\t\t" . '<input name="order_number" id="order_number" value="';
echo $order_number;
echo '" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Cota">' . "\r\n\r\n\t\t\t" . '<input name="customer_phone" id="customer_phone" value="';
echo $customer_phone;
echo '" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Telefone">' . "\r\n\t\t\t\r\n\t\t\t" . '<input name="start_date" id="start_date" type="date" value="';
echo ($start_date ? $start_date : date('Y-m-d', strtotime('-7 days')));
echo '" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">' . "\r\n" . '            <input name="end_date" id="end_date" type="date" value="';
echo ($end_date ? $end_date : date('Y-m-d'));
echo '" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">' . "\r\n\r\n\t\t\t" . '<button class="fb-2 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple filtrar"> Filtrar</button>' . "\r\n\t\t" . '</div>' . "\r\n\t" . '</form>' . "\r\n\t";
if ((!empty($product_id) || !empty($status_id) || !empty($order) || !empty($order_number) || !empty($customer_phone)) && $_settings->userdata('type') == '1') {
	echo "\t\t" . '<button class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple exportar-contatos" onclick="export_raffle_contacts();">Exportar Pedidos</button>' . "\r\n\t";
}

echo "\t" . '<div class="w-full overflow-hidden rounded-lg shadow-xs">' . "\r\n\t\t" . '<div class="w-full overflow-x-auto">' . "\r\n\t\t\t" . '<table class="w-full whitespace-no-wrap">' . "\r\n\t\t\t\t" . '<thead>' . "\r\n\t\t\t\t\t" . '<tr' . "\r\n\t\t\t\t\t" . 'class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">ID</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Data</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Campanha</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Cliente</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Whats</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Qtd</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Números</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Total</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Afiliado</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Status</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Ação</th>' . "\r\n\t\t\t\t" . '</tr>' . "\r\n\t\t\t" . '</thead>' . "\r\n\t\t\t" . '<tbody' . "\r\n\t\t\t" . 'class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">' . "\r\n\t\t\t";
$perPage = 20;
$page = (isset($_GET['pg']) ? $_GET['pg'] : 1);
$offset = $perPage * ($page - 1);
$i = 1;
$where = '';

if ($product_id) {
	$where .= ' AND o.product_id = \'' . $product_id . '\'';
}

if ($status_id) {
	$where .= ' AND o.status = \'' . $status_id . '\'';
}
if ($start_date || $end_date) {
	$where .= ' AND o.date_created BETWEEN \'' . $start_date . ' 00:00:00\' AND \'' . $end_date . ' 23:59:59\'';
}

if ($order) {
	$where .= ' AND o.id = \'' . $order . '\'';
}

if ($order_number) {
	if (ctype_alpha($order_number) && $tod == '3') {
		$bichos = ['00' => 'Avestruz', '01' => 'Águia', '02' => 'Burro', '03' => 'Borboleta', '04' => 'Cachorro', '05' => 'Cabra', '06' => 'Carneiro', '07' => 'Camelo', '08' => 'Cobra', '09' => 'Coelho', 10 => 'Cavalo', 11 => 'Elefante', 12 => 'Galo', 13 => 'Gato', 14 => 'Jacaré', 15 => 'Leão', 16 => 'Macaco', 17 => 'Porco', 18 => 'Pavão', 19 => 'Peru', 20 => 'Touro', 21 => 'Tigre', 22 => 'Urso', 23 => 'Veado', 24 => 'Vaca'];
		$foundNumber = NULL;

		foreach ($bichos as $number => $animal) {
			if (strcasecmp_utf8($order_number, $animal) === 0) {
				$foundNumber = $number;
				break;
			}
		}

		if ($foundNumber !== null) {
			$order_number = $foundNumber;
		}
	}
	else if (ctype_alpha($order_number) && $tod == '4') {
		$bichos = ['00' => 'Avestruz M1', '01' => 'Avestruz M2', '02' => 'Águia M1', '03' => 'Águia M2', '04' => 'Burro M1', '05' => 'Burro M2', '06' => 'Borboleta M1', '07' => 'Borboleta M2', '08' => 'Cachorro M1', '09' => 'Cachorro M2', 10 => 'Cabra M1', 11 => 'Cabra M2', 12 => 'Carneiro M1', 13 => 'Carneiro M2', 14 => 'Camelo M1', 15 => 'Camelo M2', 16 => 'Cobra M1', 17 => 'Cobra M2', 18 => 'Coelho M1', 19 => 'Coelho M2', 20 => 'Cavalo M1', 21 => 'Cavalo M2', 22 => 'Elefante M1', 23 => 'Elefante M2', 24 => 'Galo M1', 25 => 'Galo M2', 26 => 'Gato M1', 27 => 'Gato M2', 28 => 'Jacaré M1', 29 => 'Jacaré M2', 30 => 'Leão M1', 31 => 'Leão M2', 32 => 'Macaco M1', 33 => 'Macaco M2', 34 => 'Porco M1', 35 => 'Porco M2', 36 => 'Pavão M1', 37 => 'Pavão M2', 38 => 'Peru M1', 39 => 'Peru M2', 40 => 'Touro M1', 41 => 'Touro M2', 42 => 'Tigre M1', 43 => 'Tigre M2', 44 => 'Urso M1', 45 => 'Urso M2', 46 => 'Veado M1', 47 => 'Veado M2', 48 => 'Vaca M1', 49 => 'Vaca M2'];
		$foundNumber = NULL;

		foreach ($bichos as $number => $animal) {
			if (strcasecmp_utf8($order_number, $animal) === 0) {
				$foundNumber = $number;
				break;
			}
		}

		if ($foundNumber !== null) {
			$order_number = $foundNumber;
		}
	}

	$regex = '(^' . $order_number . ',|,' . $order_number . ',|,' . $order_number . '$|^' . $order_number . '$)';
	$where .= ' AND o.order_numbers REGEXP \'' . $regex . '\'';
}

if ($customer_phone) {
	$subquery = '(SELECT id FROM customer_list WHERE phone LIKE \'%' . $customer_phone . '%\')';
	$where .= ' AND o.customer_id IN ' . $subquery;
}

if (!empty($where)) {
	$where = ' WHERE ' . ltrim($where, ' AND');
}

$qry = $conn->query('SELECT o.*, CONCAT(c.firstname, \' \', c.lastname) as customer, p.type_of_draw, c.phone, o.whatsapp_status' . "\r\n\t\t\t\t" . 'FROM `order_list` o' . "\r\n\t\t\t\t" . 'INNER JOIN customer_list c ON o.customer_id = c.id' . "\r\n\t\t\t\t" . 'INNER JOIN product_list p ON o.product_id = p.id' . "\r\n\t\t\t\t" . $where . "\r\n\t\t\t\t" . 'ORDER BY ABS(UNIX_TIMESTAMP(o.date_created)) DESC' . "\r\n\t\t\t\t" . 'LIMIT ' . $perPage . ' OFFSET ' . $offset);
$totalResults = $conn->query('SELECT o.* FROM order_list o ' . $where)->num_rows;

while ($row = $qry->fetch_assoc()) {
	echo "\t\t\t\t" . '<tr class="text-gray-700 dark:text-gray-400">' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t" . '#';
	echo $row['id'];
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo date('d-m-Y', strtotime($row['date_created'])) . '<br> ás ' . date('H:i', strtotime($row['date_created']));
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo $row['product_name'];
	echo "\t\t\t\r\n\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo $row['customer'];
	echo "\t\t\t\t\t\t" . '<p class="text-xs" style="white-space: nowrap;">';
	echo substr(formatPhoneNumber($row['phone']), 0, -5) . '****';
	echo '</p>' . "\r\n\t\t\t\t\t" . '</td>' . "\r\n\t\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n" . '                    ';
	echo drope_send_whatsapp($row['id'], $row['code'], $row['status'], $row['customer'], $row['phone'], $row['product_name'], $row['order_numbers'], $row['quantity'], format_num($row['total_amount'], 2), $row['whatsapp_status'], $row['type_of_draw']);
	echo "\t\t\r\n\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo $row['quantity'];
	echo "\t\r\n\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t" . '<div class="order_numbers">' . "\t\t\t\t\t\t\t\r\n\t\t\t";
	$nCollection = array_filter(explode(',', $row['order_numbers']));
	$qty_nums = count($nCollection);
	$type_of_draw = $row['type_of_draw'];

	if (500 < $qty_nums) {
		echo 'Indisponível devido a alta quantidade';
	}
	else if (10 < $qty_nums) {
		if ($row['status'] == 3) {
			echo '<div class="drope-tab">' . "\r\n\t\t\t\t\t" . '<input id="drope-tab-' . $row['id'] . '" type="checkbox">' . "\r\n\t\t\t\t\t" . '<label for="drope-tab-' . $row['id'] . '">Ver números</label>' . "\r\n\t\t\t\t\t" . '<div class="drope-content"><s>' . drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw) . '</s></div>' . "\r\n\t\t\t\t\t" . '</div>';
		}
		else {
			echo '<div class="drope-tab">' . "\r\n\t\t\t\t\t" . '<input id="drope-tab-' . $row['id'] . '" type="checkbox">' . "\r\n\t\t\t\t\t" . '<label for="drope-tab-' . $row['id'] . '">Ver números</label>' . "\r\n\t\t\t\t\t" . '<div class="drope-content">' . drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw) . '</div>' . "\r\n\t\t\t\t\t" . '</div>';
		}
	}
	else if ($row['status'] == 3) {
		echo '<s>' . drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw) . '</s>';
	}
	else {
		echo drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw);
	}

	echo '   ' . "\r\n\r\n\t\t\t\t\t\t" . '</div>' . "\t\r\n\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t" . 'R$ ';
	echo format_num($row['total_amount'], 2);
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo ($row['referral_id'] ? $row['referral_id'] : '-');
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-xs">' . "\r\n\t\t\t\t\t\t";

	switch ($row['status']) {
	case 1:
		echo '<span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Pendente</span>';
		echo '<br><span onclick="update_order_status(' . $row['id'] . ', 2);" id="approve-payment">Aprovar</span>';
		break;
	case 2:
		echo '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Pago</span>';

		if ($row['payment_method']) {
			echo '<br>' . $row['payment_method'] . '<br>';
		}
		else {
			echo '<br>Automático<br>';
		}

		if ($row['date_updated']) {
			echo '' . date('d-m-Y', strtotime($row['date_updated'])) . '<br> ás ' . date('H:i', strtotime($row['date_updated'])) . '';
		}

		break;
	case 3:
		echo '<span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">Cancelado</span>';
		echo '<br><span onclick="update_order_status(' . $row['id'] . ', 2);" id="approve-payment">Aprovar</span>';
		break;
	}

	echo "\t\t\t\t\r\n\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t\t\t\t" . '<div class="flex items-center space-x-4 text-sm">' . "\r\n\t\t\t\t\t\t\t" . '<a href="./?page=orders/view_order&id=';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t\t" . 'aria-label="View"' . "\r\n\t\t\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />' . "\r\n\t\t\t\t\t\t\t\t\t" . '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />' . "\r\n\t\t\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t" . '</a>' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
	if (empty($row['order_numbers']) && $row['status'] == 2) {
		echo "\t\t\t\t\t\t\t" . '<a class="corrigir_pedido" data-id="';
		echo $row['id'];
		echo '">' . "\r\n\t\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t\t\t" . 'title="Corrigir pedido" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t\t\t" . 'aria-label="View">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-check" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514Z"/>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t\t" . '</a>' . "\r\n\t\t\t\t\t\t";
	}

	echo "\r\n\t\t\t\t\t\t";

	if ($qty_nums != $row['quantity']) {
		echo "\t\t\t\t\t\t\t" . '<a class="corrigir_quantity" data-id="';
		echo $row['id'];
		echo '" quantity="';
		echo $row['quantity'] - $qty_nums;
		echo '">' . "\r\n\t\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t\t\t" . 'title="Corrigir pedido" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t\t\t" . 'aria-label="View">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-check" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514Z"/>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t\t" . '</a>' . "\r\n\t\t\t\t\t\t";
	}

	echo "\r\n\t\t\t\t\t\t";

	if (str_contains($row['order_numbers'], 'Array')) {
		echo "\t\t\t\t\t\t\t" . '<a class="corrigir_array" data-id="';
		echo $row['id'];
		echo '" product-id="';
		echo $row['product_id'];
		echo '">' . "\r\n\t\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t\t\t" . 'title="Corrigir pedido" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t\t\t" . 'aria-label="View">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-check" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514Z"/>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t\t" . '</a>' . "\r\n\t\t\t\t\t\t";
	}

	echo "\t\t\t\t\t\t\r\n\t\t\t\t\t\t";

	if ($_settings->userdata('type') == '1') {
		echo "\t\t\t\t\t\t" . '<a class="delete_pedido" href="javascript:void(0)" @click="openModal" data-id="';
		echo $row['id'];
		echo '">' . "\r\n\t\t\t\t\t\t\t" . '<button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">' . "\r\n\t\t\t\t\t\t\t\t" . '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>' . "\r\n\t\t\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t" . '</a>' . "\r\n\t\t\t\t\t\t";
	}

	echo "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n";
}

echo "\r\n" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '<div' . "\r\n" . 'class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"' . "\r\n" . '>' . "\r\n" . '<span class="flex items-center col-span-3">' . "\r\n" . '</span>' . "\r\n" . '<span class="col-span-2"></span>' . "\r\n\r\n\r\n" . '<!-- Pagination -->' . "\r\n" . '<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">' . "\r\n\t" . '<nav aria-label="Table navigation">' . "\r\n\t\t" . '<ul class="inline-flex items-center">' . "\r\n\t\t\t";
$totalPages = ceil($totalResults / $perPage);
echo "\t\t\t";

if (1 < $page) {
	echo "\t\t\t\t" . '<a href=\'./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page - 1;
	echo '\'><li>' . "\r\n\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t" . 'class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n\t\t\t\t\t" . 'aria-label="Previous"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<svg' . "\r\n\t\t\t\t\t" . 'class="w-4 h-4 fill-current"' . "\r\n\t\t\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t\t\t" . 'viewBox="0 0 20 20"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<path' . "\r\n\t\t\t\t\t" . 'd="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"' . "\r\n\t\t\t\t\t" . 'clip-rule="evenodd"' . "\r\n\t\t\t\t\t" . 'fill-rule="evenodd"' . "\r\n\t\t\t\t\t" . '></path>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</li></a>' . "\r\n\t";
}

echo "\r\n\t";

if (3 < $page) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=1"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</button></li></a>' . "\r\n\t\t" . '<li class="dots">...</li>' . "\r\n\t";
}

echo "\r\n\t";

if (0 < ($page - 2)) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page - 2;
	echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page - 2;
	echo '</button></li></a>' . "\r\n\t";
}

echo "\r\n\t";

if (0 < ($page - 1)) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page - 1;
	echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page - 1;
	echo '</button></li></a>' . "\r\n\t";
}

echo "\r\n\t" . '<a href="./?page=orders&product_id=';
echo $product_id;
echo '&status_id=';
echo $status_id;
echo '&order_number=';
echo $order_number;
echo '&customer_phone=';
echo $customer_phone;
echo '&start_date=';
echo $start_date;
echo '&end_date=';
echo $end_date;
echo '&pg=';
echo $page;
echo '">' . "\r\n\t\t" . '<li>' . "\r\n\t\t\t" . '<button' . "\t" . 'class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">';
echo $page;
echo '</button>' . "\r\n\t\t" . '</li>' . "\r\n\t" . '</a>' . "\r\n\t";

if (($page + 1) < ($totalPages + 1)) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page + 1;
	echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page + 1;
	echo '</button></li></a>' . "\t\r\n\t";
}

echo "\r\n\t";

if (($page + 2) < ($totalPages + 1)) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page + 2;
	echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page + 2;
	echo '</button></li></a>' . "\r\n\t";
}

echo "\r\n\t";

if ($page < ($totalPages - 2)) {
	echo "\t\t" . '<li class="dots">...</li>' . "\r\n\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $totalPages;
	echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $totalPages;
	echo '</button></li></a>' . "\r\n\t";
}

echo "\r\n\r\n\t";

if ($page < $totalPages) {
	echo "\t\t" . '<a href="./?page=orders&product_id=';
	echo $product_id;
	echo '&status_id=';
	echo $status_id;
	echo '&order_number=';
	echo $order_number;
	echo '&customer_phone=';
	echo $customer_phone;
	echo '&start_date=';
	echo $start_date;
	echo '&end_date=';
	echo $end_date;
	echo '&pg=';
	echo $page + 1;
	echo '"><li>' . "\r\n\t\t\t" . '<button' . "\r\n\t\t\t" . 'class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n\t\t\t" . 'aria-label="Next"' . "\r\n\t\t\t" . '>' . "\r\n\t\t\t" . '<svg' . "\r\n\t\t\t" . 'class="w-4 h-4 fill-current"' . "\r\n\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t" . 'viewBox="0 0 20 20"' . "\r\n\t\t\t" . '>' . "\r\n\t\t\t" . '<path' . "\r\n\t\t\t" . 'd="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"' . "\r\n\t\t\t" . 'clip-rule="evenodd"' . "\r\n\t\t\t" . 'fill-rule="evenodd"' . "\r\n\t\t\t" . '></path>' . "\r\n\t\t" . '</svg>' . "\r\n\t" . '</button>' . "\r\n" . '</li>' . "\r\n" . '</a>' . "\r\n";
}

echo "\r\n" . '</ul>' . "\r\n" . '</nav>' . "\r\n" . '</span>' . "\r\n" . '<!-- End pagination -->' . "\r\n\r\n\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</main>' . "\r\n\r\n" . '<!-- Modal Delete -->' . "\r\n" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">' . "\r\n\t" . '<!-- Modal -->' . "\r\n\t" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal" style="display: none;">' . "\r\n\t\t" . '<!-- Remove header if you don\'t want a close icon. Use modal body to place modal tile. -->' . "\r\n\t\t" . '<header class="flex justify-end">' . "\r\n\t\t\t" . '<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">' . "\r\n\t\t\t\t" . '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">' . "\r\n\t\t\t\t\t" . '<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</header>' . "\r\n\t\t" . '<div class="mt-4 mb-6">' . "\r\n\t\t\t" . '<p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">' . "\r\n\t\t\t\t" . 'Deseja excluir?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t\t" . '<p class="text-sm text-gray-700 dark:text-gray-400">' . "\r\n\t\t\t\t" . 'Você realmente deseja excluir esse pedido?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t" . '</div>' . "\r\n\t\t" . '<footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">' . "\r\n\t\t\t" . '<button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . 'Não' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t\t" . '<button class="delete_data w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t\t" . 'Sim' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</footer>' . "\r\n\t" . '</div>' . "\r\n" . '</div>' . "\r\n\r\n" . '<!-- End Modal Delete -->' . "\r\n" . '<script>' . "\r\n\t" . '$(document).ready(function(){' . "\r\n\t\t" . '$(\'.delete_pedido\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . '$(\'.delete_data\').attr(\'data-id\', id);' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.delete_data\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'delete_order(id)' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.send-whatsapp\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-post-id\');' . "\r\n\t\t\t" . 'update_whatsapp_status(id);' . "\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.corrigir_pedido\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'correct_order(id)' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.corrigir_array\').click(function(){' . "\r\n\t\t\t" . 'var oid = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'var pid = $(this).attr(\'product-id\');' . "\r\n\t\t\t" . 'correct_array(oid, pid)' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.corrigir_quantity\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'var qtd = $(this).attr(\'quantity\');' . "\r\n\t\t\t" . 'correct_quantity(id, qtd)' . "\t\r\n\t\t" . '})' . "\r\n\r\n\r\n\t" . '})' . "\r\n\t" . 'function delete_order($id){' . "\r\n\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=delete_order",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO01] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO02] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . 'function correct_quantity($id, $qtd){' . "\r\n\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=correct_quantity",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id, qtd: $qtd},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO15] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO16] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . 'function correct_order($id){' . "\r\n\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=correct_order",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO03] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO04] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . 'function correct_array($oid, $pid){' . "\r\n\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=correct_array",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{oid: $oid, pid: $pid},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO10] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO11] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . 'function update_whatsapp_status($id){' . "\r\n\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=update_whatsapp_status",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO03] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO04] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n" . 'function export_raffle_contacts() {' . "\r\n" . '    var raffle = $(\'#product_id\').val();' . "\r\n" . '    var status = $(\'#status_id\').val();' . "\r\n" . '    ' . "\r\n" . '    // Montar a URL do download' . "\r\n" . '    var downloadURL = _base_url_ + "class/Main.php?action=export_raffle_contacts2&raffle=" + raffle + "&status=" + status;' . "\r\n\r\n" . '    // Redirecionar o navegador para a URL de download' . "\r\n" . '    window.location.href = downloadURL;' . "\r\n" . '}' . "\r\n\r\n\t" . 'function update_order_status(id, status){' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=update_order_status_sys",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: id, status: status},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO05] - An error occured.");' . "\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . '//alert(\'O status do pedido foi atualizado com sucesso!\');' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert(resp.msg);' . "\r\n\t\t\t\t\t" . '//alert("[AO06] - An error occured.");' . "\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . '$(function(){' . "\r\n\t\t" . '$(\'#filter-form\').submit(function(e){' . "\r\n\t\t\t" . 'e.preventDefault()' . "\r\n\t\t\t" . 'location.href = \'./?page=orders&\'+$(this).serialize()' . "\r\n\t\t" . '})' . "\r\n\r\n\r\n\t" . '})' . "\r\n" . '</script>';

?>