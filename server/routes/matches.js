const router = require('express').Router();
const axios = require('axios');
const authentication = require('../middelware/authentication')
const Match = require('../models/Match');


// GET ALL MATCHES
router.get('/', async (req, res) =>{
    try {
        const matches = await Match.find().populate('driverIDs')
        res.send(matches)
    } catch (error) {
        console.log(error)
    }
})

// GET SINGLE MATCH
router.get('/:id', async (req, res, next) =>{
    try {
        const { id } = req.params;
        const singleMatch = await Match.findOne({
            _id: id,
        }).populate('driverIDs')
        if(!singleMatch) return next()
        return res.send(singleMatch)
    } catch (error) {
        console.log(error)
        
    }
})

// UPDATE Match
router.put('/:id', authentication, async (req, res) =>{
    try {
       const updatedMatch = await Match.findByIdAndUpdate(req.params.id, req.body)
       await updatedMatch.save()
       res.send(updatedMatch)
    } catch (error) {
        console.log(error)
        
    }
})
module.exports = router 