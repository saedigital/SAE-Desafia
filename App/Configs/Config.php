<?php
$Config = array();

$Config['name_project'] = "SaeDigital";

$Config['base_dir'] = "/";
$Config['base_url'] = "http://127.0.0.1/";

$Config['enable_query_strings'] = true;
$Config['encrypt_key'] = "A65ASD56654DS46554D64D";

/**
 * DATABASE CONFIG
 */
$Config['db_activedb'] = true; //Iniciar conexão com BD se for utilizar. Projetos sem DB
$Config['db_hostname'] = "localhost";
$Config['db_database'] = "_testes";
$Config['db_username'] = "root";
$Config['db_password'] = "mysql";

$Config['db_generate'] = false; //Gerar Modelos
$Config['db_generate_dir'] = ""; //Pasta para Gerar
$Config['db_generate_base_only'] = true; //Atualizar apenas arquivo base do modelo
$Config['db_keyname'] = "frame_work"; //Nome da conexão

/**
 * SESSÃO CONFIG
 */
$Config['session_id'] = "sphap"; //Nome da Sessão

$Config['auth_user'] = "admin@maik";
$Config['auth_pass'] = "d592bd35-6338-4131-a6be-0cf70a24192d";

//Configs Rotas
$Config['default_route'] = "Login";
$Config['route_error_404'] = "NotFound";

//Default Lang
$Config['lang'] = "pt-br";

/**
 * Template Engine
 * TEMPLATE_ENGINE_NULL = Sem uso de engine de template
 * TEMPLATE_ENGINE_SMARTY = Usar Smarty template
 * TEMPLATE_ENGINE_TWIG = Usar TWIG template
 */
$Config['template'] = TEMPLATE_ENGINE_SMARTY;