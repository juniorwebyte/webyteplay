<?php



$enable_hide_numbers = $_settings->info('enable_hide_numbers');
$enable_cpf = $_settings->info('enable_cpf');

if ($enable_cpf == 1) {
	$search_type = 'search_orders_by_cpf';
}
else {
	$search_type = 'search_orders_by_phone';
}

echo '<div class="container app-main">' . "\r\n" . '   <div class="mb-3">' . "\r\n" . '      <div class="row justify-content-between w-100 align-items-center">' . "\r\n" . '         <div class="col">' . "\r\n" . '            <div class="app-title">' . "\r\n" . '               <h1>🛒 Meus números</h1>' . "\r\n\r\n" . '            </div>' . "\r\n" . '         </div>' . "\r\n" . '         <div class="col-auto text-end"><button type="button" data-bs-toggle="modal" data-bs-target="#modal-buscar" class="btn btn-warning btn-sm"><i class="bi bi-search"></i> Buscar</button></div>' . "\r\n" . '      </div>' . "\r\n" . '   </div>' . "\r\n" . '   <form id="modal-buscar" class="modal fade" aria-hidden="true" style="display: none;">' . "\r\n" . '      <div class="modal-dialog modal-sm modal-dialog-centered">' . "\r\n" . '         <div class="modal-content">' . "\r\n" . '            <div class="modal-header">' . "\r\n" . '               <h5 class="modal-title">Buscar compras</h5>' . "\r\n" . '            </div>' . "\r\n" . '            <div class="modal-body">' . "\r\n" . '            ';

if ($enable_cpf != 1) {
	echo '               <div class="form-group mb-3"><label class="form-label">Informe seu telefone</label>' . "\r\n" . '                  <input onkeyup="formatarTEL(this);" maxlength="15" name="phone" required="" class="form-control" value=""></div>' . "\r\n" . '                  ';
}
else {
	echo '               <div class="form-group mb-3"><label class="form-label">Informe seu CPF</label>' . "\r\n" . '                  <input name="cpf" class="form-control" id="cpf" value="" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required></div>' . "\r\n" . '               ';
}

echo '                  <div class="text-end"><button type="submit" class="btn btn-warning">Buscar compras</button></div>' . "\r\n" . '               </div>' . "\r\n" . '            </div>' . "\r\n" . '         </div>' . "\r\n" . '      </form>' . "\r\n" . '      <div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Clique em buscar para localizar suas compras</div>' . "\r\n" . '      <div>' . "\r\n" . '         ';
$i = 1;
$phone = (isset($_SESSION['phone']) ? $_SESSION['phone'] : '');
$cpf = (isset($_SESSION['cpf']) ? $_SESSION['cpf'] : '123');

