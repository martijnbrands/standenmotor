const router = require('express').Router();
const Player = require('../models/Player');
const authentication = require('../middelware/authentication')
const { playerValidation } = require('../validation');

// GET ALL PLAYERS
router.get('/', async (req, res) =>{
    try {
        const players = await Player.find()
        res.json(players)
    } catch (error) {
        console.log(error)
    }
})

// GET SINGLE PLAYER
router.get('/:id', async (req, res, next) =>{
    try {
        const { id } = req.params;
        const singlePlayer = await Player.findOne({
            _id: id,
        })
        if(!singlePlayer) return next()
        return res.json(singlePlayer)
    } catch (error) {
        console.log(error)
        
    }
})

// ADD PLAYER
router.post('/', authentication, async (req, res) =>{
    // Validation
    const {error} = playerValidation(req.body)
    if(error) return res.status(400).send(error.details[0].message)

    try{
        const newPlayer = new Player(req.body)
        await newPlayer.save()
        res.send(newPlayer)
    } catch(error){
        console.log(error)
        res.status(400).send("error, user not created")
    }
})

// UPDATE PLAYER
router.put('/:id', authentication,  async (req, res) =>{
    try {
       const updatedPlayer = await Player.findByIdAndUpdate(req.params.id, req.body)
       await updatedPlayer.save()
       res.json(updatedPlayer)
    } catch (error) {
        console.log(error)
        
    }
})

// DELETE PLAYER
router.delete('/:id', authentication, async (req, res) =>{
    try {
        const { id } = req.params;
        await Player.deleteOne({_id: id})
        res.status(200).send("success")
    } catch (error) {
        console.log(error)
    }
})

module.exports = router