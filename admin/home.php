<?php


echo ' ';
$raffle = (isset($_GET['raffle']) ? $_GET['raffle'] : '');
$top = (isset($_GET['top']) ? $_GET['top'] : '');
$start_date = date('Y-m-d', strtotime('-6 days'));
$end_date = date('Y-m-d');



echo '<style>' . "\r\n" . '  .order_numbers{padding:10px;max-width:150px;overflow:auto;white-space:normal}.winner-info span{display:block}tr.text-gray-700.dark\\:text-gray-400{vertical-align:text-bottom}td.px-4.py-3.text-sm{max-width:240px;text-wrap:pretty}@media only screen and (max-width:600px){#rankingcompradores .flex,#searchganhadores .flex{display:block}}' . "\r\n" . '</style>       ' . "\r\n\r\n" . '<main class="h-full overflow-y-auto">' . "\r\n" . '  <div class="container px-6 mx-auto grid">' . "\r\n" . '    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h2>' . "\r\n\r\n" . '<!--Busca Ganhador x Ranking -->' . "\r\n" . '<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">' . "\r\n" . '    <!-- Card -->' . "\r\n" . '  <div class="items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n" . '    <div id="searchganhadores">' . "\r\n" . '      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">BUSCAR GANHADOR</p>' . "\r\n" . '        <form action="" id="buscar-ganhador" style="margin-bottom:10px">' . "\r\n" . '          <div class="flex" style="justify-content: space-between;">' . "\r\n" . '            <div>' . "\r\n" . '              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Campanha</p>' . "\r\n" . '              <select name="raffle" id="raffle" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">' . "\r\n" . '                  <option value="">Selecione</option>' . "\r\n" . '                  ';
$qry = $conn->query('SELECT * FROM `product_list`');

while ($row = $qry->fetch_assoc()) {
	echo '                <option value="';
	echo $row['id'];
	echo '" ';

	if ($raffle == $row['id']) {
		echo 'selected';
	}

	echo '>';
	echo $row['name'];
	echo '</option>' . "\r\n" . '                ';
}

echo '              </select>' . "\r\n" . '            </div>' . "\r\n" . '            <div>' . "\r\n" . '              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Número</p>' . "\r\n" . '              <input type="text" name="number" class="mr-2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="12345">' . "\r\n" . '            </div>' . "\r\n" . '            <div>' . "\r\n" . '              <br>' . "\r\n" . '              <button class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple filtrar"> Buscar</button>' . "\r\n" . '            </div>' . "\r\n" . '          </div>' . "\r\n" . '      </form>' . "\r\n\r\n" . '    <p class="text-gray-700 dark:text-gray-200 winner-info">' . "\r\n" . '    <span id="pedido"></span>' . "\r\n" . '    <span id="name"></span>' . "\r\n" . '    <span id="phone"></span>' . "\r\n" . '    <span id="raffle"></span>' . "\r\n" . '    <span id="date"></span>' . "\r\n" . '    <span id="quantity"></span>' . "\r\n" . '    <span id="value"></span>' . "\r\n" . '    <span id="payment_status"></span>' . "\r\n" . '    <span id="number"></span>' . "\r\n" . '    <span class="winner"></span>' . "\r\n" . '  </p>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n" . '<!-- Card -->' . "\r\n" . '<div class="items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n\r\n" . '<div id="rankingcompradores">' . "\r\n" . '  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">' . "\r\n" . '  RANKING DE COMPRADORES' . "\r\n" . '</p>' . "\r\n" . '    <form action="" id="filter-form" style="margin-bottom:10px">' . "\r\n" . '         <div class="flex" style="justify-content: space-between;">' . "\r\n" . '          <div>' . "\r\n" . '            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Campanha</p>' . "\r\n" . '            <select name="raffle" id="raffle" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">xxx' . "\r\n" . '                <option value="">Selecione</option>' . "\r\n" . '                ';
$qry = $conn->query('SELECT * FROM `product_list`');

while ($row = $qry->fetch_assoc()) {
	echo '              <option value="';
	echo $row['id'];
	echo '" ';

	if ($raffle == $row['id']) {
		echo 'selected';
	}

	echo '>';
	echo $row['name'];
	echo '</option>' . "\r\n" . '               ';
}

echo '            </select>' . "\r\n" . '          </div>' . "\r\n" . '          <div>' . "\r\n" . '            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Quantidade</p>' . "\r\n" . '           <select name="top" id="top" class="mr-2 block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">' . "\r\n" . '              <option value="1" ';

if ($top == 1) {
	echo 'selected';
}

echo '>1</option>               ' . "\r\n" . '              <option value="2" ';

if ($top == 2) {
	echo 'selected';
}

echo '>2</option>               ' . "\r\n" . '              <option value="3" ';

if ($top == 3) {
	echo 'selected';
}

echo '>3</option>               ' . "\r\n" . '              <option value="4" ';

if ($top == 4) {
	echo 'selected';
}

echo '>4</option>               ' . "\r\n" . '              <option value="5" ';

if ($top == 5) {
	echo 'selected';
}

