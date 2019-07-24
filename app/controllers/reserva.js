const Reserva = require('../models').Reserva

module.exports = {
  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  findAll(req, res) {
    return Reserva
      .findAll()
      .then(reservas => res.status(200).send(reservas))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  add(req, res) {
    return Reserva
      .create({
        name_booking: req.body.name_booking,
        Espetaculo_id: req.body.espetaculo_id,
      })
      .then(espetaculo => res.status(201).send(espetaculo))
      .catch(error => res.status(400).send(error))
  },
}