# Candidato

**Nome**: Leandro Pereira Corso

**Email**: contato@leandrocorso.com.br

# Instalação
1. Obtenha a última versão do sistema pelo repositório no directory_index do seu Apache.

2. Execute no MySQL Server do seu localhost o dumb da base de dados presente na raiz deste projeto. [`sae_digital.sql`](sae_digital.sql)

3. No arquivo SAE-Desafia/application/config/database.php, altere os dados de acesso da base de dados para a necessidade do seu servidor.

4. Certifique-se que o arquivo .htdocs está presente na raiz do projeto.

5. Execute no endereço: 'http://localhost/SAE-Desafia'.

# Observações
Sistema desenvolvido em PHP 7.0 usando o framework CodeIgniter 3.1.7 e base de dados MariaDB 10.0.34 (Compatível com MySQL) e frontend em Bootstrap 4.0 com o tema padrão. Executado em Apache HTTP Server 2.4.18 e sistema operacional Linux Ubuntu 16.04 LTS.

O sistema possui dois usuários padrão, Administrador e Cliente.

# Acesso de Administrador
* E-mail: admin@admin.com
* Senha: admin

Observação: Após o login será encaminhado para a área administrativa.

Acesso de Cliente
* E-mail: client@client.com
* Senha: client

Observação: Após o login será encaminhado para a área de espetáculos.

# Para o Administrador é permitido:

* Criar novos espetáculos;
* Editar espetáculos já existentes;
* Excluir espetáculos;
* Visualizar histórico de vendas e dados financeiros.
* Todas as atribuições de Cliente;

# Para o Cliente é permitido:

* Visualizar os espetáculos e disponibilidade de poltronas;
* Reservar uma ou mais poltronas;
* Excluir suas próprias reservas.
