# Candidato

**Nome**: Jefferson Miranda Carvalho

**Email**: miranda.w.sam@outlook.com

# Instalação

Tecnologias: Biblioteca Vue.js, Django Rest e PostgreSQL.
Ambientes de desenvolvimento: Visual Studio (Django Rest) e Visual Studio Code (Vue.js).

O sistema é composto por duas aplicações em diferentes repositórios: Uma aplicação web em Vue.js e uma API em Django Rest.

A API é responsável por fazer conexões no banco de dados e levar os dados até a aplicação Vue.js por meio de chamadas AJAX.

PASSOS PARA RODAR A API EM DJANGO (Neste repositório):

1. Ir até o diretório raiz e abrir o prompt de comandos;
2. Executar o comando "pip install requirements.txt" para instalar os pacotes necessários para o funcionamento da aplicação;
3. Executar o comando "python manage.py runserver" para executar a aplicação;
4. Mantenha a aplicação rodando em localhost:8000, pois este é o endereço que a aplicação cliente (Vue.js) irá realizar as chamadas AJAX.

PASSOS PARA RODAR A APLICAÇÃO VUE.JS (Link repositório: https://github.com/JeffersonMiranda/teatro-application-vuejs):

1. Ir até o diretório raiz e abrir o prompt de comandos;
2. Executar o comando "npm install" para instalar os pacotes da pasta node_modules para o funcionamento da aplicação;
3. Executar o comando "npm run dev" para executar a aplicação web;
4. Acesse a aplicação em localhost:8080 para os testes. 

# Observações

As informações estão armazenadas em um banco de dados PostgreSQL hospedado em um servidor Heroku. Se tiver algum erro ou dúvida ao longo dos testes, por favor me informem para eu poder ajudar. 
