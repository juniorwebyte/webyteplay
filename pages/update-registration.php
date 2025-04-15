<?php


require_once './settings.php';
$enable_cpf = $_settings->info('enable_cpf');
$enable_email = $_settings->info('enable_email');
$enable_address = $_settings->info('enable_address');
$enable_password = $_settings->info('enable_password');
$enable_two_phone = $_settings->info('enable_two_phone');
$enable_birth = $_settings->info('enable_birth');
$enable_instagram = $_settings->info('enable_instagram');

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

echo '<div class="container app-main app-form">' . "\r\n" . ' <form id="form-cadastrar" method="get" action=".">' . "\r\n\r\n" . '  <div class="perfil app-card card mb-2">' . "\r\n\r\n" . '        <div class="rounded-pill mt-2 mb-2" style="margin-inline: auto; width: 180px; height: 180px; position: relative; overflow: hidden;">' . "\r\n" . '            <img id="cimg" alt="" src="';
echo validate_image((isset($avatar) ? $avatar : ''));
echo '" class="img-fluid" decoding="async" data-nimg="fill">' . "\r\n" . '        </div>' . "\r\n" . '        <div style="margin-inline:auto; padding: 0 10px 0 10px">' . "\r\n" . '            <input id="customFile" name="img" onchange="displayImg(this,$(this))" type="file"  accept=".png, .jpg, .jpeg">' . "\r\n" . '        </div>' . "\r\n\r\n" . '   <div class="card-body">' . "\r\n" . '   <input type="hidden" name="id" value="';
echo (isset($id) ? $id : '');
echo '">' . "\r\n" . '    <div class="mb-2">' . "\r\n" . '        <label for="firstname" class="form-label">Nome</label>' . "\r\n" . '        <input type="text" name="firstname" class="form-control text-black" id="firstname" placeholder="Primeiro nome" required="" value="';
echo (isset($firstname) ? $firstname : '');
echo '">' . "\r\n" . '    </div>' . "\r\n" . '    <div class="mb-2">' . "\r\n" . '        <label for="lastname" class="form-label">Sobrenome</label>' . "\r\n" . '        <input type="text" name="lastname" class="form-control text-black" id="lastname" placeholder="Sobrenome" required="" value="';
echo (isset($lastname) ? $lastname : '');
echo '">' . "\r\n" . '    </div>' . "\r\n" . '    ';

if ($enable_cpf == 1) {
	echo '        <div class="mb-2">' . "\r\n" . '            <label for="cpf" class="form-label">CPF</label>' . "\r\n" . '            <input name="cpf" class="form-control text-black" id="cpf" value="';
	echo (isset($cpf) ? $cpf : '');
	echo '" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required>' . "\r\n" . '        </div>' . "\r\n" . '    ';
}

echo '    ';

if ($enable_email == 1) {
	echo '    <div class="mb-2">' . "\r\n" . '        <label for="email" class="form-label">E-mail</label>' . "\r\n" . '        <input type="email" name="email" class="form-control text-black" id="email" placeholder="exemplo@exemplo.com" value="';
	echo (isset($email) ? $email : '');
	echo '">' . "\r\n" . '    </div>' . "\r\n" . '    ';
}

echo '    <div class="mb-2">' . "\r\n" . '        <label for="phone" class="form-label">Telefone</label>' . "\r\n" . '        <input readonly onkeyup="formatarTEL(this);" class="form-control text-black mb-2" name="phone" id="phone" maxlength="15" required="" value="';
echo (isset($phone) ? formatPhoneNumber($phone) : '');
echo '" style="background-color: #eeee;">' . "\r\n" . '    </div>' . "\r\n" . '    ';

if ($enable_birth == 1) {
	echo '    <div class="mb-2">' . "\r\n" . '        <label for="birth" class="form-label">Data de nascimento</label>' . "\r\n" . '        <input type="date" name="birth" class="form-control text-black" id="birth" placeholder="@usuario" value="';
	echo (isset($birth) ? $birth : '');
	echo '">' . "\r\n" . '    </div>' . "\r\n" . '    ';
}

