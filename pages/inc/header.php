<?php


$user_id = $_settings->userdata('id');
$user_type = $_settings->userdata('type');
$logo = validate_image($_settings->info('logo'));
$favicon = validate_image($_settings->info('favicon'));
$enable_password = $_settings->info('enable_password');
$enable_pixel = $_settings->info('enable_pixel');
$enable_ga4 = $_settings->info('enable_ga4');
$google_ga4_id = $_settings->info('google_ga4_id');
$enable_gtm = $_settings->info('enable_gtm');
$google_gtm_id = $_settings->info('google_gtm_id');
$facebook_access_token = $_settings->info('facebook_access_token');
$facebook_pixel_id = $_settings->info('facebook_pixel_id');
$affiliate = $_settings->userdata('is_affiliate');
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parts = parse_url($url);
$path_name = $parts['path'];
$path = explode('/', $path_name);
$page = $path[1];

if (isset($parts['query'])) {
    parse_str($parts['query'], $query);
    $ref = $query['ref'];

    if (isset($ref)) {
        $_SESSION['ref'] = $ref;
    }
}
?>
<html translate="no">
<html lang="pt-br">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
   <?php echo exibir_cabecalho($conn); ?>

   <?php if ($favicon): ?>
      <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo validate_image($_settings->info('favicon')); ?>">
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo validate_image($_settings->info('favicon')); ?>">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo validate_image($_settings->info('favicon')); ?>">
   <?php endif; ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <meta name="theme-color" content="#000000">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
   <script src="<?php echo BASE_URL; ?>includes/jquery/jquery.min.js"></script>
   <script> var _base_url_ = '<?php echo BASE_URL; ?>'; </script>

   <?php if (($enable_pixel == 1) && !empty($facebook_pixel_id)): ?>
      <script>
         !function(f, b, e, v, n, t, s) {
            if (f.fbq) return; 
            n = f.fbq = function() {
               n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; 
            n.push = n; 
            n.loaded = !0; 
            n.version = '2.0';
            n.queue = []; 
            t = b.createElement(e); 
            t.async = !0;
            t.src = v; 
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
         }(window, document, 'script','https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '<?php echo $facebook_pixel_id; ?>');
         fbq('track', 'PageView');
      </script>
      <noscript>
         <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $facebook_pixel_id; ?>&ev=PageView&noscript=1" />
      </noscript>
   <?php endif; ?>

   <?php if (($enable_ga4 == 1) && !empty($google_ga4_id)): ?>
      <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_ga4_id; ?>"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', '<?php echo $google_ga4_id; ?>');
      </script>
   <?php endif; ?>

   <?php if (($enable_gtm == 1) && !empty($google_gtm_id)): ?>
      <!-- Google Tag Manager -->
      <script>
         (function(w,d,s,l,i){
            w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','<?php echo $google_gtm_id; ?>');
      </script>
      <!-- End Google Tag Manager -->
   <?php endif; ?>
</head>
<body>
<?php if (($enable_gtm == 1) && !empty($google_gtm_id)): ?>
   <!-- Google Tag Manager (noscript) -->
   <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $google_gtm_id; ?>"
      height="0" width="0" style="display:none;visibility:hidden"></iframe>
   </noscript>
   <!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<div id="__next">
   <header class="header-app-header <?php echo $page; ?>">
      <div class="header-app-header-container">
         <div class="container container-600 font-mdd">
            <div style="text-align-last: justify; padding: 20 0 20 0;">
               
               
                <button type="button" aria-label="Menu" class="btn btn-link text-white font-lgg ps-0" data-bs-toggle="modal" data-bs-target="#mobileMenu" style="margin-top:5px">
                    <i class="bi bi-filter-left"></i>
                </button>
                <a class="flex-grow-1 text-center" href="/">
                <?php if ($logo): ?>
                   <img src="<?php echo $logo; ?>" class="header-app-brand">
                <?php else: ?>
                   <img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="header-app-brand">
                <?php endif; ?>
                </a>
                 <?php if (CONTACT_TYPE == '1'): ?>
                    <a class="btn btn-link text-white pe-0 text-right text-decoration-none" href="/contato">
                <?php else: ?>
                    <a class="btn btn-link text-white pe-0 text-right text-decoration-none" href="https://api.whatsapp.com/send/?phone=55<?php echo $_settings->info('phone'); ?>">
                <?php endif; ?>
                   <div class="duvida d-flex justify-content-end opacity-50"><i class="bi bi-chat-dots-fill"></i></div>
                   <div class="duvida text-yellow font-xss">Suporte!</div>
                </a> 
            </div>
         </div>
      </div>
   </header>
   <div class="black-bar <?php echo $page; ?> fuse"></div>
   <menu id="mobileMenu" class="modal fade modal-fluid" tabindex="-1" aria-labelledby="mobileMenuLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
         <div class="modal-content bg-cor-primaria">
            <header class="app-header app-header-mobile--show">
               <div class="container container-600 h-100 d-flex align-items-center justify-content-between">
                  <?php if ($logo): ?>
                     <a href="/"><img src="<?php echo $logo; ?>" class="app-brand img-fluid"></a>
                  <?php else: ?>
                     <a href="/"><img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="app-brand img-fluid"></a>
                  <?php endif; ?>
                  <div class="app-header-mobile">
                     <button type="button" class="btn btn-link text-white menu-mobile--button pe-0 font-lgg" data-bs-dismiss="modal" aria-label="Fechar">
                        <i class="bi bi-x-circle"></i>
                     </button>
                  </div>
               </div>
            </header>
            <div class="modal-body">
               <div class="container container-600">
                  <?php if ($user_id): ?>
                     <div class="card-usuario mb-2">
                        <picture>
                           <img src="<?php echo ($_settings->userdata('avatar') ? validate_image($_settings->userdata('avatar')) : BASE_URL . 'assets/img/avatar.png'); ?>" class="img-fluid img-perfil">
                        </picture>
                        <div class="card-usuario--informacoes">
                           <h3>Olá, <?php echo ucwords($_settings->userdata('firstname')) . ' ' . ucwords($_settings->userdata('lastname')); ?></h3>
                           <div class="email font-xss saldo-value"></div>
                        </div>
                        <div class="card-usuario--sair">
                           <a href="<?php echo BASE_URL . 'logout?' . $_SERVER['REQUEST_URI']; ?>">
                              <button type="button" class="btn btn-link text-center text-white-50 ps-1 pe-0 pt-0 pb-0 font-lg">
                                 <i class="bi bi-box-arrow-left"></i>
                              </button>
                           </a>
                        </div>
                     </div>
                  <?php endif; ?>

                  <nav class="nav-vertical nav-submenu font-xs mb-2">
                     <ul>
                        <li><a class="text-white" alt="Página Principal" href="/"><i class="icone bi bi-house"></i><span>Início</span></a></li>
                        <li><a class="text-white" alt="Campanhas" href="/campanhas"><i class="icone bi bi-megaphone"></i><span>Campanhas</span></a></li>
                        <li><a class="text-white" alt="Meus Números" href="/meus-numeros"><i class="icone bi bi-card-list"></i><span>Meus números Novo</span></a></li>
                        
                        <?php if ($user_id): ?>
                           <!-- <li><a alt="Atualizar cadastro" class="text-white" href="/perfil"><i class="icone bi bi-person"></i><span>Perfil</span></a></li> -->
                        <?php else: ?>
                           <li><a alt="Cadastrar" class="text-white" href="/cadastrar"><i class="icone bi bi-person-plus"></i><span>Cadastrar</span></a></li>
                           <!-- <li><a alt="Entrar" class="text-white" href="/login"><i class="icone bi bi-person-circle"></i><span>Entrar</span></a></li> -->
                        <?php endif; ?>
                        
                        <li><a href="<?php echo BASE_URL; ?>contato" class="text-white"><i class="icone bi bi-chat-dots-fill"></i><span>Fale Conosco</span></a></li>
                        <li><a href="<?php echo BASE_URL . 'logout?' . $_SERVER['REQUEST_URI']; ?>" class="text-white"><i class="icone bi bi-box-arrow-right"></i><span>Sair</span></a></li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </menu>