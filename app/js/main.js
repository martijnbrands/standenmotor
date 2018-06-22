$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.tabs').tabs();
	$('select').formSelect();
  
});





// var deferredPrompt;

// window.addEventListener('beforeinstallprompt', function (e) {
//   // Prevent Chrome 67 and earlier from automatically showing the prompt
//   e.preventDefault();
//   // Stash the event so it can be triggered later.
//   deferredPrompt = e;
// });


// Saving Data
// form.addEventListener('submit' , (e) =>{
// 	e.preventDefault();
// 	db.collection('players').add({
// 		name: form.name.value,
// 		goals: form.goals.value,
// 		assists: form.assists.value
// 	});
// 	form.name.value = "";
// 	form.goals.value = "";
// 	form.assists.value = "";

// })

// window.addEventListener('load', function() {
//       var outputElement = document.getElementById('output');
//       navigator.serviceWorker.register('sw.js', { scope: './' })
//         .then(function(r) {
//           console.log('registered service worker');
//         })
//         .catch(function(whut) {
//           console.errlet db = firebase.firestore();