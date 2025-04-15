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
    echo '<script>alert(\'Você já está cadastrado\'); ' . "\r\n" . '    location.replace(\'/\');</script>';
    exit();
}

echo '<div class="container app-main app-form">' . "\r\n" . '    <form id="form-cadastrar" method="get" action=".">' . "\r\n\r\n" . '        <div class="perfil app-card card mb-2">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="mb-2">' . "\r\n" . '                    <label for="firstname" class="form-label">Nome</label>' . "\r\n" . '                    <input type="text" name="firstname" class="form-control text-black" id="firstname" placeholder="Primeiro nome"' . "\r\n" . '                        required="">' . "\r\n" . '                </div>' . "\r\n" . '                <div class="mb-2">' . "\r\n" . '                    <label for="lastname" class="form-label">Sobrenome</label>' . "\r\n" . '                    <input type="text" name="lastname" class="form-control text-black" id="lastname" placeholder="Sobrenome"' . "\r\n" . '                        required="">' . "\r\n" . '                </div>' . "\r\n" . '                ';

if ($enable_cpf == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="cpf" class="form-label">CPF</label>' . "\r\n" . '                        <input name="cpf" class="form-control text-black" id="cpf" value="" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required>' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n" . '                ';

if ($enable_email == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="email" class="form-label">E-mail</label>' . "\r\n" . '                        <input type="email" name="email" class="form-control text-black" id="email" placeholder="exemplo@exemplo.com "' . "\r\n" . '                            required>' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n" . '                <div class="mb-2">' . "\r\n" . '                    <label for="phone" class="form-label">Telefone</label>' . "\r\n" . '                    <input onkeyup="formatarTEL(this);" class="form-control text-black mb-2" name="phone" id="phone" maxlength="15"' . "\r\n" . '                    placeholder="(00) 0000-0000" required="" value="" class=>' . "\r\n" . '                </div>' . "\r\n" . '                ' . "\r\n" . '                ';

if ($enable_two_phone == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="phone_confirm" class="form-label">Confirme seu telefone</label>' . "\r\n" . '                        <input onkeyup="formatarTEL(this);" class="form-control text-black mb-2" name="phone_confirm" id="phone_confirm" maxlength="15"' . "\r\n" . '                        placeholder="(00) 0000-0000" required="" value="" class=>' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n" . '                ';

if ($enable_password == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="password" class="form-label">Senha</label>' . "\r\n" . '                        <input class="form-control text-black mb-2" name="password" id="password" required="" minlength="5"' . "\r\n" . '                            maxlength="20" type="password">' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n" . '                ';

if ($enable_birth == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="birth" class="form-label">Data de nascimento</label>' . "\r\n" . '                        <input type="date" name="birth" id="birth" placeholder="11/11/1990" class="form-control text-black mb-2" required>' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n" . '                ';

if ($enable_instagram == 1) {
    echo '                    <div class="mb-2">' . "\r\n" . '                        <label for="instagram" class="form-label">Instagram</label>' . "\r\n" . '                        <input name="instagram" class="form-control text-black" id="instagram" placeholder="@usuario">' . "\r\n" . '                    </div>' . "\r\n" . '                ';
}

echo "\r\n\r\n" . '            </div>' . "\r\n" . '        </div>' . "\r\n\r\n" . '        ';

if ($enable_address == 1) {
    echo '            <div class="endereco app-card card mb-2 ">' . "\r\n" . '                <div class="card-body">' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="zipcode" class="form-label">CEP</label>' . "\r\n" . '                        <input name="zipcode"  class="form-control text-black" type="text" id="zipcode" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" />' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="address" class="form-label">Endereço</label>' . "\r\n" . '                        <input type="text" name="address"  class="form-control text-black" id="address" required="">' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="number" class="form-label">Número</label>' . "\r\n" . '                        <input type="text" name="number"  class="form-control text-black" id="number">' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="neighborhood" class="form-label">Bairro</label>' . "\r\n" . '                        <input name="neighborhood"  class="form-control text-black" type="text" id="neighborhood" size="40" required=""/>' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="complement" class="form-label">Complemento</label>' . "\r\n" . '                        <input type="text" name="complement"  class="form-control text-black" id="complement">' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="state" class="form-label">Estado</label>' . "\r\n" . '                        <select class="form-select" name="state" id="state" required="">' . "\r\n" . '                            <option value="">-- Estado --</option>' . "\r\n" . '                            <option value="AC">Acre</option>' . "\r\n" . '                            <option value="AL">Alagoas</option>' . "\r\n" . '                            <option value="AP">Amapá</option>' . "\r\n" . '                            <option value="AM">Amazonas</option>' . "\r\n" . '                            <option value="BA">Bahia</option>' . "\r\n" . '                            <option value="CE">Ceará</option>' . "\r\n" . '                            <option value="DF">Distrito Federal</option>' . "\r\n" . '                            <option value="ES">Espí&shy;rito Santo</option>' . "\r\n" . '                            <option value="GO">Goiás</option>' . "\r\n" . '                            <option value="MA">Maranhão</option>' . "\r\n" . '                            <option value="MT">Mato Grosso</option>' . "\r\n" . '                            <option value="MS">Mato Grosso do Sul</option>' . "\r\n" . '                            <option value="MG">Minas Gerais</option>' . "\r\n" . '                            <option value="PA">Pará</option>' . "\r\n" . '                            <option value="PB">Paraiba</option>' . "\r\n" . '                            <option value="PR">Paraná</option>' . "\r\n" . '                            <option value="PE">Pernambuco</option>' . "\r\n" . '                            <option value="PI">Piauí&shy;</option>' . "\r\n" . '                            <option value="RJ">Rio de Janeiro</option>' . "\r\n" . '                            <option value="RN">Rio Grande do Norte</option>' . "\r\n" . '                            <option value="RS">Rio Grande do Sul</option>' . "\r\n" . '                            <option value="RO">Rondônia</option>' . "\r\n" . '                            <option value="RR">Roraima</option>' . "\r\n" . '                            <option value="SC">Santa Catarina</option>' . "\r\n" . '                            <option value="SP">São Paulo</option>' . "\r\n" . '                            <option value="SE">Sergipe</option>' . "\r\n" . '                            <option value="TO">Tocantins</option>' . "\r\n" . '                        </select>' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="city" class="form-label">Cidade</label>' . "\r\n" . '                        <input name="city" class="form-select" type="text" id="city" size="40" />' . "\r\n" . '                    </div>' . "\r\n" . '                    <div class="mb-2">' . "\r\n" . '                        <label for="reference_point" class="form-label">Ponto de referência</label><input type="text"' . "\r\n" . '                            name="reference_point"  class="form-control text-black" id="reference_point">' . "\r\n" . '                    </div>' . "\r\n" . '                </div>' . "\r\n" . '            </div>' . "\r\n" . '        ';
}

echo '        <button type="submit" class="btn btn-secondary btn-wide">Cadastrar</button>' . "\r\n" . '    </form>' . "\r\n" . '</div>' . "\r\n\r\n" . '<script>' . "\r\n\r\n" . '    function date_formator(date) {' . "\r\n" . '        console.log(date);' . "\r\n" . '        date = date.replace(\'//\', \'/\');' . "\r\n" . '        var result = date.split("/");' . "\r\n" . '        var length = result.length;' . "\r\n" . '        if (length <= 2 && result[length - 1] != "") {' . "\r\n" . '            var last_two_digits = result[length -1];' . "\r\n" . '            if (last_two_digits.length >= 2) {' . "\r\n" . '                date = date.slice(0, -last_two_digits.length);' . "\r\n" . '                date = date + last_two_digits.slice(0,2) + "/";' . "\r\n" . '            }' . "\r\n" . '        }' . "\r\n" . '        if (typeof result[2] != "undefined") {' . "\r\n" . '            var year = result[2];' . "\r\n" . '            if (year.length > 4) {' . "\r\n" . '                date = date.slice(0, -year.length);' . "\r\n" . '                year = year.slice(0, 4);' . "\r\n" . '                date = date + year;' . "\r\n" . '            }' . "\r\n" . '        }' . "\r\n" . '        return date;' . "\r\n" . '    }' . "\r\n" . '    function limpa_formulário_cep() {' . "\r\n" . '        //Limpa valores do formulário de cep.' . "\r\n" . '        document.getElementById(\'address\').value = ("");' . "\r\n" . '        document.getElementById(\'neighborhood\').value = ("");' . "\r\n" . '        document.getElementById(\'city\').value = ("");' . "\r\n" . '        document.getElementById(\'state\').value = ("");' . "\r\n" . '    }' . "\r\n\r\n" . '    function meu_callback(conteudo) {' . "\r\n" . '        if (!("erro" in conteudo)) {' . "\r\n" . '            //Atualiza os campos com os valores.' . "\r\n" . '            document.getElementById(\'address\').value = (conteudo.logradouro);' . "\r\n" . '            document.getElementById(\'neighborhood\').value = (conteudo.bairro);' . "\r\n" . '            document.getElementById(\'city\').value = (conteudo.localidade);' . "\r\n" . '            document.getElementById(\'state\').value = (conteudo.uf);' . "\r\n" . '        } //end if.' . "\r\n" . '        else {' . "\r\n" . '            //CEP não Encontrado.' . "\r\n" . '            limpa_formulário_cep();' . "\r\n" . '            alert("CEP não encontrado.");' . "\r\n" . '        }' . "\r\n" . '    }' . "\r\n\r\n" . '    function pesquisacep(valor) {' . "\r\n\r\n" . '        //Nova variável "cep" somente com dígitos.' . "\r\n" . '        var cep = valor.replace(/\\D/g, \'\');' . "\r\n\r\n" . '        //Verifica se campo cep possui valor informado.' . "\r\n" . '        if (cep != "") {' . "\r\n\r\n" . '            //Expressão regular para validar o CEP.' . "\r\n" . '            var validacep = /^[0-9]{8}$/;' . "\r\n\r\n" . '            //Valida o formato do CEP.' . "\r\n" . '            if (validacep.test(cep)) {' . "\r\n" . '                //Preenche os campos com "..." enquanto consulta webservice.' . "\r\n" . '                document.getElementById(\'address\').value = "...";' . "\r\n" . '                document.getElementById(\'neighborhood\').value = "...";' . "\r\n" . '                document.getElementById(\'city\').value = "...";' . "\r\n" . '                document.getElementById(\'state\').value = "...";' . "\r\n\r\n" . '                //Cria um elemento javascript.' . "\r\n" . '                var script = document.createElement(\'script\');' . "\r\n\r\n" . '                //Sincroniza com o callback.' . "\r\n" . '                script.src = \'https://viacep.com.br/ws/\' + cep + \'/json/?callback=meu_callback\';' . "\r\n\r\n" . '                //Insere script no documento e carrega o conteúdo.' . "\r\n" . '                document.body.appendChild(script);' . "\r\n\r\n" . '            } //end if.' . "\r\n" . '            else {' . "\r\n" . '                //cep é inválido.' . "\r\n" . '                limpa_formulário_cep();' . "\r\n" . '                alert("Formato de CEP inválido.");' . "\r\n" . '            }' . "\r\n" . '        } //end if.' . "\r\n" . '        else {' . "\r\n" . '            //cep sem valor, limpa formulário.' . "\r\n" . '            limpa_formulário_cep();' . "\r\n" . '        }' . "\r\n" . '    };' . "\r\n\r\n" . '    $(document).ready(function () {' . "\r\n" . '        $(\'#form-cadastrar\').submit(function (e) {' . "\r\n" . '            e.preventDefault()' . "\r\n" . '            var phoneValue = $(\'#phone\').val();' . "\r\n" . '            var phoneConfirmValue = $(\'#phone_confirm\').val();' . "\r\n" . '            if ($(\'#phone\')) {' . "\r\n" . '                if (phoneValue.length < 15 || phoneValue.length > 15) {' . "\r\n" . '                    alert(\'Telefone inválido. Por favor corrija.\');' . "\r\n" . '                    return;' . "\r\n" . '                }' . "\r\n" . '            }' . "\r\n" . '            if (phoneConfirmValue) {' . "\r\n" . '                if (phoneConfirmValue != phoneValue){' . "\r\n" . '                    alert(\'Telefone inválido. Por favor corrija\');' . "\r\n" . '                    return;' . "\r\n" . '                }' . "\r\n" . '            }' . "\r\n\r\n" . '            $.ajax({' . "\r\n" . '                url: _base_url_ + "class/Customer.php?action=registration",' . "\r\n" . '                method: \'POST\',' . "\r\n" . '                type: \'POST\',' . "\r\n" . '                data: new FormData($(this)[0]),' . "\r\n" . '                dataType: \'json\',' . "\r\n" . '                cache: false,' . "\r\n" . '                processData: false,' . "\r\n" . '                contentType: false,' . "\r\n" . '                error: err => {' . "\r\n" . '                    console.log(err)' . "\r\n" . '                    alert(\'An error occurred\')' . "\r\n\r\n" . '                },' . "\r\n" . '                success: function (resp) {' . "\r\n" . '                    if (resp.status == \'success\') {' . "\r\n" . '                        alert(\'Usuário cadastrado com sucesso.\');' . "\r\n" . '                        location.href = (resp.redirect);' . "\r\n" . '                    } else if (resp.status == \'phone_already\') {' . "\r\n" . '                        alert(\'Este telefone já está cadastrado.\');' . "\r\n" . '                    } else if (resp.status == \'cpf_already\') {' . "\r\n" . '                        alert(\'Este CPF já está cadastrado.\');' . "\r\n" . '                    } else if (resp.status == \'cpf_invalid\') {' . "\r\n" . '                        alert(resp.msg);' . "\r\n" . '                    } else if (resp.status == \'birth_invalid\') {' . "\r\n" . '                        alert(resp.msg);' . "\r\n" . '                    } else if (!!resp.msg) {' . "\r\n" . '                        el.html(resp.msg)' . "\r\n" . '                        el.show(\'slow\')' . "\r\n" . '                        _this.prepend(el)' . "\r\n\r\n" . '                    } else {' . "\r\n" . '                        alert(\'An error occurred\')' . "\r\n" . '                        console.log(resp)' . "\r\n" . '                    }' . "\r\n" . '                }' . "\r\n" . '            })' . "\r\n" . '        })' . "\r\n" . '    })' . "\r\n" . '</script>';


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

