// In your index.js 

const firestoreService = require('firestore-export-import');
const serviceAccount = require('./serviceAccountKey.json');

// Initiate Firebase App
firestoreService.initializeApp(serviceAccount, 'https://fir-86cac.firebaseio.com');

// Start exporting your data
let result = firestoreService.backup('2017-2018', 'players');
result.then(data => console.log(JSON.stringify(data)))