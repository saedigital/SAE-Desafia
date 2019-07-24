# Candidato

**Nome**: Paulo Teixeira

**Email**: dev.pauloteixeira@gmail.com

# Instalação

- Configure seu banco de dados no arquivo `app/config/database.json`. (MySQL)

- Instalação de dependências

```bash
npm install
```

- Rode as migrations

```bash
npx sequelize db:migrate
```

- Subir aplicação

```bash
npm run dev
```

# Observações

O comando para subir a aplicação levanta em simultaneo os dois serviços, front-end e back-end, respectivamente na porta **8080** e **4000**.

# Tecnologias utilizadas
- Express
- ORM Sequelize
- Vue.js
- SCSS
- MySQL