# Candidato

**Nome**: Maicon Wilson Gonçalez

**Email**: maicon@maiscontrole.net

# Instalação
Importar Banco de Dados:
Arquivo banco.sql

Alterar as seguintes configurações em:

App/Configs/Configs.php

	$Config['base_dir'] = "/";  //Ex: / para root /teste/ caso esteja na pasta teste em root.
	$Config['base_url'] = "http://127.0.0.1/";  // Url Base Ex: http://127.0.0.1/teste/

Alterar Configurações do BD

	$Config['db_hostname'] = "localhost"; //host do bd
	$Config['db_database'] = "_testes"; // nome do bd
	$Config['db_username'] = "root"; // usuario do bd
	$Config['db_password'] = "mysql"; //senha

# Observações

Servidor utilizado:
* PHP version: 7.0.10
* Apache/2.4.23 (Win32)
* MySQL 5.6.31 Community Server (GPL)

Para fazer login, utilize os dados Abaixo:
* Usuário: admin
* Senha: 123456

Não foi utilizado framework, toda a estrutura são projetos que estou desenvolvendo, pode ser visto em:
https://github.com/Dellacurtais/MicroFramework
https://github.com/Dellacurtais/PHPDatabase

Muitas implementações foram feitas nos projetos acima durante o desenvolvimento do próprio teste, já que nenhum ainda foi finalizado.

Bibliotécas de Terceiros:
* Smarty Template Engine

Admin Template Sb Admin 2
* https://startbootstrap.com/template-overviews/sb-admin-2/

Demo:
* http://maiscontrole.net/teste/
