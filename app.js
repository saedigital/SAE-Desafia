const express = require('express')
const app = express()

const routesEspetaculos = require('./routes/api/espetaculos')

app.all('*', function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*")
  res.header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT")
  res.header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers")
  next()
})

app.use(express.urlencoded({ extended: false }))
app.use('/espetaculos', routesEspetaculos)

const port = process.env.PORT || 4000
app.listen(port, () => console.log(`Listening on port ${port}...`))
