const router = require('express').Router();
const authentication = require('../middelware/authentication')
const Match = require('../models/Match');
const cron = require('node-cron');
const axios  = require('axios');

async function getApiMatches() {
    try {
        const response = await axios.get(`https://mhc-oss-api.herokuapp.com/api/teams/Heren2`);
        const matches = response.data.matches;
        console.log("api ",  matches);
        } catch (error) {
           console.log(error);
       }
}
async function getDatabaseMatches() {
    try {
        const matches = await Match.find()
        console.log("database ", matches);
        } catch (error) {
           console.log(error);
       }
}
cron.schedule("*/10 * * * * *", async () => {
//    await getApiMatches()
   await getDatabaseMatches()
});


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

// ADD MATCH
router.post('/', async (req, res) =>{
    // Validation
    try{
        const newMatch = new Match(req.body)
        await newMatch.save()
        res.send(newMatch)
    } catch(error){
        console.log(error)
        res.status(400).send("error, match not created")
    }
})

// UPDATE MATCH
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