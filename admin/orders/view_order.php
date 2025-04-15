<?php


if (isset($_GET['id']) && 0 < $_GET['id']) {
	$qry = $conn->query('SELECT * from `order_list` where id = \'' . $_GET['id'] . '\' ');

	if (0 < $qry->num_rows) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}

echo '<style>' . "\r\n\t" . '.order_numbers{padding:10px;max-width:150px;white-space:nowrap;overflow:auto}' . "\r\n" . '</style>' . "\r\n" . '<main class="h-full pb-16 overflow-y-auto">' . "\r\n\t" . '<div class="container px-6 mx-auto grid">' . "\r\n\t\t" . '<h2' . "\r\n\t\t" . 'class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"' . "\r\n\t\t" . '>' . "\r\n\t\t" . '#';
echo (isset($id) ? $id : '');
echo ' Detalhes' . "\r\n\t" . '</h2>' . "\r\n\r\n\r\n\t" . '<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">' . "\r\n\t\t" . '<label class="block text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Pedido:</span>' . "\r\n\t\t\t" . '<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t" . 'value="#';
echo (isset($id) ? $id : '');
echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\r\n\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">' . "\r\n\t\t\t\t" . 'Status' . "\r\n\t\t\t" . '</span>' . "\r\n\t\t\t" . '<select name="order_status" id="order_status"' . "\r\n\t\t\t" . 'class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"' . "\r\n\t\t\t" . '>' . "\r\n\t\t\t";
$status = (isset($status) ? $status : '');

switch ($status) {
case 1:
	echo '<option value="1" selected>Pendente</option>';
	echo '<option value="2">Pago</option>';
	echo '<option value="3">Cancelado</option>';
	break;
case 2:
	echo '<option value="1">Pendente</option>';
	echo '<option value="2" selected>Pago</option>';
	echo '<option value="3">Cancelado</option>';
	break;
case 3:
	echo '<option value="1">Pendente</option>';
	echo '<option value="2">Pago</option>';
	echo '<option value="3" selected>Cancelado</option>';
	break;
}

echo "\t\t" . '</select>' . "\r\n\t" . '</label>' . "\r\n";
$gt = 0;
$order_items = $conn->query("\r\n" . '  SELECT oi.*, p.name as product, p.price, p.image_path, p.type_of_draw, ol.order_numbers, ol.quantity as order_quantity, ol.discount_amount' . "\r\n" . '  FROM `order_items` oi' . "\r\n" . '  INNER JOIN product_list p ON oi.product_id = p.id' . "\r\n" . '  INNER JOIN order_list ol ON oi.order_id = ol.id' . "\r\n" . '  WHERE oi.order_id = \'' . $id . '\'' . "\r\n");
$order_total = $conn->query('SELECT total_amount FROM `order_list` WHERE `id` = \'' . $id . '\'');
$total = $order_total->fetch_assoc();

while ($row = $order_items->fetch_assoc()) {
	$gt += $row['price'] * $row['order_quantity'];
	echo "\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Campanha</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="';
	echo $row['product'];
	echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Quantidade de cotas</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="';
	echo $row['order_quantity'];
	echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Valor da cota</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="R$ ';
	echo format_num($row['price'], 2);
	echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n" . '    ';

	if ($row['discount_amount']) {
		$subtotal = $total['total_amount'] + $row['discount_amount'];
		$subtotal = format_num($subtotal, 2);
		echo "\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Subtotal</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="R$ ';
		echo $subtotal;
		echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Desconto</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="R$ ';
		echo format_num($row['discount_amount'], 2);
		echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\t" . '  ';
	}

	echo "\r\n\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Total</span>' . "\r\n\t\t\t" . '<input name="price" id="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="R$ ';
	echo format_num($total['total_amount'], 2);
	echo '" disabled/>' . "\r\n\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Cotas</span>' . "\r\n\t\t\t" . '<textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Descrição da campanha" disabled>';
	$type_of_draw = $row['type_of_draw'];

	if (2 < $type_of_draw) {
		$order_numbers = drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw);
		echo str_replace('<span class="comma-hide">', '', $order_numbers);
	}
	else {
		$order_numbers = drope_format_luck_numbers($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw);
		echo str_replace('<span class="comma-hide">', '', $order_numbers);
	}

	echo '   ' . "\r\n" . '</textarea>' . "\r\n\t\t" . '</label>' . "\r\n\t";
}

echo '</div>' . "\r\n" . '</div>' . "\r\n\r\n\r\n" . '</div>' . "\r\n" . '</main>' . "\r\n\r\n" . '<script>' . "\r\n\t" . '$(function(){' . "\r\n\t\t" . '$(\'#delete_data\').click(function(){' . "\r\n\t\t\t" . '_conf("Are you sure to delete this order permanently?","delete_order", ["';
echo (isset($id) ? $id : '');
echo '"])' . "\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'#order_status\').on(\'change\', function() {' . "\r\n\t\t\t" . 'let status = $(\'#order_status\').val();' . "\r\n\t\t\t" . 'update_order_status(\'';
echo (isset($id) ? $id : '');
echo '\', status);' . "\r\n\t\t" . '})' . "\r\n\t" . '})' . "\r\n\t" . 'function delete_order($id){' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=delete_order",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO11] - An error occured.");' . "\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.replace("./?page=orders");' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO12] - An error occured.");' . "\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . 'function update_order_status($id, $status){' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=update_order_status_sys",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id, status: $status},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AO13] - An error occured.");' . "\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'alert(\'O status do pedido foi atualizado com sucesso!\');' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AO14] - An error occured.");' . "\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n" . '</script>';

?>