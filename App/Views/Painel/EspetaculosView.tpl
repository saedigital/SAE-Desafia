{*Meta Title*}
{capture name="title"}
    {$Lang->line("metatitle_espetaculo")}
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
    {$Lang->line("espetaculo_view")}
    <div class="pull-right">
        <a href="{base_url("Painel/Espetaculos")}" class="btn btn-info">{$Lang->line("btn_back_all")}</a>
        <a href="{base_url("Painel/Espetaculos/Delete/{$Esp['id']}")}" class="btn btn-danger">{$Lang->line("btn_esp_delete")}</a>
        <a href="{base_url("Painel/Espetaculos/Editar/{$Esp['id']}")}" class="btn btn-warning">{$Lang->line("btn_esp_edit")}</a>
    </div>
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
                            <div class="huge">{$Esp['ticketsLimit']-$Esp['ticketsActive']}</div>
                            <div>Reservas Disponíveis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-ticket fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{$Esp['ticketsActive']}</div>
                            <div>Reservas Ativas</div>
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
                            <div class="huge">{$Esp['ticketsCancel']}</div>
                            <div>Reservas Canceladas</div>
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
                            <div class="huge">R$ {number_format($Esp['ticketsActive']*23.76,"2",",",".")}</div>
                            <div>Reserva Ativas</div>
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
                            <div class="huge">R$ {number_format($Esp['ticketsCancel']*23.76,"2",",",".")}</div>
                            <div>Reservas Canceladas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            {$Lang->line("painel_espetaculo_view")}
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <h4>{$Lang->line("esp_title_reserve")}</h4>
                <hr>
                {$Forms->init(["action" => base_url("Painel/Poltrona/Reserve"), "method" => "post"], "cadPoltrona")}
                <input type="hidden" name="id" value="{$Esp['id']}">
                <div class="form-group">
                    <label>{$Lang->line("esp_input_name_polt")}</label>
                    <input class="form-control" placeholder="{$Lang->line("esp_input_name_polt_desc")}" name="nome">
                    <p class="help-block">{$Lang->line("esp_input_name_polt_desc")}</p>
                </div>
                <div class="form-group">
                    <label>{$Lang->line("esp_input_code_polt")}</label>
                    <input type="text" class="form-control" placeholder="{$Lang->line("esp_input_code_polt_desc")}" name="code">
                    <p class="help-block">{$Lang->line("esp_input_code_polt_desc")}</p>
                </div>
                <div class="form-group">
                    <label>{$Lang->line("esp_input_ndoc_polt")}</label>
                    <input type="text" class="form-control" placeholder="{$Lang->line("esp_input_ndoc_polt_desc")}" name="doc">
                    <p class="help-block">{$Lang->line("esp_input_ndoc_polt_desc")}</p>
                </div>

                <button type="button" class="btn btn-info btn-block" onclick="sendForm(this, this.form)">{$Lang->line("btn_send_poltrona")}</button>
                {$Forms->end()}
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>{$Lang->line("th_esp_nome")}</th>
                        <td>{$Esp['name']}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_limit")}</th>
                        <td>{$Esp['ticketsLimit']}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_init")}</th>
                        <td>{formateDate($Esp['start_at'])}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_end")}</th>
                        <td>{formateDate($Esp['end_at'])}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_uf")}</th>
                        <td>{$Esp['state']}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_city")}</th>
                        <td>{$Esp['city']}</td>
                    </tr>
                    <tr>
                        <th>{$Lang->line("th_esp_address")}</th>
                        <td>{$Esp['address']}</td>
                    </tr>
                </table>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Código</th>
                        <th>Documento</th>
                        <th>Token</th>
                        <th>Status</th>
                        <th>Criado Em</th>
                        <th>Atualizado Em</th>
                        <th width="140px">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$Reservas['Results'] item=item}
                        <tr>
                            <td>{$item.reservationTo}</td>
                            <td>{$item.reservationPolt}</td>
                            <td>{$item.reservationCpf}</td>
                            <td>{$item.reservationToken}</td>
                            <td>{$item.status}</td>
                            <td>{formateDate($item.create_at, "d/m/Y H:i")}</td>
                            <td>{formateDate($item.update_at, "d/m/Y H:i")}</td>
                            <td>
                                {if $item.status == "Ativa"}
                                <a href="{base_url("Painel/Poltrona/Cancel")}/{$item.id}" class="btn btn-warning" title="Cancelar">
                                    <i class="fa fa-close"></i>
                                </a>
                                {/if}
                                <a href="{base_url("Painel/Poltrona/Delete")}/{$item.id}" class="btn btn-danger" title="Apagar">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>

        </div>
        <div class="panel-footer"></div>
    </div>
{/capture}

{*Implementar Rodapé*}
{capture name="footer_block"}
    <script>
        function sendForm(btn, form){
            $(btn).attr("disabled","disabled");
            $.post($(form).attr("action"), $(form).serializeArray(), function(result) {
                $.notifyClose();
                $(btn).removeAttr("disabled","disabled");
                if (result.responseError) {
                    $("[name=cadPoltrona]").val(result.data.newToken);
                    $.notify({ message: result.msg }, { type: 'danger' });
                    var alls = $(form).serializeArray();
                    alls.push({ "name":"city" });
                    for (var keys in alls){
                        if (result.data[alls[keys]['name']] != undefined) {
                            $.notify({ message: result.data[alls[keys]['name']] }, { type: 'danger' });
                        }
                    }
                }else{
                    $.notify({ message: result.msg }, { type: 'success' });
                    redirUrl(result.data.url);
                }
            });
        }
        function redirUrl(url){
            setTimeout(function(){
                window.location = url
            }, 800)
        }
    </script>
{/capture}