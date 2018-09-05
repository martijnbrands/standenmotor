var db = firebase.firestore();
db.settings({ timestampsInSnapshots: true });

var playerTable = document.querySelector("#player__table");
var driverTable = document.querySelector("#driver__table");

var form = document.querySelector("#player__form");

//Set season
function setSeason() {
	seasonValue = document.getElementById('season').value;

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

//Render player data
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

	db.collection( seasonValue + "/data/players/").doc(doc.id).update({
		points: pointsCount
	})
}


// Render driver data
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

	var team = document.createElement('p');
	team.setAttribute('class', 'team');
	team.textContent = doc.data().team;
	match.appendChild(team);

	var timestamp = doc.data().time.seconds;
	
	var matchDate = moment.unix(timestamp).format("DD-MM-YYYY");
	var date = document.createElement('p');
	date.setAttribute('class', 'date');
	date.textContent = matchDate
	match.appendChild(date);
	
	var matchTime = moment.unix(timestamp).format("HH:mm");
	var time = document.createElement('p');
	time.setAttribute('class', 'time');
	time.textContent = matchTime
	match.appendChild(time);

	li.appendChild(match);
	li.appendChild(driver);

	driverTable.appendChild(li);
}

// Getting drivers data
db.collection("drivers").orderBy('time', "asc").get().then(function (snapshot) {
	snapshot.docs.forEach(function (doc) {
		renderDrivers(doc);
	});
});
  