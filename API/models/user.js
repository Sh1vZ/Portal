module.exports = (sequelize, Sequelize) => {
  const User = sequelize.define("userApi", {
    name: {
      type: Sequelize.STRING
    },
    adress: {
      type: Sequelize.STRING
    },
    number: {
      type: Sequelize.STRING
    }
  });

  return User;
};