# Candidato

**Nome**: Anderson Roberto da Silva

**Email**: byander@gmail.com

# Tecnologias adotadas
A aplicação para gerenciar os espetáculos e reservas de poltronas de um teatro foi criada como um site utilizando as seguintes tecnologias:
• Front-End: Foi utilizado o framework Bootstrap, a biblioteca JQuery e os plugins JQuery Masked Input e Seat-Charts para JQuery. O plugin Masked Input é utilizada nos campos data e hora no cadastro do espetáculo e o plugin Seat-Charts é utilizada para selecionar e remover as poltronas;
• Back-End: Foi adotada a linguagem PHP e para armazenada o banco de dados MySQL.

# Instalação
É necessário ter o PHP e o MySQL instalados. Neste exemplo foi utilizado o aplicativo WampServer pois é um pacote que contém o PHP, o servidor Apache, o banco de dados MySQL e o phpMyAdmin para administrar o banco de dados. 

1) Criação do banco de dados.
Acesse o phpMyAdmin e primeiramente certifique-se que o usuário tem permissão para criar banco de dados e tabelas. Na guia “Import”, clique no botão “Choose File” para selecionar o arquivo. Na janela que abrir, selecione o arquivo “scriptSQL.sql” e depois clique no botão “Go”. Irá ser criado um banco de dados chamado “db_teatro”.

2) Configurar o arquivo de conexão com o banco.
No diretório SAE-Desafia, acesse o diretório “config” e edite o arquivo “init.php”. O arquivo vai conter o seguintes parâmetros:
	$host = 'localhost'; //nome do host do MySQL
	$database = 'db_teatro'; //O nome do banco de dados
	$user_bd = 'root'; //Usuário do banco de dados MySQL
	$password_bd = ''; //Senha do banco de dados MySQL

Modifique os valores entre as aspas simples de acordo com o seu ambiente.

# Execução
Após tudo configuração, acesso a aplicação digitando no navegador localhost/SAE-Desafia
A aplicação é dividida em duas áreas, chamadas de Teatro e Área administrativa.

Área administrativa
Nesta página é possível criar, editar, atualizar e excluir os espetáculos. Também é possível visualizar a quantidade de poltronas reservadas e disponíveis, o valor arrecado por espetáculo e também o valor total arrecadado, somando todos os espetáculos. Estes dados só estarão disponíveis quando o usuário reservar as poltronas.
Neste exemplo, está disponível sempre 20 poltronas por espetáculo. 

Página principal
Nesta página é listada os espetáculos criados na página Área administrativa. Uma observação: caso seja criado um espetáculo cuja data e hora seja inferior a data atual do servidor, na página principal não será mostrada este espetáculo.
Para reservar uma ou mais poltronas, basta clicar no botão Reservar e na página do espetáculo, basta selecionar as poltronas. Note que ao selecionar e remover uma poltrona, o usuário é informado do valor da reserva.  Para, reservar, clique no botão Reservar e aguarde um instante. Se deseja cancelar uma ou mais poltronas, clique no botão Cancelar Poltrona.
Voltando na página principal, é possível visualizar as reservas realizadas pelo usuário, clicando no botão Minhas Reservas. Nesta página, é possível visualizar o número da reserva, seu valor total e clicando no botão Detalhes é possível visualizar e remover as poltronas reservas. Também é possível visualizar o valor total logo mais acima.

