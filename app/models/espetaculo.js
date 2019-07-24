'use strict';

module.exports = (sequelize, DataTypes) => {
  const Espetaculo = sequelize.define('Espetaculo', {
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
  }, {});

  return Espetaculo;
};