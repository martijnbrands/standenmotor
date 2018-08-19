//je kan hier de bestanden van je App Shell toevoegen
var bestandenNaarCache = [ 
    '/',
    '/index.html',
    '/js/main.min.js',
    '/css/style.min.css'
];


var statischeCache = 'de casche'; //je kan hier de naam van je cache zelf bepalen


self.addEventListener('install', function(event) {
  console.log('[Service Worker] Installing Service Worker ...', event);
  event.waitUntil(
  		caches.open(statischeCache) 
  			.then(function(cache){
  				console.log("precaching the app shell");
  				cache.addAll(bestandenNaarCache);
  			})
  	)
});




self.addEventListener('fetch', function(event) {
  console.log('[Service Worker] Fetching something ....', event);
  event.respondWith(
    //controleer of de fetch van het document in de cache zit
    caches.match(event.request)
        .then(function(response){
            //als dat zo is dan response naar document met dat bestand
            if(response){
                return response;
            } else {
                //niet in cache dan bestand van netwerk halen en
                //response naar het aanroepende document geven
                return fetch(event.request);
            }
        })
    );
});




//de onderstaande code zorgt dat oude cache wordt verwijderd 

self.addEventListener('activate', function(event) {
  console.log('[Service Worker] Activating new service worker...');

  var dezeCacheBewaren = [statischeCache];

  event.waitUntil(
    caches.keys().then(function(cacheNamen) {
      return Promise.all(
        cacheNamen.map(function(cacheNaam) {
          if (dezeCacheBewaren.indexOf(cacheNaam) === -1) {
            return caches.delete(cacheNaam);
          }
        })
      );
    })
  );
});
