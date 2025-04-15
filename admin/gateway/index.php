<?php
$mercadopago = $_settings->info('mercadopago');
$mercadopago_access_token = $_settings->info('mercadopago_access_token');
$gerencianet = $_settings->info('gerencianet');
$gerencianet_client_id = $_settings->info('gerencianet_client_id');
$gerencianet_client_secret = $_settings->info('gerencianet_client_secret');
$gerencianet_pix_key = $_settings->info('gerencianet_pix_key');
$paggue = $_settings->info('paggue');
$paggue_client_key = $_settings->info('paggue_client_key');
$paggue_client_secret = $_settings->info('paggue_client_secret');
$pagstar = $_settings->info('pagstar');
$pagstar_client_key = $_settings->info('pagstar_client_key');
$pagstar_client_secret = $_settings->info('pagstar_client_secret');
$openpix = $_settings->info('openpix');
$openpix_app_id = $_settings->info('openpix_app_id');
$openpix_tax = $_settings->info('openpix_tax');
$pay2m = $_settings->info('pay2m');
$pay2m_client_id = $_settings->info('pay2m_client_id');
$pay2m_client_secret = $_settings->info('pay2m_client_secret');
$pay2m_tax = $_settings->info('pay2m_tax');
$ezzepay = $_settings->info('ezzepay');
$ezzepay_client_id = $_settings->info('ezzepay_client_id');
$ezzepay_client_secret = $_settings->info('ezzepay_client_secret');
$nextpay = $_settings->info('nextpay');
$nextpay_client_id = $_settings->info('nextpay_client_id');
$nextpay_client_secret = $_settings->info('nextpay_client_secret');
$openpix_webhook_url = $_settings->info('openpix_webhook_url') ? $_settings->info('openpix_webhook_url') : base_url . 'webhook.php?notify=openpix';

?>
<style>
    .active-tab {
        border-bottom: none !important;
    }

    .can-toggle {
        position: relative;
        margin-bottom: 20px;
    }

    .can-toggle *,
    .can-toggle *:before,
    .can-toggle *:after {
        box-sizing: border-box;
    }

    .can-toggle input[type=checkbox] {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
    }

    .can-toggle input[type=checkbox]:checked~label .can-toggle__switch:before {
        content: attr(data-unchecked);
        left: 0;
    }

    .can-toggle input[type=checkbox]:checked~label .can-toggle__switch:after {
        content: attr(data-checked);
    }

    .can-toggle label {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        position: relative;
        display: flex;
        align-items: center;
    }

    .can-toggle label .can-toggle__switch {
        position: relative;
    }

    .can-toggle label .can-toggle__switch:before {
        content: attr(data-checked);
        position: absolute;
        top: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .can-toggle label .can-toggle__switch:after {
        content: attr(data-unchecked);
        position: absolute;
        z-index: 5;
        text-transform: uppercase;
        text-align: center;
        background: white;
        transform: translate3d(0, 0, 0);
    }

    .can-toggle input[type=checkbox]:focus~label .can-toggle__switch,
    .can-toggle input[type=checkbox]:hover~label .can-toggle__switch {
        background-color: #777;
    }

    .can-toggle input[type=checkbox]:focus~label .can-toggle__switch:after,
    .can-toggle input[type=checkbox]:hover~label .can-toggle__switch:after {
        color: #5e5e5e;
    }

    .can-toggle input[type=checkbox]:hover~label {
        color: #6a6a6a;
    }

    .can-toggle input[type=checkbox]:checked~label:hover {
        color: #55bc49;
    }

    .can-toggle input[type=checkbox]:checked~label .can-toggle__switch {
        background-color: #70c767;
    }

    .can-toggle input[type=checkbox]:checked~label .can-toggle__switch:after {
        color: #4fb743;
    }

    .can-toggle input[type=checkbox]:checked:focus~label .can-toggle__switch,
    .can-toggle input[type=checkbox]:checked:hover~label .can-toggle__switch {
        background-color: #5fc054;
    }

    .can-toggle input[type=checkbox]:checked:focus~label .can-toggle__switch:after,
    .can-toggle input[type=checkbox]:checked:hover~label .can-toggle__switch:after {
        color: #47a43d;
    }

    .can-toggle label .can-toggle__switch {
        transition: background-color 0.3s cubic-bezier(0, 1, 0.5, 1);
        background: #848484;
    }

    .can-toggle label .can-toggle__switch:before {
        color: rgba(255, 255, 255, 0.5);
    }

    .can-toggle label .can-toggle__switch:after {
        transition: transform 0.3s cubic-bezier(0, 1, 0.5, 1);
        color: #777;
    }

    .can-toggle input[type=checkbox]:focus~label .can-toggle__switch:after,
    .can-toggle input[type=checkbox]:hover~label .can-toggle__switch:after {
        box-shadow: 0 3px 3px rgba(0, 0, 0, 0.4);
    }

    .can-toggle input[type=checkbox]:checked~label .can-toggle__switch:after {
        transform: translate3d(65px, 0, 0);
    }

    .can-toggle input[type=checkbox]:checked:focus~label .can-toggle__switch:after,
    .can-toggle input[type=checkbox]:checked:hover~label .can-toggle__switch:after {
        box-shadow: 0 3px 3px rgba(0, 0, 0, 0.4);
    }

    .can-toggle label {
        font-size: 14px;
    }

    .can-toggle label .can-toggle__switch {
        height: 36px;
        flex: 0 0 134px;
        border-radius: 4px;
    }

    .can-toggle label .can-toggle__switch:before {
        left: 67px;
        font-size: 12px;
        line-height: 36px;
        width: 67px;
        padding: 0 12px;
    }

    .can-toggle label .can-toggle__switch:after {
        top: 2px;
        left: 2px;
        border-radius: 2px;
        width: 65px;
        line-height: 32px;
        font-size: 12px;
    }

    .can-toggle label .can-toggle__switch:hover:after {
        box-shadow: 0 3px 3px rgba(0, 0, 0, 0.4);
    }

    @media all and (max-width: 40em) {
        #tabs {
            flex-wrap: wrap;
        }

        #tabs .mr-1 {
            margin-bottom: 15px;
        }
    }
