{include file=$layout}

{include file="Painel/Layout/Header.tpl"}

<div id="page-wrapper">
    <div class="container-fluid">
        {if $smarty.capture.header_title}
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{$smarty.capture.header_title}</h1>
            </div>
        </div>
        {/if}
        {if $smarty.capture.content}
            {$smarty.capture.content}
        {/if}
    </div>
</div>

{include file="Painel/Layout/Footer.tpl"}