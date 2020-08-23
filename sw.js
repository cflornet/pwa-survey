var cache_name = 'APP-V1';
var db_version = 27;

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cache_name).then(function(cache) {
      return cache.addAll([
        'assets/css/style.css',
        'assets/js/script.js',
        'assets/js/write.js',
        'assets/js/mod.js',
        'assets/js/del.js',
        'assets/js/logout.js',
        'assets/js/profile.js',
        'assets/js/summary.js',
        'assets/js/functions.js',
        'assets/js/index-min.js',
        'assets/js/typeahead.bundle.js',
        'manifest.json',
        'sw.js',
        'header.php',
        'footer.php',
        'index.php',
        'write.php',
        'logout.php',
        'profile.php',
        'mod.php',
        'del.php',
        'summary.php',
        'https://code.jquery.com/jquery-3.4.1.slim.min.js',
        'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js',
        'https://kit.fontawesome.com/a076d05399.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://use.fontawesome.com/releases/v5.7.1/css/all.css',
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

self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if(cacheName !== cache_name)
            return caches.delete(cacheName);
        })
      );
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
        if(event.request.method == 'GET')
          return caches.match(event.request, {ignoreSearch: true});

    })
  )
});

self.addEventListener('push', function(event) {
  let title = 'FeedBack';
                        
  let options = {
      body: "It's time to fill your activities",
      icon: "assets/img/icon/icon.png",
      vibrate: [200, 100, 200],
      tag: "daily-fill",
      showTrigger: new Date().getTime() + 15 * 1000
  };

  event.waitUntil(self.registration.showNotification(title, options));

});


self.addEventListener('notificationclick', function(event) {
  event.notification.close();

  event.waitUntil(
    clients.openWindow('https://developers.google.com/web/')
  );
});