echo '>5</option>               ' . "\r\n" . '              <option value="6" ';

if ($top == 6) {
	echo 'selected';
}

echo '>6</option>               ' . "\r\n" . '              <option value="7" ';

if ($top == 7) {
	echo 'selected';
}

echo '>7</option>               ' . "\r\n" . '              <option value="8" ';

if ($top == 8) {
	echo 'selected';
}

echo '>8</option>               ' . "\r\n" . '              <option value="9" ';

if ($top == 9) {
	echo 'selected';
}

echo '>9</option>               ' . "\r\n" . '              <option value="10" ';

if ($top == 10) {
	echo 'selected';
}

echo '>10</option>               ' . "\r\n" . '            </select>' . "\r\n" . '          </div>' . "\r\n" . '          <div>' . "\r\n" . '            <br>' . "\r\n" . '            <button class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple filtrar"> Gerar lista</button>' . "\r\n" . '          </div>' . "\r\n" . '        </div>' . "\r\n" . '    </form>' . "\r\n" . '<p class="text-lg text-gray-700 dark:text-gray-200">' . "\r\n" . '           ';
$g_total = 0;
$i = 1;
if ($raffle && $top) {
	$requests = $conn->query("\r\n" . '                SELECT c.firstname, c.lastname, c.phone, SUM(o.quantity) AS total_quantity, SUM(o.total_amount) AS total_amount, ' . "\r\n" . '                o.code, CONCAT(\' \', o.product_name) AS product' . "\r\n" . '                FROM order_list o' . "\r\n" . '                INNER JOIN customer_list c ON o.customer_id = c.id' . "\r\n" . '                WHERE o.product_id = ' . $raffle . ' AND o.status = 2' . "\r\n" . '                GROUP BY o.customer_id' . "\r\n" . '                ORDER BY total_quantity DESC' . "\r\n" . '                LIMIT ' . $top . "\r\n" . '                ');

	while ($row = $requests->fetch_assoc()) {
		echo '                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="border:1px solid #eee;margin-bottom:10px;padding:10px;">' . "\r\n" . '                    Nome: ';
		echo $row['firstname'];
		echo ' ';
		echo $row['lastname'];
		echo '<br>' . "\r\n" . '                    Telefone: ';
		echo substr(formatPhoneNumber($row['phone']), 0, -4) . 'XXXX';
		echo '<br>' . "\r\n" . '                    Quantidade: ';
		echo $row['total_quantity'];
		echo '<br>' . "\r\n" . '                    Total: R$ ';
		echo format_num($row['total_amount'], 2);
		echo ' ' . "\r\n" . '                    </p>         ' . "\r\n\r\n" . '            ';
	}

	echo "\r\n" . '            ';
}

