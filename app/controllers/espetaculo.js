const Espetaculo = require('../models').Espetaculo

module.exports = {
  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  findAll(req, res) {
    return Espetaculo
      .findAll()
      .then(espetaculo => res.status(200).send(espetaculo))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  add(req, res) {
    return Espetaculo
      .create({
        name: req.body.name,
      })
      .then(espetaculo => res.status(201).send(espetaculo))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  remove(req, res) {
    return Espetaculo
      .destroy({ where: { id: req.params.id } })
      .then(espetaculo => res.status(201).send(espetaculo))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  update(req, res) {
    return Espetaculo
      .update(
        { name: req.body.name },
        { where: { id: req.params.id } }
      )
      .then(espetaculo => res.status(201).send(espetaculo))
      .catch(error => res.status(400).send(error))
  },

  /**
   * 
   * @param {*} req 
   * @param {*} res 
   */
  getById(req, res) {
    return Espetaculo
      .findOne({ where: { id: req.params.id }})
      .then(espetaculo => {
        if (!espetaculo) {
          return res.status(404).send({
            message: 'Espetaculo not found',
          });
        }
        return res.status(200).send(espetaculo);
      })
      .catch(error => res.status(400).send(error));
  },
}