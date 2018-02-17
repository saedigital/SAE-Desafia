# Candidato

**Nome**: Andre Cardoso

**Email**: andrecardosodev@gmail.com

# Instalação

Baixe o repositório no branch `andre-cardoso` e rode o comando `composer install`. Caso 
não de certo com o install, dê um update: `composer update`.

> Caso haja questionamento sobre incluir módulos em arquivo de configuração, basta rejeitar. Tudo que 
a aplicacão precisa pra rodar já está registrado corretamente.

Assim que a instalação das dependências finalizar siga os passos abaixo.


## Passo 1 - Criando o banco de dados

Crie um novo banco de dados MySQL. Sugestão de nome: `sae_andre_cardoso`. 

```shell
$ mysql -u {user} -p
mysql> CREATE SCHEMA `sae_andre_cardoso` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
```

Em seguida configure o 
arquivo `config/autoload/doctrine-module` com as informações do banco recém criado.

```php
# config/autoload/doctrine_orm.global.php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'user',
                    'password' => 'password',
                    'dbname' => 'sae_andre_cardoso',
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ]
    ],
];

```

## Passo 2 - Executando Migrations

Antes de tudo temos de habilitar o modo desenvolvimento para poder 
realizar as migrações e fixtures. Rode o seguinte comando: `composer development-enable`.

```shell
$ composer development-enable
> zf-development-mode enable
You are now in development mode.
```

Agora que já estamos em modo desenvolvimento, banco de dados já existe e a configuração para sua correta conexão está ok, 
é o momento de criar as tabelas. Para tal, utilizei o Doctrine Migrations (você pode saber mais sobre 
migrations com o Doctrine em um artigo que escrevi em meu blog - [link](https://andrebian.com/doctrine-migrations-com-zend-framework)).

Em resumo, o comando a ser executado é o `./vendor/bin/doctrine-module migrations:migrate --no-interaction`.


## Passo 3 - Executando Fixtures

Por padrão já cadastrei 3 eventos/espetáculos, basta rodar as fixtures que a aplicação estará pronta para uso. 
Rode o comando `./vendor/bin/doctrine-module orm:fixtures:load`.


```shell
$ ./vendor/bin/doctrine-module orm:fixtures:load
Careful, database will be purged. Do you want to continue y/N ?y
  > purging database
  > loading [0] Application\Fixture\LoadEvent
```

## Passo 4 - Rode o Built-in Server

Agora basta rodar o comando `php -S localhost:8080 -t public`. Adicionalmente existe um script registrado no composer.json 
pra facilitar a disponibilização do web server de testes: `composer serve`

```shell
$ php -S localhost:8080 -t public
```

Resultado

![Image 1](doc/images/img-1.png)


## Com o Docker

Rode o comando `docker-compose up -d --build`.


Em seguida entre no container `docker-compose exec sae-desafia-andre-cardoso bash` e siga os passos **2** e **3**.


Feito isto, basta acessar `http://localhost:8080` em seu browser.

# Observações
[...]

# Testes

Para rodar os testes, utilize o comando `composer test`. Toda a suíte de 
testes será executada e, estando o Xdebug instalado, será gerado o 
resultado do coverage na pasta `build/coverage-html`. Abra o arquivo 
`build/coverage-html/index.html` em seu navegador.

```shell
$ composer test
> phpunit
PHPUnit 6.4.4 by Sebastian Bergmann and contributors.

..........................................                        42 / 42 (100%)

Time: 7.61 seconds, Memory: 28.00MB

OK (42 tests, 155 assertions)

Generating code coverage report in HTML format ... done

```