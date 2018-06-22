
var db = firebase.firestore();



db.settings({ timestampsInSnapshots: true });

var playerTable = document.querySelector("#player__table");
var driverTable = document.querySelector("#driver__table");

var form = document.querySelector("#player__form");

function setSeason() {
	var seasonValue = document.getElementById('season').value;

	$("#player__table").html("");

	if (seasonValue == 1) {
		seasonValue = "2018-2019";
		db.collection(seasonValue + "/data/players").orderBy('points', "desc").get().then(function (snapshot) {
			snapshot.docs.forEach(function (doc) {
				renderPlayers(doc);
			});
		});
	} else if (seasonValue == 2) {
		seasonValue = "2017-2018";
		db.collection(seasonValue + "/data/players").orderBy('points', "desc").get().then(function (snapshot) {
			snapshot.docs.forEach(function (doc) {
				renderPlayers(doc);
			});
		});
	} else if (seasonValue == 3) {
		seasonValue = "2016-2017";
		db.collection(seasonValue + "/data/players").orderBy('points', "desc").get().then(function (snapshot) {
			snapshot.docs.forEach(function (doc) {
				renderPlayers(doc);
			});
		});
	} 
}

function renderPlayers(doc) {

	var tr = document.createElement('tr');

	var name = document.createElement('td');
	name.setAttribute('class', 'name');

	var goals = document.createElement('td');
	goals.setAttribute('class', 'goals');

	var assists = document.createElement('td');
	assists.setAttribute('class', 'assists');
	var points = document.createElement('td');
	points.setAttribute('class', 'points');

	var goalsCount = doc.data().goals;
	var assistsCount = doc.data().assists;

	var goalsToInt = parseInt(goalsCount);
	var assistsToInt = parseInt(assistsCount);

	var pointsCount = goalsToInt * 2 + assistsToInt;

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

	// db.collection("2017-2018/data/players").doc(doc.id).update({
	// 	points: pointsCount
	// })
}

function renderDrivers(doc) {

	var li = document.createElement('li');

	var match = document.createElement('div');
	match.setAttribute('class', 'collapsible-header');

	var driver = document.createElement('div');
	driver.setAttribute('class', 'collapsible-body');

	li.setAttribute('data-id', doc.id);

	for (var i = 0, len = doc.data().driver.length; i < len; i++) {
		var person = document.createElement('span');
		person.textContent = doc.data().driver[i];
		driver.appendChild(person);
	};

	for (var i = 0, len = doc.data().match.length; i < len; i++) {
		var clubs = document.createElement('span');
		clubs.setAttribute('class', 'team');

		clubs.textContent = doc.data().match[i];
		match.appendChild(clubs);
	};

	// var utcSeconds = doc.data().tijd.seconds;
	// var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
	// d.setUTCSeconds(utcSeconds);
	// console.log(d);

	// tijd.textContent = d;
	// console.log(doc.data().tijd.seconds);

	// match.textContent = doc.data().match;

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

db.collection("2017-2018/data/players").orderBy('points', "desc").get().then(function (snapshot) {
	snapshot.docs.forEach(function (doc) {
		renderPlayers(doc);
	});
});

// Getting drivers data
db.collection("2017-2018/data/drivers").get().then(function (snapshot) {

	snapshot.docs.forEach(function (doc) {
		renderDrivers(doc);
	});
});

//Realtime data
// db.collection("players").orderBy('goals', "desc").onSnapshot(snapshot =>{
// 	let changes = snapshot.docChanges();

// 	changes.forEach(change =>{
// 		if (change.type == 'added'){
// 			renderPlayers(change.doc);
// 		}
// 	})
// })