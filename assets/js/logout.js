localStorage.setItem('usr_id', '');
localStorage.setItem('usr_name', '');
localStorage.setItem('usr_status', 0);

let request = indexedDB.open("FeedBackDB", db_version);

request.onsuccess = function(event) {
    let db = event.target.result;

    db.transaction(["requests"], "readwrite")
    .objectStore("requests")
    .clear();

    db.transaction(["activites"], "readwrite")
    .objectStore("activites")
    .clear();

    db.transaction(["dates"], "readwrite")
    .objectStore("dates")
    .clear();

    db.transaction(["groups"], "readwrite")
    .objectStore("groups")
    .clear();

    window.location.href = window.location.origin;
}

