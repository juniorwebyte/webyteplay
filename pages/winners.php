<?php


echo '<div class="container app-main">' . "\r\n" . '   <div class="app-title mb-2">' . "\r\n" . '      <h1>🏆 Ganhadores</h1>' . "\r\n" . '      <div class="app-title-desc">confira os sortudos</div>' . "\r\n" . '   </div>' . "\r\n" . '   ';
$sql = "\r\n" . '           SELECT name AS product_name, draw_number, draw_winner, date_of_draw, image_path, slug' . "\r\n" . '           FROM product_list' . "\r\n" . '           WHERE draw_number <> \'\'' . "\r\n" . '            ';
$products = $conn->query($sql);
echo '   <div class="app-content">' . "\r\n" . '      ';

while ($row = $products->fetch_assoc()) {
	$product_name = $row['product_name'];
	$draw_number = $row['draw_number'];
	$draw_name = $row['draw_winner'];
	$draw_number_arr = json_decode(json_encode($draw_number));
	$draw_winner_arr = json_decode(json_encode($draw_name));
	$draw_number = $draw_number_arr[0];
	$draw_name = $draw_winner_arr[0];
	$date_of_draw = strtotime($row['date_of_draw']);
	$date_of_draw = date('d/m/y', $date_of_draw);
	$image_path = validate_image($row['image_path']);
	echo '         ';

	if (!empty($draw_number_arr)) {
		echo '            ';
		$winners_qty = 5;
		$draw_number_arr = (isset($draw_number_arr) ? $draw_number_arr : '');
		if ($winners_qty && $draw_number_arr) {
			$draw_winner_arr = json_decode($draw_winner_arr, true);
			$draw_number_arr = json_decode($draw_number_arr, true);
			$winners = [];

			foreach ($draw_winner_arr as $qty_index => $name) {
				foreach ($draw_number_arr as $amount_index => $number) {
					$query = $conn->query('SELECT CONCAT(firstname, \' \', lastname) as name, avatar FROM customer_list WHERE phone = \'' . $name . '\'');
					$rowCustomer = $query->fetch_assoc();

					if ($qty_index === $amount_index) {
						$winners[$qty_index] = ['name' => $rowCustomer['name'], 'number' => $number, 'product' => $product_name, 'date' => $date_of_draw, 'image' => ($rowCustomer['avatar'] ? validate_image($rowCustomer['avatar']) : BASE_URL . 'assets/img/avatar.png')];
					}
				}
			}
		}

		echo '            ';
		$count = 0;

		foreach ($winners as $winner) {
			++$count;
			echo '                  <a href="/campanha/';
			echo $row['slug'];
			echo '">' . "\r\n" . '                     <div class="ganhadorItem_ganhadorContainer__1Sbxm mb-2">' . "\r\n" . '                        <div class="ganhadorItem_ganhadorFoto__324kH box-shadow-08">' . "\r\n" . '                           <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">' . "\r\n" . '                              <img alt="';
			echo $winner['product'];
			echo ' ganhador do prêmio ';
			echo $winner['product'];
			echo '" src="';
			echo $winner['image'];
			echo '" decoding="async" data-nimg="fill" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">' . "\r\n" . '                              <noscript><img alt="';
			echo $draw_name;
			echo ' ganhador do prêmio ';
			echo $winner['product'];
			echo '" src="';
			echo $winner['image'];
			echo '" decoding="async" data-nimg="fill" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" loading="lazy" /></noscript>' . "\r\n" . '                           </div>' . "\r\n" . '                        </div>' . "\r\n" . '                        <div class="undefined w-100">' . "\r\n" . '                           <h3 class="ganhadorItem_ganhadorNome__2j_J-" style="text-transform: uppercase;">';
			echo $winner['name'];
			echo '</h3>' . "\r\n" . '                           <div class="ganhadorItem_ganhadorDescricao__Z4kO2">' . "\r\n" . '                              <p class="mb-0" style="text-transform:uppercase;"><b>';
			echo $winner['product'];
			echo '</b></p>' . "\r\n" . '                              <p class="mb-0">Número da sorte <b> ';
			echo $winner['number'];
			echo ' </b></p>' . "\r\n" . '                              <p class="mb-0">Data da premiação <b> ';
			echo $winner['date'];
			echo ' </b></p>' . "\r\n" . '                           </div>' . "\r\n" . '                        </div>' . "\r\n" . '                     </div>' . "\r\n" . '                  </a>' . "\r\n" . '            ';
		}

		echo '         ';
	}

	echo '      ';
}

echo '   </div>' . "\r\n" . '</div>';

?>