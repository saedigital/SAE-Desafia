'use strict';

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('Reservas', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      name_booking: {
        type: Sequelize.STRING,
        allowNull: false,
      },
      Espetaculo_id: {
        type: Sequelize.INTEGER,
        references: {
          model: 'Espetaculos',
          key: 'id',
        },
        allowNull: false
      },
      price: {
        type: Sequelize.DECIMAL(10, 2),
        allowNull: false,
        defaultValue: 23.76,
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    })
  },

  down: queryInterface => queryInterface.dropTable('Reservas'),
};
