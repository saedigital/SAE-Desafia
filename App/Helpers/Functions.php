<?php

function getStates(){
    return array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    );
}

function formateDate($data, $format = "d/m/Y"){
    if (is_null($data))
        return "---";

    return date($format, strtotime($data));
}

function makePagination($pager, $baseUrl){
    ?>
    <ul class="pagination">
        <?php if ($pager['preview_page'] != null){ ?>
            <li>
                <a href="<?=base_url("{$baseUrl}?p={$pager['preview_page']}")?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php } ?>
        <?php for ($p = $pager['start_on']; $p <= $pager['end_on']; $p++){ ?>
            <li><a href="<?=base_url("{$baseUrl}?p={$p}")?>"><?=$p?></a></li>
        <?php } ?>
        <?php if ($pager['next_page'] != null){ ?>
            <li>
                <a href="<?=base_url("{$baseUrl}?p={$pager['next_page']}")?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>
    <?php
}