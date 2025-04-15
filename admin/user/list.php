<?php


if ($_settings->userdata('type') != '1') {
	echo 'Você não tem permissão para acessar essa página.';
	exit();
}

echo '<main class="h-full pb-16 overflow-y-auto">' . "\r\n\t" . '<div class="container grid px-6 mx-auto">' . "\r\n\t\t" . '<h2' . "\r\n\t\t" . 'class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"' . "\r\n\t\t" . '>' . "\r\n\t\t" . 'Usuários <a href="./?page=user/manage_user" id="create_new"><button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t" . 'Cadastrar novo' . "\r\n\t\t" . '</button></a>' . "\r\n\t" . '</h2>         ' . "\r\n\t" . '<div class="w-full overflow-hidden rounded-lg shadow-xs">' . "\r\n\t\t" . '<div class="w-full overflow-x-auto">' . "\r\n\t\t\t" . '<table class="w-full whitespace-no-wrap">' . "\r\n\t\t\t\t" . '<thead>' . "\r\n\t\t\t\t\t" . '<tr' . "\r\n\t\t\t\t\t" . 'class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"' . "\r\n\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Foto</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Nome</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Usuário</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Tipo</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Data</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Email</th>' . "\r\n\t\t\t\t\t" . '<th class="px-4 py-3">Ação</th>' . "\r\n\t\t\t\t" . '</tr>' . "\r\n\t\t\t" . '</thead>' . "\r\n\t\t\t" . '<tbody' . "\r\n\t\t\t" . 'class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">' . "\r\n\t\t\t";
$perPage = 20;
$page = (isset($_GET['pg']) ? $_GET['pg'] : 1);
$offset = $perPage * ($page - 1);
$totalResults = $conn->query('SELECT * FROM users')->num_rows;
$totalPages = ceil($totalResults / $perPage);
$i = 1;
$qry = $conn->query('SELECT *, concat(firstname,\' \', lastname) as `name` from `users` order by concat(firstname,\' \', lastname) asc LIMIT ' . $perPage . ' OFFSET ' . $offset);

while ($row = $qry->fetch_assoc()) {
	echo "\t\t\t\t" . '<tr class="text-gray-700 dark:text-gray-400">' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t" . '<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">' . "\r\n\t\t\t\t\t\t\t" . '<img class="object-cover w-full h-full rounded-full" src="';
	echo validate_image($row['avatar']);
	echo '" alt="" loading="lazy">' . "\r\n\t\t\t\t\t\t\t" . '<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>' . "\r\n\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t\t\t\t";
	echo $row['name'];
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t\t\t\t";
	echo $row['username'];
	echo "\t\t\t\t\t" . '</td>' . "\r\n\r\n\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";

	if ($row['type'] == 1) {
		echo "\t\t\t\t\t\t\t" . 'Administrador' . "\r\n\t\t\t\t\t\t";
	}
	else if ($row['type'] == 2) {
		echo "\t\t\t\t\t\t\t" . 'Staff' . "\r\n\t\t\t\t\t\t";
	}
	else {
		echo "\t\t\t\t\t\t\t" . 'N/A' . "\r\n\t\t\t\t\t\t";
	}

	echo "\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo date('d-m-Y H:i', strtotime($row['date_updated']));
	echo "\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t" . '<td class="px-4 py-3 text-sm">' . "\r\n\t\t\t\t\t\t";
	echo $row['email'];
	echo "\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t" . '<td class="px-4 py-3">' . "\r\n\t\t\t\t\t\t" . '<div class="flex items-center space-x-4 text-sm">' . "\r\n\t\t\t\t\t\t\t" . '<a href="./?page=user/manage_user&id=';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t\t" . 'aria-label="Edit"' . "\r\n\t\t\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t\t\t" . '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>' . "\r\n\t\t\t\t\t\t\t\t" . '</svg>' . "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t" . '</a>' . "\r\n\r\n\t\t\t\t\t\t" . '<a class="delete_user" href="javascript:void(0)" @click="openModal" data-id="';
	echo $row['id'];
	echo '">' . "\r\n\t\t\t\t\t\t\t" . '<button' . "\r\n\t\t\t\t\t\t\t" . 'class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"' . "\r\n\t\t\t\t\t\t\t" . 'aria-label="Delete"' . "\r\n\t\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t\t" . '<svg' . "\r\n\t\t\t\t\t\t\t" . 'class="w-5 h-5"' . "\r\n\t\t\t\t\t\t\t" . 'aria-hidden="true"' . "\r\n\t\t\t\t\t\t\t" . 'fill="currentColor"' . "\r\n\t\t\t\t\t\t\t" . 'viewBox="0 0 20 20"' . "\r\n\t\t\t\t\t\t\t" . '>' . "\r\n\t\t\t\t\t\t\t" . '<path' . "\r\n\t\t\t\t\t\t\t" . 'fill-rule="evenodd"' . "\r\n\t\t\t\t\t\t\t" . 'd="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"' . "\r\n\t\t\t\t\t\t\t" . 'clip-rule="evenodd"' . "\r\n\t\t\t\t\t\t\t" . '></path>' . "\r\n\t\t\t\t\t\t" . '</svg>' . "\r\n\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t" . '</a>' . "\r\n\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n";
}

