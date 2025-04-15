<?php


echo ' ';
$enable_hide_numbers = $_settings->info('enable_hide_numbers');

if ($_settings->userdata('id') != '') {
	$qry = $conn->query('SELECT * FROM `customer_list` where id = \'' . $_settings->userdata('id') . '\'');

	if (0 < $qry->num_rows) {
		foreach ($qry->fetch_array() as $k => $v) {
			if (!is_numeric($k)) {
				$$k = $v;
			}
		}
	}
}
else {
	echo '<script>alert(\'Você não tem permissão para acessar essa página\'); ' . "\r\n" . '    location.replace(\'/\');</script>';
	exit();
}

echo '<div class="container app-main">' . "\r\n" . '            <div class="app-title mb-3">' . "\r\n" . '             <h1>🛒 Compras</h1>' . "\r\n" . '             <div class="app-title-desc">recentes</div>' . "\r\n" . '         </div>' . "\r\n" . '         <div>' . "\r\n" . '            ';
$i = 1;
$orders = $conn->query('SELECT o.*, p.image_path, p.qty_numbers, oi.product_id, p.type_of_draw ' . "\r\n" . '                        FROM `order_list` o ' . "\r\n" . '                        INNER JOIN `order_items` oi ON o.id = oi.order_id ' . "\r\n" . '                        INNER JOIN `product_list` p ON oi.product_id = p.id' . "\r\n" . '                        WHERE o.customer_id = \'' . $_settings->userdata('id') . '\' ' . "\r\n" . '                        ORDER BY ABS(UNIX_TIMESTAMP(o.date_created)) DESC');

while ($row = $orders->fetch_assoc()) {
	echo '               ';
	$class = '';
	$border = '';
	$btn = '';
	$status = $row['status'];

	if ($row['status'] == '1') {
		$class = 'bg-warning';
		$border = 'border-warning';
		$btn = 'btn-warning';
	}

	if ($row['status'] == '2') {
		$class = 'bg-success';
		$border = 'border-success';
		$btn = 'btn-success';
	}

	if ($row['status'] == '3') {
		$class = 'bg-danger';
		$border = 'border-danger';
		$btn = 'btn-danger';
	}

	echo '                <div class="card app-card mb-2 pointer border-bottom border-2 ';
	echo $border;
	echo '">' . "\r\n" . '                  <div class="card-body">' . "\r\n\r\n" . '                   <div class="row align-items-center row-gutter-sm">' . "\r\n" . '                    <div class="col-auto">' . "\r\n" . '                     <div class="position-relative rounded-pill overflow-hidden box-shadow-08" style="width: 56px; height: 56px;">' . "\r\n" . '                      <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">' . "\r\n" . '                       <img src="';
	echo validate_image($row['image_path']);
	echo '" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">' . "\r\n" . '                       <noscript></noscript>' . "\r\n" . '                   </div>' . "\r\n" . '               </div>' . "\r\n" . '           </div>' . "\r\n" . '           <div class="col ps-2">' . "\r\n" . '           <div class="compra-title font-weight-500 text-uppercase">';
	echo $row['product_name'];
	echo '</div>' . "\r\n" . '           <small class="compra-data font-xss opacity-50 text-uppercase"><i class="bi bi-calendar4-week"></i> ';
	echo date('d-m-Y H:i', strtotime($row['date_created']));
	echo '</small>' . "\r\n" . '             <div class="compra-cotas font-xs mt-2">' . "\r\n" . '               ';

	if ($status != 3) {
		$type_of_draw = $row['type_of_draw'];
		$nCollection = explode(',', $row['order_numbers']);
		$qty_nums = count($nCollection);

		if (1 < $type_of_draw) {
			echo drope_format_luck_numbers_dashboard($row['order_numbers'], $row['qty_numbers'], $class, $opt = true, $type_of_draw);
		}
		else if (($type_of_draw == 1) && $status == 1 && $enable_hide_numbers == 1) {
			echo 'As cotas serão geradas após o pagamento.';
		}
		else {
			echo '<div class="drope-tab">' . "\r\n" . '                        <input id="drope-tab-' . $row['id'] . '" type="checkbox">' . "\r\n" . '                        <label for="drope-tab-' . $row['id'] . '">Ver números</label>' . "\r\n" . '                        <div class="drope-content">' . drope_format_luck_numbers_dashboard($row['order_numbers'], $row['quantity'], $class = false, $opt = true, $type_of_draw) . '</div>' . "\r\n" . '                        </div>';
		}
	}

	echo '   ' . "\r\n" . '          </div>' . "\r\n" . '         </div>' . "\r\n" . '         <div class="col-12 pt-2">' . "\r\n" . '        <a href="/compra/';
	echo $row['order_token'];
	echo '">' . "\r\n" . '        <span class="btn ';
	echo $btn;
	echo ' btn-sm p-1 px-2 w-100 font-xss">';

	if ($status == '1') {
		echo 'Efetuar pagamento';
	}

	if ($status == '2') {
		echo 'Visualizar compra';
	}

	if ($status == '3') {
		echo 'Compra cancelada';
	}

	echo '</span>' . "\r\n" . '    </a>' . "\r\n" . '       </div>' . "\r\n" . '     </div>' . "\r\n\r\n\r\n\r\n" . ' </div>' . "\r\n" . '</div>' . "\r\n";
}

echo '</div>' . "\r\n" . '<div class="row">' . "\r\n" . ' <div class="col"></div>' . "\r\n" . ' <div class="col"></div>' . "\r\n" . '</div>' . "\r\n" . '</div>';

?>