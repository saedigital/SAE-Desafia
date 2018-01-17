# Candidato

**Nome**: Murilo Nascimento Schitz

**Email**: murilo.nascimento1988@gmail.com.br

# Instalação
[...]
- Instalar o mysql: sudo apt-get install mysql-server mysql-client
- Instalar o PHP7: sudo apt-get -y install php7.0 php7.0-mysql
- Instalar as seguintes dependencias:
  PHP >= 7.0.0,
  OpenSSL PHP Extension,
  PDO PHP Extension,
  Mbstring PHP Extension,
  Tokenizer PHP Extension,
  XML PHP Extension
- configurar o banco de dados no arquivo .env
- criar o banco de dados, create database 'saedesafia'
- php artisan migrate
- php artisan db:seed

# Observações
[...]
- Para rodar o servidor embutido: php artisan serve