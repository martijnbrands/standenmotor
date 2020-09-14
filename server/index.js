const express = require('express');
const app = express();
const dotenv = require('dotenv');
const cors = require('cors');
const mongoose = require('mongoose');
const cookieParser = require('cookie-parser');
const path = require('path');
dotenv.config();

const PORT = process.env.PORT || 3000;


// Connect to Database
mongoose.connect(process.env.DATABASE_URI, { useNewUrlParser: true, useUnifiedTopology: true, useCreateIndex: true, useFindAndModify: false}, () => 
    console.log("Connected to database")
);

// Middeleware
app.use(cors())
app.use(express.json())
app.use(cookieParser())


// Import Routes
const authRoute = require('./routes/auth');
const playersRoute = require('./routes/players');
const matchesRoute = require('./routes/matches');

// Route Middlewares
app.use('/api/user', authRoute)
app.use('/api/players', playersRoute)
app.use('/api/matches', matchesRoute)

if(process.env.NODE_ENV === "production") {
    //here we are configuring dist to serve app files
    app.use('/', express.static(path.join(__dirname, '/public')))

    // this * route is to serve project on different page routes except root `/`
    app.get(/.*/, function (req, res) {
        res.sendFile(path.join(__dirname, '/public/index.html'))
    })
}


app.listen(PORT, () => console.log(`Server up and running on port ${PORT}`))

