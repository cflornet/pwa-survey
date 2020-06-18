var cache_name = 'APP-V12';
var db_version = 6;

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cache_name).then(function(cache) {
      return cache.addAll([
        'assets/js/script.js',
        'assets/js/write.js',
        'manifest.json',
        'sw.js',
        'header.php',
        'footer.php',
        'index.php',
        'write.php',
        'https://code.jquery.com/jquery-3.4.1.slim.min.js',
        'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js',
        'https://kit.fontawesome.com/a076d05399.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'assets/img/Feed.png',
        'assets/img/back.png',
        'assets/img/see.png',
        'assets/img/edit.png',
        'assets/img/see2.png',
        'assets/img/edit2.png',
        'assets/img/sv.jpg',
        'assets/img/read.png'
      ]);
    }).catch(function(error) {
      console.log(error);
    })
  );
});

self.addEventListener('activate', (e) => {
  e.waitUntil(
    caches.keys().then((keyList) => {
        return Promise.all(keyList.map((key) => {
          if(key !== cache_name) {
            return caches.delete(key); //Delete old cache
          }
      }));
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    fetch(event.request).then(function(response) {
      let clonedResponse = response.clone();

      if(event.request.method == 'GET') { // Only cache GET requests
        caches.open(cache_name).then(function(cache) {
          cache.put(event.request, clonedResponse);
        });
      }

      return response;
    })
    .catch(function() {
        return caches.match(event.request, {ignoreSearch: true});
    })
  )
});
