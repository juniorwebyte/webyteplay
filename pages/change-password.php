<?php


require_once './settings.php';
echo '  ';

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

echo '<div class="container app-main app-form">' . "\r\n" . '   <form autocomplete="off" id="form-change-password">' . "\r\n" . '      <div class="alteracao-de-senha app-card card mb-2">' . "\r\n" . '         <div class="card-body">' . "\r\n" . '            <div class="mb-2">' . "\r\n" . '            <label for="senha" class="form-label">Senha</label>' . "\r\n" . '            <input type="password" name="password" class="form-control text-black" id="password" autocomplete="off" placeholder="Digite sua senha" required="" minlength="5" maxlength="20">' . "\r\n" . '            </div>' . "\r\n" . '            <div class="">' . "\r\n" . '            <label for="csenha" class="form-label">Confirmação de senha</label>' . "\r\n" . '            <input type="password" name="rpassword" class="form-control text-black" id="cpassword" placeholder="Confirme sua senha" required="" minlength="5" maxlength="20">' . "\r\n" . '         </div>' . "\r\n" . '         </div>' . "\r\n" . '      </div>' . "\r\n" . '      <button type="submit" class="btn btn-secondary btn-wide">Alterar</button>' . "\r\n" . '   </form>' . "\r\n" . '</div>' . "\r\n" . '<script>' . "\r\n" . '  $(document).ready(function(){' . "\r\n" . '    $(\'#form-change-password\').submit(function(e){' . "\r\n" . '        e.preventDefault()' . "\r\n" . '        var _this = $(this)' . "\r\n" . '        var el = $(\'<div>\')' . "\r\n" . '            el.addClass(\'alert alert-dark err_msg\')' . "\r\n" . '            el.hide()' . "\r\n" . '        $(\'.err_msg\').remove()' . "\r\n" . '              ' . "\r\n" . '        $.ajax({' . "\r\n" . '            url:_base_url_+"class/Customer.php?action=change_password_system",' . "\r\n" . '            method:\'POST\',' . "\r\n" . '            type:\'POST\',' . "\r\n" . '            data:new FormData($(this)[0]),' . "\r\n" . '            dataType:\'json\',' . "\r\n" . '            cache:false,' . "\r\n" . '            processData:false,' . "\r\n" . '            contentType: false,' . "\r\n" . '            error:err=>{' . "\r\n" . '                console.log(err)' . "\r\n" . '                alert(\'An error occurred\')' . "\r\n" . '                ' . "\r\n" . '            },' . "\r\n" . '            success:function(resp){' . "\r\n" . '                if(resp.status == \'success\'){' . "\r\n" . '                  alert(\'Senha alterada com sucesso.\');' . "\r\n" . '                  //location.href = (\'./\')' . "\r\n" . '                }else if(!!resp.msg){' . "\r\n" . '                    el.html(resp.msg)' . "\r\n" . '                    el.show(\'slow\')' . "\r\n" . '                    _this.prepend(el)' . "\r\n" . '                    ' . "\r\n" . '                }else{' . "\r\n" . '                    alert(\'An error occurred\')' . "\r\n" . '                    console.log(resp)' . "\r\n" . '                }' . "\r\n" . '            }' . "\r\n" . '        })' . "\r\n" . '    })' . "\r\n" . '  })' . "\r\n" . '</script>';

?>