echo "\r\n" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '<div' . "\r\n" . 'class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"' . "\r\n" . '>' . "\r\n" . '<span class="flex items-center col-span-3">' . "\r\n" . '</span>' . "\r\n" . '<span class="col-span-2"></span>' . "\r\n\r\n" . '<!-- Pagination -->' . "\r\n";

if (0 < $totalPages) {
	echo '<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">' . "\r\n" . '    <nav aria-label="Table navigation">' . "\r\n" . '        <ul class="inline-flex items-center">' . "\r\n\r\n";

	if (1 < $page) {
		echo '            <a href=\'./?page=user/list&pg=';
		echo $page - 1;
		echo '\'><li>' . "\r\n" . '                <button' . "\r\n" . '                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n" . '                aria-label="Previous"' . "\r\n" . '                >' . "\r\n" . '                <svg' . "\r\n" . '                class="w-4 h-4 fill-current"' . "\r\n" . '                aria-hidden="true"' . "\r\n" . '                viewBox="0 0 20 20"' . "\r\n" . '                >' . "\r\n" . '                <path' . "\r\n" . '                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"' . "\r\n" . '                clip-rule="evenodd"' . "\r\n" . '                fill-rule="evenodd"' . "\r\n" . '                ></path>' . "\r\n" . '            </svg>' . "\r\n" . '        </button>' . "\r\n" . '    </li></a>' . "\r\n";
	}

	echo "\r\n" . '    ';

	if (3 < $page) {
		echo '        <a href="./?page=user/list&pg=1"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</button></li></a>' . "\r\n" . '    <li class="dots">...</li>' . "\r\n" . '    ';
	}

	echo "\r\n" . '    ';

	if (0 < ($page - 2)) {
		echo '        <a href="./?page=user/list&pg=';
		echo $page - 2;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page - 2;
		echo '</button></li></a>' . "\r\n" . '    ';
	}

	echo "\r\n" . '    ';

	if (0 < ($page - 1)) {
		echo '    <a href="./?page=user/list&pg=';
		echo $page - 1;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page - 1;
		echo '</button></li></a>' . "\r\n" . '  ';
	}

	echo "\r\n" . '  <a href="./?page=user/list&pg=';
	echo $page;
	echo '">' . "\r\n" . '    <li>' . "\r\n" . '    <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">';
	echo $page;
	echo '</button>' . "\r\n" . ' </li>' . "\r\n" . ' </a>' . "\r\n" . '    ';

	if (($page + 1) < ($totalPages + 1)) {
		echo '    <a href="./?page=user/list&pg=';
		echo $page + 1;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page + 1;
		echo '</button></li></a>   ' . "\r\n";
	}

	echo "\r\n";

	if (($page + 2) < ($totalPages + 1)) {
		echo '        <a href="./?page=user/list&pg=';
		echo $page + 2;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $page + 2;
		echo '</button></li></a>' . "\r\n";
	}

	echo "\r\n";

	if ($page < ($totalPages - 2)) {
		echo '<li class="dots">...</li>' . "\r\n" . '<a href="./?page=user/list&pg=';
		echo $totalPages;
		echo '"><li><button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">';
		echo $totalPages;
		echo '</button></li></a>' . "\r\n";
	}

	echo "\r\n\r\n";

	if ($page < $totalPages) {
		echo '    <a href="./?page=user/list&pg=';
		echo $page + 1;
		echo '"><li>' . "\r\n" . '    <button' . "\r\n" . '    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"' . "\r\n" . '    aria-label="Next"' . "\r\n" . '    >' . "\r\n" . '    <svg' . "\r\n" . '    class="w-4 h-4 fill-current"' . "\r\n" . '    aria-hidden="true"' . "\r\n" . '    viewBox="0 0 20 20"' . "\r\n" . '    >' . "\r\n" . '    <path' . "\r\n" . '    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"' . "\r\n" . '    clip-rule="evenodd"' . "\r\n" . '    fill-rule="evenodd"' . "\r\n" . '    ></path>' . "\r\n" . '</svg>' . "\r\n" . '</button>' . "\r\n" . '</li>' . "\r\n" . '</a>' . "\r\n";
	}

	echo "\r\n" . '</ul>' . "\r\n" . '</nav>' . "\r\n" . '</span>' . "\r\n" . '<!-- End pagination -->' . "\r\n";
}

