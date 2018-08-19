$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.tabs').tabs();
	$('select').formSelect();
});


if('serviceWorker' in navigator){
	navigator.serviceWorker
		.register("/sw.js")
		.then(function(){
			console.log("Service worker is registered!")
	})
}

