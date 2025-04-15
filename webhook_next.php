<?php
require_once 'settings.php';

$json_event = file_get_contents('php://input', true);
$event = json_decode($json_event);

if ($json_event) {
    $event = json_decode($json_event);

    $txid = $event->_id;
    $qry = $conn->query('SELECT o.status, o.product_id, o.total_amount, o.quantity, c.firstname, c.lastname, c.phone, o.referral_id' . "\r\n\t\t\t" . 'FROM order_list o' . "\r\n\t\t\t" . 'INNER JOIN customer_list c ON o.customer_id = c.id' . "\r\n\t\t\t" . 'WHERE o.txid = \'' . $txid . '\'');

    if (0 < $qry->num_rows) {
        $row = $qry->fetch_assoc();
        $status_order = $row['status'];
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $total_amount = $row['total_amount'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $phone = '55' . $row['phone'] . '';
        $ref = $row['referral_id'];
    }
    $product_list = $conn->query("\r\n\t\t\t" . 'SELECT pending_numbers, paid_numbers, qty_numbers' . "\r\n\t\t\t" . 'FROM product_list' . "\r\n\t\t\t" . 'WHERE id = \'' . $product_id . '\'' . "\r\n\t\t\t");

    if (0 < $product_list->num_rows) {
        $row = $product_list->fetch_assoc();
        $pendingNumbers = $row['pending_numbers'];
        $updatePending = $pendingNumbers - $quantity;
        $paidNumbers = $row['paid_numbers'];
        $updatePaid = $paidNumbers + $quantity;
        $qty_numbers = $row['qty_numbers'];
    }
    if ($ref) {
        $referral = $conn->query('SELECT * FROM referral WHERE referral_code = \'' . $ref . '\'');

        if (0 < $referral->num_rows) {
            $row = $referral->fetch_assoc();
            $status_affiliate = $row['status'];
            $percentage_affiliate = $row['percentage'];
        }
    }
    if ($event->status == "CAPTURED") {

        if ($status_order == '1') {

            date_default_timezone_set('America/Sao_Paulo');
            $payment_date = date('Y-m-d H:i:s');
            $sql_ol = 'UPDATE order_list SET status = \'2\', date_updated = \'' . $payment_date . '\', whatsapp_status = \'\' WHERE txid = \'' . $txid . '\'';
            $conn->query($sql_ol);
            $sql_pl = 'UPDATE product_list SET pending_numbers = \'' . $updatePending . '\', paid_numbers = \'' . $updatePaid . '\' WHERE id = \'' . $product_id . '\'';
            $conn->query($sql_pl);

            if ($ref) {
                if ($ref) {
                    if ($status_affiliate == 1) {
                        $value = $total_amount * $percentage_affiliate;
                        $value = $value / 100;
                        $aff_sql = 'UPDATE referral SET amount_pending = amount_pending + ' . $value . ' WHERE referral_code = ' . $ref;
                        $conn->query($aff_sql);
                    }
                }
            }

            $dados = ['first_name' => $firstname, 'last_name' => $lastname, 'phone' => $phone, 'id' => $pedido_id, 'total_amount' => $total_amount];
            send_event_pixel('Purchase', $dados);
            order_email($_settings->info('email_purchase'), '[' . $_settings->info('name') . '] - Pagamento aprovado', $pedido_id);
        }
    }
}
