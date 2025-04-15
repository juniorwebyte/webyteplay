<?php
$enable_footer = $_settings->info('enable_footer');
$enable_password = $_settings->info('enable_password');
$enable_email = $_settings->info('enable_email');
$enable_cpf = $_settings->info('enable_cpf');
$text_footer = $_settings->info('text_footer');
$whatsapp_footer = $_settings->info('whatsapp_footer');
$instagram_footer = $_settings->info('instagram_footer');
$facebook_footer = $_settings->info('facebook_footer');
$twitter_footer = $_settings->info('twitter_footer');
$youtube_footer = $_settings->info('youtube_footer');

?>
<?php if($enable_footer == '1'){ ?>
   <style>
 .container-fluid.rodape {background: #000;text-align: center;color: #6e6e6e;}.container-fluid.rodape .col-md-12.col-12.font-xs a{color:#eee;font-weight: bold;}.app-title-footer {font-weight: 100;font-size: 18px;}li.spacing-icon {padding: 10px;}li.spacing-icon a{color:#888;}ul.social a.whatsapp1:hover {color: #00e676;}ul.social a.instagram1:hover {color: #bc3090;}ul.social a.facebook1:hover {color: #3c5a99;}ul.social a.twitter1:hover {color: #00acee;}ul.social a.youtube1:hover {color: #e22c29;}.text-center.links-rodape a {color: #eee;}
</style>
<div class="container-fluid rodape">
    
 <div class="row justify-content-center align-items-center" style="padding:15px">
  <div class="col-md-12 col-12">
      <h4 class="app-title-footer">Estamos nas redes sociais</h4>
    <?php if($whatsapp_footer || $instagram_footer || $facebook_footer || $twitter_footer || $youtube_footer){ ?>
   <?php } ?>
   <ul class="list-unstyled d-flex flex-wrap justify-content-center social">
    <?php if($whatsapp_footer){ ?>
     <li class="spacing-icon">
      <a class="whatsapp1" target="_blank" href="<?= $whatsapp_footer; ?>" title="WhatsApp">
       <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
    </svg>
</a>
</li>
<?php } ?>

<?php if($instagram_footer){ ?>
<li class="spacing-icon">
  <a class="instagram1" target="_blank" href="<?= $instagram_footer; ?>" title="Instagram">
   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
</svg>
</a>
</li>
<?php } ?>
<?php if($facebook_footer){ ?>
<li class="spacing-icon">
  <a class="facebook1" target="_blank" href="<?= $facebook_footer; ?>" title="Facebook">
   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
</svg>
</a>
</li>
<?php } ?>
<?php if($twitter_footer){ ?>
<li class="spacing-icon">
  <a class="twitter1" target="_blank" href="<?= $twitter_footer; ?>" title="Twitter">
   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
</svg>
</a>
</li>
<?php } ?>

<?php if($youtube_footer){ ?>
<li class="spacing-icon">
  <a class="youtube1" target="_blank" href="<?= $youtube_footer; ?>" title="Youtube">
   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-play-btn-fill" viewBox="0 0 16 16">
    <path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"></path>
</svg>
</a>
</li>
<?php } ?>
</ul>
</div>

<div class="text-center links-rodape">
    <a href="/" class="px-2">Início</a>
    <a href="/campanhas" class="px-2">Campanhas</a>
</div>

<?php if($enable_footer){ ?>
  <div class="col-md-12 col-12 font-xs">
   <hr>     
   © Copyright <?= date('Y'); ?> - <?= $_settings->info('name'); ?>. Todos os direitos reservados.<br>

   Desenvolvido Com 
   
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16" style="color: #df0e22">
   <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>
  </svg>
  
  Por <a href="https://wa.me/5511/" target="_blank" class="font-weight-600 font-xs badge" rel="noreferrer" style="background-color:#ff7e01;">eu</a>
</p>
</div>
<?php } ?>
</div>
</div>
<?php } ?>

<?php if(!$user_id){ ?>
    <form class="modal fade" id="loginModal">
        <div class="modal-dialog modal-sm modal-fullscreen-md-down modal-dialog-centered">
           <div class="modal-content rounded-0">
              <div class="modal-header">
                 <h5 class="modal-title">Login</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body app-form">
                 <p class="text-muted font-xs">Por favor, entre com seus dados ou faça um cadastro.</p>
                 <span id="aviso-login"></span>
                 <div class="mb-2">
                    <div class="form-floating font-weight-500">
                        <input onkeyup="leowpMask(this);" maxlength="15" name="phone" id="phone" required="" class="form-control" placeholder="(00) 0000-0000" value="">
                        <label for="username">Telefone</label>
                    </div>
                </div>
                <?php if($enable_password == '1'){ ?>
                    <div class="mb-2">
                        <div class="form-floating font-weight-500">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required=""><label for="password">Senha</label></div>
                        </div>
                        <div class="btn btn-link btn-sm text-decoration-none mb-4 text-cardLink opacity-75"><a href="/recuperar-senha">Esqueci minha senha</a></div>
                    <?php } ?>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <button type="submit" class="btn btn-wide-in btn-primary font-weight-500 rounded-pill mb-2">Continuar</button>
                        <div class="btn btn-link btn-sm text-decoration-none"><a data-bs-toggle="modal" data-bs-target="#cadastroModal">Criar conta</a></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php if(isset($slug)){ ?>
        <span id="openCadastro" data-bs-toggle="modal" data-bs-target="#cadastroModal" style="display:none;"></span>
        <form class="modal fade" id="cadastroModal">
            <div class="modal-dialog modal-sm modal-fullscreen-md-down modal-dialog-centered">
               <div class="modal-content rounded-0">
                  <div class="modal-header">
                     <h5 class="modal-title">Cadastro</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body app-form">
                     <p class="text-muted font-xs">Por favor, entre com seus dados para finalizar o cadastro.</p>
                     <span id="aviso-login"></span>
                     <div class="mb-2">
                        <label for="firstname" class="form-label">Nome</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Nome" required="">
                    </div>
                    <div class="mb-2">
                        <label for="lastname" class="form-label">Sobrenome</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Sobrenome" required="">
                    </div>
                    <?php if($enable_cpf == 1){ ?>
                        <div class="mb-2">
                            <label for="cpf" class="form-label">CPF</label>
                            <input name="cpf" class="form-control" id="cpf" required="" value="" oninput="mascara(this)" onblur="valida_cpf(this)">
                        </div>
                    <?php } ?>

                    <div class="mb-2">
                        <label for="phone" class="form-label">Telefone</label>
                        <input onkeyup="leowpMask(this);" maxlength="15" name="phone" id="phone" required="" class="phone form-control" placeholder="(00) 0000-0000" value="">

                    </div>
                    <?php if($enable_email == 1){ ?>
                        <div class="mb-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="exemplo@exemplo.com " required>
                        </div> 
                    <?php } ?>

                    <?php if($enable_password == '1'){ ?>
                        <div class="mb-2">
                            <div class="form-floating font-weight-500">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required=""><label for="password">Senha</label></div>
                            </div>
                            <div class="btn btn-link btn-sm text-decoration-none mb-4 text-cardLink opacity-75"><a href="/recuperar-senha">Esqueci minha senha</a></div>
                        <?php } ?>
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <button type="submit" class="btn btn-wide-in btn-primary font-weight-500 rounded-pill mb-2">Continuar</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>

          function mascara(i){
           var v = i.value;
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
  }

  i.setAttribute("maxlength", "14");
  if (v.length == 3 || v.length == 7) i.value += ".";
  if (v.length == 11) i.value += "-";

}
function valida_cpf(cpf) {
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
        if (!digitos_iguais) {
            numeros = cpf.substring(0, 9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
            numeros = cpf.substring(0, 10);
            soma = 0;
            for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
            return true;
        }
        else
            return false;
    }
    $(document).ready(function(){
        $('#form-cadastrar, #cadastroModal').submit(function(e){
            e.preventDefault();
            var phoneValue = $('.phone').val();
            if($('.phone')){
                if (phoneValue.length < 15 || phoneValue.length > 15) {
                 alert('Telefone inválido. Por favor corrija.');
                 return;
             }
         }
         var cpfValue = $('#cpf').val();          
         if($('#cpf').length > 0){
            cpfValue = cpfValue.replace(/[\s.-]*/igm, '');
            if (!valida_cpf(cpfValue)) {
             alert('CPF inválido. Por favor corrija.');
             return;
         }
     }

     $.ajax({
        url:_base_url_+"classes/Users.php?f=registration",
        method:'POST',
        type:'POST',
        data:new FormData($(this)[0]),
        dataType:'json',
        cache:false,
        processData:false,
        contentType: false,
        error:err=>{
            console.log(err)
            alert('An error occurred')

        },
        success:function(resp){
            if(resp.status == 'success'){
              alert('Cadastrado com sucessso.');
              $('.btn-close').click();
              $('#overlay').fadeIn(300);                  
              setTimeout(function() {
                 $('#add_to_cart').click();
             }, 1000);
              setTimeout(function() {
                $('#place_order').click();
                $("#overlay").fadeOut(300);
            }, 2000);

          }else{
            alert('An error occurred')
            console.log(resp)
        }
    }
})
 })
    })
</script>
<?php } ?>
<script>

  $(document).ready(function(){
    //end_loader();
    $('#loginModal').submit(function(e){
        e.preventDefault()

        $.ajax({
            url:_base_url_+"classes/Login.php?f=login_customer",
            method:'POST',
            type:'POST',
            data:new FormData($(this)[0]),
            dataType:'json',
            cache:false,
            processData:false,
            contentType: false,
            error:err=>{
                console.log(err)
                alert('An error occurred')
                //end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                   alert('Login efetuado com sucesso!');
                   <?php if(isset($slug)){ ?>
                    $('.btn-close').click();
                    $('#overlay').fadeIn(300);
                    setTimeout(function() {
                     $('#add_to_cart').click();
                 }, 1000);
                    setTimeout(function() {
                        $('#place_order').click();
                        $("#overlay").fadeOut(300);
                    }, 2000);
                <?php }else{ ?>
                   location.reload();
               <?php } ?>
           }else if(!!resp.msg){
            <?php if(!isset($slug)){ ?>
            var phone = $('#loginModal #phone').val();
           // $('#cadastroModal #phone').val(phone);
           // $('#openCadastro').click();

            $('#aviso-login').html('<div style="color:red;font-size:14px;margin-bottom:10px;">Telefone ou senha incorretos!</div>');  
           <?php }else{ ?> 
            var phone = $('#loginModal #phone').val();
            $('#cadastroModal #phone').val(phone);
            $('#openCadastro').click();
                //$('#aviso-login').html('<div style="color:red;font-size:14px;margin-bottom:10px;">Telefone não cadastrado ou incorreto!</div>');  
        <?php } ?>
    }else{
        alert('An error occurred')
        console.log(resp)
    }
                //end_loader()
}
})
    })
})
</script>

<?php } ?>
<script>
   function leowpMask(e){v=e.value,console.log("v:"+v),console.log("v.length:"+v.length),v=v.replace(/\D/g,""),v=v.replace(/^(\d{2})(\d)/g,"($1) $2"),console.log("v:"+v),v=v.replace(/(\d)(\d{4})$/,"$1-$2"),e.value=v}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" data-nscript="afterInteractive"></script>

</body>
</html>