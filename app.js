const express = require('express')
const app = express()

const routesEspetaculos = require('./routes/api/espetaculos')

app.all('*', function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*")
  res.header("Access-Control-Allow-Headers", "X-Requested-With")
  next()
})

app.use(express.urlencoded({ extended: false }))
app.use('/espetaculos', routesEspetaculos)

const port = process.env.PORT || 4000
app.listen(port, () => console.log(`Listening on port ${port}...`))
