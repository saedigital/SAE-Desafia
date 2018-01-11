# Candidato

**Nome**: Guilherme de Souza Vieira Beira

**Email**: guilherme.vieira.beira@gmail.com

# Instalação
após ter clonado o reposotório
```console
virtualenv env -p python3
source env/bin/activate
pip install -r requirements-dev.txt
cp contrib/env-sample .env
python manage.py migrate
python manage.py runserver
```

# Observações
o banco padrão é o sqlite3, caso queira mudar configurar o arquivo .env que esta na raiz