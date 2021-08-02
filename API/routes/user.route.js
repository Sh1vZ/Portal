
const express = require('express');
const userController=require('../controllers/user.controller')

const router=express.Router()

router.get('/get',userController.getAll)
router.post('/insert',userController.postData)
router.delete('/delete',userController.deleteAll)

module.exports = router;