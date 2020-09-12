const mongoose = require('mongoose');

const schemaOptions = { toJSON: { virtuals: true } };

const playerSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true
    },
    goals: {
        type: Number,
        default: 0
    },
    assists: {
        type: Number,
        default: 0
    }
}, schemaOptions)

playerSchema.virtual('points').get(function () {
    return this.goals * 2 + this.assists
})

module.exports = mongoose.model('Players', playerSchema)