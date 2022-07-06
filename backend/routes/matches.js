const router = require("express").Router();
const authentication = require("../middelware/authentication");
const Match = require("../models/Match");
const cron = require("node-cron");
const axios = require("axios");

cron.schedule("*/20 * * * * *", async () => {
  let apiMatches = [
    {
      matchId: "12345",
      matchDateTime: Date.now(),
      homeTeam: "Oss",
      awayTeam: "Rosmalen",
    },
    {
      matchId: "67890",
      matchDateTime: Date.now(),
      homeTeam: "Uden",
      awayTeam: "Venlo",
    },
  ];
  const matches = await Match.find().populate("driverIDs")
  if (!matches.length) {
    // Add API matches if DB is empty
    apiMatches.forEach(async (apiMatch) => {
      const newMatch = new Match(apiMatch);
      await newMatch.save();
    });
  } else {
    for (let i = 0; i < apiMatches.length; i++) {
       console.log(apiMatches[i].matchId)
       console.log("____")
       console.log(matches)
      }
    }
    // for await (const apiMatch of apiMatches) {
    //   console.log(apiMatch.matchId);
    //   console.log("_______")
    //   matches.map(dbMatch => {
    //     return dbMatch.matchId
    //   }).find( async (dbMatch) => {
    //     console.log(dbMatch)
    //   })
    //   matches.filter(async (dbMatch) => {
    //     console.log(dbMatch.matchId)
    //     console.log("________________")
    //     if (dbMatch.matchId === apiMatch.matchId) {
    //         console.log("gevonden")
    //         return
    //     }
    //     else{
    //         console.log("Niet gevonden")
    //         return
    //     }
        //         // Check of de wedstrijd bestaat
        //         console.log(dbMatch.matchId, apiMatch.matchId)
        //         if (dbMatch.matchId === apiMatch.matchId) {
        //           // Check of de datum of tijd is gewijzigd
        //           if (dbMatch.matchDateTime !== apiMatch.matchDateTime) {
        //             console.log("Update de datum");
        //             const updatedMatch = await Match.findByIdAndUpdate(dbMatch, {
        //               matchDateTime: apiMatch.matchDateTime,
        //             });
        //             await updatedMatch.save();
        //           }
        //           console.log("Wedstrijd bestaat al in DB");
        //           return true;
        //         }
        //         console.log("Wedstrijd bestaat nog niet in DB");
        //         // const newMatch = new Match(apiMatch);
        //         // await newMatch.save();
        //         console.log("Nieuwe wedstrijd aangemaakt");
        //         return false;
    //   });
    // }
    //     apiMatches.forEach(async (apiMatch) => {
    //       matches.find(async (dbMatch) => {
    //         // Check of de wedstrijd bestaat
    //         console.log(dbMatch.matchId, apiMatch.matchId)
    //         if (dbMatch.matchId === apiMatch.matchId) {
    //           // Check of de datum of tijd is gewijzigd
    //           if (dbMatch.matchDateTime !== apiMatch.matchDateTime) {
    //             console.log("Update de datum");
    //             const updatedMatch = await Match.findByIdAndUpdate(dbMatch, {
    //               matchDateTime: apiMatch.matchDateTime,
    //             });
    //             await updatedMatch.save();
    //           }
    //           console.log("Wedstrijd bestaat al in DB");
    //           return true;
    //         }
    //         console.log("Wedstrijd bestaat nog niet in DB");
    //         // const newMatch = new Match(apiMatch);
    //         // await newMatch.save();
    //         console.log("Nieuwe wedstrijd aangemaakt");
    //         return false;
    //       });
    //     });
//   }
});

// Haal API Matches op
// Haal dan de database matches op
// Loop over de database matches en kijk of de westrijd id bestaat
// zo ja kijk of de API tijd anders is dan de DB tijd
// zo ja update de tijd
// bestaat de API match niet in de DB maak er dan een aan.

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
