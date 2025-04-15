<?php

$status = (isset($_GET['status']) ? $_GET['status'] : '1');
echo '<style>' . "\r\n" . '#myProgress{width:100%;background-color:#ddd}#myBar{height:12px;background-color:#4caf50;text-align:center;line-height:30px;color:#fff}.alert{position:relative;padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem}.alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}' . "\r\n" . '</style>' . "\r\n" . '<main class="h-full pb-16 overflow-y-auto">' . "\r\n\t" . '<div class="container grid px-6 mx-auto">' . "\r\n\t\t" . '<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Campanhas' . "\r\n\t\t" . '<a href="./?page=products/manage_product" id="create_new">' . "\r\n\t\t\t" . '<button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t\t" . 'Criar novo' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n\t\t" . '</h2>' . "\r\n\t\t" . '<form action="" id="filter-form" style="margin-bottom:10px" method="GET">' . "\r\n\t\t" . '<div class="flex filtro-busca">' . "\r\n\t\t\t" . '<select name="status" id="status" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . '<option value="">Todos os status</option>' . "\r\n\t\t\t\t" . '<option value="1" ';

if ($status == '1') {
	echo 'selected';
}

echo '>Ativas</option>' . "\r\n\t\t\t\t" . '<option value="2" ';

if ($status == '2') {
	echo 'selected';
}

echo '>Pausadas</option>' . "\r\n\t\t\t\t" . '<option value="3" ';

if ($status == '3') {
	echo 'selected';
}

echo '>Finalizadas</option>' . "\r\n\t\t\t" . '</select>' . "\r\n\t\t\t" . '<button class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple filtrar"> Filtrar</button>' . "\r\n\t\t" . '</div>' . "\r\n\t" . '</form>' . "\t\r\n\t" . '<div class="w-full overflow-hidden rounded-lg shadow-xs">' . "\r\n\t\t" . '<div class="w-full overflow-x-auto">' . "\r\n\t\t\t" . '<table class="w-full whitespace-no-wrap">' . "\r\n\t\t\t\t" . '<thead>' . "\r\n\t\t\t\t\t" . '<tr' . "\r\n\t\t\t\t\t" . 'class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Campanha</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Tipo</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Valor</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Qtd. Números</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Status</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Data</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Ação</th>' . "\r\n\t\t\t\t" . '</tr>' . "\r\n\t\t\t" . '</thead>' . "\r\n\t\t\t" . '<tbody' . "\r\n\t\t\t" . 'class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"' . "\r\n\t\t\t" . '>' . "\r\n\t\t\t";
$perPage = 10;
$page = (isset($_GET['pg']) ? $_GET['pg'] : 1);
$offset = $perPage * ($page - 1);
$i = 1;
$where = '';

if ($status) {
	$where .= ' AND status = \'' . $status . '\'';
}

if (!empty($where)) {
	$where = ' WHERE ' . ltrim($where, ' AND');
}

$qry = $conn->query('SELECT * from `product_list` ' . $where . ' ORDER BY id DESC LIMIT ' . $perPage . ' OFFSET ' . $offset);
$totalResults = $conn->query('SELECT id FROM product_list ' . $where)->num_rows;
$totalPages = ceil($totalResults / $perPage);

