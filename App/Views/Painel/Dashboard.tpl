{*Meta Title*}
{capture name="title"}
    {$Lang->line("financeiro_metatitle")}
{/capture}

{*Implementar Cabeçalhos*}
{capture name="header_block"}{/capture}

{*Logo do Menu*}
{capture name="logo_menu"}
    <div class="text-center">
        <img class="img-responsive" src="{base_url("public/logo.png")}">
    </div>
{/capture}

{*Titulo da Página*}
{capture name="header_title"}
    {$Lang->line("financeiro_title")}
{/capture}

{*Conteúdo*}
{capture name="content"}
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-ticket fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{$actives}</div>
                            <div>Reservas Ativas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">R$ {number_format($actives*23.76,"2",",",".")}</div>
                            <div>Reserva Ativas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-ticket fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{$cancels}</div>
                            <div>Reservas Canceladas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">R$ {number_format($cancels*23.76,"2",",",".")}</div>
                            <div>Reservas Canceladas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/capture}

{*Implementar Rodapé*}
{capture name="footer_block"}{/capture}