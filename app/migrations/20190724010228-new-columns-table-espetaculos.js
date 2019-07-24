'use strict';

module.exports = {
  up: (queryInterface, Sequelize) => {
    return Promise.all([
      queryInterface.addColumn('Espetaculos', 'quantity_armchairs', { type: Sequelize.INTEGER }),
      queryInterface.addColumn('Espetaculos', 'description', { type: Sequelize.STRING }),
      queryInterface.addColumn('Espetaculos', 'date', { type: Sequelize.DATE }),
    ])
  },

  down: (queryInterface, Sequelize) => {
    return Promise.all([
      queryInterface.removeColumn('Espetaculos', 'quantity_armchairs'),
      queryInterface.removeColumn('Espetaculos', 'description'),
      queryInterface.removeColumn('Espetaculos', 'date'),
    ])
  }
};