echo '    ';

if ($enable_instagram == 1) {
	echo '    <div class="mb-2">' . "\r\n" . '        <label for="instagram" class="form-label">Instagram</label>' . "\r\n" . '        <input name="instagram" class="form-control text-black" id="instagram" placeholder="@usuario" value="';
	echo (isset($instagram) ? $instagram : '');
	echo '">' . "\r\n" . '    </div>' . "\r\n" . '    ';
}

echo "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";

if ($enable_address == 1) {
	echo '<div class="endereco app-card card mb-2 ">' . "\r\n" . '   <div class="card-body">' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="zipcode" class="form-label">CEP</label>' . "\r\n" . '            <input name="zipcode" class="form-control text-black" type="text" id="zipcode" onkeyup="handleZipCode(event)" value="';
	echo (isset($zipcode) ? $zipcode : '');
	echo '" size="10" maxlength="9" onblur="pesquisacep(this.value);" />' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="address" class="form-label">Endereço</label>' . "\r\n" . '            <input type="text" name="address" class="form-control text-black" id="address" value="';
	echo (isset($address) ? $address : '');
	echo '">' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="number" class="form-label">Número</label>' . "\r\n" . '            <input type="text" name="number" class="form-control text-black" id="number" value="';
	echo (isset($number) ? $number : '');
	echo '">' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="neighborhood" class="form-label">Bairro</label>' . "\r\n" . '            <input type="text" name="neighborhood" class="form-control text-black" id="neighborhood" value="';
	echo (isset($neighborhood) ? $neighborhood : '');
	echo '">' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="complement" class="form-label">Complemento</label>' . "\r\n" . '            <input type="text" name="complement" class="form-control text-black" id="complement" value="';
	echo (isset($complement) ? $complement : '');
	echo '">' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="state" class="form-label">Estado</label>' . "\r\n" . '            <select class="form-select text-black" name="state" id="state">' . "\r\n" . '                <option value="">-- Estado --</option>' . "\r\n" . '                <option value="AC" ';

	if ($state == 'AC') {
		echo 'selected';
	}

	echo '>Acre</option>' . "\r\n" . '                <option value="AL" ';

	if ($state == 'AL') {
		echo 'selected';
	}

	echo '>Alagoas</option>' . "\r\n" . '                <option value="AP" ';

	if ($state == 'AP') {
		echo 'selected';
	}

	echo '>Amapá</option>' . "\r\n" . '                <option value="AM" ';

	if ($state == 'AM') {
		echo 'selected';
	}

	echo '>Amazonas</option>' . "\r\n" . '                <option value="BA" ';

	if ($state == 'BA') {
		echo 'selected';
	}

	echo '>Bahia</option>' . "\r\n" . '                <option value="CE" ';

	if ($state == 'CE') {
		echo 'selected';
	}

	echo '>Ceará</option>' . "\r\n" . '                <option value="DF" ';

	if ($state == 'DF') {
		echo 'selected';
	}

	echo '>Distrito Federal</option>' . "\r\n" . '                <option value="ES" ';

	if ($state == 'ES') {
		echo 'selected';
	}

	echo '>Espí&shy;rito Santo</option>' . "\r\n" . '                <option value="GO" ';

	if ($state == 'GO') {
		echo 'selected';
	}

	echo '>Goiás</option>' . "\r\n" . '                <option value="MA" ';

	if ($state == 'MA') {
		echo 'selected';
	}

	echo '>Maranhão</option>' . "\r\n" . '                <option value="MT" ';

	if ($state == 'MT') {
		echo 'selected';
	}

	echo '>Mato Grosso</option>' . "\r\n" . '                <option value="MS" ';

	if ($state == 'MS') {
		echo 'selected';
	}

	echo '>Mato Grosso do Sul</option>' . "\r\n" . '                <option value="MG" ';

	if ($state == 'MG') {
		echo 'selected';
	}

	echo '>Minas Gerais</option>' . "\r\n" . '                <option value="PA" ';

	if ($state == 'PA') {
		echo 'selected';
	}

	echo '>Pará</option>' . "\r\n" . '                <option value="PB" ';

	if ($state == 'PB') {
		echo 'selected';
	}

	echo '>Paraiba</option>' . "\r\n" . '                <option value="PR" ';

	if ($state == 'PR') {
		echo 'selected';
	}

	echo '>Paraná</option>' . "\r\n" . '                <option value="PE" ';

	if ($state == 'PE') {
		echo 'selected';
	}

	echo '>Pernambuco</option>' . "\r\n" . '                <option value="PI" ';

	if ($state == 'PI') {
		echo 'selected';
	}

	echo '>Piauí&shy;</option>' . "\r\n" . '                <option value="RJ" ';

	if ($state == 'RJ') {
		echo 'selected';
	}

	echo '>Rio de Janeiro</option>' . "\r\n" . '                <option value="RN" ';

	if ($state == 'RN') {
		echo 'selected';
	}

	echo '>Rio Grande do Norte</option>' . "\r\n" . '                <option value="RS" ';

	if ($state == 'RS') {
		echo 'selected';
	}

	echo '>Rio Grande do Sul</option>' . "\r\n" . '                <option value="RO" ';

	if ($state == 'RO') {
		echo 'selected';
	}

	echo '>Rondônia</option>' . "\r\n" . '                <option value="RR" ';

	if ($state == 'RR') {
		echo 'selected';
	}

	echo '>Roraima</option>' . "\r\n" . '                <option value="SC" ';

	if ($state == 'SC') {
		echo 'selected';
	}

	echo '>Santa Catarina</option>' . "\r\n" . '                <option value="SP" ';

	if ($state == 'SP') {
		echo 'selected';
	}

	echo '>São Paulo</option>' . "\r\n" . '                <option value="SE" ';

	if ($state == 'SE') {
		echo 'selected';
	}

	echo '>Sergipe</option>' . "\r\n" . '                <option value="TO" ';

	if ($state == 'TO') {
		echo 'selected';
	}

	echo '>Tocantins</option>' . "\r\n" . '            </select>' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="city" class="form-label">Cidade</label>' . "\r\n" . '            <input name="city" class="form-control text-black" type="text" id="city" value="';
	echo (isset($city) ? $city : '');
	echo '" size="40" />' . "\r\n" . '        </div>' . "\r\n" . '        <div class="mb-2">' . "\r\n" . '            <label for="reference_point" class="form-label">Ponto de referência</label>' . "\r\n" . '            <input type="text" name="reference_point" class="form-control text-black" id="reference_point" value="';
	echo (isset($reference_point) ? $reference_point : '');
	echo '">' . "\r\n" . '        </div>' . "\r\n" . '    </div>' . "\r\n" . '</div>' . "\r\n";
}

