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
      .then(reserva => res.status(201).send(reserva))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  remove(req, res) {
    return Reserva
      .update(
        { status: 0 },
        { where: { id: req.params.id } }
      )
      .then(reserva => res.status(201).send(reserva))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  findByIdEspetaculo(req, res) {
    return Reserva
      .findAll({ where: { status: 1, Espetaculo_id: req.params.id }})
      .then(reservas => {
        if (!reservas) {
          return res.status(404).send({
            message: 'Espetaculo not found',
          });
        }
        return res.status(200).send(reservas);
      })
      .catch(error => res.status(400).send(error));
  },
}