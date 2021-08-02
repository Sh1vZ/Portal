const express = require("express");

const app = express();
const db = require("./sequelize");
const userRoutes=require('./routes/user.route')

app.use((req, res, next) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods',
    'OPTIONS, GET, POST, PUT, PATCH, DELETE'
  );
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
  next();
});

app.use((error, req, res, next) => {
  const status = error.statusCode || 500;
  const message = error.message;
  const data = error.data;
  res.status(status).json({ message: message, data: data });
});

app.use('/api/user',userRoutes)


db.sequelize.sync().then((res) => {
  app.listen(8080);
  console.log(`server started on port 8080`)
}).catch((err) => {
  console.log(err)
})
