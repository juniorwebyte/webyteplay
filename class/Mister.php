
<?php
require_once('../settings.php');




class Mister extends DBConnection
{

    public function __construct()
    {
        global $_settings;
        if (!isset($_settings)) {
            $_settings = new System();
        }
        $this->settings = $_settings;
        parent::__construct();
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    public function capture_err()
    {
        if (!$this->conn->error) {
            return false;
        } else {
            $resp["status"] = "failed";
            $resp["error"] = $this->conn->error;
            return json_encode($resp);
            exit();
        }
    }
    public function duplicate_product() {
		$id = $_POST['id'];
	
		// Verifica se o ID foi fornecido
		if (empty($id)) {
			echo "ID não fornecido.";
			return;
		}
	
		// Seleciona o registro original do banco de dados
		$qry = $this->conn->query('SELECT * FROM `product_list` WHERE id = \'' . $this->conn->real_escape_string($id) . '\'');
	
		if ($qry->num_rows > 0) {
			$product = $qry->fetch_assoc();
	
			// Prepara os dados para o novo registro
			// Supondo que 'id' é a chave primária e auto-incrementada, então não a incluímos na inserção
			unset($product['id']);
           $currentDate = new DateTime();
        $product['date_created'] = $currentDate->format('Y-m-d H:i:s');
        $product['date_updated'] = $currentDate->format('Y-m-d H:i:s');
        
        // Calcula a diferença de dias entre created_at e date_of_draw original
        if (isset($product['date_of_draw']) && !empty($product['date_of_draw'])) {
            $createdAtOriginal = new DateTime($product['date_created']);
            $dateOfDrawOriginal = new DateTime($product['date_of_draw']);
            $interval = $createdAtOriginal->diff($dateOfDrawOriginal);
            $newDateOfDraw = $currentDate->add($interval);
            $product['date_of_draw'] = $newDateOfDraw->format('Y-m-d H:i:s');
        } else {
            unset($product['date_of_draw']);
        }

            unset($product['draw_winner']);
            unset($product['draw_number']);
            
            $product['paid_numbers'] = 0;
            $product['pending_numbers'] = 0;

            $slug = slugify($product['slug']);
        $check_slug = $this->conn->query(
            'SELECT * FROM `product_list` where `slug` LIKE \'' . $slug . '%\''
        )->num_rows;


        if (0 < $check_slug) {
            $check_slug += 1;
            $slug = $slug . "-" . strval($check_slug);
        }
        $product['slug'] = $slug;
	
			$columns = implode(", ", array_keys($product));
			$values  = implode("', '", array_map(array($this->conn, 'real_escape_string'), array_values($product)));
	
			// Insere o novo registro no banco de dados
			$insert_qry = 'INSERT INTO `product_list` (' . $columns . ') VALUES (\'' . $values . '\')';
			if ($this->conn->query($insert_qry) === TRUE) {
				$resp["status"] = "success";
                $resp["msg"] = "Registro duplicado com sucesso.";
                $resp["pid"] = $this->conn->insert_id;

			} else {
				echo "Erro ao duplicar o registro: " . $this->conn->error;
			}
		} else {
			echo "Registro não encontrado.";
		}
        return json_encode($resp);
	}
	
 
    public function save_product_auto_cota() {
        $product_id = $_POST['product_id']; 
        $status_auto_cota = $_POST['status_auto_cota'] ?? '0';
        $tipo_auto_cota = $_POST['tipo_auto_cota'];

    
    
        // Validações de entrada
        if (empty($product_id)) {
            return json_encode([
                "status" => "failed",
                "msg" => "ID do produto não fornecido."
            ]);
        }
    
    
        if (empty($tipo_auto_cota)) {
            return json_encode([
                "status" => "failed",
                "msg" => "Valor Base do Auto Cota não fornecido."
            ]);
        }
    
        // Prepara a consulta para evitar injeção SQL
        $stmt = $this->conn->prepare('UPDATE `product_list` SET `status_auto_cota` = ?, `tipo_auto_cota` = ? WHERE id = ?');
        if (!$stmt) {
            return json_encode([
                "status" => "failed",
                "msg" => "Erro ao preparar a consulta: " . $this->conn->error
            ]);
        }
    
        $stmt->bind_param('ssi', $status_auto_cota, $tipo_auto_cota, $product_id);
    
        // Executa a consulta
        if ($stmt->execute()) {
            $resp = [
                "status" => "success",
                "msg" => "Auto Cota atualizado com sucesso.",
                "product_id" => "$product_id",
                "status_auto_cota" => "$status_auto_cota",
                "tipo_auto_cota" => "$tipo_auto_cota"

            ];
        } else {
            $resp = [
                "status" => "failed",
                "msg" => "Erro ao atualizar Auto Cota: " . $stmt->error
            ];
        }
    
        // Fecha a declaração
        $stmt->close();
    
        return json_encode($resp);
    }
    

    public function get_product_auto_cota(){
        $product_id = $_POST['product_id'];
        if (empty($product_id)) {
            $resp["status"] = "failed";
            $resp["msg"] = "ID do produto não fornecido.";
            return json_encode($resp);
        }
        $qry = $this->conn->query('SELECT `status_auto_cota`, `tipo_auto_cota` FROM `product_list` WHERE id = \'' . $this->conn->real_escape_string($product_id) . '\'');
        if ($qry->num_rows > 0) {
            $product = $qry->fetch_assoc();
            $resp["status"] = "success";
            $resp["status_auto_cota"] = $product['status_auto_cota'];
            $resp["tipo_auto_cota"] = $product['tipo_auto_cota'];
        } else {
            $resp["status"] = "failed";
            $resp["msg"] = "Produto não encontrado.";
        }
        return json_encode($resp);


    }
    public function place_order()
	{
		$lockFile = $_SERVER['DOCUMENT_ROOT'] . '/pedido.lock';
		$lock = fopen($lockFile, 'w');

		if (flock($lock, LOCK_EX)) {
			$customer_id = $this->settings->userdata('id');
			$customer_fname = $this->settings->userdata('firstname');
			$customer_lname = $this->settings->userdata('lastname');
			$customer_phone = $this->settings->userdata('phone');
			$customer_email = $this->settings->userdata('email');
			$customer_cpf = $this->settings->userdata('cpf');
			$customer_name = $customer_fname . ' ' . $customer_lname;
			$dateCreated = date('Y-m-d H:i:s');
			$product_id = $_POST['product_id'];
			$numbers = (isset($_POST['numbers']) ? $_POST['numbers'] : '');
			$pref = date('Ymdhis.u');
			$code = uniqidReal();
			$ref = $_POST['ref'];
			$order_token = md5($pref . $code);

			if ($this->settings->info('pay2m') == 1) {
				if (empty($customer_cpf)) {
					$resp['status'] = 'pay2m';
					$resp['error'] = 'Seu cadastro precisa ser atualizado, por favor, adicione um CPF válido.';
					$resp['redirect'] = BASE_URL . 'user/atualizar-cadastro';
					flock($lock, LOCK_UN);
					fclose($lock);
					return json_encode($resp);
					exit();
				}
			}

			$multiple = $this->settings->info('enable_multiple_order');

			if ($multiple == 1) {
				$multiple_order = $this->conn->prepare('SELECT id FROM `order_list` WHERE status = 1 AND customer_id = ?');
				$multiple_order->bind_param('i', $customer_id);
				$multiple_order->execute();
				$customer_order = $multiple_order->get_result();

				if (0 < $customer_order->num_rows) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Faça o pagamento do pedido anterior para criar um novo pedido.';
					flock($lock, LOCK_UN);
					fclose($lock);
					return json_encode($resp);
					exit();
				}
			}

			$cart_total = $this->conn->query('SELECT SUM(c.quantity * p.price) FROM `cart_list` c inner join product_list p on c.product_id = p.id where customer_id = \'' . $customer_id . '\' ')->fetch_array()[0];
			$stmt_plist = $this->conn->prepare('SELECT name, qty_numbers, limit_order_remove, type_of_draw FROM `product_list` WHERE id = ?');
			$stmt_plist->bind_param('i', $product_id);
			$stmt_plist->execute();
			$product_list = $stmt_plist->get_result();

			if (0 < $product_list->num_rows) {
				$product = $product_list->fetch_assoc();
				$product_name = $product['name'];
				$qty_numbers = $product['qty_numbers'];
				$type_of_draw = $product['type_of_draw'];
				$order_expiration = $product['limit_order_remove'];
			}

			$quantity = $this->conn->query('SELECT SUM(c.quantity) FROM `cart_list` c inner join product_list p on c.product_id = p.id where customer_id = \'' . $customer_id . '\' ')->fetch_array()[0];

			if (!$quantity) {
				$resp['status'] = 'failed';
				$resp['error'] = 'Erro ao criar pedido.';
				flock($lock, LOCK_UN);
				fclose($lock);
				return json_encode($resp);
				exit();
			}

			$limitOrder = 0;
			$customerOrders = 0;
			$limitOrdersQuery = $this->conn->query('SELECT limit_orders FROM product_list WHERE id = \'' . $product_id . '\'');
			if ($limitOrdersQuery && 0 < $limitOrdersQuery->num_rows) {
				$limitOrder = $limitOrdersQuery->fetch_assoc();
				$limitOrder = $limitOrder['limit_orders'];
			}

			$customerOrdersQuery = $this->conn->query('SELECT id FROM order_list WHERE customer_id = \'' . $customer_id . '\' AND product_id = \'' . $product_id . '\'');
			if ($customerOrdersQuery && 0 < $customerOrdersQuery->num_rows) {
				$customerOrders = $customerOrdersQuery->num_rows;
			}

			if ($limitOrder != 0) {
				if ($limitOrder <= $customerOrders) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Você atingiu o limite de pedido(s) para essa campanha.';
					flock($lock, LOCK_UN);
					fclose($lock);
					return json_encode($resp);
					exit();
				}
			}

			$query = 'SELECT discount_qty, enable_discount, discount_amount, enable_cumulative_discount, enable_sale, sale_qty, sale_price, status, qty_numbers, pending_numbers, paid_numbers, date_of_draw FROM product_list WHERE id = \'' . $product_id . '\'';
			$result = $this->conn->query($query);
			if ($result && 0 < $result->num_rows) {
				$row = $result->fetch_assoc();
				$pending_numbers = $row['pending_numbers'];
				$discount_qty = $row['discount_qty'];
				$enable_discount = $row['enable_discount'];
				$enable_cumulative_discount = $row['enable_cumulative_discount'];
				$discount_amount = $row['discount_amount'];
				$enable_sale = $row['enable_sale'];
				$sale_qty = $row['sale_qty'];
				$sale_price = $row['sale_price'];
				$status = $row['status'];
				$paid_n = $row['paid_numbers'];
				$pending_n = $row['pending_numbers'];
				$date_of_draw = $row['date_of_draw'];
			}

			$totalSales = $paid_n + $pending_n;

			if (1 < $status) {
				$resp['status'] = 'failed';
				$resp['error'] = 'Campanha pausada ou finalizada.';
				return json_encode($resp);
				exit();
			}

			if ($qty_numbers <= $totalSales) {
				$this->conn->query('UPDATE product_list SET status = \'2\', status_display = \'6\' WHERE id = \'' . $product_id . '\'');
				$resp['status'] = 'failed';
				$resp['error'] = 'Camnpanha pausada ou finalizada.';
				flock($lock, LOCK_UN);
				fclose($lock);
				return json_encode($resp);
				exit();
			}

			if ($date_of_draw) {
				$expirationTime = date('Y-m-d H:i:s', strtotime($date_of_draw));
				$currentDateTime = date('Y-m-d H:i:s');

				if ($expirationTime < $currentDateTime) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Compra não permitida. A campanha foi pausada ou finalizada.';
					flock($lock, LOCK_UN);
					fclose($lock);
					return json_encode($resp);
					exit();
				}
			}

