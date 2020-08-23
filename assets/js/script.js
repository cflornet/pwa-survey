let request = indexedDB.open("FeedBackDB", db_version);

request.onupgradeneeded = function(event) {
    let db = event.target.result;

    if(db.objectStoreNames.contains('requests'))    db.deleteObjectStore('requests');
    if(db.objectStoreNames.contains('activites'))    db.deleteObjectStore('activites');
    if(db.objectStoreNames.contains('dates'))    db.deleteObjectStore('dates');
    if(db.objectStoreNames.contains('groups'))    db.deleteObjectStore('groups');

    db.createObjectStore("requests", { autoIncrement : true });
    db.createObjectStore("activites", { autoIncrement : true });
    db.createObjectStore("dates", { autoIncrement : true });
    db.createObjectStore("groups", { autoIncrement : true });

    localStorage.setItem('usr_id', '');
    localStorage.setItem('usr_name', '');
    localStorage.setItem('usr_status', 0);

    window.location.href = window.location.origin;
}

request.onsuccess = function(event) {
    let db = event.target.result;

    let body = new FormData();
    body.append('action', 'test_online');
    fetch('ajax-post.php', {method: 'POST', body: body}).then(test_response => {

        //Execute cached requests
        let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

        getRequests.onsuccess = function(event) { //On get cached requests
            let result = event.target.result[0];

            if(Array.isArray(result) && result.length > 0) {
                let cachedRequests = result;

                if(!Array.isArray(cachedRequests))
                    cachedRequests = [];

                console.log(cachedRequests);

                cachedRequests.forEach(function(element) {
                    let formData = new FormData();

                    Object.keys(element).forEach(function(key) {
                        formData.append(key, element[key]);
                    });

                    let params = {
                        method: 'POST',
                        body: formData
                    }

                    fetch('ajax-post.php', params).then(response => { //Send the request 
                        
                    });
                });

                db.transaction(["requests"], "readwrite") //Clear the table
                    .objectStore("requests").clear();

                window.location.href = window.location.href;

            }
        }

    });
    
}

if(localStorage.getItem('usr_status') == 0 && window.location.pathname != '/' && window.location.pathname != '/index.php')
    window.location.freh = window.location.origin;

if(window.location.pathname == '/' || window.location.pathname == '/index.php') {
    let usr_status = localStorage.getItem('usr_status');


    if(usr_status > 0) {
        document.querySelector('#cnt_1').style.display = 'block';
        document.querySelector('#cnt_2').style.display = 'none';

        let selectDateForm = document.querySelector('form#selectDateForm');

        populateIndexDatesForm(selectDateForm);

        selectDateForm.addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            
            showDayActivity(document.getElementById('activities'), formData.get('fec'));
        });
    }
    else {
        document.querySelector('#cnt_1').style.display = 'none';
        document.querySelector('#cnt_2').style.display = 'block';

        let form = document.querySelector('#loginForm');

        form.addEventListener('submit', function(event) {
		
            event.preventDefault();
    
            login(this);         
        });
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

                    })
                });

            }
        });
    }
}

//----------------------------------------------



