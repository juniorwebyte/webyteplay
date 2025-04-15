<?php


if (isset($_GET['id'])) {
	$user = $conn->query('SELECT * FROM customer_list where id =\'' . $_GET['id'] . '\' ');

	foreach ($user->fetch_array() as $k => $v) {
		if (!is_numeric($k)) {
			$$k = $v;
		}
	}
}

$enable_email = $_settings->info('enable_email');
$enable_cpf = $_settings->info('enable_cpf');
$enable_password = $_settings->info('enable_password');
$enable_address = $_settings->info('enable_address');
$enable_birth = $_settings->info('enable_birth');
$enable_instagram = $_settings->info('enable_instagram');
echo '<style>' . "\r\n\t" . '#cimg{' . "\r\n\t\t" . 'max-width:100%;' . "\r\n\t\t" . 'max-height:25em;' . "\r\n\t\t" . 'object-fit:scale-down;' . "\r\n\t\t" . 'object-position:center center;' . "\r\n\t" . '}' . "\r\n" . '</style>' . "\r\n" . '<main class="h-full pb-16 overflow-y-auto">' . "\r\n\t" . '<div class="container px-6 mx-auto grid">' . "\r\n\t\t" . '<h2' . "\r\n\t\t" . 'class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"' . "\r\n\t\t" . '>' . "\r\n\t\t";
echo (isset($id) ? 'Editar usuário' : 'Novo usuário');
echo ' <a href="./?page=customers"><button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t" . 'Voltar' . "\r\n\t\t" . '</button></a>' . "\r\n\t" . '</h2>' . "\r\n\r\n\r\n\t" . '<div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">' . "\r\n\t\t" . '<form action="" id="manage-user" autocomplete="off">' . "\t\r\n\t\t\t" . '<input type="hidden" name="id" value="';
echo (isset($id) ? $id : '');
echo '">' . "\r\n\t\t\t" . '<label class="block text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Nome</span>' . "\r\n\t\t\t\t" . '<input name="firstname" id="firstname" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Nome" value="';
echo (isset($firstname) ? $firstname : '');
echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Sobrenome</span>' . "\r\n\t\t\t\t" . '<input name="lastname" id="lastname" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Sobrenome" value="';
echo (isset($lastname) ? $lastname : '');
echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t";