			$total_pending_numbers = $pending_n + $quantity;
			$total_paid_numbers = $paid_n + $quantity;
			$total_amount = (0 < $cart_total ? $cart_total : 0);
			$pay_status = 1;

			if ($total_amount == 0) {
				$pay_status = 2;
				$this->conn->query('UPDATE product_list SET paid_numbers = \'' . $total_paid_numbers . '\' WHERE id = \'' . $product_id . '\'');
			}
			else {
				$this->conn->query('UPDATE product_list SET pending_numbers = \'' . $total_pending_numbers . '\' WHERE id = \'' . $product_id . '\'');
			}

			$order_discount_amount = '';
			if ($enable_discount && $discount_amount) {
				$discount_qty = json_decode($discount_qty, true);
				$discount_amount = json_decode($discount_amount, true);
				$discounts = [];

				foreach ($discount_qty as $qty_index => $qty) {
					foreach ($discount_amount as $amount_index => $amount) {
						if ($qty_index === $amount_index) {
							$discounts[$qty_index] = ['qty' => $qty, 'amount' => $amount];
						}
					}
				}

				if ($enable_cumulative_discount == 1) {
					$accumulative_discount = 0;
					$remaining_quantity = $quantity;
					usort($discounts, function($a, $b) {
						return $b['qty'] - $a['qty'];
					});

					foreach ($discounts as $discount) {
						if ($discount['qty'] <= $remaining_quantity) {
							$multiples = floor($remaining_quantity / $discount['qty']);
							$discount_amount = $multiples * $discount['amount'];
							$accumulative_discount += $discount_amount;
							$remaining_quantity -= $multiples * $discount['qty'];
						}
					}

					if (0 < $accumulative_discount) {
						$total_amount -= $accumulative_discount;
						$order_discount_amount = $accumulative_discount;
					}
				}
				else {
					usort($discounts, function($a, $b) {
						return $b['qty'] - $a['qty'];
					});

					foreach ($discounts as $discount) {
						if ($discount['qty'] <= $quantity) {
							$total_amount -= $discount['amount'];
							$order_discount_amount = $discount['amount'];
							break;
						}
					}
				}
			}
			if (($enable_sale == 1) && $enable_discount == 0 && $sale_qty <= $quantity) {
				$order_discount_amount = $total_amount - ($quantity * $sale_price);
				$total_amount = $quantity * $sale_price;
			}

