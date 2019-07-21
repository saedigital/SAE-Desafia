const express = require('express')
const router = express.Router()

const espetaculoController = require('../../controllers').espetaculo

router.get('/', espetaculoController.findAll)
router.post('/cadastro', espetaculoController.add)

router.get('/:id', espetaculoController.getById)
router.get('/:id/excluir', espetaculoController.remove)
router.put('/:id/atualiza', espetaculoController.update)

module.exports = router