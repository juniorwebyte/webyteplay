<?php


require_once '../settings.php';
$logo = validate_image($_settings->info('logo'));

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
	$link = 'https';
}
else {
	$link = 'http';
}

$link .= '://';
$link .= $_SERVER['HTTP_HOST'];
$link .= $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['userdata']) && !strpos($link, 'login.php')) {
	redirect('admin/login.php');
}
if (isset($_SESSION['userdata']) && strpos($link, 'login.php')) {
	redirect('admin/index.php');
}

$module = ['', 'admin', ''];


echo '<!DOCTYPE html>' . "\r\n" . '<html :class="{ \'theme-dark\': dark }" x-data="data()" lang="en">' . "\r\n" . '<head>' . "\r\n" . '  <meta charset="UTF-8" />' . "\r\n" . '  <meta name="viewport" content="width=device-width, initial-scale=1.0" />' . "\r\n" . '  <title>Painel Administrador</title>' . "\r\n" . '  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />' . "\r\n" . '  <link rel="stylesheet" href="';
echo BASE_URL;
echo 'admin/assets/css/tailwind.output.css" />' . "\r\n" . '  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer ></script>' . "\r\n" . '  <script src="';
echo BASE_URL;
echo 'includes/jquery/jquery.min.js"></script>' . "\r\n" . '  <script>' . "\r\n" . '    var _base_url_ = \'';
echo BASE_URL;
echo '\';' . "\r\n" . '  </script>' . "\r\n" . '</head>' . "\r\n" . '<body>' . "\r\n" . '  <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">' . "\r\n" . '    <div' . "\r\n" . '    class="flex-1 h-full max-w-2xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"' . "\r\n" . '     style="max-width:25rem;">' . "\r\n" . '    <div class="overflow-y-auto">' . "\r\n" . '      <div class="flex items-center justify-center p-6 md:grid-cols-2 xl:grid-cols-2">' . "\r\n" . '        <div class="w-full">';         

 ?>
<a class="flex-grow-1 text-center" style="display: flex;justify-content: center;" href="/">
                
                   <img src="<?php echo BASE_URL; ?>uploads/re9.png" width="150px" class="header-app-brand" style="object-fit: contain;">
               
                </a>
<?php echo '<h1' . "\r\n" . '          class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200" style="text-align:center;"' . "\r\n" . '          >' . "\r\n" . '          Painel Administrador' . "\r\n" . '        </h1>'; echo ' <form id="login-frm" action="" method="post">' . "\r\n" . '          <label class="block text-sm">' . "\r\n" . '            <span class="text-gray-700 dark:text-gray-400">Usuário</span>' . "\r\n" . '            <input type="text" name="username" autofocus' . "\r\n" . '            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n" . '            placeholder="Informe o usuário"' . "\r\n" . '            />' . "\r\n" . '          </label>' . "\r\n" . '          <label class="block mt-4 text-sm">' . "\r\n" . '            <span class="text-gray-700 dark:text-gray-400">Senha</span>' . "\r\n" . '            <input name="password"' . "\r\n" . '            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"' . "\r\n" . '            placeholder="***************" type="password"/>' . "\r\n" . '          </label>' . "\r\n\r\n" . '          <button type="submit"' . "\r\n" . '          class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-dark transition-colors duration-150 bg-warning-600 border border-transparent rounded-lg active:bg-warning-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"' . "\r\n\r\n" . '          >' . "\r\n" . '          Entrar' . "\r\n" . '        </button>' . "\r\n" . '      </form>' . "\r\n\r\n" . '      <p class="mt-4">' . "\r\n" . '        <a' . "\r\n" . '        class="text-sm font-medium text-dark-600 dark:text-purple-400 hover:underline"' . "\r\n" . '        href="recover.php"' . "\r\n" . '        >' . "\r\n" . '        Recuperar senha?' . "\r\n" . '      </a>' . "\r\n" . '    </p>' . "\r\n\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n" . '<script>' . "\r\n" . '  $(document).ready(function(){' . "\r\n" . '    $(\'#login-frm\').submit(function(e){' . "\r\n" . '        e.preventDefault()' . "\r\n" . '        var _this = $(this)' . "\r\n" . '        var el = $(\'<div>\')' . "\r\n" . '            el.addClass(\'alert alert-dark err_msg\')' . "\r\n" . '            el.hide()' . "\r\n" . '        $(\'.err_msg\').remove()' . "\r\n" . ' ' . "\r\n" . '        $.ajax({' . "\r\n" . '            url:_base_url_+"class/Auth.php?action=login",' . "\r\n" . '            method:\'POST\',' . "\r\n" . '            type:\'POST\',' . "\r\n" . '            data:new FormData($(this)[0]),' . "\r\n" . '            dataType:\'json\',' . "\r\n" . '            cache:false,' . "\r\n" . '            processData:false,' . "\r\n" . '            contentType: false,' . "\r\n" . '            error:err=>{' . "\r\n" . '                //console.log(err)' . "\r\n" . '                alert(\'An error occurred\')' . "\r\n" . '            },' . "\r\n" . '            success:function(resp){' . "\r\n" . '                if(resp.status == \'success\'){' . "\r\n" . '                    location.href = (\'./\')' . "\r\n" . '                }else if(!!resp.msg){' . "\r\n" . '                    el.html(resp.msg)' . "\r\n" . '                    el.show(\'slow\')' . "\r\n" . '                    _this.prepend(el)' . "\r\n" . '                    $(\'html, body\').scrollTop(0)' . "\r\n" . '                }else{' . "\r\n" . '                    alert(\'An error occurred\')' . "\r\n" . '                    //console.log(resp)' . "\r\n" . '                }' . "\r\n" . '            }' . "\r\n" . '        })' . "\r\n" . '    })' . "\r\n" . '  })' . "\r\n" . '</script>';

?>