			$order_numbers = '';
			$insert = $this->conn->query('INSERT INTO `order_list` (`code`, `customer_id`, `product_name`, `quantity`, `status`, `total_amount`, `order_token`, `order_numbers`, `product_id`, `order_expiration`, `discount_amount`, `date_created`) VALUES (\'' . $code . '\', \'' . $customer_id . '\', \'' . $product_name . '\', \'' . $quantity . '\', \'' . $pay_status . '\', \'' . $total_amount . '\', \'' . $order_token . '\', \'' . $order_numbers . '\', \'' . $product_id . '\', \'' . $order_expiration . '\', \'' . $order_discount_amount . '\', \'' . $dateCreated . '\') ');

			if ($insert) {
				$oid = $this->conn->insert_id;
				$data = '';
				$sql_cart = 'SELECT c.*,' . "\r\n\t\t\t\t" . 'p.name AS product,' . "\r\n\t\t\t\t" . 'p.price,' . "\r\n\t\t\t\t" . 'p.image_path' . "\r\n\t\t\t\t" . 'FROM `cart_list` c' . "\r\n\t\t\t\t" . 'INNER JOIN product_list p ON c.product_id = p.id' . "\r\n\t\t\t\t" . 'WHERE customer_id = \'' . $customer_id . '\'';
				$cart = $this->conn->query($sql_cart);
				$qty_numbers = $qty_numbers;
				$total_numbers_generated = $quantity;
				$use_manual_numbers = false;

				if (1 < $type_of_draw) {
					$use_manual_numbers = true;
				}

				if ($use_manual_numbers) {
					$orders = $this->conn->query('SELECT order_numbers FROM order_list WHERE product_id = \'' . $product_id . '\' AND status <> 3');
					$cotas_vendidas = [];
					$all_lucky_numbers = [];

					while ($row = $orders->fetch_assoc()) {
						$cotas_vendidas[] = $row['order_numbers'];
					}

					$all_lucky_numbers = implode(',', $cotas_vendidas);
					$all_lucky_numbers = explode(',', $all_lucky_numbers);
					$cotas_vendidas = array_filter($cotas_vendidas);
					$arrValues = array_filter(explode(',', implode(',', $cotas_vendidas)));
					$result = $this->is_in_array($numbers, $arrValues);

					if ($result) {
						$resultNumber = implode(',', $result);
						$resp['status'] = 'failed';
						$resp['error'] = (1 < count($result) ? 'Os números ' . $resultNumber . ' acabaram de ser reservados por outra pessoa. Por favor, escolha outros números' : 'O número ' . $resultNumber . ' acabou de ser reservado por outra pessoa. Por favor, escolha outro número');
						$this->conn->query('DELETE FROM `order_list` where code = \'' . $code . '\'');
						$this->conn->query('UPDATE `product_list` SET `pending_numbers` = `pending_numbers` - \'' . $total_numbers_generated . '\' WHERE `id` = \'' . $product_id . '\'');
						return json_encode($resp);
					}

					$order_numbers = implode(',', $numbers) . ',';
					$update = $this->conn->query('UPDATE `order_list` SET `order_numbers` = \'' . $order_numbers . '\' WHERE `code` = \'' . $code . '\'');
				}
				else {
                    $orders = $this->conn->query(
                        "SELECT order_numbers , product_list.cotas_premiadas, product_list.status_auto_cota FROM order_list INNER JOIN product_list ON product_list.id = order_list.product_id WHERE order_list.product_id = '" .
                            $product_id .
                            "' AND order_list.status <> 3"
                    );
                    $cotas_vendidas = [];
                    $cotas_premiadas = "";
                    $all_lucky_numbers = [];

                    $status_cota_check = $this->conn
                        ->query(
                            "SELECT paid_numbers, status_auto_cota, tipo_auto_cota , qty_numbers FROM product_list WHERE id = '" .
                                $product_id .
                                "'"
                        )
                        ->fetch_assoc();
                    $total_numbers = $status_cota_check["qty_numbers"];
                    $total_paid_numbers = $status_cota_check["paid_numbers"];
                    $status_auto_cota = $status_cota_check["status_auto_cota"];
                    $tipo_auto_cota = $status_cota_check["tipo_auto_cota"];
                    
                    

                    $row = []; // Inicializando $row
					while ($row = $orders->fetch_assoc()) {
						$cotas_vendidas[] = $row['order_numbers'];
					}

                   

                    if (!empty($tipo_auto_cota) && $status_auto_cota == 1) {
                        $cotas_vendidas[] = $tipo_auto_cota;
						$resp['tipo_auto_cota'] = $tipo_auto_cota;
                    }

                    $all_lucky_numbers = implode(",", $cotas_vendidas);
                    $all_lucky_numbers = explode(",", $all_lucky_numbers);
                    $numeros_ja_vendidos = array_filter($all_lucky_numbers);

                    if (
                        $qty_numbers <
                        $total_numbers_generated +
                        count($numeros_ja_vendidos) -
                        1
                    ) {
                        $resp["status"] = "failed";
                        $resp["error"] =
                            "[DP01] - Erro ao criar pedido, selecione uma quantidade menor.";
                        $this->conn->query(
                            'DELETE FROM `order_list` where code = \'' .
                                $code .
                                '\''
                        );
                        $this->conn->query(
                            'UPDATE `product_list` SET `pending_numbers` = `pending_numbers` - \'' .
                                $total_numbers_generated .
                                '\' WHERE `id` = \'' .
                                $product_id .
                                '\''
                        );
                        flock($lock, LOCK_UN);
                        fclose($lock);
                        return json_encode($resp);
                    }
                    $globos = strlen($qty_numbers - 1);
$numeris = [];

// Gerar todos os números possíveis dentro do range
for ($i = 0; $i < $qty_numbers; $i++) {
    if (!in_array($i, $numeros_ja_vendidos)) {
        $numeris[] = str_pad(
            $i,
            max((int) $globos, 1),
            "0",
            STR_PAD_LEFT
        );
    }
}

// Embaralhar os números restantes
shuffle($numeris);

// Selecionar os primeiros $total_numbers_generated números
$numeris = array_slice($numeris, 0, $total_numbers_generated);

// Converter a lista de números para uma string
$order_numbers = implode(",", $numeris) . ",";
                    $update = $this->conn->query(
                        'UPDATE `order_list` SET `order_numbers` = \'' .
                            $order_numbers .
                            '\' WHERE `code` = \'' .
                            $code .
                            '\''
                    );
                }
				if (($this->settings->info('mercadopago') == 1) && 0 < $total_amount) {
		 mercadopago_generate_pix($oid, $total_amount, $customer_name, $customer_email, $order_expiration);

                    $resp['gateway'] = 'mercadopago';
				}
				if (($this->settings->info('gerencianet') == 1) && 0 < $total_amount) {
					gerencianet_generate_pix($oid, $total_amount, $customer_name, $customer_email, $order_expiration);
                    $resp['gateway'] = 'gerencianet';
				}
				if (($this->settings->info('paggue') == 1) && 0 < $total_amount) {
					paggue_generate_pix($oid, $total_amount, $customer_name, $customer_email, $order_expiration);
                    $resp['gateway'] = 'paggue';
				}
				if (($this->settings->info('openpix') == 1) && 0 < $total_amount) {
					openpix_generate_pix($oid, $total_amount, $customer_name, $customer_email, $order_expiration, $customer_phone);
                    $resp['gateway'] = 'openpix';
				}
				if (($this->settings->info('pay2m') == 1) && 0 < $total_amount) {
					pay2m_generate_pix($oid, $total_amount, $customer_name, $customer_cpf, $order_expiration);
                    $resp['gateway'] = 'pay2m';
				}
				// if (($this->settings->info('ezzepay') == 1) && 0 < $total_amount) {
				// 	ezzepay_generate_pix($oid, $total_amount, $customer_name, $customer_cpf, $order_expiration);
                //     $resp['gateway'] = 'ezzepay';
				// }
				if (($this->settings->info('nextpay') == 1) && 0 < $total_amount) {
					nextpay_generate_pix($oid, $total_amount, $customer_name, $customer_cpf, $order_expiration);
                    $resp['gateway'] = 'nextpay';
				}

				if (!empty($ref)) {
					$referral = $this->conn->query('SELECT status FROM referral WHERE referral_code = \'' . $ref . '\'');

					if (0 < $referral->num_rows) {
						$row = $referral->fetch_assoc();
						$status_affiliate = $row['status'];

						if ($status_affiliate == 1) {
							$update = $this->conn->query('UPDATE order_list SET referral_id = ' . $ref . ' WHERE id = ' . $oid);
						}
					}
				}

				if ($this->settings->info('enable_dwapi') == 1) {
					$queryPhone = $this->conn->query('SELECT phone FROM customer_list WHERE id = \'' . $customer_id . '\'');
					if ($queryPhone && 0 < $queryPhone->num_rows) {
						$customerRow = $queryPhone->fetch_assoc();
						$customerPhone = $customerRow['phone'];
						$message = $this->settings->info('mensagem_novo_pedido_dwapi');
						$queryPIX = $this->conn->query('SELECT pix_code FROM order_list WHERE id = \'' . $oid . '\'');
						if ($queryPIX && 0 < $queryPIX->num_rows) {
							$pixRow = $queryPIX->fetch_assoc();
							$pix_code = $pixRow['pix_code'];
							$this->send_order_whatsapp($customerPhone, $customer_name, $product_name, $order_numbers, $total_amount, $message, $pix_code);
						}
					}
				}

				while ($row = $cart->fetch_assoc()) {
					if (!empty($data)) {
						$data .= ', ';
					}

					$data .= '(\'' . $oid . '\', \'' . $row['product_id'] . '\', \'' . $row['quantity'] . '\', \'' . $row['price'] . '\')';
				}

				if (!empty($data)) {
					$sql = 'INSERT INTO order_items (`order_id`, `product_id`, `quantity`, `price`) VALUES ' . $data;
					$save = $this->conn->query($sql);

					if ($save) {
						$resp['status'] = 'success';
						$this->conn->query('DELETE FROM `cart_list` where customer_id = \'' . $customer_id . '\'');
					}
					else {
						$resp['status'] = 'failed';
						$resp['error'] = $this->conn->error;
						$this->conn->query('DELETE FROM `order_list` where id = \'' . $oid . '\'');
					}
				}
				else {
					$resp['status'] = 'success';
				}
			}
			else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}

			if ($resp['status'] == 'success') {
				$resp['redirect'] = '/compra/' . $order_token . '';
			}

			if ($this->settings->info('enable_pixel') == 1) {
				$dados = ['first_name' => $customer_fname, 'last_name' => $customer_lname, 'phone' => '55' . $customer_phone, 'id' => $oid, 'total_amount' => $total_amount];
				send_event_pixel('InitiateCheckout', $dados);
			}

			$this->correct_stock($product_id);

			if ($status == 1) {
				$query = $this->conn->query('SELECT SUM(quantity) as quantity FROM order_list WHERE product_id = \'' . $product_id . '\' AND status <> 3');
				if ($query && 0 < $query->num_rows) {
					$row = $query->fetch_assoc();
					$quantidade = $row['quantity'];

					if (($qty_numbers + 1) <= $quantidade) {
						$this->conn->query('UPDATE product_list SET status = \'3\', status_display = \'6\' WHERE id = \'' . $product_id . '\'');
					}
				}
			}

			order_email($this->settings->info('email_order'), '[' . $this->settings->info('name') . '] - Confirmação de pedido', $oid);
			flock($lock, LOCK_UN);
			fclose($lock);
		}

		return json_encode($resp);
	}

    public function correct_stock($id)
	{
		if (empty($id)) {
			$id = $_GET['id'];
		}
        $resp = [];

		$sql_pending = $this->conn->query('SELECT p.pending_numbers, SUM(o.quantity) as quantity FROM product_list as p LEFT JOIN order_list as o ON p.id = o.product_id WHERE p.id = \'' . $id . '\' AND o.status = \'1\'');
		if ($sql_pending && 0 < $sql_pending->num_rows) {
			while ($row = $sql_pending->fetch_assoc()) {
				$pl_pending = $row['pending_numbers'];
				$ol_pending = $row['quantity'];
				if (empty($ol_pending) || $ol_pending == NULL) {
					$ol_pending = 0;
				}

				if ($pl_pending != $ol_pending) {
					$update = $this->conn->query('UPDATE product_list SET pending_numbers = \'' . $ol_pending . '\' WHERE id = \'' . $id . '\'');

					if ($update) {
						$resp['status'] = 'success';
						continue;
					}

					$resp['status'] = 'failed';
					$resp['msg'] = $this->conn->error;
				}
			}
		}

		$sql_paid = $this->conn->query('SELECT p.paid_numbers, SUM(o.quantity) as quantity FROM product_list as p LEFT JOIN order_list as o ON p.id = o.product_id WHERE p.id = \'' . $id . '\' AND o.status = \'2\'');
		if ($sql_paid && 0 < $sql_paid->num_rows) {
			while ($row = $sql_paid->fetch_assoc()) {
				$pl_paid = $row['paid_numbers'];
				$ol_paid = $row['quantity'];
				if (empty($ol_paid) || $ol_paid == NULL) {
					$ol_paid = 0;
				}

				if ($pl_paid != $ol_paid) {
					$update = $this->conn->query('UPDATE product_list SET paid_numbers = \'' . $ol_paid . '\' WHERE id = \'' . $id . '\'');

					if ($update) {
						$resp['status'] = 'success';
						continue;
					}

					$resp['status'] = 'failed';
					$resp['msg'] = $this->conn->error;
				}
			}
		}

		return json_encode($resp);
	}

    public function get_product_by_slug(){
        $slug = $_POST['slug'];
        $qry = $this->conn->query('SELECT * FROM `product_list` WHERE slug = \'' . $this->conn->real_escape_string($slug) . '\'');
        if ($qry->num_rows > 0) {
            $product = $qry->fetch_assoc();
            $resp["status"] = "success";
            $resp["product"] = $product;
        } else {
            $resp["status"] = "failed";
            $resp["msg"] = "Produto não encontrado.";
        }
        return json_encode($resp);
    }

}

ini_set('display_errors', 0);
$Mister = new Mister();
$action = (!isset($_GET['action']) ? 'none' : strtolower($_GET['action']));

switch ($action) {
        case "get_product_auto_cota":
             echo $Mister->get_product_auto_cota();
             break;
        case "save_product_auto_cota":
             echo $Mister->save_product_auto_cota();
             break;

        case "duplicate_product":
            echo $Mister->duplicate_product();
            break;
        case "get_product_by_slug":
            echo $Mister->get_product_by_slug();
            break;    



       case "place_order_process":
            echo $Mister->place_order();
            break;     


    default:
        break;
}
