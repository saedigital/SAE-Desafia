<!DOCTYPE html>
<html lang="{$FastApp->getConfig("lang")}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    {if $smarty.capture.title}
        <title>{$smarty.capture.title}</title>
    {else}
        <title>{$FastApp->getConfig("name_project")}</title>
    {/if}

    <link href="{base_url("public/vendor/bootstrap/css/bootstrap.min.css")}" rel="stylesheet">
    <link href="{base_url("public/vendor/metisMenu/metisMenu.min.css")}" rel="stylesheet">
    <link href="{base_url("public/dist/css/sb-admin-2.css")}" rel="stylesheet">
    <link href="{base_url("public/vendor/morrisjs/morris.css")}" rel="stylesheet">
    <link href="{base_url("public/vendor/font-awesome/css/font-awesome.min.css")}" rel="stylesheet" type="text/css">
    <link href="{base_url("public/vendor/datepicker/css/bootstrap-datepicker3.css")}" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {if $smarty.capture.header_block}
        {$smarty.capture.header_block}
    {/if}
</head>
<body>
<div id="wrapper">

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <ul class="nav navbar-top-links navbar-right">

        </ul>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="hidden-sm hidden-xs">
                        <a>
                            {if $smarty.capture.logo_menu}
                                {$smarty.capture.logo_menu}
                            {else}
                                {$FastApp->getConfig("name_project")}
                            {/if}
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> {$Lang->line("menu_espetaculo")} <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{base_url("Painel/Espetaculos/Novo")}">{$Lang->line("menu_espetaculo_novo")}</a>
                            </li>
                            <li>
                                <a href="{base_url("Painel/Espetaculos")}">{$Lang->line("menu_espetaculo_todos")}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{base_url("Painel/Financeiro")}"><i class="fa fa-money fa-fw"></i> {$Lang->line("menu_financeiro")}</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>