const express = require('express')
const app = express()

const routesEspetaculos = require('./routes/api/espetaculos')

app.use(express.urlencoded({ extended: false }))
app.use('/espetaculos', routesEspetaculos)

const port = process.env.PORT || 4000
app.listen(port, () => console.log(`Listening on port ${port}...`))
