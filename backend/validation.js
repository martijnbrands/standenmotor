const Joi = require('@hapi/joi');

// Register validation
const registerValidation = data => {
    const schema = Joi.object( {
        email: Joi.string().email().required(),
        password: Joi.string().min(6).required()
    })
    return schema.validate(data)
}

// Login validation
const loginValidation = data => {
    const schema = Joi.object( {
        email: Joi.string().email().required(),
        password: Joi.string().min(6).required()
    })
    return schema.validate(data)
}

// Player validation
const playerValidation = data => {
    const schema = Joi.object( {
        name: Joi.string().required(),
        goals: Joi.number().default(0),
        assists: Joi.number().default(0),
    })
    return schema.validate(data)
}

module.exports.registerValidation = registerValidation;
module.exports.loginValidation = loginValidation;
module.exports.playerValidation = playerValidation;