echo "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</main>' . "\r\n\r\n" . '<!-- Modal Delete -->' . "\r\n" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">' . "\r\n\t" . '<!-- Modal -->' . "\r\n\t" . '<div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal" style="display: none;">' . "\r\n\t\t" . '<!-- Remove header if you don\'t want a close icon. Use modal body to place modal tile. -->' . "\r\n\t\t" . '<header class="flex justify-end">' . "\r\n\t\t\t" . '<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">' . "\r\n\t\t\t\t" . '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">' . "\r\n\t\t\t\t\t" . '<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>' . "\r\n\t\t\t\t" . '</svg>' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</header>' . "\r\n\t\t" . '<div class="mt-4 mb-6">' . "\r\n\t\t\t" . '<p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">' . "\r\n\t\t\t\t" . 'Deseja excluir?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t\t" . '<p class="text-sm text-gray-700 dark:text-gray-400">' . "\r\n\t\t\t\t" . 'Você realmente deseja excluir esse usuário?' . "\r\n\t\t\t" . '</p>' . "\r\n\t\t" . '</div>' . "\r\n\t\t" . '<footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">' . "\r\n\t\t\t" . '<button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">' . "\r\n\t\t\t\t" . 'Não' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t\t" . '<button class="delete_data w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t\t" . 'Sim' . "\r\n\t\t\t" . '</button>' . "\r\n\t\t" . '</footer>' . "\r\n\t" . '</div>' . "\r\n" . '</div>' . "\r\n\r\n" . '<!-- End Modal Delete -->' . "\r\n" . '<script>' . "\r\n\t" . '$(document).ready(function(){' . "\r\n\t\t" . '$(\'.delete_user\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . '$(\'.delete_data\').attr(\'data-id\', id);' . "\t\r\n\t\t" . '})' . "\r\n\t\t" . '$(\'.delete_data\').click(function(){' . "\r\n\t\t\t" . 'var id = $(this).attr(\'data-id\');' . "\r\n\t\t\t" . 'delete_user(id);' . "\t\r\n\t\t" . '})' . "\r\n\r\n\t" . '})' . "\r\n\t" . 'function delete_user($id){' . "\t\t\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'url:_base_url_+"class/Customer.php?action=delete_system",' . "\r\n\t\t\t" . 'method:"POST",' . "\r\n\t\t\t" . 'data:{id: $id},' . "\r\n\t\t\t" . 'dataType:"json",' . "\r\n\t\t\t" . 'error:err=>{' . "\r\n\t\t\t\t" . 'console.log(err)' . "\r\n\t\t\t\t" . 'alert("[AU01] - An error occured.");' . "\r\n\t\t\t\t\r\n\t\t\t" . '},' . "\r\n\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t" . 'if(resp == \'1\'){' . "\r\n\t\t\t\t\t" . 'location.reload();' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . 'alert("[AU02] - An error occured.");' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '})' . "\r\n\t" . '}' . "\r\n" . '</script>';

?>