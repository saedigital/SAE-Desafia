# Candidato

**Nome**: Thiago Cardoso Silva

**Email**: silva.thiagocardoso@gmail.com

# Instalação

Coloque todos os arquivos em seu localhost, em uma pasta de sua escolha.

Peça ao composer que instale as dependências do projeto usando o comando "composer install". Para isso, possua o composer instalado globalmente na máquina.

Crie uma database vazia para ser usada, e rode o arquivo DB.sql presente na raíz do projeto para importar a database e todas as tabelas. Infelizmente, não houve tempo hábil para desenvolver adequadamente as migrations que eu gostaria.

Configure o arquivo .env para rodar o projeto em sua plataforma. Para isso, copie o arquivo .env.example renomeando-o para .env e colocando os dados corretos de acesso ao seu banco de dados e o caminho de acesso a sua aplicação

# Configurações recomendadas
Ubuntu 18.04 ou superior
PHP 7.2
Mysql 5.7
Composer

# Observações
Haveriam inúmeras outras implementações, por exemplo, a imagem e mais detalhes de cada espetáculo, ou até mesmo para se reservar um assento em um espetáculo definindo seus horários de apresentação, dados de quem está reservando, separação de valores por setores e até mesmo um editor do valor da poltrona, porém, no tempo dado, o desafio está cumprido. O valor da poltrona pode ser modificado em config/config.php
Não cheguei programar a geração da versão de produção do site, pois, nas instruções passadas, ele seria avaliado em um localhost. Em uma versão de produção, tería-se um criticalcss para acelerar o carregamento, a minificação de arquivos JS e CSS para a pasta public; e a compactação das imagens também na pasta public.