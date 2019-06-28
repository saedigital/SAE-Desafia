# Candidato

**Nome**: Gerson Arbigaus

**Email**: gerson87@gmail.com

# Instalação
Criar as tabelas no banco de dados:

```sql
    create table if not exists shows
    (
      id            int auto_increment
        primary key,
      name          text                               not null,
      sits          int                                not null,
      date          datetime default CURRENT_TIMESTAMP null,
      place         text                               not null,
      reserved_sits int      default 0                 null,
      price         float    default 0                 null
    )
      comment 'Tabela de espetáculos';
      
      create table if not exists shows
      (
        id            int auto_increment
          primary key,
        name          text                               not null,
        sits          int                                not null,
        date          datetime default CURRENT_TIMESTAMP null,
        place         text                               not null,
        reserved_sits int      default 0                 null,
        price         float    default 0                 null
      )
        comment 'Tabela de espetáculos';
        
```

Configurar os dados do banco criado no arquivo config.php

Pode acessar a pasta src e rodar via shell:

```sh
    php -S 127.0.0.1:8081
```

Acessar via browser

http://127.0.0.1:8081

# Observações
Utilizado a estrutura MVC e para o CSS foi utilizado o Materialize CSS.