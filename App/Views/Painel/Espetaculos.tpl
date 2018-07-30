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
    {$Lang->line("espetaculo_alls")}
{/capture}

{*Conteúdo*}
{capture name="content"}
    {assign var="error" value=$Session->getFlash("error")}
    {assign var="success" value=$Session->getFlash("success")}
    {if $error}
        <div class="alert alert-danger">
            {$error}
        </div>
    {/if}
    {if $success}
        <div class="alert alert-success">
            {$success}
        </div>
    {/if}

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Limite</th>
                    <th>Reservas</th>
                    <th>Disponíveis</th>
                    <th>Data Inic.</th>
                    <th>Data Final</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th width="140px">#</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$Results item=item}
                    <tr>
                        <td>{$item.name}</td>
                        <td>{$item.ticketsLimit}</td>
                        <td>{$item.ticketsActive}</td>
                        <td>{$item.ticketsLimit-$item.ticketsActive}</td>
                        <td>{formateDate($item.start_at)}</td>
                        <td>{formateDate($item.end_at)}</td>
                        <td>{$item.state}</td>
                        <td>{$item.city}</td>
                        <td>
                            <a href="{base_url("Painel/Espetaculos/View")}/{$item.id}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{base_url("Painel/Espetaculos/Editar")}/{$item.id}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{base_url("Painel/Espetaculos/Delete")}/{$item.id}" class="btn btn-danger">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
            <small>* Ao remover um espetáculo, todas as reservas do mesmo são deletadas</small>
        </div>
        <div class="panel-footer">
            <div class="text-center">
                {makePagination($Pages, "Painel/Espetaculos")}
            </div>
        </div>
    </div>


{/capture}

{*Implementar Rodapé*}
{capture name="footer_block"}

{/capture}