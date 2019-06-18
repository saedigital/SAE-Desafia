# Candidato

**Nome**: Gabriel Kovalechyn

**Email**: gkovalechyn@gmail.com  

# Instalação
## Requerimentos:
* Node.js (Preferencialmente 10+)
* NPM
* MongoDB 3.2+

## Passos:
* Execute o comando `npm install` dentro da pasta do projeto.
* Copie o arquivo `.env.example` para `.env`.
* Configure o arquivo `.env`, a única entrada realmente necessária é o `DB_URI`.
* Para executar pode ser executado `npm run watch`, `npm run dev` ou `npm run prod`. Para os dois últimos comandos é necessário executar `node build/bundle.js` para iniciar o servidor.
* Depois só conectar com o browser em `localhost:<porta>`.

# Observações
* Eu deixei o URI do banco de dados que eu estava usando como teste, eu ia usar o PostgreSQL mas não tinha nenhum serviço decente que me desse um banco de dados de graça, por isso usei o mongo.
* Se optar por primeiro construir o bundle e depois executar, só ter certeza que o diretório de execução é o diretório raiz do projeto.