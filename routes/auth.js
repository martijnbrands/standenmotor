const router = require('express').Router();
const jwt = require('jsonwebtoken')
const bcrypt = require('bcryptjs');
const User = require('../models/User');
const { registerValidation, loginValidation } = require('../validation')

// REGISTER
router.post('/register', async (req, res) =>{

    // Validation
    const {error} = registerValidation(req.body)
    if(error) return res.status(400).send(error.details[0].message)

    // Checking if the user is already in the database
    const emailExist = await User.findOne({email: req.body.email});
    if (emailExist) return res.status(400).send('Email already exists');

    // Hash passwords
    const salt = await bcrypt.genSalt(10);
    const hashedPassword = await bcrypt.hash(req.body.password, salt)

    // Create a new user
    const user = new User({
        email: req.body.email,
        password: hashedPassword
    });
    try {
        const saveduser = await user.save()
        res.send({
            user: user._id,
            email: user.email,
            date: user.date,
        })
    } catch (error) {
        res.status(400).send(error.message)
    }
})

// LOGIN
router.post('/login', async (req, res) =>{

    // Validation
    const {error} = loginValidation(req.body)
    if(error) return res.status(400).send(error.details[0].message)

    // Checking for valid email
    const user = await User.findOne({email: req.body.email});
    if (!user) return res.status(400).send('Email does not exists');

    // Checking for valid password
    const validPassword = await bcrypt.compare(req.body.password, user.password)
    if (!validPassword) return res.status(400).send('Invalid password')

    // Creat and assing a token
    const token = jwt.sign({_id: user._id}, process.env.JWT_AUTH_SECRET)
    res.json({"token": token})


})

module.exports = router