while ($row = $qry->fetch_assoc()) {
	$qry2 = $conn->query('SELECT SUM(quantity) FROM order_list WHERE product_id = ' . $row['id'] . ' AND status <> 3');
	$row2 = $qry2->fetch_assoc();
	$quantityy = $row2['SUM(quantity)'];
	$percent = ($row2['SUM(quantity)'] * 100) / $row['qty_numbers'];
	$percent = number_format($percent, 2, '.', '');
	echo "\t\t\t\t" . '<tr class="text-gray-700 dark:text-gray-400">' . "\r\n\t\t\t\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t\t\t\t" . '<div class="flex items-center text-sm">' . "\r\n\t\t\t\t\t\t\t" . '<!-- Avatar with inset shadow -->' . "\r\n\t\t\t\t\t\t\t" . '<div' . "\r\n\t\t\t\t\t\t\t" . 'class="relative hidden w-8 h-8 mr-3 rounded-full md:block"' . "\r\n\t\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t\t" . '<img' . "\r\n\t\t\t\t\t\t\t" . 'class="object-cover w-full h-full rounded-full"' . "\r\n\t\t\t\t\t\t\t" . 'src="';
	echo validate_image($row['image_path']);
	echo '"' . "\r\n\t\t\t\t\t\t\t" . 'alt=""' . "\r\n\t\t\t\t\t\t\t" . 'loading="lazy"' . "\r\n\t\t\t\t\t\t\t" . '/>' . "\r\n\t\t\t\t\t\t\t" . '<div' . "\r\n\t\t\t\t\t\t\t" . 'class="absolute inset-0 rounded-full shadow-inner"' . "\r\n\t\t\t\t\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t\t\t\t\t" . '></div>' . "\r\n\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t" . '<div>' . "\r\n\t\t\t\t\t\t\t" . '<p class="font-semibold">';
	echo $row['name'];
	echo '</p>' . "\r\n\t\t\t\t\t\t\t" . '<p class="text-xs text-gray-600 dark:text-gray-400">' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . '</p>' . "\r\n\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t";

	if ($row['type_of_draw'] == 1) {
		echo "\t\t\t\t\t\t" . 'Automático' . "\r\n\t\t\t\t\t";
	}

	echo "\r\n\t\t\t\t\t";

	if ($row['type_of_draw'] == 2) {
		echo "\t\t\t\t\t\t" . 'Números' . "\r\n\t\t\t\t\t";
	}

	echo "\r\n\t\t\t\t\t";

	if ($row['type_of_draw'] == 3) {
		echo "\t\t\t\t\t\t" . 'Fazendinha' . "\r\n\t\t\t\t\t";
	}

	echo "\t\t\t\t\t";

	if ($row['type_of_draw'] == 4) {
		echo "\t\t\t\t\t\t" . 'Fazendinha metade' . "\r\n\t\t\t\t\t";
	}

	echo "\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t" . 'R$ ';
	echo format_num($row['price'], 2);
	echo "\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t" . '<div id="myProgress">' . "\r\n" . '                    <div id="myBar" style="width:';
	echo $percent;
	echo '%"></div>' . "\r\n" . '                    </div>' . "\r\n\t\t\t\t\t";
	echo $percent;
	echo '% de ';
	echo $row['qty_numbers'];
	echo ' vendidos' . "\r\n\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t" . '<td class="px-4 py-3 text-xs">' . "\r\n\t\t\t\t\t";

	if ($row['status'] == 1) {
		echo "\t\t\t\t\t\t" . '<span' . "\r\n\t\t\t\t\t\t" . 'class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"' . "\r\n\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t" . 'Ativo' . "\r\n\t\t\t\t\t" . '</span>' . "\r\n\t\t\t\t";
	}

	echo "\r\n\t\t\t\t";

	if ($row['status'] == 2) {
		echo "\t\t\t\t\t" . '<span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">' . "\r\n\t\t\t\t\t\t" . 'Pausado' . "\r\n\t\t\t\t\t" . '</span>' . "\t\t\t" . '  ' . "\r\n\r\n\t\t\t\t";
	}

	echo "\r\n\t\t\t\t";

	if ($row['status'] == 3) {
		echo "\t\t\t\t\t" . '<span' . "\r\n\t\t\t\t\t" . 'class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . 'Finalizado' . "\r\n\t\t\t\t" . '</span>' . "\r\n\t\t\t";
	}

	echo "\t\t" . '</td>' . "\r\n\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t";
	echo date('d-m-Y H:i', strtotime($row['date_created']));
	echo "\t\t" . '</td>' . "\r\n\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t" . '<div class="flex items-center space-x-4 text-sm">' . "\r\n\t\t\t" . '<!--' . "\r\n\t\t\t" . '<a href="./report.php?id=';
	echo $row['id'];
	echo '" target="_blank">' . "\r\n\t\t\t\t\t" . '<button title="Relatório de vendas" ' . "\r\n\t\t\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t" . 'aria-label="Relatório de vendas"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t\t" . '<path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>' . "\r\n\t\t\t\t\t\t" . '<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>' . "\r\n\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t" . '</button>' . "\r\n\t\t\t" . '</a>' . "\r\n\t\t\t" . '-->' . "\r\n\t\t\t" . '<a href="';
	echo BASE_URL;
	echo 'campanha/';
	echo $row['slug'];
	echo '" target="_blank">' . "\r\n\t\t\t\t" . '<button title="Ver campanha" ' . "\r\n\t\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t" . 'aria-label="View"' . "\r\n\t\t\t\t" . '>' . "\r\n\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">' . "\r\n\t\t\t\t\t" . '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />' . "\r\n\t\t\t\t\t" . '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n\t\t" . '<a href="./?page=products/manage_product&id=';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t" . '<button title="Editar" ' . "\r\n\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t" . 'aria-label="Edit">' . "\r\n\t\t\t\t" . '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">' . "\r\n\t\t\t\t" . '<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n\t\t" . '<!--' . "\r\n\t\t" . '<a class="duplicates" data-id="';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t" . '<button title="Corrigir duplicidades" ' . "\r\n\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t" . 'aria-label="Corrigir duplicidades">' . "\r\n\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t" . '<path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z"/>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n\t\t" . '<a class="stock" data-id="';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t" . '<button title="Corrigir estoque" ' . "\r\n\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t" . 'aria-label="Corrigir estoque">' . "\r\n\t\t\t\t" . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill-gear" viewBox="0 0 16 16">' . "\r\n\t\t\t\t\t" . '<path d="M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1Z"/>' . "\r\n\t\t\t\t\t" . '<path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7Zm6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.552 4.552 0 0 1 .23-2.002Zm-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.507 4.507 0 0 1-1.3-1.905Zm3.631-4.538c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n\t\t" . '-->' . "\r\n\t\t";

	if ($_settings->userdata('type') == '1') {
		echo "\t\t" . '<a class="delete_sorteio" href="javascript:void(0)" @click="openModal" data-id="';
		echo $row['id'];
		echo '">' . "\r\n\t\t\t" . '<button title="Deletar" ' . "\r\n\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">' . "\r\n\t\t\t" . '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">' . "\r\n\t\t\t" . '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>' . "\r\n\t\t" . '</svg>' . "\r\n\t\t" . '</button>' . "\r\n\t\t" . '</a>' . "\r\n";
	}

	echo "\r\n" . '</div>' . "\r\n" . '</td>' . "\r\n" . '</tr>' . "\r\n";
}