echo '</p>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n\r\n\r\n" . '</div>' . "\r\n" . '<!-- Busca Ganhador x Ranking -->' . "\r\n";
echo "\r\n" . '<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">' . "\r\n" . '  <!-- Card -->' . "\r\n" . '  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n" . '    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">' . "\r\n" . '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">' . "\r\n" . '      <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z"/>' . "\r\n" . '    </svg>' . "\r\n" . '    </div>' . "\r\n" . '    <div>' . "\r\n" . '      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">' . "\r\n" . '        Campanhas' . "\r\n" . '      </p>' . "\r\n" . '      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">' . "\r\n" . '      ';
$productsQuery = $conn->query('SELECT COUNT(id) FROM product_list');
$row = $productsQuery->fetch_assoc();
echo ($row['COUNT(id)'] ? $row['COUNT(id)'] : '0');
echo '      </p>' . "\r\n" . '    </div>' . "\r\n" . '  </div>' . "\r\n" . '  <!-- Card -->' . "\r\n" . '  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n" . '    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">' . "\r\n" . '      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">' . "\r\n" . '        <path' . "\r\n" . '          d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">' . "\r\n" . '        </path>' . "\r\n" . '      </svg>' . "\r\n" . '    </div>' . "\r\n" . '    <div>' . "\r\n" . '      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">' . "\r\n" . '        Clientes' . "\r\n" . '      </p>' . "\r\n" . '      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">' . "\r\n" . '      ';
$customersQuery = $conn->query('SELECT COUNT(id) FROM customer_list');
$row = $customersQuery->fetch_assoc();
echo ($row['COUNT(id)'] ? $row['COUNT(id)'] : '0');
echo '      </p>' . "\r\n" . '    </div>' . "\r\n" . '  </div>' . "\r\n" . '  <!-- Card -->' . "\r\n" . '  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n" . '    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">' . "\r\n" . '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">' . "\r\n" . '      <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>' . "\r\n" . '      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>' . "\r\n" . '    </svg>' . "\r\n" . '    </div>' . "\r\n" . '    <div>' . "\r\n" . '      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">' . "\r\n" . '        Pedidos' . "\r\n" . '      </p>' . "\r\n" . '      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">' . "\r\n" . '      ';
$ordersQuery = $conn->query('SELECT COUNT(id) FROM order_list');
$row = $ordersQuery->fetch_assoc();
echo ($row['COUNT(id)'] ? $row['COUNT(id)'] : '0');
echo '      </p>' . "\r\n" . '    </div>' . "\r\n" . '  </div>' . "\r\n" . '  <!-- Card -->' . "\r\n" . '  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">' . "\r\n" . '    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">' . "\r\n" . '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">' . "\r\n" . '      <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>' . "\r\n" . '    </svg>' . "\r\n" . '    </div>' . "\r\n" . '    <div>' . "\r\n" . '      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">' . "\r\n" . '        Faturamento' . "\r\n" . '      </p>' . "\r\n" . '      <div style="display: flex;">' . "\r\n" . '        <div id="hide-view" style="display:none; margin-right:5px;">' . "\r\n" . '        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">' . "\r\n" . '          ';
$queryFaturamento = $conn->query('SELECT id, SUM(total_amount) as total FROM order_list WHERE status = 2');
$row = $queryFaturamento->fetch_assoc();
echo 'R$' . number_format(($row['total'] ? $row['total'] : 0), 2, ',', '.');
echo '        </p>' . "\r\n" . '        </div>' . "\r\n" . '        <button onclick="hideView()" class="text-lg font-semibold text-gray-700 dark:text-gray-200">' . "\r\n" . '          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">' . "\r\n" . '            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>' . "\r\n" . '            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>' . "\r\n" . '          </svg>' . "\r\n" . '        </button>' . "\r\n" . '      </div>' . "\r\n" . '    </div>' . "\r\n" . '  </div><br>' . "\r\n" . '  <!-- Fim Card -->' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</main>' . "\r\n" . '<script>' . "\r\n" . '  function hideView() {' . "\r\n" . '    var x = document.getElementById("hide-view");' . "\r\n" . '    if (x.style.display === "none") {' . "\r\n" . '      x.style.display = "block";' . "\r\n" . '    } else {' . "\r\n" . '      x.style.display = "none";' . "\r\n" . '    }' . "\r\n" . '  }' . "\r\n" . '  $(document).ready(function(){   ' . "\r\n" . '  $(\'#buscar-ganhador\').submit(function(e){' . "\r\n" . '    e.preventDefault()' . "\r\n\r\n" . '    $.ajax({' . "\r\n" . '      url:_base_url_+"class/Main.php?action=search_raffle_winner",' . "\r\n" . '      method:\'POST\',' . "\r\n" . '      type:\'POST\',' . "\r\n" . '      data:new FormData($(this)[0]),' . "\r\n" . '      dataType:\'json\',' . "\r\n" . '      cache:false,' . "\r\n" . '      processData:false,' . "\r\n" . '      contentType: false,' . "\r\n" . '      error:err=>{' . "\r\n" . '        //console.log(err)' . "\r\n" . '        alert(\'An error occurred\')' . "\r\n\r\n" . '     },' . "\r\n" . '     success:function(resp){' . "\r\n" . '        if(resp.status == \'success\'){' . "\r\n" . '          $(\'#pedido\').html(\'<strong>Pedido:</strong> \' + resp.pedido);' . "\r\n" . '          $(\'#name\').html(\'<strong>Nome:</strong> \' + resp.name );' . "\r\n" . '          $(\'#phone\').html(\'<strong>Telefone:</strong> <a href="https://api.whatsapp.com/send/?phone=55\' + resp.phone.replace(/[^a-zA-Z0-9]/g, \'\') + \'" target="_blank">\' + resp.phone.replace(/\\d{4}$/, \'****\'));' . "\r\n" . '          $(\'#date\').html(\'<strong>Data da compra:</strong> \' + resp.date);' . "\r\n" . '          $(\'#quantity\').html(\'<strong>Quantidade:</strong> \' + resp.quantity);' . "\r\n" . '          $(\'#value\').html(\'<strong>Valor:</strong> R$\' + resp.value);' . "\r\n" . '          $(\'#number\').html(\'<strong>Número(s):</strong> \' + resp.number);' . "\r\n" . '          $(\'#payment_status\').html(\'<strong>Status:</strong> \' + resp.payment_status);' . "\r\n" . '          $(\'.winner\').text(\'\');' . "\r\n" . '         //console.log(resp);                                  ' . "\r\n" . '      }else{' . "\r\n" . '          $(\'#pedido\').html(\'\');' . "\r\n" . '          $(\'#quantity\').html(\'\');' . "\r\n" . '          $(\'#value\').html(\'\');' . "\r\n" . '          $(\'#name\').html(\'\');' . "\r\n" . '          $(\'#phone\').html(\'\');' . "\r\n" . '          $(\'#date\').html(\'\');' . "\r\n" . '          $(\'#number\').html(\'\');' . "\r\n" . '          $(\'#payment_status\').html(\'\');' . "\r\n\r\n" . '       $(\'.winner\').text(\'Nenhum registro foi encontrado\');' . "\r\n" . '       //console.log(resp)' . "\r\n" . '    }' . "\r\n" . ' }' . "\r\n" . '})' . "\r\n" . ' })' . "\r\n" . '})' . "\r\n" . '</script>';

?>