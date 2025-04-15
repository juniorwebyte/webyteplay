<?php


echo '<div class="container app-main">' . "\r\n" . '   <div class="app-title mb-2">' . "\r\n" . '      <h1>🔐 Recuperação de senha</h1>' . "\r\n" . '   </div>' . "\r\n" . '   <div class="app-content app-form">' . "\r\n" . '      <form id="recover-password">' . "\r\n" . '         <div class="app-card card mb-2">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '               <p class="font-xs text-muted mb-1">Enviaremos um link para criação de uma nova senha.</p>' . "\r\n" . '               <div class="form-group">' . "\r\n" . '               <label for="email" class="form-label">E-mail</label>' . "\r\n" . '               <input type="email" name="email" class="form-control text-black" id="email" placeholder="Seu e-mail de cadastro" required="">' . "\r\n" . '            </div>' . "\r\n" . '            </div>' . "\r\n" . '         </div>' . "\r\n" . '         <button type="submit" class="btn btn-secondary btn-wide">Enviar</button>' . "\r\n" . '      </form>' . "\r\n" . '   </div>' . "\r\n" . '</div>' . "\r\n" . '<script>' . "\r\n" . '     $(document).ready(function(){' . "\r\n" . '        $(\'#recover-password\').submit(function(e){' . "\r\n" . '            e.preventDefault();' . "\r\n\r\n" . '           $.ajax({' . "\r\n" . '            url:_base_url_+"class/Main.php?action=recover_password",' . "\r\n" . '            method:\'POST\',' . "\r\n" . '            type:\'POST\',' . "\r\n" . '            data:new FormData($(this)[0]),' . "\r\n" . '            dataType:\'json\',' . "\r\n" . '            cache:false,' . "\r\n" . '            processData:false,' . "\r\n" . '            contentType: false,' . "\r\n" . '            error:err=>{' . "\r\n" . '                console.log(err)' . "\r\n" . '                alert(\'An error occurred\')' . "\r\n" . '                ' . "\r\n" . '            },' . "\r\n" . '            success:function(resp){' . "\r\n" . '                if(resp.status == \'success\'){' . "\r\n" . '                  alert(\'Um link para a criação de uma nova senha foi enviada para o seu e-mail. Por favor verifique a caixa de entrada ou de spam.\');' . "\r\n" . '                  location.href = (\'./\')                                    ' . "\r\n" . '              }else{' . "\r\n" . '                alert(\'Usuário não encontrado com o e-mail informado.\')' . "\r\n" . '                console.log(resp)' . "\r\n" . '            }' . "\r\n" . '        }' . "\r\n" . '    })' . "\r\n" . '       })' . "\r\n" . '    })  ' . "\r\n\r\n" . '</script>';

?>