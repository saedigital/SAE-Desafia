'use strict';

module.exports = (sequelize, DataTypes) => {
  var Reserva = sequelize.define('Reserva', {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
      autoIncrement: true,
      allowNull: false
    },
    name_booking: DataTypes.STRING,
    Espetaculo_id: DataTypes.INTEGER,
    price: DataTypes.DECIMAL(10, 2),
  }, {})

  return Reserva;
};