if ($enable_cpf == 1) {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">CPF</span>' . "\r\n\t\t\t\t" . '<input id="cpf" name="cpf" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'maxlength="14" pattern=".{14,}" placeholder="000.000.000-00" onkeydown="javascript: fMasc( this, mCPF );" value="';
	echo (isset($cpf) ? $cpf : '');
	echo '">' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\r\n\t\t\t";

if ($enable_email == 1) {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">E-mail</span>' . "\r\n\t\t\t\t" . '<input name="email" id="email" type="email" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="example@example.com" value="';
	echo (isset($email) ? $email : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Telefone</span>' . "\r\n\t\t\t\t" . '<input onkeyup="formatarTEL(this);" maxlength="15" name="phone" id="phone" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="(00) 00000-00000" value="';
echo (isset($phone) ? formatPhoneNumber($phone) : '');
echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t";

if ($enable_birth == 1) {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Data de nascimento</span>' . "\r\n\t\t\t\t" . '<input name="birth" id="birth" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="11/11/1990" value="';
	echo (isset($birth) ? $birth : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\r\n\t\t\t";

if ($enable_instagram == 1) {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Instagram</span>' . "\r\n\t\t\t\t" . '<input name="instagram" id="instagram" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="@instagram" value="';
	echo (isset($instagram) ? $instagram : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\t\t\t\r\n\t\t\t";

if ($enable_address == 1) {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">CEP:</span>' . "\r\n\t\t\t\t" . '<input name="zipcode" id="zipcode" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="CEP" value="';
	echo (isset($zipcode) ? $zipcode : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Endereço:</span>' . "\r\n\t\t\t\t" . '<input name="address" id="address" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Endereço" value="';
	echo (isset($address) ? $address : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Número:</span>' . "\r\n\t\t\t\t" . '<input name="number" id="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Número" value="';
	echo (isset($number) ? $number : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Bairro:</span>' . "\r\n\t\t\t\t" . '<input name="neighborhood" id="neighborhood" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Bairro" value="';
	echo (isset($neighborhood) ? $neighborhood : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Complemento:</span>' . "\r\n\t\t\t\t" . '<input name="complement" id="complement" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Complemento" value="';
	echo (isset($complement) ? $complement : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Estado:</span>' . "\r\n\t\t\t\t" . '<select class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="state" id="state">' . "\r\n\t\t\t\t\t" . '<option value="">-- Estado --</option>' . "\r\n\t\t\t\t\t" . '<option value="AC" ';

	if ($state == 'AC') {
		echo 'selected';
	}

	echo '>Acre</option>' . "\r\n\t\t\t\t\t" . '<option value="AL" ';

	if ($state == 'AL') {
		echo 'selected';
	}

	echo '>Alagoas</option>' . "\r\n\t\t\t\t\t" . '<option value="AP" ';

	if ($state == 'AP') {
		echo 'selected';
	}

	echo '>Amapá</option>' . "\r\n\t\t\t\t\t" . '<option value="AM" ';

	if ($state == 'AM') {
		echo 'selected';
	}

	echo '>Amazonas</option>' . "\r\n\t\t\t\t\t" . '<option value="BA" ';

	if ($state == 'BA') {
		echo 'selected';
	}

	echo '>Bahia</option>' . "\r\n\t\t\t\t\t" . '<option value="CE" ';

	if ($state == 'CE') {
		echo 'selected';
	}

	echo '>Ceará</option>' . "\r\n\t\t\t\t\t" . '<option value="DF" ';

	if ($state == 'DF') {
		echo 'selected';
	}

	echo '>Distrito Federal</option>' . "\r\n\t\t\t\t\t" . '<option value="ES" ';

	if ($state == 'ES') {
		echo 'selected';
	}

	echo '>Espí&shy;rito Santo</option>' . "\r\n\t\t\t\t\t" . '<option value="GO" ';

	if ($state == 'GO') {
		echo 'selected';
	}

	echo '>Goiás</option>' . "\r\n\t\t\t\t\t" . '<option value="MA" ';

	if ($state == 'MA') {
		echo 'selected';
	}

	echo '>Maranhão</option>' . "\r\n\t\t\t\t\t" . '<option value="MT" ';

	if ($state == 'MT') {
		echo 'selected';
	}

	echo '>Mato Grosso</option>' . "\r\n\t\t\t\t\t" . '<option value="MS" ';

	if ($state == 'MS') {
		echo 'selected';
	}

	echo '>Mato Grosso do Sul</option>' . "\r\n\t\t\t\t\t" . '<option value="MG" ';

	if ($state == 'MG') {
		echo 'selected';
	}

	echo '>Minas Gerais</option>' . "\r\n\t\t\t\t\t" . '<option value="PA" ';

	if ($state == 'PA') {
		echo 'selected';
	}

	echo '>Pará</option>' . "\r\n\t\t\t\t\t" . '<option value="PB" ';

	if ($state == 'PB') {
		echo 'selected';
	}

	echo '>Paraiba</option>' . "\r\n\t\t\t\t\t" . '<option value="PR" ';

	if ($state == 'PR') {
		echo 'selected';
	}

	echo '>Paraná</option>' . "\r\n\t\t\t\t\t" . '<option value="PE" ';

	if ($state == 'PE') {
		echo 'selected';
	}

	echo '>Pernambuco</option>' . "\r\n\t\t\t\t\t" . '<option value="PI" ';

	if ($state == 'PI') {
		echo 'selected';
	}

	echo '>Piauí&shy;</option>' . "\r\n\t\t\t\t\t" . '<option value="RJ" ';

	if ($state == 'RJ') {
		echo 'selected';
	}

	echo '>Rio de Janeiro</option>' . "\r\n\t\t\t\t\t" . '<option value="RN" ';

	if ($state == 'RN') {
		echo 'selected';
	}

	echo '>Rio Grande do Norte</option>' . "\r\n\t\t\t\t\t" . '<option value="RS" ';

	if ($state == 'RS') {
		echo 'selected';
	}

	echo '>Rio Grande do Sul</option>' . "\r\n\t\t\t\t\t" . '<option value="RO" ';

	if ($state == 'RO') {
		echo 'selected';
	}

	echo '>Rondônia</option>' . "\r\n\t\t\t\t\t" . '<option value="RR" ';

	if ($state == 'RR') {
		echo 'selected';
	}

	echo '>Roraima</option>' . "\r\n\t\t\t\t\t" . '<option value="SC" ';

	if ($state == 'SC') {
		echo 'selected';
	}

	echo '>Santa Catarina</option>' . "\r\n\t\t\t\t\t" . '<option value="SP" ';

	if ($state == 'SP') {
		echo 'selected';
	}

	echo '>São Paulo</option>' . "\r\n\t\t\t\t\t" . '<option value="SE" ';

	if ($state == 'SE') {
		echo 'selected';
	}

	echo '>Sergipe</option>' . "\r\n\t\t\t\t\t" . '<option value="TO" ';

	if ($state == 'TO') {
		echo 'selected';
	}

	echo '>Tocantins</option>' . "\r\n\t\t\t\t" . '</select>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Cidade:</span>' . "\r\n\t\t\t\t" . '<input name="city" id="city" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Cidade" value="';
	echo (isset($city) ? $city : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Ponto de referência:</span>' . "\r\n\t\t\t\t" . '<input name="reference_point" id="reference_point" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'placeholder="Ponto de referência" value="';
	echo (isset($reference_point) ? $reference_point : '');
	echo '"/>' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\t\t\t\r\n\t\t\t";

if ($enable_password == '1') {
	echo "\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">';
	echo (isset($id) ? 'Nova' : '');
	echo ' Senha</span>' . "\r\n\t\t\t\t" . '<input type="password" name="password" id="password" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'value=""/>' . "\r\n\t\t\t\t";

	if (isset($id)) {
		echo "\t\t\t\t\t" . '<small class="text-gray-700 dark:text-gray-200"><i>Deixe em branco se não quiser alterar a senha.</i></small>' . "\r\n\t\t\t\t";
	}

	echo "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Confirme a senha</span>' . "\r\n\t\t\t\t" . '<input type="password" id="cpassword" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n\t\t\t\t" . 'value=""/>' . "\t\t\t\t" . ' ' . "\r\n\t\t\t" . '</label>' . "\r\n\t\t\t";
}

echo "\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<span class="text-gray-700 dark:text-gray-400">Avatar</span>' . "\r\n\t\t\t\t" . '<input id="customFile" name="img" onchange="displayImg(this,$(this))" type="file" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"  accept="image/png, image/jpeg">' . "\r\n\t\t\t" . '</label>' . "\r\n\r\n\t\t\t" . '<label class="block mt-4 text-sm">' . "\r\n\t\t\t\t" . '<img src="';
echo validate_image((isset($avatar) ? $avatar : ''));
echo '" alt="" id="cimg" class="img-fluid img-thumbnail">' . "\r\n\t\t\t" . '</div>' . "\r\n\r\n\r\n\t\t\t" . '<div class="mt-2">' . "\r\n\t\t\t\t" . '<button form="manage-user" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">' . "\r\n\t\t\t\t\t" . 'Salvar' . "\r\n\t\t\t\t" . '</button>' . "\r\n\t\t\t" . '</div>' . "\r\n\r\n\t\t" . '</main>' . "\r\n\t\t";
$id = (isset($id) ? $id : '');
$change = '';
$msg = '';

if ($id) {
	$change = 'update_customer';
	$msg = 'Cliente atualizado com sucesso';
}
else {
	$change = 'registration';
	$msg = 'Cliente cadastrado com sucesso';
}

echo "\t\t" . '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>' . "\r\n\t\t" . '<script>' . "\r\n\t\t\t" . 'function formatarTEL(e){v=e.value,console.log("v:"+v),console.log("v.length:"+v.length),v=v.replace(/\\D/g,""),v=v.replace(/^(\\d{2})(\\d)/g,"($1) $2"),console.log("v:"+v),v=v.replace(/(\\d)(\\d{4})$/,"$1-$2"),e.value=v}' . "\r\n\r\n\t\t\t" . 'function displayImg(input,_this) {' . "\r\n\t\t\t\t" . 'if (input.files && input.files[0]) {' . "\r\n\t\t\t\t\t" . 'var reader = new FileReader();' . "\r\n\t\t\t\t\t" . 'reader.onload = function (e) {' . "\r\n\t\t\t\t\t\t" . '$(\'#cimg\').attr(\'src\', e.target.result);' . "\r\n\t\t\t\t\t" . '}' . "\r\n\r\n\t\t\t\t\t" . 'reader.readAsDataURL(input.files[0]);' . "\r\n\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t" . '$(\'#cimg\').attr(\'src\', "';
echo validate_image((isset($avatar) ? $avatar : ''));
echo '");' . "\r\n\t\t\t\t" . '}' . "\r\n\t\t\t" . '}' . "\r\n\t\t\t" . '$(\'#manage-user\').submit(function(e){' . "\r\n\t\t\t\t" . 'e.preventDefault();' . "\r\n\t\t\t\t" . '$.ajax({' . "\r\n\t\t\t\t\t" . 'url:_base_url_+\'class/Customer.php?action=';
echo $change;
echo '\',' . "\r\n\t\t\t\t\t" . 'data: new FormData($(this)[0]),' . "\r\n\t\t\t\t\t" . 'cache: false,' . "\r\n\t\t\t\t\t" . 'contentType: false,' . "\r\n\t\t\t\t\t" . 'processData: false,' . "\r\n\t\t\t\t\t" . 'method: \'POST\',' . "\r\n\t\t\t\t\t" . 'type: \'POST\',' . "\r\n\t\t\t\t\t" . 'success:function(resp){' . "\r\n\t\t\t\t\t\t" . 'var returnedData = JSON.parse(resp);' . "\r\n\t\t\t\t\t\t" . 'if(returnedData.status == \'success\'){' . "\r\n\t\t\t\t\t\t\t" . 'alert(\'';
echo $msg;
echo '\');' . "\r\n\t\t\t\t\t\t\t" . 'location.href=\'./?page=customers\';' . "\r\n\t\t\t\t\t\t" . '} else if (returnedData.status == \'phone_already\'){' . "\r\n\t\t\t\t\t\t\t" . 'alert(\'Esse telefone já está em uso.' . "\t" . '\');' . "\r\n\t\t\t\t\t\t" . '} else if (returnedData.status == \'email_already\'){' . "\r\n\t\t\t\t\t\t\t" . 'alert(\'Esse email já está em uso.\');' . "\r\n\t\t\t\t\t\t" . '} else if (returnedData.status == \'cpf_already\'){' . "\r\n\t\t\t\t\t\t\t" . 'alert(\'Esse CPF já está em uso\');' . "\r\n\t\t\t\t\t\t" . '} else if (resp.status == \'cpf_invalid\') {' . "\r\n" . '                        ' . "\t" . 'alert(\'Esse CPF não é válido.\');' . "\r\n" . '                    ' . "\t" . '} else {' . "\r\n\t\t\t\t\t\t\t" . 'alert(\'Erro ao atualizar usuário\')' . "\r\n\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t" . '}' . "\r\n\t\t\t\t" . '})' . "\r\n\t\t\t" . '})' . "\r\n\r\n\t\t\t" . 'function mascara(i) {' . "\r\n\t\t\t\t" . 'let valor = i.value.replace(/\\D/g, \'\');' . "\r\n\r\n\t\t\t\t" . 'if (isNaN(valor[valor.length - 1])) {' . "\r\n\t\t\t\t\t" . 'i.value = valor.slice(0, -1);' . "\r\n\t\t\t\t\t" . 'return;' . "\r\n\t\t\t\t" . '}' . "\r\n\r\n\t\t\t\t" . 'i.setAttribute("maxlength", "14");' . "\r\n\r\n\t\t\t\t" . 'i.value = valor.replace(/(\\d{3})(\\d{3})(\\d{3})(\\d{2})/, \'$1.$2.$3-$4\');' . "\r\n\t\t\t" . '}' . "\r\n\r\n\t\t\t" . 'function is_cpf (c) {' . "\r\n\r\n\t\t\t\t" . 'if((c = c.replace(/[^\\d]/g,"")).length != 11)' . "\r\n\t\t\t\t" . 'return false' . "\r\n\r\n\t\t\t\t" . 'if (c == "00000000000")' . "\r\n\t\t\t\t" . 'return false;' . "\r\n\r\n\t\t\t\t" . 'var r;' . "\r\n\t\t\t\t" . 'var s = 0;' . "\r\n\r\n\t\t\t\t" . 'for (i=1; i<=9; i++)' . "\r\n\t\t\t\t" . 's = s + parseInt(c[i-1]) * (11 - i);' . "\r\n\r\n\t\t\t\t" . 'r = (s * 10) % 11;' . "\r\n\r\n\t\t\t\t" . 'if ((r == 10) || (r == 11))' . "\r\n\t\t\t\t" . 'r = 0;' . "\r\n\r\n\t\t\t\t" . 'if (r != parseInt(c[9]))' . "\r\n\t\t\t\t" . 'return false;' . "\r\n\r\n\t\t\t\t" . 's = 0;' . "\r\n\r\n\t\t\t\t" . 'for (i = 1; i <= 10; i++)' . "\r\n\t\t\t\t" . 's = s + parseInt(c[i-1]) * (12 - i);' . "\r\n\r\n\t\t\t\t" . 'r = (s * 10) % 11;' . "\r\n\r\n\t\t\t\t" . 'if ((r == 10) || (r == 11))' . "\r\n\t\t\t\t" . 'r = 0;' . "\r\n\r\n\t\t\t\t" . 'if (r != parseInt(c[10]))' . "\r\n\t\t\t\t" . 'return false;' . "\r\n\r\n\t\t\t\t" . 'return true;' . "\r\n\t\t\t" . '}' . "\r\n\r\n\r\n\t\t\t" . 'function fMasc(objeto,mascara) {' . "\r\n\t\t\t\t" . 'obj=objeto' . "\r\n\t\t\t\t" . 'masc=mascara' . "\r\n\t\t\t\t" . 'setTimeout("fMascEx()",1)' . "\r\n\t\t\t" . '}' . "\r\n\r\n\t\t\t" . 'function fMascEx() {' . "\r\n\t\t\t\t" . 'obj.value=masc(obj.value)' . "\r\n\t\t\t" . '}' . "\r\n\r\n\t\t\t" . 'function mCPF(cpf){' . "\r\n\t\t\t\t" . 'cpf=cpf.replace(/\\D/g,"")' . "\r\n\t\t\t\t" . 'cpf=cpf.replace(/(\\d{3})(\\d)/,"$1.$2")' . "\r\n\t\t\t\t" . 'cpf=cpf.replace(/(\\d{3})(\\d)/,"$1.$2")' . "\r\n\t\t\t\t" . 'cpf=cpf.replace(/(\\d{3})(\\d{1,2})$/,"$1-$2")' . "\r\n\t\t\t\t" . 'return cpf' . "\r\n\t\t\t" . '}' . "\r\n\r\n\t\t" . '</script>';

?>