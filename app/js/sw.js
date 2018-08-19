var bestandenNaarCache = [ 
    'index.html',
    '/js/main.min.js',
    '/css/styles.min.css'
];


var statischeCache = 'mijncache1'; //je kan hier de naam van je cache zelf bepalen


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
