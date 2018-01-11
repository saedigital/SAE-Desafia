# Candidato

**Nome**: Guilherme de Souza Vieira Beira

**Email**: guilherme.vieira.beira@gmail.com

# Instalação
# Instaçação

- instale o  python>=3.5 e o [Pip](https://pypi.python.org/pypi/pip)
- instale [Virtualenv](https://virtualenv.pypa.io/en/stable/)
- dentro da pasta SAE-Desafia crie um virtualenv com os seguintes comandos 
    ```
    $ virtualenv env -p python3
    ```
- Caso use windonws 
    ```
    $ env\Script\activate
    ```
- Caso use linux
    ```
    $ source env/bin/activate
    ```
- e instale as dependências
    ```
    $ pip install -r requeriments.txt
    ```
 - copie o arquivo de configuração
  ```
  $ cp contrib/env-sample .env
  ```
 - crie as migrações e rode o servidor
    ```
    $ python manage.py migrate
    $ ython manage.py runserver
    ```
- e [clique aqui!](http://127.0.0.1:8000)

# Observações
o banco padrão é o sqlite3, caso queira mudar configurar o arquivo .env que esta na raiz
