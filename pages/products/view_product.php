<style>
        /*! CSS Used from: https://ui8-crypter-2.herokuapp.com/css/app.min.css ; media=all */
        @media all {

            .auctions__author {
                display: inline-flex;
                align-items: center;
                margin-bottom: auto;
                padding: 0.5rem;
                background: rgba(32, 32, 37, 0.75);
                border-radius: 0.75rem;
                font-size: .75rem;
                line-height: 1.25rem;
                letter-spacing: -0.01em;
                font-weight: 700;
            }

            .auctions__avatar {
                position: relative;
                flex-shrink: 0;
                width: 1.5rem;
                height: 1.5rem;
                margin-right: 1rem;
            }

            .auctions__avatar img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 0.5rem;
            }
        }

        .share- .premiada .tipo {
            background: green;
            color: white;
        }

        .ouro .tipo {
            background: gold;
            color: white;
        }

        .coringa .tipo {
            background: red;
            color: white;
        }

        .congrats__preview {
            position: relative;
            height: 17.8125rem;
            margin: 0 auto;
        }

        .congrats__image {
            z-index: 2;
            width: 33.125rem;
        }

        .congrats__image,
        .congrats__polygon,
        .congrats__confetti {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .congrats__image img {
            width: 100%;
            margin-top: 50px
        }

        .share__input {
            width: 100%;
            height: 4rem;
            padding: 0 4.5rem 0 2rem;
            border-radius: 0.75rem;
            background: rgba(225, 226, 226, 0.5);
            text-overflow: ellipsis;
            font-size: 1rem;
            line-height: 1.5rem;
            letter-spacing: -0.01em;
            font-weight: 700;
            color: #202025;
        }

        .share__copy {
            position: absolute;
            top: 50%;
            right: 2rem;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-size: 0;
            background: none;
            border: none;
            cursor: pointer;
        }

        .share__copy .icon {
            fill: #686A6C;
            transition: fill 0.2s;
            width: 1.5rem;
            height: 1.5rem;
            fill: #202025;
        }

        @media (max-width: 767px) {
            #wallet {
                position: relative;
                bottom: -65px;
                right: -120px;
                width: 35% !important;
            }

            #icf span svg {
                width: 18px;
                height: 18px;

            }

            h5.sc-3f9a15f1-14.jQlWTy {
                font-size: 1.2rem !important;
            }

        }

        h5.sc-3f9a15f1-14.jQlWTy {
            font-size: 1.5rem;
        }

        .share__field {
            position: relative;
        }

        .congrats__polygon {
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-filter: drop-shadow(0 0.25rem 5rem rgba(0, 0, 0, 0.25));
            filter: drop-shadow(0 0.25rem 5rem rgba(0, 0, 0, 0.25));
        }

        .congrats__background {
            width: 63.25rem;
            height: 63.25rem;
            -webkit-clip-path: url(#polygon);
            clip-path: url(#polygon);
            background: linear-gradient(180deg, #F7FBFA 0%, rgba(247, 251, 250, 0) 76.7%);
        }

        .congrats__confetti {
            width: 81.375rem;
        }

        /*! CSS Used from: https://html.crumina.net/cryptoki/nft/css/normalize.css */
        a {
            background-color: transparent;
        }

        img {
            border-style: none;
        }

        /*! CSS Used from: https://html.crumina.net/cryptoki/nft/css/main.css */
        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }

        ::selection {
            background: #03f0d1;
            
            text-shadow: none;
        }

        img {
            vertical-align: middle;
        }

        img {
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover,
        a:active {
           
        }

        .gradient-text {
            background-size: 100%;
            background-clip: text;
            -webkit-background-clip: text;
            -moz-background-clip: text;
            -webkit-text-fill-color: transparent;
            -moz-text-fill-color: transparent;
        }

        .gradient-text.Premiada {
            background-image: linear-gradient(90deg, white, white);
        }


        .gradient-text.Ouro {
            background-image: linear-gradient(90deg, brown, gold);
        }

        .gradient-text.Coringa {
            background-image: linear-gradient(90deg, violet, #7e3af2);
        }

        .gradient-text::selection {
          
        }

        @media print {

            *,
            *::before,
            *::after {
                color: #000 !important;
                box-shadow: none !important;
                text-shadow: none !important;
            }

            a,
            a:visited {
                text-decoration: underline;
            }

            a[href]::after {
                content: " (" attr(href) ")";
            }

            img {
                page-break-inside: avoid;
            }
        }

        .avatar {
            position: relative;
        }

        .avatar,
        .avatar img {
            border-radius: 50%;
        }

        .avatar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #177afa 20%, #03f0d1);
        }

        .avatar a {
            line-height: 1;
        }

        .avatar img {
        }

        .box-42 {
            width: 42px;
            height: 42px;
            min-width: 42px;
        }

        .box-42 img {
            width: 38px;
            height: 38px;
        }

        .placed-bid {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
        }

        .ganhadorItem_ganhadorContainer__1Sbxm {
            border-bottom: 1px solid hsla(0, 0%, 100%, 0.16);
        }

        .placed-bid:not(:last-child) {
            border-bottom: 1px solid hsla(0, 0%, 100%, 0.16);
        }

        .bid-box {
            text-align: right;
        }

        .bid-box .crypto-value {
            line-height: 1;
            margin-bottom: 10px;
        }

        .bid-box .currency-value {
            font-size: 13px;
            line-height: 1;
        }

        .new_gradient_anime.--md {
            min-width: 57px;
            border-radius: 8px;
        }

        .new_gradient_anime {
            min-width: 40px;
            height: 21px;
            font-weight: 700;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
            border-radius: 10px;
            color: #fff;
            background-position: 0 0;
            background-size: 600%;

            background-image: linear-gradient(to right, white, white, #f14848, #556FFF);
            animation-duration: 20s;
            animation-iteration-count: infinite;
            animation-name: gradient;
        }

        .line_ainme {
            animation-duration: 20s;
            animation-iteration-count: infinite;
            animation-name: line;
        }

        .new_gradient_anime.Premiada {
            background-image: linear-gradient(to right, gray, white);
            color: black;
        }

        .new_gradient_anime.Maior {
            background-image: linear-gradient(to right, #1925ad, #556FFF);
            color: white;
        }

        .new_gradient_anime.Menor {
            background-image: linear-gradient(to right, #f14848, #f14848);
            color: white;
        }

        .new_gradient_anime.Ouro {
            background-image: linear-gradient(to right, orange, gold);
            color: white
        }

        .new_gradient_anime.Coringa {
            background-image: linear-gradient(to right, violet, #7e3af2);
            color: white
        }

        .modal-dialog.cotas {
            max-width: 40%;
        }

        .prize {
            font-size: 14px;
        }

        @media (max-width: 767px) {
            .prize {
                font-size: 13px;
            }

            .modal-dialog.cotas {
                max-width: 100% !important;
            }
        }

        @keyframes line {
            0% {
                background-position: 0 0;
            }

            15% {
                background-position: 5% 0;
            }

            30% {
                background-position: 10% 0;
            }

            45% {
                background-position: 15% 0;
            }

            60% {
                background-position: 10% 0;
            }

            75% {
                background-position: 5% 0;
            }

            100% {
                background-position: 0 0;
            }

        }

        @keyframes gradient {
            0% {
                background-position: 0 0;
            }

            15% {
                background-position: 15% 0;
            }

            30% {
                background-position: 30% 0;
            }

            45% {
                background-position: 45% 0;
            }

            60% {
                background-position: 60% 0;
            }

            75% {
                background-position: 75% 0;
            }

            90% {
                background-position: 90% 0;
            }

            100% {
                background-position: 100% 0;
            }


        }

        .bid-placer {
            display: flex;
            align-items: center;
        }

        .bid-placer .avatar+.bid-info {
            margin-left: 10px;
        }

        .bid-info .bid-title {
            line-height: 1.4;
            font-weight: 500;
        }

        .bid-info .bid-date {
            font-size: 11px;
            line-height: 1;
        }

        .congrats__details {
            position: relative;
            z-index: 3;
            max-width: 50.125rem;
            margin: -0.5rem auto 0;
            text-align: center;
        }

        .congrats__title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0F121A;
            margin-bottom: 0.5rem;
        }

        .congrats__message {
            font-size: 1.125rem;
            color: #0F121A;
            margin-bottom: 1.5rem;
        }

        .congrats__content {
            font-size: 1rem;
            line-height: 2rem;
            letter-spacing: -0.02em;
            font-weight: 700;
            color: #686A6C;
        }

        .cards {
            position: relative;
            height: 90px;
            transition-duration: 0.5s;
            background: none;
            overflow: hidden;
        }

        .cards:hover {
            height: 180px;
        }

        .cards:hover .outlinePage {
            box-shadow: 0 10px 15px #b1985e;
        }

        .cards:hover .detailPage {
            display: flex;
        }



        .outlinePage1 {
            position: relative;
            background: #0f121a;
            height: 90px;
            border-radius: 25px;
            transition-duration: 0.5s;
            z-index: 2;
        }

        .outlinePage2 {
            position: relative;
            background: #0f121a;
            height: 90px;
            border-radius: 25px;
            transition-duration: 0.5s;
            z-index: 2;
        }

        .outlinePage3 {
            position: relative;
            background: #0f121a;
            height: 90px;
            border-radius: 25px;
            transition-duration: 0.5s;
            z-index: 2;
        }

        .outlinePage4 {
            position: relative;
            background: #0f121a;
            height: 90px;
            border-radius: 25px;
            transition-duration: 0.5s;
            z-index: 2;
        }

        .outlinePage5 {
            position: relative;
            background: #0f121a;
            height: 90px;
            border-radius: 25px;
            transition-duration: 0.5s;
            z-index: 2;
        }

        .detailPage {
            position: relative;
            display: none;
            background: white;
            top: -20px;
            z-index: 1;
            transition-duration: 1s;
            border-radius: 0 0 25px 25px;
            overflow: hidden;
            align-items: center;
            justify-content: flex-start;
        }

        .splitLine1 {
            opacity: 0.6;
            position: absolute;
            height: 10px;
            width: 100%;
            top: 45px;
            background-image: linear-gradient(to right,
                    transparent 10%,
                    #ffe8a0 35%,
                    #f7b733 50%,
                    #0f121a 80%,
                    transparent 90%);
            z-index: 1;

        }

        .splitLine2 {
            opacity: 0.6;
            position: absolute;
            height: 10px;
            width: 100%;
            top: 45px;
            background-image: linear-gradient(to right,
                    transparent 10%,
                    #e9e9e9 35%,
                    #c0c0c0 50%,
                    #0f121a 80%,
                    transparent 90%);
            z-index: 1;
        }

        .splitLine3 {
            opacity: 0.6;
            position: absolute;
            height: 10px;
            width: 100%;
            top: 45px;
            background-image: linear-gradient(to right,
                    transparent 10%,
                    #dda16f 35%,
                    #cd7f3d 50%,
                    #0f121a 80%,
                    transparent 90%);
            z-index: 1;
        }

        .splitLine4 {
            opacity: 0.6;
            position: absolute;
            height: 10px;
            width: 100%;
            top: 45px;
            background-image: linear-gradient(to right,
                    transparent 10%,
                    #fff 35%,
                    #fcfcfc 50%,
                    #0f121a 80%,
                    transparent 90%);
            z-index: 1;
        }

        .splitLine5 {
            opacity: 0.6;
            position: absolute;
            height: 10px;
            width: 100%;
            top: 45px;
            background-image: linear-gradient(to right,
                    transparent 10%,
                    #fff 35%,
                    #fcfcfc 50%,
                    #0f121a 80%,
                    transparent 90%);
            z-index: 1;
        }

        .trophy {
            position: absolute;
            right: 8px;
            top: -4px;
            z-index: 2;
            font-size: 60px;
        }

        .ranking_number1 {
            position: relative;
            color: #ffc64b;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 35px;
            left: 20px;
            padding: 0;
            margin: 0;
            top: -3px;
        }

        .ranking_number2 {
            position: relative;
            color: #c0c0c0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 35px;
            left: 20px;
            padding: 0;
            margin: 0;
            top: -3px;
        }

        .ranking_number3 {
            position: relative;
            color: #cd7f3d;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 35px;
            left: 20px;
            padding: 0;
            margin: 0;
            top: -3px;
        }

        .ranking_number4 {
            position: relative;
            color: #fff;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 35px;
            left: 20px;
            padding: 0;
            margin: 0;
            top: -3px;
        }

        .ranking_number5 {
            position: relative;
            color: #fff;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 35px;
            left: 20px;
            padding: 0;
            margin: 0;
            top: -3px;
        }

        .ranking_word {
            position: relative;
            font-size: 16px;
        }

        .userAvatar {
            position: absolute;
            bottom: 8px;
            left: 30px;
            font-size: 14px;
        }

        .userName {
            position: absolute;
            font-weight: 500;
            left: 55px;
            font-size: 12px;
            margin-bottom: 0;
            bottom: 10px
        }

        .medals {
            position: absolute;
            top: 15px;
            right: 5px;
            font-size: 50px;
        }

        .gradesBox {
            position: relative;
            top: 10px;
            margin-right: 10px;
            margin-left: 15px;
        }

        .gradesIcon {
            position: absolute;
            top: 10px;
        }

        .gradesBoxLabel {
            position: relative;
            display: block;
            color: #424c50;
            letter-spacing: 2px;
            margin-top: 20px;
            font-weight: 800;
            font-size: 16px;
        }

        .gradesBoxNum {
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            display: block;
            font-size: 18px;
            font-weight: 800;
            margin-left: 20px;
            color: #ea9518;
            top: -5px;
        }

        .timeNum {
            color: #6cabf6;
        }

        .slide-in-top {
            animation: slide-in-top 1s cubic-bezier(0.65, 0.05, 0.36, 1) both;
        }

        @keyframes slide-in-top {
            0% {
                transform: translateY(-100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
<?php



if (isset($_GET['id']) && 0 < $_GET['id']) {
	$qry = $conn->query('SELECT * from `product_list` where slug = \'' . $_GET['id'] . '\' ');

	if (0 < $qry->num_rows) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
	else {
		echo '<script>' . "\r\n" . '            //alert(\'Você não tem permissão para acessar essa página.\'); ' . "\r\n" . '            location.replace(\'' . BASE_URL . '\');' . "\r\n" . '          </script>';
		exit();
	}
}
else {
	echo '<script>' . "\r\n" . '          //alert(\'Você não tem permissão para acessar essa página.\');' . "\r\n" . '          location.replace(\'' . BASE_URL . '\');' . "\r\n" . '        </script>';
	exit();
}

$totalNumbers = $paid_numbers + $pending_numbers;
$percentage = ($totalNumbers / $qty_numbers) * 100;
if ((85 <= $percentage) && $status == 1 && $status_display != 2) {
	$updateStatusStatements = $conn->query('UPDATE product_list SET status_display = \'2\' WHERE id = \'' . $id . '\'');
}

if ($date_of_draw) {
	$expirationTime = date('Y-m-d H:i:s', strtotime($date_of_draw));
	$currentDateTime = date('Y-m-d H:i:s');

	if ($expirationTime < $currentDateTime) {
		$selectStatement = 'SELECT * FROM product_list WHERE id = \'' . $id . '\'';
		$selectResult = $conn->query($selectStatement);

		if (0 < $selectResult->num_rows) {
			$updatePendingStatements = $conn->query('UPDATE product_list SET status = \'3\', status_display = \'4\' WHERE id = \'' . $id . '\'');
		}
	}
}

if ($type_of_draw == '1') {
	require_once 'automatic.php';
}

if ($type_of_draw == '2') {
	require_once 'numbers.php';
}

if ($type_of_draw == '3') {
	require_once 'farm.php';
}

if ($type_of_draw == '4') {
	require_once 'half-farm.php';
}

?>