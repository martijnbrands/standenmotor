const mongoose = require('mongoose');

const matchesSchema = new mongoose.Schema({
    matchId: {
        type: String
    },
    matchDate: {
        type: String
    },
    matchTime: {
        type: String
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
    driverIDs: [{ type: mongoose.Schema.Types.ObjectId, ref: 'Players'}] 
})


module.exports = mongoose.model('matches', matchesSchema)