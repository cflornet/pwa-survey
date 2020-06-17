function cleanResponse(response) {
  const clonedResponse = response.clone();

  // Not all browsers support the Response.body stream, so fall back to reading
  // the entire body into memory as a blob.
  const bodyPromise = 'body' in clonedResponse ?
    Promise.resolve(clonedResponse.body) :
    clonedResponse.blob();

  return bodyPromise.then((body) => {
    // new Response() is happy when passed either a stream or a Blob.
    return new Response(body, {
      headers: clonedResponse.headers,
      status: clonedResponse.status,
      statusText: clonedResponse.statusText,
    });
  });
}

var cache_name = 'APP-V3';

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cache_name).then(function(cache) {
      return cache.addAll([
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
        'assets/img/back.png',
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
        cacheNames.filter(function(cacheName) {
          // Return true if you want to remove this cache,
          // but remember that caches are shared across
          // the whole origin
        }).map(function(cacheName) {
          return caches.delete(cacheName);
        })
      );
    })
  );
});


self.addEventListener('fetch', event => {
  event.respondWith(
    caches.open(cache_name)
      .then(cache => cache.match(event.request, {ignoreSearch: true}))
      .then(response => {
      return fetch(event.request) || response;
    })
  );
});