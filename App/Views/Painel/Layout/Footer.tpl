</div>

<script src="{base_url("public/vendor/jquery/jquery.min.js")}"></script>
<script src="{base_url("public/vendor/bootstrap/js/bootstrap.min.js")}"></script>
<script src="{base_url("public/vendor/metisMenu/metisMenu.min.js")}"></script>
<script src="{base_url("public/vendor/raphael/raphael.min.js")}"></script>
<script src="{base_url("public/vendor/morrisjs/morris.min.js")}"></script>
<script src="{base_url("public/vendor/datepicker/js/bootstrap-datepicker.js")}"></script>
<script src="{base_url("public/vendor/datepicker/locales/bootstrap-datepicker.pt-BR.min.js")}"></script>
<script src="{base_url("public/dist/js/bootstrap-notify.min.js")}"></script>
<script src="{base_url("public/dist/js/sb-admin-2.js")}"></script>
<script src="{base_url("public/js/jquery.city.min.js")}"></script>

<script>
    $(document).ready(function(){
        var datepicker = $(".datepicker");
        if (datepicker.length > 0) {
            datepicker.datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR"
            });
        }
    });
</script>

{if $smarty.capture.footer_block}
    {$smarty.capture.footer_block}
{/if}

</body>
</html>