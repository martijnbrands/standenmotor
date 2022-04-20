const mongoose = require('mongoose');
const moment = require('moment')

const matchesSchema = new mongoose.Schema({
    createdAt: { 
        type: Date,
        default: Date.now ,
        expires: function() {
            return moment.duration(this.matchDateTime).add(12, 'hours');
        }
    },
    matchId: {
        type: String
    },
    matchDateTime: {
        type: Date,
    },
    homeTeam: {
        type: String
    },
    awayTeam: {
        type: String
    },
    field: {
        type: String
    },
    shirtColor: {
        type: String,
        enum : ['white','yellow'],
        default: 'white'
    },
   sockColor: {
        type: String,
        enum : ['blue','white'],
        default: 'blue'
    },
    driverIDs: [{ type: mongoose.Schema.Types.ObjectId, ref: 'Players'}] 
})


module.exports = mongoose.model('matches', matchesSchema)