</style>
<main class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Gateway de pagamento</h2>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex">
            <ul class="flex" id="tabs">
                <!-- <li class="mr-1">
                    <a href="#tab1"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700 active-tab">MercadoPago</a>
                </li>
                <li class="mr-1">
                    <a href="#tab2"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">Gerencianet</a>
                </li> -->
                <li class="mr-1">
                    <a href="#tab3"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700 active-tab">Paggue</a>
                </li>
				
                <li class="mr-1">
                    <a href="#tab4"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">PagStar</a>
                </li>
				<li class="mr-1">
                    <a href="#tab5"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">Open Pix</a>
                </li>
                <li class="mr-1">
                    <a href="#tab6"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">Pay2m</a>
                </li>
                <li class="mr-1">
                    <a href="#tab7"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">EzzePay</a>
                </li>
                <li class="mr-1">
                    <a href="#tab8"
                        class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 inline-block py-2 px-4 font-semibold border rounded-t text-gray-700">NextPay</a>
                </li>
            </ul>
        </div>

        <form action="" id="gateway-form">
            <div class="mt-4">
                <!-- <div id="tab1" class="tabcontent text-gray-700 dark:text-gray-400">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Habilitar MercadoPago?</span>
                    </label>
                    <div class="can-toggle">
                        <input type="checkbox" name="mercadopago" id="mercadopago"
                            <?= isset($mercadopago) && $mercadopago == 1 ? 'checked' : '' ?>>
                        <label for="mercadopago">
                            <div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
                        </label>
                    </div>
                    <div class="mercadopago" style="display: none;">
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Access Token:</strong></span>
                            <input name="mercadopago_access_token" id="mercadopago_access_token"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $mercadopago_access_token ?>" />
                        </label>
                    </div>
                </div>

                <div id="tab2" class="tabcontent hidden text-gray-700 dark:text-gray-400">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Habilitar Gerencianet?</span>
                    </label>
                    <div class="can-toggle">
                        <input type="checkbox" name="gerencianet" id="gerencianet"
                            <?= isset($gerencianet) && $gerencianet == 1 ? 'checked' : '' ?>>
                        <label for="gerencianet">
                            <div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
                        </label>
                    </div>
                    <div class="gerencianet" style="display: none;">
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client ID:</strong></span>
                            <input name="gerencianet_client_id" id="gerencianet_client_id"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $gerencianet_client_id ?>" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
                            <input name="gerencianet_client_secret" id="gerencianet_client_secret"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $gerencianet_client_secret ?>" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Chave PIX:</strong></span>
                            <input name="gerencianet_pix_key" id="gerencianet_pix_key"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $gerencianet_pix_key ?>" />
                        </label>
                    </div>
                </div> -->

                <div id="tab3" class="tabcontent text-gray-700 dark:text-gray-400">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Habilitar Paggue?</span>
                    </label>
                    <div class="can-toggle">
                        <input type="checkbox" name="paggue" id="paggue"
                            <?= isset($paggue) && $paggue == 1 ? 'checked' : '' ?>>
                        <label for="paggue">
                            <div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
                        </label>
                    </div>

                    <div class="paggue" >
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client Key:</strong></span>
                            <input name="paggue_client_key" id="paggue_client_key"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $paggue_client_key ?>" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
                            <input name="paggue_client_secret" id="paggue_client_secret"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $paggue_client_secret ?>" />
                        </label>
                    </div>
                </div>

                <div id="tab4" class="tabcontent hidden text-gray-700 dark:text-gray-400">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Habilitar Pagstar?</span>
                    </label>
                    <div class="can-toggle">
                        <input type="checkbox" name="pagstar2" id="pagstar2"
                            <?= isset($pagstar) && $pagstar == 1 ? 'checked' : '' ?>>
                        <label for="pagstar2">
                            <div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
                        </label>
                    </div>
                    <input type="hidden" name="pagstar" id="pagstar" val=''>
                    <div class="pagstar">
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client Key:</strong></span>
                            <input name="pagstar_client_key" id="pagstar_client_key"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $pagstar_client_key ?>" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
                            <input name="pagstar_client_secret" id="pagstar_client_secret"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="<?= $pagstar_client_secret ?>" />
                        </label>
                    </div>
                </div>
				<div id="tab5" class="tabcontent hidden text-gray-700 dark:text-gray-400">

					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Habilitar OpenPix?</span>	
					</label>
					<div class="can-toggle">
						<input type="checkbox" name="openpix" id="openpix"  <?= isset($openpix) && $openpix == 1 ? 'checked' : '' ?>>
						<label for="openpix">
							<div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
						</label>
					</div>
					<div class="openpix" >
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>App ID:</strong></span>
							<input name="openpix_app_id" id="openpix_app_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Informe o App ID do OpenPix" value="<?=$openpix_app_id ?>">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Taxa (%):</strong>
							<p>Taxa adicional que será cobrada para o cliente no ato do pagamento.</p>
							</span>
							<input name="openpix_tax" id="openpix_tax" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="0" type="number" value="<?=$openpix_tax ?>">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Webhook URL:</strong><p>Adicone a url abaixo na área "Webhook" no OpenPix!</p></span>
							<input name="openpix_webhook_url" id="openpix_webhook_url" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?=$openpix_webhook_url ?>">
						</label>
					</div>

				</div>
				<div id="tab6" class="tabcontent hidden text-gray-700 dark:text-gray-400">

					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Habilitar Pay2m?</span>	
					</label>
					<div class="can-toggle">
						<input type="checkbox" name="pay2m" id="pay2m"
							<?= isset($pay2m) && $pay2m == 1 ? 'checked' : '' ?>>
						<label for="pay2m">
							<div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
						</label>
					</div>
					<div class="pay2m">
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client ID:</strong></span>
							<input name="pay2m_client_id" id="pay2m_client_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="ex: APP_USR-3168251416537780-022013-002dd7b5414e26092866660fb80a874a-190911003" value="<?=$pay2m_client_id ?>">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
							<input name="pay2m_client_secret" id="pay2m_client_secret" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="ex: APP_USR-3168251416537780-022013-002dd7b5414e26092866660fb80a874a-190911003" value="<?=$pay2m_client_secret ?> ">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Taxa (%):</strong>
							<p>Taxa adicional que será cobrada para o cliente no ato do pagamento.</p>
							</span>
							<input name="pay2m_tax" id="pay2m_tax" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="0" type="number" value="<?=$pay2m_tax ?>">
						</label>
					</div>
				</div>
				<div id="tab7" class="tabcontent hidden text-gray-700 dark:text-gray-400">

					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Habilitar EzzePay?</span>	
					</label>
					<div class="can-toggle">
						<input type="checkbox" name="ezzepay" id="ezzepay"
							<?= isset($ezzepay) && $ezzepay == 1 ? 'checked' : '' ?>>
						<label for="ezzepay">
							<div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
						</label>
					</div>
					<div class="ezzepay">
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client ID:</strong></span>
							<input name="ezzepay_client_id" id="ezzepay_client_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?=$ezzepay_client_id ?>">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
							<input name="ezzepay_client_secret" id="ezzepay_client_secret" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?=$ezzepay_client_secret ?> ">
						</label>
					</div>
				</div>
				<div id="tab8" class="tabcontent hidden text-gray-700 dark:text-gray-400">

					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Habilitar NextPay?</span>	
					</label>
					<div class="can-toggle">
						<input type="checkbox" name="nextpay" id="nextpay"
							<?= isset($nextpay) && $nextpay == 1 ? 'checked' : '' ?>>
						<label for="nextpay">
							<div class="can-toggle__switch" data-checked="Sim" data-unchecked="Não"></div>
						</label>
					</div>
					<div class="nextpay">
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client ID:</strong></span>
							<input name="nextpay_client_id" id="nextpay_client_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?=$nextpay_client_id?>">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Client Secret:</strong></span>
							<input name="nextpay_client_secret" id="nextpay_client_secret" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?=$nextpay_client_secret?> ">
						</label>
						<label class="block mt-4 text-sm">
							<span class="text-gray-700 dark:text-gray-400"><strong>Webhook</strong></span>
							<input name="nextpay_webhook" id="nextpay_webhook" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly value="<?=BASE_URL?>webhook_next.php">
						</label>
					</div>
				</div>

            </div>

            <input type="hidden" name="gateway" value="1">
            <div class="mt-6">
                <button type="submit"
                    class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let mercadopago = $('#mercadopago').prop('checked');
        let gerencianet = $('#gerencianet').prop('checked');
        let pagstar = $('#pagstar2').prop('checked');
        let openpix = $('#openpix').prop('checked');
        let pay2m = $('#pay2m').prop('checked');
        let nextpay = $('#nextpay').prop('checked');
        let paggue = $('#paggue').prop('checked');
        let ezzepay = $('#ezzepay').prop('ezzepay');

        if (mercadopago) {
            $('.mercadopago').show();
        } else {
            $('.mercadopago').hide();
        }
        if (gerencianet) {
            $('.gerencianet').show();
        } else {
            $('.gerencianet').hide();
        }
        if (pagstar) {
            $('.pagstar').show();
        } else {
            $('.pagstar').hide();
        }
        if (openpix) {
            $('.openpix').show();
        } else {
            $('.openpix').hide();
        }
        if (pay2m) {
            $('.pay2m').show();
        } else {
            $('.pay2m').hide();
        }
        if (paggue) {
            $('.paggue').show();
        } else {
            $('.paggue').hide();
        }
        if (nextpay) {
            $('.nextpay').show();
        } else {
            $('.nextpay').hide();
        }
        if (ezzepay) {
            $('.ezzepay').show();
        } else {
            $('.ezzepay').hide();
        }
        $('#mercadopago').on('change', function() {
            if ($(this).prop('checked')) {
                $('.mercadopago').show();
            } else {
                $('.mercadopago').hide();
            }
        })
        $('#gerencianet').on('change', function() {
            if ($(this).prop('checked')) {
                $('.gerencianet').show();
                $(this).val('1');
            } else {
                $('.gerencianet').hide();
                $(this).val('2');
            }
        })
        $('#pagstar2').on('change', function() {
            if ($(this).prop('checked')) {
                $('.pagstar').show();
                $(this).val('1');
            } else {
                $('.pagstar').hide();
                $(this).val('2');
            }
        })
        $('#openpix').on('change', function() {
            if ($(this).prop('checked')) {
                $('.openpix').show();
                $(this).val('1');
            } else {
                $('.openpix').hide();
                $(this).val('2');
            }
        })
        $('#pay2m').on('change', function() {
            if ($(this).prop('checked')) {
                $('.pay2m').show();
                $(this).val('1');
            } else {
                $('.pay2m').hide();
                $(this).val('2');
            }

        })
        $('#paggue').on('change', function() {
            if ($(this).prop('checked')) {
                $('.paggue').show();
                $(this).val('1');
            } else {
                $('.paggue').hide();
                $(this).val('2');
            }

        })
        $('#nextpay').on('change', function() {
            if ($(this).prop('checked')) {
                $('.nextpay').show();
                $(this).val('1');
            } else {
                $('.nextpay').hide();
                $(this).val('2');
            }

        })
        $('#ezzepay').on('change', function() {
            if ($(this).prop('checked')) {
                $('.ezzepay').show();
                $(this).val('1');
            } else {
                $('.ezzepay').hide();
                $(this).val('2');
            }

        })




        $('#tabs').on('click', function() {
            console.log(pagstar)
        })
        const tabs = document.querySelectorAll('ul#tabs a');
        const tabContents = document.querySelectorAll('.tabcontent');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(item => item.classList.remove('active-tab'));
                tabContents.forEach(content => content.classList.add('hidden'));
                this.classList.add('active-tab');
                document.querySelector(this.getAttribute('href')).classList.remove('hidden');
            });
        });
        $('#gateway-form').submit(function(e) {

            e.preventDefault();

            pagstar = $('#pagstar2').prop('checked');
            if (pagstar) {
                $('#pagstar').val('1');
            } else {
                $('#pagstar').val('2');
            }
            let openpix = $('#openpix').prop('checked');
            if (openpix) {
                $('#openpix').val('1');
            } else {
                $('#openpix').val('2');
            }
            let pay2m = $('#pay2m').prop('checked');
            if (pay2m) {
                $('#pay2m').val('1');
            } else {
                $('#pay2m').val('2');
            }
            let nextpay = $('#nextpay').prop('checked');
            if (nextpay) {
                $('#nextpay').val('1');
            } else {
                $('#nextpay').val('2');
            }


            $.ajax({
                url: _base_url_ + 'class/System.php?action=update_system',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    var returnedData = JSON.parse(resp);
                    if (returnedData.status == 'success') {
                        alert('Configurações salvas com sucesso!');
                        location.reload();
                    } else {
                        alert('Ops');
                    }
                }
            })
        })
    });
</script>
