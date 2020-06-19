if(window.location.pathname == '/' || window.location.pathname == '/index.php') {
    let usr_status = localStorage.getItem('usr_status');


    if(usr_status > 0) {
        document.querySelector('#cnt_1').style.display = 'block';
        document.querySelector('#cnt_2').style.display = 'none';

        let selectDateForm = document.querySelector('form#selectDateForm');
        let formData = new FormData();

        formData.append('action', 'get_dates');
        formData.append('usr_id', localStorage.getItem('usr_id'));

        let params = {
            method: 'POST',
            body: formData
        };

        fetch('ajax-write.php', params).then(response => { //Get available dates 
            response.text().then(content => {
                selectDateForm.innerHTML = content; //Echo form

                let request = indexedDB.open("FeedBackDB", db_version);
                var db;

                request.onsuccess = function(event) {
                    db = event.target.result;
                    
                    let deleteRequest = db.transaction(["get_dates"], "readwrite")
                                            .objectStore("get_dates").clear();

                    db.transaction(["get_dates"], "readwrite")
                    .objectStore("get_dates")
                    .add({
                        'date': new Date().toString(),
                        'content': content
                    });
                }

            });

            
        })
        .catch(err => { //IF the request fails (probably because no Internet), get the result from cache
            let request = indexedDB.open("FeedBackDB", db_version);
            var db;

            request.onsuccess = function(event) {
                db = event.target.result;

                let dates = db.transaction(["get_dates"], "readwrite")
                .objectStore("get_dates")
                .getAll();

                dates.onsuccess = function(event) {
                    let result = event.target.result;

                    selectDateForm.innerHTML = result[0].content; //Echo form
                    console.log(result);
                }

            }
        });
    }
    else {
        document.querySelector('#cnt_1').style.display = 'none';
        document.querySelector('#cnt_2').style.display = 'block';
    }


    // ----------------------------------------------------------------


    var container = document.getElementsByClassName("modal-body")[0];
    var emptyField = false;

    container.onkeydown = function(e) {
        let target = e.srcElement || e.target;
        let myLength = target.value.length;

        if(myLength === 0 && (e.keyCode == 8 || e.keyCode == 46)) { //On Backspace or delete press
            emptyField = true;
        }
    }
    container.onkeyup = function(e) 
    {
        let target = e.srcElement || e.target;
        let myLength = target.value.length;
        
        let inputName = target.attributes["name"].value;
        let inputNumber = inputName.substr(3);

        if (myLength >= 1) 
        {
            let nextNumber = parseInt(inputNumber)+1;

            let next = container.querySelector('input[name="cod'+nextNumber+'"]');
            
            if(next) {
                next.focus();
            }
        }
        
        // Move to previous field if empty (user pressed backspace)
        else if (myLength === 0 && emptyField) 
        {
            let previousNumber = parseInt(inputNumber)-1;

            let previous = container.querySelector('input[name="cod'+previousNumber+'"]');
            
            if(previous) {
                previous.focus();
            }

        }
        
        emptyField = false;
    }

    if ('serviceWorker' in navigator)
    {
        navigator.serviceWorker.register('sw.js')
            .then(function(reg)
            {
                console.log("SW Registered.");
                /*if ('SyncManager' in window) {
                    reg.sync.register('sync-diary');
                    console.log('Sync Registered');
                }*/
            }).catch(function(err) 
            {
                console.log("SW Not Registered: ", err)
            });      	
    }

    if('serviceWorker' in navigator && 'PushManager' in window) {
        Notification.requestPermission().then(function(result) {
            if(result === 'granted') {

                navigator.serviceWorker.ready.then(function(reg) {
                    reg.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: 'BKH2DEMO8OQOnevRZtN2GecXNGegk42XiUX1dHEoUxd6PQwRw8BGvPgQQV1hm-DspVePisdm1WPKLrwPIab0x4E'
                    }).then(function(pushSubscription) {

                        console.log(pushSubscription);
                        console.log(JSON.stringify(pushSubscription));

                    })
                });

            }
        });
    }
}

//----------------------------------------------

let request = indexedDB.open("FeedBackDB", db_version);

request.onupgradeneeded = function(event) {
    let db = event.target.result;

    db.createObjectStore("get_dates", { autoIncrement : true });
    db.createObjectStore("get_write_form", { autoIncrement : true });
    db.createObjectStore("requests", { autoIncrement : true });
}

request.onsuccess = function(event) {
    let db = event.target.result;

    let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

    getRequests.onsuccess = function(event) { //On get cached requests
        let result = event.target.result;

        if(Array.isArray(result) && result.length > 0) {
            let cachedRequests = result[0].content;
            
            if(cachedRequests !== undefined)
                cachedRequests = JSON.parse(cachedRequests);

            if(!Array.isArray(cachedRequests))
                cachedRequests = [];

            cachedRequests.forEach(function(element) {
                let formData = new FormData();

                Object.keys(element).forEach(function(key) {
                    formData.append(key, element[key]);
                });

                let params = {
                    method: 'POST',
                    body: formData
                }

                fetch('ajax-write.php', params).then(response => { //Send the request 
                    response.text().then(res => { 
                        console.log(res); 
                    });
                });
            });

            db.transaction(["requests"], "readwrite") //Clear the table
                .objectStore("requests").clear();

        }
    }
}

