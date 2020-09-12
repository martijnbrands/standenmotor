const jwt = require('jsonwebtoken');

module.exports = function authentication(req, res, next) {
    const token = req.header('auth-token');
    if(!token) return res.status(401).send("Access Denied")
    try {
        const isVerified = jwt.verify(token, process.env.JWT_AUTH_SECRET)
        req.user = isVerified
        next()
    } catch (error) {
        res.status(400).send("Invalid Token")
    }
}