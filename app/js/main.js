let db = firebase.firestore();

db.settings({timestampsInSnapshots: true});

const messaging = firebase.messaging();

const playerTable = document.querySelector("#player__table");
const driverTable = document.querySelector("#driver__table");

const form = document.querySelector("#player__form");


function renderPlayers2017(doc){
	let tr = document.createElement('tr');

	let name = document.createElement('td');
	name.setAttribute('class', 'name');
	
	let goals = document.createElement('td');
	goals.setAttribute('class', 'goals');

	let assists = document.createElement('td');
	assists.setAttribute('class', 'assists')
	;
	let points = document.createElement('td');
	points.setAttribute('class', 'points');

	let goalsCount = doc.data().goals;
	let assistsCount = doc.data().assists;

	let goalsToInt = parseInt(goalsCount);
	let assistsToInt = parseInt(assistsCount);

	let pointsCount = goalsToInt * 2 + assistsToInt;

	tr.setAttribute('data-id', doc.id);

	name.textContent = doc.data().name;
	goals.textContent = doc.data().goals;
	assists.textContent = doc.data().assists;
	points.textContent = pointsCount;

	tr.appendChild(name);
	tr.appendChild(goals);
	tr.appendChild(assists);
	tr.appendChild(points);

	playerTable.appendChild(tr);

	db.collection("/2017-2018/data/players/").doc(doc.id).update({
		points: pointsCount
	})

}

function renderPlayers2016(doc){
	let tr = document.createElement('tr');

	let name = document.createElement('td');
	name.setAttribute('class', 'name');
	
	let goals = document.createElement('td');
	goals.setAttribute('class', 'goals');

	let assists = document.createElement('td');
	assists.setAttribute('class', 'assists')
	;
	let points = document.createElement('td');
	points.setAttribute('class', 'points');

	let goalsCount = doc.data().goals;
	let assistsCount = doc.data().assists;

	let goalsToInt = parseInt(goalsCount);
	let assistsToInt = parseInt(assistsCount);

	let pointsCount = goalsToInt * 2 + assistsToInt;

	tr.setAttribute('data-id', doc.id);

	name.textContent = doc.data().name;
	goals.textContent = doc.data().goals;
	assists.textContent = doc.data().assists;
	points.textContent = pointsCount;

	tr.appendChild(name);
	tr.appendChild(goals);
	tr.appendChild(assists);
	tr.appendChild(points);

	playerTable.appendChild(tr);

	db.collection("/2016-2017/data/players/").doc(doc.id).update({
		points: pointsCount
	})

}



function renderDrivers(doc) {

	let li = document.createElement('li');

	let match = document.createElement('div');
	match.setAttribute('class', 'collapsible-header');

	let driver = document.createElement('div');
	driver.setAttribute('class', 'collapsible-body');
	
	li.setAttribute('data-id', doc.id);

	

	// var timestamp = doc.data().datetime.toString();
	// console.log(timestamp);
	 

	for (var i = 0, len = doc.data().driver.length; i < len; i++) {
		let person = document.createElement('span');
	  	person.textContent = doc.data().driver[i];
	  	driver.appendChild(person);

	};

	// var utcSeconds = doc.data().tijd.seconds;
	// var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
	// d.setUTCSeconds(utcSeconds);
	// console.log(d);

	// tijd.textContent = d;
	// console.log(doc.data().tijd.seconds);

	match.textContent = doc.data().match;
	
	li.appendChild(match);
	li.appendChild(driver);
	
	driverTable.appendChild(li);
}

// Getting players data
// db.collection("players").orderBy('points', "desc").get().then((snapshot) =>{
// 	snapshot.docs.forEach(doc =>{
// 		renderPlayers(doc);
// 	})
// })

db.collection("2017-2018/data/players").orderBy('points', "desc").get().then((snapshot) =>{
	snapshot.docs.forEach(doc =>{
		renderPlayers2017(doc);
	})
})
// Getting drivers data
db.collection("2017-2018/data/drivers").get().then((snapshot) =>{

	snapshot.docs.forEach(doc =>{
		renderDrivers(doc);
	})
})




$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.tabs').tabs();
	$('select').formSelect();
});


firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
  } else {
    
  }
});

function setSeason() {
	var seasonValue = document.getElementById('season').value;
	$("#player__table").html("");
	if(seasonValue == 1){
		db.collection("2017-2018/data/players").orderBy('points', "desc").get().then((snapshot) =>{
			snapshot.docs.forEach(doc =>{
				renderPlayers2017(doc);
			})
		})
	}else if (seasonValue == 2) {
		db.collection("2016-2017/data/players").orderBy('points', "desc").get().then((snapshot) =>{
			snapshot.docs.forEach(doc =>{
				renderPlayers2016(doc);
			})
		})
	}

}




//Realtime data
// db.collection("players").orderBy('goals', "desc").onSnapshot(snapshot =>{
// 	let changes = snapshot.docChanges();

// 	changes.forEach(change =>{
// 		if (change.type == 'added'){
// 			renderPlayers(change.doc);
// 		}
// 	})
// })


	
// Saving Data
form.addEventListener('submit' , (e) =>{
	e.preventDefault();
	db.collection('players').add({
		name: form.name.value,
		goals: form.goals.value,
		assists: form.assists.value
	});
	form.name.value = "";
	form.goals.value = "";
	form.assists.value = "";

})

window.addEventListener('load', function() {
      var outputElement = document.getElementById('output');
      navigator.serviceWorker.register('sw.js', { scope: './' })
        .then(function(r) {
          console.log('registered service worker');
        })
        .catch(function(whut) {
          console.error('uh oh... ');
          console.error(whut);
        });
       
      window.addEventListener('beforeinstallprompt', function(e) {
        outputElement.textContent = 'beforeinstallprompt Event fired';
      });
    });
