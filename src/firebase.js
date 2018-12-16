import firebase from 'firebase/app'
import 'firebase/firestore'

// Initialize Firebase
var config = {
    apiKey: "AIzaSyBzxzU0otHLRpYNm04NLbfosZ16rko8ums",
    authDomain: "fir-86cac.firebaseapp.com",
    databaseURL: "https://fir-86cac.firebaseio.com",
    projectId: "fir-86cac",
    storageBucket: "fir-86cac.appspot.com",
    messagingSenderId: "618984433812"
  };
  firebase.initializeApp(config);

  const db = firebase.firestore();
  db.settings({ timestampsInSnapshots: true})
  export default db