<!DOCTYPE html>
<html>
<body>
<head>
	<!-- Desenvolvido por Gerson Arbigaus -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAE Desafia</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_URL."assets/css/materialize.min.css"; ?>" />
	<link rel="stylesheet" href="<?php echo BASE_URL."assets/css/nouislider.min.css"; ?>" />
	<link rel="stylesheet" href="<?php echo BASE_URL."assets/css/style.css"; ?>" />
</head>
<main>
	<div class="container">
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</div>
	
</main>
<footer class="page-footer green darken-4">
	<div class="container">
            <div class="row">
                <div class="white-text col l6 s12">
                    <p class="white-text" style="font-size: 20px; padding-bottom: 1px;">SAE Desafia</p>
                    <ul class="grey-text text-lighten-3">
                        <li><?php ?></li>
                        <li><a class="grey-text text-lighten-3" href="mailto:<?php  ?>"><?php  ?></a></li>
                    </ul>
                </div>
                <div class="col l4 offset-l2 s12">
                    <ul>
                        <li><a target="_blank" class="grey-text text-lighten-3" href="https://github.com/Arbigaus/SAE-Desafia/tree/gerson-arbigaus">Github do Projeto</a></li>
                    </ul>
            </div>
        </div>
    </div>
</footer>

	<script type="text/javascript" src="<?php echo BASE_URL."assets/js/jquery.min.js"; ?>" ></script>
	<script type="text/javascript" src="<?php echo BASE_URL."assets/js/materialize.min.js"; ?>" ></script>
	<script type="text/javascript" src="<?php echo BASE_URL."assets/js/jquery.mask.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL."assets/js/script.js"; ?>"></script>
<script>
        $(document).ready(function(){
            $('.datepicker').datepicker();
        });
    </script>
</body>
</html>