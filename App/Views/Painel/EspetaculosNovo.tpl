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
    {$Lang->line("espetaculo_novo")}
{/capture}

{*Conteúdo*}
{capture name="content"}

    <div class="row">
        <div class="col-md-12 col-lg-12">
            {$Forms->init(["action" => base_url("Painel/Espetaculos/Cadastrar"), "method" => "post"], "cadEspetaculo")}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {$Lang->line("painel_espetaculo_novo")}
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_name")}</label>
                            <input class="form-control" placeholder="{$Lang->line("esp_input_name_desc")}" name="nome">
                            <p class="help-block">{$Lang->line("esp_input_name_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_limit")}</label>
                            <input type="number" class="form-control" placeholder="{$Lang->line("esp_input_limit_desc")}" name="limit">
                            <p class="help-block">{$Lang->line("esp_input_limit_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_dini")}</label>
                            <input type="text" class="form-control datepicker" placeholder="{$Lang->line("esp_input_dini_desc")}" name="init">
                            <p class="help-block">{$Lang->line("esp_input_dini_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_dend")}</label>
                            <input type="text" class="form-control datepicker" placeholder="{$Lang->line("esp_input_dend_desc")}" name="end">
                            <p class="help-block">{$Lang->line("esp_input_dend_desc")}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_uf")}</label>
                            <select class="form-control" id="estado" name="uf">
                                <option>{$Lang->line("esp_input_uf_sel")}</option>
                            </select>
                            <p class="help-block">{$Lang->line("esp_input_uf_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_city")}</label>
                            <select class="form-control" id="cidade" name="city">
                                <option>{$Lang->line("esp_input_city_sel")}</option>
                            </select>
                            <p class="help-block">{$Lang->line("esp_input_city_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label>{$Lang->line("esp_input_address")}</label>
                            <input class="form-control" placeholder="{$Lang->line("esp_input_address_desc")}" name="address">
                            <p class="help-block">{$Lang->line("esp_input_address_desc")}</p>
                        </div>
                        <div class="form-group">
                            <label> </label>
                            <button type="button" class="btn btn-info btn-block" onclick="sendForm(this, this.form)">{$Lang->line("btn_send_espetaculo")}</button>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
            {$Forms->end()}
        </div>
    </div>

{/capture}

{*Implementar Rodapé*}
{capture name="footer_block"}
    <script>
        jQuery(document).ready(function(){
            var Estado = $('#estado');
            Estado.seleccity({
                        Select_Target: "#cidade",
                        Link_Json: "{base_url("public/js/brasil.json")}"
                    },
                    function(){ },
                    function(){ }
            );
        });
        function sendForm(btn, form){
            $(btn).attr("disabled","disabled");
            $.post($(form).attr("action"), $(form).serializeArray(), function(result) {
                $.notifyClose();
                $(btn).removeAttr("disabled","disabled");
                if (result.responseError) {
                    $("[name=cadEspetaculo]").val(result.data.newToken);
                    $.notify({ message: result.msg }, { type: 'danger' });
                    var alls = $(form).serializeArray();
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