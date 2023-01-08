const router = require("express").Router();
const authentication = require("../middelware/authentication");
const Match = require("../models/Match");
const cron = require("node-cron");
const axios = require("axios");

// Haal API Matches op
// Haal dan de database matches op
// Loop over de database matches en kijk of de westrijd id bestaat
// zo ja kijk of de API tijd anders is dan de DB tijd
// zo ja update de tijd
// bestaat de API match niet in de DB maak er dan een aan.

// expires: function() {
//     return moment(this.matchDateTime).add(12, 'hours');
// }

// task to run every 4 hours
cron.schedule("*/5 * * * *", async () => {
  try {
    // Haal api data op
    const response = await axios.get(
      "https://publicaties.hockeyweerelt.nl/mc/teams/N5863/matches/upcoming"
    );

    // Format data
    const apiMatches = response.data.data.filter(
      (item) => item.home_team.id !== "N5863"
    );

    // Map naar ids
    const ids = apiMatches.map((match) => match.id);

    // Bekijk of de id bestaat in de database
    ids.forEach((id) => {
      Match.findOne({ id: id }, (err, match) => {
        if (err) {
          // handle error
        }
        if (match) {
          // a match with the specified id exists
          console.log("Deze wedstrijd bestaat bestaat al");

          const databaseMatch = match;
          const apiMatch = apiMatches.find((match) => match.id === id);
          if (
            databaseMatch.datetime.toString() ===
            new Date(apiMatch.datetime).toString()
          ) {
            console.log("datum is niet gewijzigd");
          } else {
            console.log("datum is gewijzigd update de match");
            Match.findOneAndUpdate({id: match.id},{$set: {datetime: apiMatch.datetime}},{new: true},
              (error, doc) => {
                if (error) {
                } else {
                  console.log(doc);
                }
              }
            );
          }
        } else {
          console.log("Deze wedstrijd bestaat nog niet maak hem aan");
          const newMatch = apiMatches.find((match) => match.id === id);

          const saveNewMatch = new Match(newMatch);
          saveNewMatch.save();
        }
      });
    });
  } catch (error) {
    console.log(error);
  }
}); 

// GET ALL MATCHES
router.get("/", async (req, res) => {
  try {
    const matches = await Match.find().populate("driverIDs");
    res.send(matches);
  } catch (error) {
    console.log(error);
  }
});

// GET SINGLE MATCH
router.get("/:id", async (req, res, next) => {
  try {
    const { id } = req.params;
    const singleMatch = await Match.findOne({
      _id: id,
    }).populate("driverIDs");
    if (!singleMatch) return next();
    return res.send(singleMatch);
  } catch (error) {
    console.log(error);
  }
});

// ADD MATCH
router.post("/", async (req, res) => {
  // Validation
  try {
    const newMatch = new Match(req.body);
    await newMatch.save();
    res.send(newMatch);
  } catch (error) {
    console.log(error);
    res.status(400).send("error, match not created");
  }
});

// UPDATE MATCH
router.put("/:id", authentication, async (req, res) => {
  try {
    const updatedMatch = await Match.findByIdAndUpdate(req.params.id, req.body);
    await updatedMatch.save();
    res.send(updatedMatch);
  } catch (error) {
    console.log(error);
  }
});
module.exports = router;
