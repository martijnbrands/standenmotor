// Validation
const Joi = require('@hapi/joi');

// Register Validation
const registerValidation = data => {
    const schema = Joi.object( {
        email: Joi.string().email().required(),
        password: Joi.string().min(6).required()
    })
    return schema.validate(data)
}

// Register Validation
const loginValidation = data => {
    const schema = Joi.object( {
        email: Joi.string().email().required(),
        password: Joi.string().min(6).required()
    })
    return schema.validate(data)
}

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