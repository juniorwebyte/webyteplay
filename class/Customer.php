<?php
require_once('../settings.php');


class Customer extends DBConnection
{
    private $settings = null;

    public function __construct()
    {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function save_users_system()
    {
        if (empty($_POST['password'])) {
            unset($_POST['password']);
        } else {
            $_POST['password'] = md5($_POST['password']);
        }

        extract($_POST);
        $data = '';
        if (empty($id)) {
            if (empty($_POST['type']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['username'])) {
                return 3;
            }
        } else {
            if (empty($_POST['type']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['username'])) {
                return 3;
            }
        }


        foreach ($_POST as $k => $v) {
            $v = $this->conn->real_escape_string($v);

            if (!empty($data)) {
                $data .= ', ';
            }

            $data .= ' `' . $k . '` = \'' . $v . '\' ';
        }


        if (empty($id)) {
            $data = str_replace('`id` = \'\' ,', '', $data);

            $qry = $this->conn->query('INSERT INTO users set ' . $data);

            if ($qry) {
                $id = $this->conn->insert_id;

                foreach ($_POST as $k => $v) {
                    if ($k != 'id') {
                        if (!empty($data)) {
                            $data .= ' , ';
                        }

                        if ($id == $this->settings->userdata('id')) {
                            $this->settings->set_userdata($k, $v);
                        }
                    }
                }

                $user_name = $this->settings->userdata('firstname');
                $insert = $this->conn->query('INSERT INTO `logs` (`origin`, `description`) VALUES (\'USER\', \'Usuário ' . $_POST['firstname'] . ' adicionado pelo usuário ' . $user_name . '\')');

                if (!empty($_FILES['img']['tmp_name'])) {
                    if (!is_dir(BASE_APP . 'uploads/avatars')) {
                        mkdir(BASE_APP . 'uploads/avatars');
                    }

                    $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $fname = 'uploads/avatars/' . $id . '.png';
                    $accept = ['image/jpeg', 'image/png'];

                    if (!in_array($_FILES['img']['type'], $accept)) {
                        $err = 'Image file type is invalid';
                    }

                    if ($_FILES['img']['type'] == 'image/jpeg') {
                        $uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
                    } else if ($_FILES['img']['type'] == 'image/png') {
                        $uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
                    }

                    if (!$uploadfile) {
                        $err = 'Image is invalid';
                    }

                    $temp = imagescale($uploadfile, 200, 200);

                    if (is_file(BASE_APP . $fname)) {
                        unlink(BASE_APP . $fname);
                    }

                    $upload = imagepng($temp, BASE_APP . $fname);

                    if ($upload) {
                        $this->conn->query('UPDATE `users` set `avatar` = CONCAT(\'' . $fname . '\', \'?v=\',unix_timestamp(CURRENT_TIMESTAMP)) where id = \'' . $id . '\'');

                        if ($id == $this->settings->userdata('id')) {
                            $this->settings->set_userdata('avatar', $fname . '?v=' . time());
                        }
                    }

                    imagedestroy($temp);
                }

                return 1;
            } else {
                return 2;
            }
        } else {
            $qry = $this->conn->query('UPDATE users set ' . $data . ' where id = ' . $id);

            if ($qry) {
                foreach ($_POST as $k => $v) {
                    if ($k != 'id') {
                        if (!empty($data)) {
                            $data .= ' , ';
                        }

                        if ($id == $this->settings->userdata('id')) {
                            $this->settings->set_userdata($k, $v);
                        }
                    }
                }

                $user_name = $this->settings->userdata('firstname');
                $insert = $this->conn->query('INSERT INTO `logs` (`origin`, `description`) VALUES (\'USER\', \'Usuário ' . $_POST['firstname'] . ' atualizado pelo usuário ' . $user_name . '\')');

                if (!empty($_FILES['img']['tmp_name'])) {
                    if (!is_dir(BASE_APP . 'uploads/avatars')) {
                        mkdir(BASE_APP . 'uploads/avatars');
                    }

                    $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $fname = 'uploads/avatars/' . $id . '.png';
                    $accept = ['image/jpeg', 'image/png'];

                    if (!in_array($_FILES['img']['type'], $accept)) {
                        $err = 'Image file type is invalid';
                    }

                    if ($_FILES['img']['type'] == 'image/jpeg') {
                        $uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
                    } else if ($_FILES['img']['type'] == 'image/png') {
                        $uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
                    }

                    if (!$uploadfile) {
                        $err = 'Image is invalid';
                    }

                    $temp = imagescale($uploadfile, 200, 200);

                    if (is_file(BASE_APP . $fname)) {
                        unlink(BASE_APP . $fname);
                    }

                    $upload = imagepng($temp, BASE_APP . $fname);

                    if ($upload) {
                        $this->conn->query('UPDATE `users` set `avatar` = CONCAT(\'' . $fname . '\', \'?v=\',unix_timestamp(CURRENT_TIMESTAMP)) where id = \'' . $id . '\'');

                        if ($id == $this->settings->userdata('id')) {
                            $this->settings->set_userdata('avatar', $fname . '?v=' . time());
                        }
                    }

                    imagedestroy($temp);
                }

                return 4;
            } else {
                return 'UPDATE users set ' . $data . ' where id = ' . $id;
            }
        }
    }

    public function delete_users_system()
    {
        extract($_POST);

        if (!$this->settings->userdata('firstname')) {
            return 2;
        }

        $usr = $this->conn->query('SELECT * FROM users WHERE id = ' . $id);

        if (0 < $usr->num_rows) {
            $row = $usr->fetch_assoc();
            $u_username = $row['username'];
            $u_firstname = $row['firstname'];
            $u_lastname = $row['lastname'];
            $u_email = $row['email'];
            $u_date_added = date('d/m/Y', strtotime($row['date_added']));
        }

        $qry = $this->conn->query('DELETE FROM users where id = ' . $id);

        if ($qry) {
            $user_name = $this->settings->userdata('firstname');
            $insert = $this->conn->query('INSERT INTO `logs` (`origin`, `description`) VALUES (\'USER\', \'Usuário ' . $u_username . ' (' . $u_firstname . ' ' . $u_lastname . ') criado em ' . $u_date_added . ' deletado pelo usuário ' . $user_name . '\')');

            if (is_file(BASE_APP . ('uploads/avatars/' . $id . '.png'))) {
                unlink(BASE_APP . ('uploads/avatars/' . $id . '.png'));
            }

            return 1;
        } else {
            return false;
        }
    }

    public function registration()
    {
        if (!empty($_POST['password'])) {
            $_POST['password'] = md5($_POST['password']);
        } else {
            unset($_POST['password']);
        }

        if (!empty($_POST['phone_confirm'])) {
            unset($_POST['phone_confirm']);
        }

        $_POST['phone'] = preg_replace('/[^0-9]/', '', $_POST['phone']);
        extract($_POST);
        $id = (isset($id) != '' && isset($id) != null && isset($id) > 0 ? $id : null);
        $data = '';
        if ($this->settings->info('enable_legal_age') == 1) {
            $year = date('Y');
            $birth = date('Y', strtotime($birth));

            if (($year - $birth) < 18) {
                $resp['status'] = 'birth_invalid';
                $resp['msg'] = 'Você precisa ser maior de 18 anos para se registrar.';
                return json_encode($resp);
            }
        }

        $check = $this->conn->query('SELECT * FROM `customer_list` where phone = \'' . $phone . '\' ' . (0 < $id ? ' and id!=\'' . $id . '\'' : '') . ' ')->num_rows;

        if (0 < $check) {
            $resp['status'] = 'phone_already';
            $resp['msg'] = 'Esse telefone já está em uso.';
            return json_encode($resp);
        }

        if (!empty($_POST['cpf'])) {
            $cpf_validate = validaCPF($cpf);

            if (!$cpf_validate) {
                $resp['status'] = 'cpf_invalid';
                $resp['msg'] = 'Esse CPF não é válido.';
                return json_encode($resp);
            }

            $cpf = $_POST['cpf'];
            $check = $this->conn->query('SELECT * FROM `customer_list` where cpf = \'' . $cpf . '\'')->num_rows;

            if (0 < $check) {
                $resp['status'] = 'cpf_already';
                $resp['msg'] = 'Esse CPF já está em uso.';
                return json_encode($resp);
            }
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $check = $this->conn->query('SELECT * FROM `customer_list` where email = \'' . $email . '\'')->num_rows;

            if (0 < $check) {
                $resp['status'] = 'email_already';
                $resp['msg'] = 'Esse email já está em uso';
                return json_encode($resp);
            }
        }

        foreach ($_POST as $k => $v) {
            $v = $this->conn->real_escape_string($v);

            if (!empty($data)) {
                $data .= ', ';
            }

            $data .= ' `' . $k . '` = \'' . $v . '\' ';
        }
        if (empty($id)) {

            $data = str_replace('`id` = \'\' ,', '', $data);
            $sql = 'INSERT INTO `customer_list` set ' . $data . ' ';
        } else {
            $sql = 'UPDATE `customer_list` set ' . $data . ' where id = \'' . $id . '\' ';
        }

        $save = $this->conn->query($sql);

        if ($save) {
            $uid = (!empty($id) ? $id : $this->conn->insert_id);
            $resp['status'] = 'success';
            $resp['redirect'] = BASE_URL;
            $resp['uid'] = $uid;

            if (!empty($id)) {
                $resp['msg'] = 'User Details has been updated successfully';
            } else {
                $resp['msg'] = 'Your Account has been created successfully';
            }
            if (!empty($uid) && $this->settings->userdata('login_type') != 1) {
                $user = $this->conn->query('SELECT * FROM `customer_list` where id = \'' . $uid . '\' ');

                if (0 < $user->num_rows) {
                    $res = $user->fetch_array();

                    foreach ($res as $k => $v) {
                        $this->settings->set_userdata($k, $v);
                    }

                    $this->settings->set_userdata('login_type', '2');
                }
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = $this->conn->error;
            $resp['sql'] = $sql;
        }
        if (($resp['status'] == 'success') && isset($resp['msg'])) {
            if ($uid) {
                $dados = [];
                $qry = $this->conn->query('SELECT c.id, c.firstname, c.lastname, c.phone FROM `customer_list` c WHERE c.id = \'' . $uid . '\' ');

                if (0 < $qry->num_rows) {
                    $row = $qry->fetch_assoc();
                    $dados['id'] = $row['id'];
                    $dados['first_name'] = $row['firstname'];
                    $dados['last_name'] = $row['lastname'];
                    $dados['phone'] = $row['phone'];
                    send_event_pixel('CompleteRegistration', $dados);
                }
            }
        }

        return json_encode($resp);
    }

    public function change_password()
    {
        if (!$this->settings->userdata('id')) {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Não autorizado.';
            return json_encode($resp);
        }

        global $_settings;
        $id = $_settings->userdata('id');

        if (!empty($_POST['password'])) {
            $password = md5($_POST['password']);
            $sql = 'UPDATE `customer_list` SET `password` = \'' . $password . '\' WHERE `id` = \'' . $id . '\'';
            $save = $this->conn->query($sql);
            $resp['status'] = 'success';
            $resp['msg'] = 'ok';
            return json_encode($resp);
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Id não existe';
            return json_encode($resp);
        }
    }

    public function update_customer()
    {
        if (!$this->settings->userdata('firstname')) {
            $resp['status'] = 'failed';
            return json_encode($resp);
        }

        if (!empty($_POST['password'])) {
            $_POST['password'] = md5($_POST['password']);
        } else {
            unset($_POST['password']);
        }

        $_POST['phone'] = preg_replace('/[^0-9]/', '', $_POST['phone']);
        extract($_POST);
        $data = '';

        if ($_POST['phone']) {
            $checkPhone = $this->conn->query('SELECT * FROM `customer_list` where phone = \'' . $phone . '\' ' . (0 < $id ? ' and id != \'' . $id . '\'' : '') . ' ')->num_rows;

            if (0 < $checkPhone) {
                $resp['status'] = 'phone_already';
                $resp['msg'] = 'Esse telefone já está em uso.';
                return json_encode($resp);
            }
        }

        if (!empty($_POST['email'])) {
            $checkEmail = $this->conn->query('SELECT * FROM `customer_list` where email = \'' . $email . '\' ' . (0 < $id ? ' and id != \'' . $id . '\'' : '') . ' ')->num_rows;

            if (0 < $checkEmail) {
                $resp['status'] = 'email_already';
                $resp['msg'] = 'Esse email já está em uso.';
                return json_encode($resp);
            }
        }

        if (!empty($_POST['cpf'])) {
            $cpf_validate = validaCPF($cpf);

            if (!$cpf_validate) {
                $resp['status'] = 'cpf_invalid';
                $resp['msg'] = 'Esse CPF não é válido.';
                return json_encode($resp);
            }

            $checkCPF = $this->conn->query('SELECT * FROM `customer_list` where cpf = \'' . $cpf . '\' ' . (0 < $id ? ' and id != \'' . $id . '\'' : '') . ' ')->num_rows;

            if (0 < $checkCPF) {
                $resp['status'] = 'cpf_already';
                $resp['msg'] = 'Esse CPF já está em uso.';
                return json_encode($resp);
            }
        }

        foreach ($_POST as $k => $v) {
            $v = $this->conn->real_escape_string($v);

            if (!empty($data)) {
                $data .= ', ';
            }

            $data .= ' `' . $k . '` = \'' . $v . '\' ';
        }

        if (empty($id)) {
            $sql = 'INSERT INTO `customer_list` set ' . $data . ' ';
        } else {
            $sql = 'UPDATE `customer_list` set ' . $data . ' where id = \'' . $id . '\' ';
        }

        $save = $this->conn->query($sql);

        if ($save) {
            $uid = (!empty($id) ? $id : $this->conn->insert_id);
            $resp['status'] = 'success';
            $resp['msg'] = 'Cadastro atualizado!';
            $resp['redirect'] = BASE_URL . 'user/atualizar-cadastro';
            $resp['uid'] = $uid;

            if (!empty($id)) {
                $resp['msg'] = 'User Details has been updated successfully';
            } else {
                $resp['msg'] = 'Your Account has been created successfully';
            }

            if (!empty($_FILES['img']['tmp_name'])) {
                if (!is_dir(BASE_APP . 'uploads/customers')) {
                    mkdir(BASE_APP . 'uploads/customers');
                }

                $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $fname = 'uploads/customers/' . $uid . '.png';
                $accept = ['image/jpeg', 'image/png'];

                if (!in_array($_FILES['img']['type'], $accept)) {
                    $resp['msg'] = 'Image file type is invalid';
                }

                if ($_FILES['img']['type'] == 'image/jpeg') {
                    $uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
                } else if ($_FILES['img']['type'] == 'image/png') {
                    $uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
                }

                if (!$uploadfile) {
                    $resp['msg'] = 'Image is invalid';
                }

                $temp = imagescale($uploadfile, 200, 200);

                if (is_file(BASE_APP . $fname)) {
                    unlink(BASE_APP . $fname);
                }

                $upload = imagepng($temp, BASE_APP . $fname);

                if ($upload) {
                    $this->conn->query('UPDATE `customer_list` set `avatar` = CONCAT(\'' . $fname . '\', \'?v=\',unix_timestamp(CURRENT_TIMESTAMP)) where id = \'' . $uid . '\'');
                }

                imagedestroy($temp);
            }
            if (!empty($uid) && $this->settings->userdata('login_type') != 1) {
                $user = $this->conn->query('SELECT * FROM `customer_list` where id = \'' . $uid . '\' ');

                if (0 < $user->num_rows) {
                    $res = $user->fetch_array();

                    foreach ($res as $k => $v) {
                        if (!is_numeric($k) && $k != 'password') {
                            $this->settings->set_userdata($k, $v);
                        }
                    }

                    $this->settings->set_userdata('login_type', '2');
                }
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = $this->conn->error;
            $resp['sql'] = $sql;
        }
        if (($resp['status'] == 'success') && isset($resp['msg'])) {
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        return json_encode($resp);
    }

    public function delete_customer_system()
    {
        if (!$this->settings->userdata('firstname')) {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Não autorizado.';
            return json_encode($resp);
        }

        extract($_POST);
        $avatarResult = $this->conn->query('SELECT avatar FROM customer_list where id = ' . $id);
        $qry = $this->conn->query('DELETE FROM customer_list where id = ' . $id);

        if ($qry) {
            $resp['status'] = 'success';

            if (0 < $avatarResult->num_rows) {
                $avatarRow = $avatarResult->fetch_array();
                $avatar = $avatarRow[0];

                if ($avatar !== null) {
                    $avatarParts = explode('?', $avatar);
                    $avatarPath = $avatarParts[0];

                    if (is_file(BASE_APP . $avatarPath)) {
                        unlink(BASE_APP . $avatarPath);
                    }
                }
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = $this->conn->error;
        }

        return json_encode($resp);
    }
}

$users = new Customer();
$action = (!isset($_GET['action']) ? 'none' : strtolower($_GET['action']));

switch ($action) {
    case 'save_system':
        echo $users->save_users_system();
        break;
    case 'delete_system':
        echo $users->delete_users_system();
        break;
    case 'delete_system_customer':
        echo $users->delete_customer_system();
        break;
    case 'update_customer':
        echo $users->update_customer();
        break;
    case 'change_password_system':
        echo $users->change_password();
        break;
    case 'registration':
        echo $users->registration();
        break;
    default:
        break;
}
