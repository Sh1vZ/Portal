const { users } = require('../sequelize')
const faker = require('faker');

exports.getAll = async (req, res, next) => {
  try {
    const user = await users.findAll()
    res.status(200).json({ message: 'Users Found', users: user });
  } catch (err) {
    if (!err.statusCode) {
      err.statusCode = 500;
    }
    next(err);
  }
}

exports.postData = async (req, res, next) => {
  const a = 5;
  let user;
  try {
    for (let i = 0; i < a; i++) {
      user = await users.create({ name: faker.name.findName(), adress: faker.address.streetName(), number: faker.phone.phoneNumberFormat() })
    }
    if (user) {
      res.status(200).json({ message: `${a} users created` });
    }
  } catch (err) {
    if (!err.statusCode) {
      err.statusCode = 500;
    }
    next(err);
  }
}

exports.deleteAll = async (req, res, next) => {
  const del = users.destroy({ where: {}, truncate: true });
  if (del) {
    res.status(200).json({ message: `All deleted` });
  }
}

