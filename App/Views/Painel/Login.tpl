<!DOCTYPE html>
<html lang="{$FastApp->getConfig("lang")}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$FastApp->getConfig("name_project")}</title>

    <link href="{base_url("public/vendor/bootstrap/css/bootstrap.min.css")}" rel="stylesheet">
    <link href="{base_url("public/vendor/metisMenu/metisMenu.min.css")}" rel="stylesheet">
    <link href="{base_url("public/dist/css/sb-admin-2.css")}" rel="stylesheet">
    <link href="{base_url("public/vendor/font-awesome/css/font-awesome.min.css")}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{$Lang->line("login_title")}</h3>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <img class="img-responsive" src="{base_url("public/logo.png")}">
                    </div>
                    <br>
                    {$Forms->init(["action" => base_url("User/Login"), "method" => "post"], "loginForm")}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="{$Lang->line("login_input_user")}" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="{$Lang->line("login_input_senha")}" name="password" type="password" value="">
                            </div>
                            <button type="button" onclick="sendLogin(this, this.form)" class="btn btn-lg btn-success btn-block">{$Lang->line("login_button_login")}</button>
                        </fieldset>
                    {$Forms->end()}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{base_url("public/vendor/jquery/jquery.min.js")}"></script>
<script src="{base_url("public/vendor/bootstrap/js/bootstrap.min.js")}"></script>
<script src="{base_url("public/vendor/metisMenu/metisMenu.min.js")}"></script>
<script src="{base_url("public/dist/js/sb-admin-2.js")}"></script>
<script src="{base_url("public/dist/js/bootstrap-notify.min.js")}"></script>

<script>
    function sendLogin(btn, form){
        $(btn).attr("disabled","disabled");
        $.post($(form).attr("action"), $(form).serializeArray(), function(result) {
            $.notifyClose();
            $(btn).removeAttr("disabled","disabled");

            if (result.responseError) {
                $("[name=loginForm]").val(result.data.newToken);
                $.notify({ message: result.msg }, { type: 'danger' });
                var alls = $(form).serializeArray();
                for (var keys in alls){
                    if (result.data[alls[keys]['name']] != undefined) {
                        $.notify({ message: result.data[alls[keys]['name']] }, { type: 'danger' });
                    }
                }
            }else{
                $.notify({ message: result.msg }, { type: 'success' });
                redirPainel(result.data.url);
            }
        });
    }
    function redirPainel(url){
        setTimeout(function(){
            window.location = url
        }, 800)
    }
</script>

</body>
</html>
