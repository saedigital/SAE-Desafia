'use strict';

module.exports = (sequelize, DataTypes) => {
  var Espetaculo = sequelize.define('Espetaculo', {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
      autoIncrement: true,
      allowNull: false
    },
    name: DataTypes.STRING,
    description: DataTypes.STRING,
    date: DataTypes.DATE,
    quantity_armchairs: DataTypes.STRING,
  }, {})

  Espetaculo.associate = function(models) {
    Espetaculo.hasMany(models.Reserva, {
      foreignKey: 'Espetaculo_id',
      as: 'Reservas',
    })
  }

  return Espetaculo;
};