'use strict';

module.exports = {
  up: (queryInterface, Sequelize) => {
    return Promise.all([
      queryInterface.addColumn('Espetaculos', 'status', {
        type: Sequelize.INTEGER,
        defaultValue: 1,
      })
    ])
  },

  down: (queryInterface, Sequelize) => {
    return Promise.all([
      queryInterface.removeColumn('Espetaculos', 'status'),
    ])
  }
};