echo "\r\n" . '<button type="submit" class="btn btn-secondary btn-wide">Salvar</button>' . "\r\n\r\n" . '</div>' . "\r\n\r\n\r\n" . '</form>' . "\r\n" . '</div>' . "\r\n\r\n" . '<script>' . "\r\n\r\n" . '    var fileInput = document.getElementById("customFile");' . "\r\n" . '    var allowedExtension1 = ".jpg";' . "\r\n" . '    var allowedExtension2 = ".jpeg";' . "\r\n" . '    var allowedExtension3 = ".png";' . "\r\n\r\n" . '    fileInput.addEventListener("change", function() {' . "\r\n" . '    // Check that the file extension is supported.' . "\r\n" . '    // If not, clear the input.' . "\r\n" . '    var hasInvalidFiles = false;' . "\r\n" . '    for (var i = 0; i < this.files.length; i++) {' . "\r\n" . '        var file = this.files[i];' . "\r\n" . '        ' . "\r\n" . '        if (!file.name.endsWith(allowedExtension1) && !file.name.endsWith(allowedExtension2) && !file.name.endsWith(allowedExtension3)) {' . "\r\n" . '        hasInvalidFiles = true;' . "\r\n" . '        }' . "\r\n" . '    }' . "\r\n" . '    ' . "\r\n" . '    if(hasInvalidFiles) {' . "\r\n" . '        fileInput.value = ""; ' . "\r\n" . '        alert("Unsupported file selected.");' . "\r\n" . '    }' . "\r\n" . '    });' . "\r\n" . '    ' . "\r\n" . '    function displayImg(input,_this) {' . "\r\n\t" . 'if (input.files && input.files[0]) {' . "\r\n\t\t" . 'var reader = new FileReader();' . "\r\n\t\t" . 'reader.onload = function (e) {' . "\r\n\t\t\t" . '$(\'#cimg\').attr(\'src\', e.target.result);' . "\r\n\t\t" . '}' . "\r\n\t\t" . 'reader.readAsDataURL(input.files[0]);' . "\r\n\t" . '}else{' . "\r\n\t\t" . '$(\'#cimg\').attr(\'src\', "';
echo validate_image((isset($avatar) ? $avatar : ''));
echo '");' . "\r\n\t" . '}' . "\r\n\t" . '}' . "\r\n" . '    ' . "\r\n" . '    const handleZipCode = (event) => {' . "\r\n" . '        let input = event.target' . "\r\n" . '        input.value = zipCodeMask(input.value)' . "\r\n" . '    }' . "\r\n\r\n" . '    const zipCodeMask = (value) => {' . "\r\n" . '        if (!value) return ""' . "\r\n" . '        value = value.replace(/\\D/g,\'\')' . "\r\n" . '        value = value.replace(/(\\d{5})(\\d)/,\'$1-$2\')' . "\r\n" . '        return value' . "\r\n" . '    }' . "\r\n\r\n" . '    function limpa_formulário_cep() {' . "\r\n" . '        //Limpa valores do formulário de cep.' . "\r\n" . '        document.getElementById(\'address\').value = ("");' . "\r\n" . '        document.getElementById(\'neighborhood\').value = ("");' . "\r\n" . '        document.getElementById(\'city\').value = ("");' . "\r\n" . '        document.getElementById(\'state\').value = ("");' . "\r\n" . '    }' . "\r\n\r\n" . '    function meu_callback(conteudo) {' . "\r\n" . '        if (!("erro" in conteudo)) {' . "\r\n" . '            //Atualiza os campos com os valores.' . "\r\n" . '            document.getElementById(\'address\').value = (conteudo.logradouro);' . "\r\n" . '            document.getElementById(\'neighborhood\').value = (conteudo.bairro);' . "\r\n" . '            document.getElementById(\'city\').value = (conteudo.localidade);' . "\r\n" . '            document.getElementById(\'state\').value = (conteudo.uf);' . "\r\n" . '        } //end if.' . "\r\n" . '        else {' . "\r\n" . '            //CEP não Encontrado.' . "\r\n" . '            limpa_formulário_cep();' . "\r\n" . '            alert("CEP não encontrado.");' . "\r\n" . '        }' . "\r\n" . '    }' . "\r\n\r\n" . '    function pesquisacep(valor) {' . "\r\n\r\n" . '        //Nova variável "cep" somente com dígitos.' . "\r\n" . '        var cep = valor.replace(/\\D/g, \'\');' . "\r\n\r\n" . '        //Verifica se campo cep possui valor informado.' . "\r\n" . '        if (cep != "") {' . "\r\n\r\n" . '            //Expressão regular para validar o CEP.' . "\r\n" . '            var validacep = /^[0-9]{8}$/;' . "\r\n\r\n" . '            //Valida o formato do CEP.' . "\r\n" . '            if (validacep.test(cep)) {' . "\r\n" . '                //Preenche os campos com "..." enquanto consulta webservice.' . "\r\n" . '                document.getElementById(\'address\').value = "...";' . "\r\n" . '                document.getElementById(\'neighborhood\').value = "...";' . "\r\n" . '                document.getElementById(\'city\').value = "...";' . "\r\n" . '                document.getElementById(\'state\').value = "...";' . "\r\n\r\n" . '                //Cria um elemento javascript.' . "\r\n" . '                var script = document.createElement(\'script\');' . "\r\n\r\n" . '                //Sincroniza com o callback.' . "\r\n" . '                script.src = \'https://viacep.com.br/ws/\' + cep + \'/json/?callback=meu_callback\';' . "\r\n\r\n" . '                //Insere script no documento e carrega o conteúdo.' . "\r\n" . '                document.body.appendChild(script);' . "\r\n\r\n" . '            } //end if.' . "\r\n" . '            else {' . "\r\n" . '                //cep é inválido.' . "\r\n" . '                limpa_formulário_cep();' . "\r\n" . '                alert("Formato de CEP inválido.");' . "\r\n" . '            }' . "\r\n" . '        } //end if.' . "\r\n" . '        else {' . "\r\n" . '            //cep sem valor, limpa formulário.' . "\r\n" . '            limpa_formulário_cep();' . "\r\n" . '        }' . "\r\n" . '    };' . "\r\n\r\n" . '    $(document).ready(function () {' . "\r\n" . '        $(\'#form-cadastrar\').submit(function (e) {' . "\r\n" . '            e.preventDefault()' . "\r\n" . '            var phoneValue = $(\'#phone\').val();' . "\r\n" . '            if ($(\'#phone\')) {' . "\r\n" . '                if (phoneValue.length < 15 || phoneValue.length > 15) {' . "\r\n" . '                    alert(\'Telefone inválido. Por favor corrija.\');' . "\r\n" . '                    return;' . "\r\n" . '                }' . "\r\n" . '            }' . "\r\n\r\n" . '            $.ajax({' . "\r\n" . '                url: _base_url_ + "class/Customer.php?action=update_customer",' . "\r\n" . '                method: \'POST\',' . "\r\n" . '                type: \'POST\',' . "\r\n" . '                data: new FormData($(this)[0]),' . "\r\n" . '                dataType: \'json\',' . "\r\n" . '                cache: false,' . "\r\n" . '                processData: false,' . "\r\n" . '                contentType: false,' . "\r\n" . '                error: err => {' . "\r\n" . '                    console.log(err)' . "\r\n" . '                    alert(\'An error occurred\')' . "\r\n" . '                },' . "\r\n" . '                success: function (resp) {' . "\r\n" . '                    if (resp.status == \'success\') {' . "\r\n" . '                        alert(\'Dados atualizados com sucessso.\');' . "\r\n" . '                        location.href = (resp.redirect);' . "\r\n" . '                    } else if (resp.status == \'phone_already\') {' . "\r\n" . '                        alert(\'Este telefone já está cadastrado.\');' . "\r\n" . '                    } else if (resp.status == \'cpf_already\') {' . "\r\n" . '                        alert(\'Este CPF já está cadastrado.\');' . "\r\n" . '                    } else if (resp.status == \'cpf_invalid\') {' . "\r\n" . '                        alert(resp.msg);' . "\r\n" . '                    } else if (!!resp.msg) {' . "\r\n" . '                        el.html(resp.msg)' . "\r\n" . '                        el.show(\'slow\')' . "\r\n" . '                        _this.prepend(el)' . "\r\n" . '                    } else {' . "\r\n" . '                        alert(\'An error occurred\')' . "\r\n" . '                        console.log(resp)' . "\r\n" . '                    }' . "\r\n" . '                }' . "\r\n" . '            })' . "\r\n" . '        })' . "\r\n" . '    })' . "\r\n" . '</script>';

?>


<script>
$(document).ready(function() {
    function sanitizeInput(selector) {
        $(selector).on('change', function() {
            let value = $(this).val();
            if (value.includes('<') || value.includes('>')) {
                alert('Entrada inválida. Por favor, corrija.');
                $(this).val('');
            }
        });
    }

    // Apply the sanitization function to multiple fields
    sanitizeInput('#firstname');
    sanitizeInput('#lastname');
    // Add more fields as needed
    sanitizeInput('#email');
    sanitizeInput('#instagram');
});
</script>
