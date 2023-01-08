const mongoose = require('mongoose');

const matchesSchema = new mongoose.Schema({
    id: {
        type: String
    },
    datetime: {
        type: Date,
    },
    location: {
        type: Object
    },
    home_team: {
        type: Object
    },
    away_team: {
        type: Object
    },
    status:{
        type: String
    },
    shirt_color: {
        type: String,
        enum : ['thuis','uit'],
        default: 'thuis'
    },
   sock_color: {
        type: String,
        enum : ['blauw','wit'],
        default: 'blauw'
    },
    driverIDs: [{ type: mongoose.Schema.Types.ObjectId, ref: 'Players'}] 
})


module.exports = mongoose.model('matches', matchesSchema)