if ($enable_cpf != 1) {
	$phone = $conn->real_escape_string($phone);
	$phoneQuery = $conn->query("\r\n" . '             SELECT id' . "\r\n" . '             FROM customer_list' . "\r\n" . '             WHERE phone = \'' . $phone . '\'' . "\r\n" . '             ');
}
else {
	$cpf = $conn->real_escape_string($cpf);
	$phoneQuery = $conn->query("\r\n" . '            SELECT id' . "\r\n" . '            FROM customer_list' . "\r\n" . '            WHERE cpf = \'' . $cpf . '\'' . "\r\n" . '            ');
}
if ($phoneQuery && 0 < $phoneQuery->num_rows) {
	$customerId = $phoneQuery->fetch_assoc()['id'];
	$orders = $conn->query("\r\n" . '           SELECT o.*, p.image_path, p.qty_numbers, o.product_id, p.type_of_draw' . "\r\n" . '           FROM `order_list` o' . "\r\n" . '           INNER JOIN `product_list` p ON o.product_id = p.id' . "\r\n" . '           WHERE o.customer_id = \'' . $customerId . '\'' . "\r\n" . '           ORDER BY ABS(UNIX_TIMESTAMP(o.date_created)) DESC' . "\r\n" . '           ');
	if ($orders && 0 < $orders->num_rows) {
		while ($orderRow = $orders->fetch_assoc()) {
			echo '             ';
			$class = '';
			$border = '';
			$btn = '';
			$status = $orderRow['status'];

			if ($orderRow['status'] == '1') {
				$class = 'bg-warning';
				$border = 'border-warning';
				$btn = 'btn-warning';
			}

			if ($orderRow['status'] == '2') {
				$class = 'bg-success';
				$border = 'border-success';
				$btn = 'btn-success';
			}

			if ($orderRow['status'] == '3') {
				$class = 'bg-danger';
				$border = 'border-danger';
				$btn = 'btn-danger';
			}

			echo '            <div class="card app-card mb-2 pointer border-bottom border-2 ';
			echo $border;
			echo '">' . "\r\n" . '               <div class="card-body">' . "\r\n\r\n" . '                <div class="row align-items-center row-gutter-sm">' . "\r\n" . '                 <div class="col-auto">' . "\r\n" . '                  <div class="position-relative rounded-pill overflow-hidden box-shadow-08" style="width: 56px; height: 56px;">' . "\r\n" . '                   <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">' . "\r\n" . '                    <img src="';
			echo validate_image($orderRow['image_path']);
			echo '" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">' . "\r\n" . '                    <noscript></noscript>' . "\r\n" . '                 </div>' . "\r\n" . '              </div>' . "\r\n" . '           </div>' . "\r\n" . '           <div class="col ps-2">' . "\r\n" . '           <div class="compra-title font-weight-500">';
			echo $orderRow['product_name'];
			echo '</div>' . "\r\n" . '           <small class="compra-data font-xss opacity-50 text-uppercase"><i class="bi bi-calendar4-week"></i> ';
			echo date('d-m-Y H:i', strtotime($orderRow['date_created']));
			echo '</small>' . "\r\n" . '            <div class="compra-cotas font-xs mt-2">' . "\r\n" . '               ';
			$nCollection = explode(',', $orderRow['order_numbers']);
			$qty_nums = count($nCollection);
			$type_of_draw = $orderRow['type_of_draw'];

			if (1 < $type_of_draw) {
				echo drope_format_luck_numbers_dashboard($orderRow['order_numbers'], $orderRow['qty_numbers'], $class, $opt = true, $type_of_draw);
			}
			else if (($type_of_draw == 1) && ($status == 1) || $status == 3 && $enable_hide_numbers == 1) {
				echo 'As cotas serão geradas após o pagamento.';
			}
			else {
				echo '<div class="drope-tab">' . "\r\n" . '                  <input id="drope-tab-' . $orderRow['id'] . '" type="checkbox">' . "\r\n" . '                  <label for="drope-tab-' . $orderRow['id'] . '">Ver números</label>' . "\r\n" . '                  <div class="drope-content">' . drope_format_luck_numbers_dashboard($orderRow['order_numbers'], $orderRow['quantity'], $class = false, $opt = true, $type_of_draw) . '</div>' . "\r\n" . '                 </div>';
			}

			unset($_SESSION['phone']);
			unset($_SESSION['cpf']);
			echo '   ' . "\r\n" . '            ' . "\r\n" . '            ' . "\r\n" . '         </div>' . "\r\n" . '      </div>' . "\r\n" . '     <div class="col-12 pt-2">' . "\r\n" . '        <a href="/compra/';
			echo $orderRow['order_token'];
			echo '">' . "\r\n" . '           <span class="btn ';
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

			echo '</span>' . "\r\n" . '        </a>' . "\r\n" . '     </div>' . "\r\n" . '  </div>' . "\r\n\r\n\r\n\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";
		}
	}
}

echo '</div>' . "\r\n" . '</div>' . "\r\n" . '<script>' . "\r\n" . '   $(window).on(\'load\', function() {' . "\r\n" . '      var tipo = "';
echo $status;
echo '";' . "\r\n" . '      if (!tipo){' . "\r\n" . '         $(\'#modal-buscar\').modal(\'show\');' . "\r\n" . '      }' . "\r\n" . '   });' . "\r\n" . '   $(document).ready(function(){' . "\r\n" . '   var tipo = "';
echo $search_type;
echo '";' . "\r\n" . '    $(\'#modal-buscar\').submit(function(e){' . "\r\n" . '     e.preventDefault()' . "\r\n" . '     $.ajax({' . "\r\n" . '      url:_base_url_+"class/Main.php?action=" + tipo,' . "\r\n" . '      method:\'POST\',' . "\r\n" . '      type:\'POST\',' . "\r\n" . '      data:new FormData($(this)[0]),' . "\r\n" . '      dataType:\'json\',' . "\r\n" . '      cache:false,' . "\r\n" . '      processData:false,' . "\r\n" . '      contentType: false,' . "\r\n" . '      error:err=>{' . "\r\n" . '       console.log(err)' . "\r\n" . '       alert(\'An error occurred\')' . "\r\n" . '    },' . "\r\n" . '    success:function(resp){' . "\r\n" . '       if(resp.status == \'success\'){' . "\r\n" . '         location.href = (resp.redirect)' . "\r\n" . '      }else{' . "\r\n" . '        alert(\'Nenhum registro de compra foi encontrado\')' . "\r\n" . '        console.log(resp)' . "\r\n" . '     }' . "\r\n" . '  }' . "\r\n" . '})' . "\r\n" . '  })' . "\r\n" . ' })' . "\r\n" . '</script>';

?>