echo "\r\n" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '<div' . "\r\n" . 'class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"' . "\r\n" . '>' . "\r\n" . '<span class="flex items-center col-span-3">' . "\r\n" . '</span>' . "\r\n" . '<span class="col-span-2"></span>' . "\r\n\r\n" . '<!-- Pagination -->' . "\r\n";

if (0 < $totalPages) {
	echo "\t" . '<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">' . "\r\n\t\t" . '<nav aria-label="Table navigation">' . "\r\n\t\t\t" . '<ul class="inline-flex items-center">' . "\r\n\r\n\t\t\t\t";

	if (1 < $page) {
		echo "\t\t\t\t\t" . '<a href=\'./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page - 1;
		echo '\'><li>' . "\r\n\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t" . 'class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n\t\t\t\t\t\t" . 'aria-label="Previous"' . "\r\n\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t" . '<svg' . "\r\n\t\t\t\t\t\t" . 'class="w-4 h-4 fill-current"' . "\r\n\t\t\t\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t\t\t\t" . 'viewBox="0 0 20 20"' . "\r\n\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t" . '<path' . "\r\n\t\t\t\t\t\t" . 'd="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"' . "\r\n\t\t\t\t\t\t" . 'clip-rule="evenodd"' . "\r\n\t\t\t\t\t\t" . 'fill-rule="evenodd"' . "\r\n\t\t\t\t\t\t" . '></path>' . "\r\n\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t" . '</button>' . "\r\n\t\t\t" . '</li></a>' . "\r\n\t\t";
	}

	echo "\r\n\t\t";

	if (3 < $page) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=1"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</button></li></a>' . "\r\n\t\t\t" . '<li class="dots">...</li>' . "\r\n\t\t";
	}

	echo "\r\n\t\t";

	if (0 < ($page - 2)) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page - 2;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page - 2;
		echo '</button></li></a>' . "\r\n\t\t";
	}

	echo "\r\n\t\t";

	if (0 < ($page - 1)) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page - 1;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page - 1;
		echo '</button></li></a>' . "\r\n\t\t";
	}

	echo "\r\n\t\t" . '<a href="./?page=products&status=';
	echo $status;
	echo '&pg=';
	echo $page;
	echo '">' . "\r\n\t\t\t" . '<li>' . "\r\n\t\t\t\t" . '<button' . "\t" . 'class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page;
	echo '</button>' . "\r\n\t\t\t" . '</li>' . "\r\n\t\t" . '</a>' . "\r\n\t\t";

	if (($page + 1) < ($totalPages + 1)) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page + 1;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page + 1;
		echo '</button></li></a>' . "\t\r\n\t\t";
	}

	echo "\r\n\t\t";

	if (($page + 2) < ($totalPages + 1)) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page + 2;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page + 2;
		echo '</button></li></a>' . "\r\n\t\t";
	}

	echo "\r\n\t\t";

	if ($page < ($totalPages - 2)) {
		echo "\t\t\t" . '<li class="dots">...</li>' . "\r\n\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $totalPages;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $totalPages;
		echo '</button></li></a>' . "\r\n\t\t";
	}

	echo "\r\n\r\n\t\t";

	if ($page < $totalPages) {
		echo "\t\t\t" . '<a href="./?page=products&status=';
		echo $status;
		echo '&pg=';
		echo $page + 1;
		echo '"><li>' . "\r\n\t\t\t\t" . '<button' . "\r\n\t\t\t\t" . 'class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n\t\t\t\t" . 'aria-label="Next"' . "\r\n\t\t\t\t" . '>' . "\r\n\t\t\t\t" . '<svg' . "\r\n\t\t\t\t" . 'class="w-4 h-4 fill-current"' . "\r\n\t\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t\t" . 'viewBox="0 0 20 20"' . "\r\n\t\t\t\t" . '>' . "\r\n\t\t\t\t" . '<path' . "\r\n\t\t\t\t" . 'd="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"' . "\r\n\t\t\t\t" . 'clip-rule="evenodd"' . "\r\n\t\t\t\t" . 'fill-rule="evenodd"' . "\r\n\t\t\t\t" . '></path>' . "\r\n\t\t\t" . '</svg>' . "\r\n\t\t" . '</button>' . "\r\n\t" . '</li>' . "\r\n" . '</a>' . "\r\n";
	}

	echo "\r\n" . '</ul>' . "\r\n" . '</nav>' . "\r\n" . '</span>' . "\r\n" . '<!-- End pagination -->' . "\r\n";
}

