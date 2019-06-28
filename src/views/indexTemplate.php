<!DOCTYPE html>
<html>
    <head>
    <!-- Desenvolvido por Gerson Arbigaus -->
        <meta charset="utf-8">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL."assets/css/materialize.min.css"; ?>"  media="screen,projection"/>
        <link href="<?php echo BASE_URL."assets/css/index.css"; ?>" type="text/css" rel="stylesheet" media="screen,projection">
        <title><?php echo SITE_TITLE; ?>Home</title>
    </head>
    <body>        
        <div class="container">	
	<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	
</body>
</html>