<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'];
require_once $root_dir . '/settings.php';
$sql = 'SELECT `date_created`, `order_expiration`, `product_id`, `quantity`, `id`, `id_mp`, `payment_method` FROM `order_list` WHERE `status` = 1';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pid = [];
    $updatePendingStatements = [];
    $deleteOrderStatements = [];

    while ($row = $result->fetch_assoc()) {
        $dateCreated = $row['date_created'];
        $orderExpiration = $row['order_expiration'];
        $product_id = $row['product_id'];
        $pid[] = $row['product_id'];
        $quantity = $row['quantity'];
        $order_id = $row['id'];
        $id_mp = $row['id_mp'];
        $payment_method = $row['payment_method'];
        $expirationTime = date('Y-m-d H:i:s', strtotime($dateCreated . ' + ' . $orderExpiration . ' minutes'));
        $currentDateTime = date('Y-m-d H:i:s');

        if (($expirationTime < $currentDateTime) && $orderExpiration > 0) {
            if ($payment_method == 'MercadoPago') {
                if (check_order_mp($order_id, $id_mp) == 'failed') {
                    $updatePendingStatements[] = 'UPDATE product_list SET pending_numbers = pending_numbers - \'' . $quantity . '\' WHERE id = \'' . $product_id . '\'';
                    $updatePendingStatements[] = 'UPDATE order_list SET status = 3, date_updated = \'' . $currentDateTime . '\' WHERE id = \'' . $order_id . '\'';
                    echo 'Pedido ' . $order_id . ' expirou e foi cancelado.<br>';
                } else {
                    echo 'Pedido ' . $order_id . ' foi aprovado.<br>';
                }
            } else if ($payment_method == 'OpenPix') {
                if (check_order_op($order_id) == 'failed') {
                    $updatePendingStatements[] = 'UPDATE product_list SET pending_numbers = pending_numbers - \'' . $quantity . '\' WHERE id = \'' . $product_id . '\'';
                    $updatePendingStatements[] = 'UPDATE order_list SET status = 3, date_updated = \'' . $currentDateTime . '\' WHERE id = \'' . $order_id . '\'';
                    echo 'Pedido ' . $order_id . ' expirou e foi cancelado.<br>';
                } else {
                    echo 'Pedido ' . $order_id . ' foi aprovado.<br>';
                }
            } else if ($payment_method == 'Pay2m') {
                if (check_order_pay2m($order_id, $id_mp) == 'failed') {
                    $updatePendingStatements[] = 'UPDATE product_list SET pending_numbers = pending_numbers - \'' . $quantity . '\' WHERE id = \'' . $product_id . '\'';
                    $updatePendingStatements[] = 'UPDATE order_list SET status = 3, date_updated = \'' . $currentDateTime . '\' WHERE id = \'' . $order_id . '\'';
                    echo 'Pedido ' . $order_id . ' expirou e foi cancelado.<br>';
                } else {
                    echo 'Pedido ' . $order_id . ' foi aprovado.<br>';
                }
            } else {
                $updatePendingStatements[] = 'UPDATE product_list SET pending_numbers = pending_numbers - \'' . $quantity . '\' WHERE id = \'' . $product_id . '\'';
                $updatePendingStatements[] = 'UPDATE order_list SET status = 3, date_updated = \'' . $currentDateTime . '\' WHERE id = \'' . $order_id . '\'';
                echo 'Pedido ' . $order_id . ' expirou e foi cancelado.<br>';
            }

            continue;
        }

        echo 'Pedido ' . $order_id . ' ainda está no prazo de validade.<br>';
    }

    $conn->begin_transaction();

    try {
        foreach ($updatePendingStatements as $updateStatement) {
            $conn->query($updateStatement);
        }

        foreach ($deleteOrderStatements as $deleteStatement) {
            $conn->query($deleteStatement);
        }

        $conn->commit();

        if ($pid) {
            $pid = array_unique($pid);

            foreach ($pid as $id) {
                revert_product($id);
                correct_stock($id);
            }
        }

        echo 'Atualizações e exclusões realizadas com sucesso.<hr>';
    } catch (Exception $e) {
        $conn->rollback();
        echo 'Erro ao processar as atualizações e exclusões: ' . $e->getMessage();
        echo '<hr>';
    }
} else {
    echo 'Não há pedidos a serem processados.';
    echo '<hr>';
}

?>
