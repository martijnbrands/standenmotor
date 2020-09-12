const express = require('express');
const app = express();
const dotenv = require('dotenv');
const cors = require('cors');
const mongoose = require('mongoose');
const cookieParser = require('cookie-parser');
const path = require('path');
dotenv.config();

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

app.use(express.static(path.join(__dirname, "public")))

const port = process.env.SERVER_PORT || 5000;
app.listen(port, () => console.log(`Server up and running on port ${port}`))

