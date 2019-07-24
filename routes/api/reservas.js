const express = require('express')
const router = express.Router()

const reservaController = require('../../app/controllers').reserva

router.get('/', reservaController.findAll)
router.post('/reservar', reservaController.add)

module.exports = router