echo "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</main>' . "\r\n\r\n" . '<!-- Modal Delete -->' . "\r\n" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">' . "\r\n\t" . '<!-- Modal -->' . "\r\n\t" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal" style="display: none;">' . "\r\n\t\t" . '<!-- Remove header if you don\'t want a close icon. Use modal body to place modal tile. -->' . "\r\n\t\t" . '<header class="flex justify-end">' . "\r\n\t\t\t" . '<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">' . "\r\n\t\t\t\t" . '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">' . "\r\n\t\t\t\t\t" . '<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</header>' . "\r\n\t\t" . '<div class="mt-4 mb-6">' . "\r\n\t\t\t" . '<p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">' . "\r\n\t\t\t\t" . 'Deseja excluir?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t\t" . '<p class="text-sm text-gray-700 dark:text-gray-400">' . "\r\n\t\t\t\t" . 'Você realmente deseja excluir esse campanha?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t" . '</div>' . "\r\n\t\t" . '<footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">' . "\r\n\t\t\t" . '<button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . 'Não' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t\t" . '<button class="delete_data w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t\t" . 'Sim' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</footer>' . "\r\n\t" . '</div>' . "\r\n" . '</div>' . "\r\n" . '<!-- End Modal Delete -->' . "\r\n\r\n" . '<script>' . "\r\n\t" . '$(document).ready(function(){' . "\r\n\t\t" . '$(\'.delete_sorteio\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . '$(\'.delete_data\').attr(\'data-id\', id);' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.delete_data\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'delete_product(id)' . "\t\r\n\t\t" . '})' . "\r\n\r\n\t" . '})' . "\r\n\r\n\t" . 'function delete_product($id){' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Main.php?action=delete_product_sys",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AP01] - An error occured.");' . "\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(typeof resp== \'object\' && resp.status == \'success\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AP02] - An error occured.");' . "\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n\r\n\t" . '$(function(){' . "\r\n\t\t" . '$(\'#filter-form\').submit(function(e){' . "\r\n\t\t\t" . 'e.preventDefault()' . "\r\n\t\t\t" . 'location.href = \'./?page=products&\'+$(this).serialize()' . "\r\n\t\t" . '})' . "\r\n\r\n\r\n\t" . '})' . "\r\n" . '</script>';

?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		
    // Seleciona todas as divs especificadas que contêm as tags <a>
    var actions = $('body > div > div.flex.flex-col.flex-1 > main > div > div > div.w-full.overflow-x-auto > table > tbody > tr > td:nth-child(7) > div');

     
    // Itera sobre cada linha da tabela
    $('body > div > div.flex.flex-col.flex-1 > main > div > div > div.w-full.overflow-x-auto > table > tbody > tr').each(function() {
        // Seleciona a div de ações e o ID correspondente dentro da mesma linha
        var actionDiv = $(this).find('td:nth-child(7) > div');
        var id = $(this).find('td:nth-child(7) > div > a:nth-child(2)').attr('href').split('/')[2].split('=')[1];

        console.log(id);

        // Cria a nova tag <a> com o nome correspondente como texto
        var newLink = $('<a>', {
            href: '#' + id, // Define o href do novo link
            text: 'Duplicar', // Define o texto do novo link
            id: 'duplicate-' + id, // Define um ID único para o link
            click: function(e) { // Adiciona o evento de clique
                e.preventDefault();
                duplicateRaffle(id); // Chama a função de duplicação com o ID
            }
        });

        // Adiciona a nova tag <a> dentro da div de ações
        actionDiv.append(newLink);
    });

	function duplicateRaffle(id) {
    var now = new Date();
    var date = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
    var time = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
    var dateTime = date + ' ' + time;

    $.ajax({
        url: '/class/Main.php?action=duplicate_product',
        type: 'POST',
        data: { id: id, dateTime: dateTime },
        success: function(response) {
            var res = JSON.parse(response);
            
            if (res.status === 'success') {
                alert('Rifa duplicada com sucesso!');
                var product = $('body > div > div.flex.flex-col.flex-1 > main > div > div > div.w-full.overflow-x-auto > table > tbody > tr').filter(function() {
                    return $(this).find('td:nth-child(7) > div > a:nth-child(2)').attr('href').split('/')[2].split('=')[1] === res.pid.toString();
                });

                product.css('background-color', 'green').css('color', 'white').css('animation', 'blink 1s linear infinite');
                setTimeout(function() {
                    product.css('background-color', '').css('color', '').css('animation', '');
                }, 5000);
                location.reload();
            } else {
                alert('Erro ao duplicar rifa!');
            }
        },
        error: function() {
            alert('Erro ao duplicar rifa!');
        }
    });
}
	});
</script>