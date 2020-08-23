async function getDates(usr_id) {
    let formData = new FormData();
    formData.append('action', 'get_user_dates');
    formData.append('usr_id', usr_id);

    let params = {
        method: 'POST',
        body: formData
    };

    let response = await fetch('ajax-post.php', params);
    let responseObject = await response.json();

    //Store in cache
    let request = await idb.openDB("FeedBackDB", db_version);

    let transaction = request.transaction('dates', 'readwrite');
    let store = transaction.objectStore('dates');

    await store.clear();
    
    responseObject.forEach(async function(value) {
        await store.add(value);
    });

    await transaction.complete;

    return true;

}

async function getActivities(usr_id) {
    let formData = new FormData();
    formData.append('action', 'get_user_activities');
    formData.append('usr_id', usr_id);

    let params = {
        method: 'POST',
        body: formData
    };

    let response = await fetch('ajax-post.php', params);
    let responseObject = await response.json();

    //Store in cache
    let request = await idb.openDB("FeedBackDB", db_version);

    let transaction = request.transaction('activites', 'readwrite');
    let store = transaction.objectStore('activites');

    await store.clear();
    
    responseObject.forEach(async function(value) {
        await store.add(value);
    });

    await transaction.complete;

    return true;

}

async function getGroups() {
    let formData = new FormData();
    formData.append('action', 'get_groups');

    let params = {
        method: 'POST',
        body: formData
    };

    let response = await fetch('ajax-post.php', params);
    let responseObject = await response.json();

    //Store in cache
    let request = await idb.openDB("FeedBackDB", db_version);

    let transaction = request.transaction('groups', 'readwrite');
    let store = transaction.objectStore('groups');

    await store.clear();
    
    responseObject.forEach(async function(value) {
        await store.add(value);
    });

    await transaction.complete;

    return true;
    
}

function deleteActivity(activity_id) {
    let requestBody = new FormData();
    requestBody.append('didf_id', activity_id);
    requestBody.append('action', 'delete_activity');


    let params = {
        method: 'POST',
        body: requestBody
    }

    fetch('ajax-post.php', params).then(response => { //Send the request 
        response.text().then(res => { 
            window.location.href = window.location.origin;
        });
    })
    .catch(err => { //If it fails, cache the request to execute it later

        let dbOpenRequest = indexedDB.open("FeedBackDB", db_version);
        var db;

        dbOpenRequest.onsuccess = function(openEvent) { //On DB opened
            db = openEvent.target.result;
            
            let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

            getRequests.onsuccess = function(event) { //On get cached requests
                let cachedRequests = event.target.result[0];

                if(!Array.isArray(cachedRequests))
                    cachedRequests = [];

                let obj = {};

                for(var pair of requestBody.entries()) {
                    obj[pair[0]] = pair[1];
                }
                cachedRequests.push(obj); //Add the request to the cachedRequests

                db.transaction(["requests"], "readwrite") //Clear the table
                    .objectStore("requests").clear();

                db.transaction(["requests"], "readwrite") //Add the cachedRequests to the DB
                    .objectStore("requests")
                    .add(cachedRequests);

                window.location.href = window.location.origin;
            }

            
        }
        
    });
}

function populateIndexDatesForm(form_element) {
    let request = indexedDB.open("FeedBackDB", db_version);
    var db;

    request.onsuccess = function(event) {
        db = event.target.result;
        
        let dates = db.transaction(["dates"], "readwrite")
        .objectStore("dates")
        .getAll();

        let options = '';

        dates.onsuccess = function(event) {
            let result = event.target.result;

            result.forEach(date => {
                let date_object = new Date(date);
                options += '<option value="'+date+'">'+date_object.toLocaleDateString('en-GB', {weekday: 'long', day: 'numeric', month: 'long'})+'</option>';
            });

            form_element.querySelector('#select_date').innerHTML = options;
        }
    }
    
}

function showDayActivity(activities_element, date) {
    let request = indexedDB.open("FeedBackDB", db_version);
    var db;

    request.onsuccess = function(event) {
        db = event.target.result;

        let activities = db.transaction(["activites"], "readwrite")
        .objectStore("activites")
        .getAll();

        activities.onsuccess = function(event) {
            let result = event.target.result;

            let html_content = '';

            result.forEach(activity => {

                let activity_date = new Date(activity.date);
                date = new Date(date);

                let milliseconds = activity_date.getTime() - date.getTime(); //Both dates have same hour so if milliseconds == 0, the day is the same

                if(milliseconds == 0) {

                    let header_content = '';

                    let start_date = new Date(activity.start_hour);
                    let end_date = new Date(activity.end_hour);

                    let interval = Date.now() - start_date.getTime(); //In milliseconds

                    let intervalDay = Math.round(interval / (1000 * 60 * 60 * 24));

                    if(intervalDay < 3) {
                        header_content = start_date.toLocaleTimeString('en-GB')+ ' to '+end_date.toLocaleTimeString('en-GB')
                                        +' - <a href="mod.php?didf_id='+activity.id+'" style="color:#fff">Modify</a> / <a href="del.php?didf_id='+activity.id+'" style="color:#fff">Delete</a>';
                    }
                    else {
                        header_content = start_date.toLocaleTimeString('en-GB')+ ' to '+end_date.toLocaleTimeString('en-GB');
                    }

                    html_content += '<hr width="100%">'
                                        +'<div class="card">'
                                            +'<div class="card-header" style="background-color:#1B5082;color:#fff">'
                                                +header_content
                                            +'</div>'

                                            +'<div class=card-body>'
                                                +'<div class="row">'
                                                    +'<div class="col">'
                                                        +activity.category+' at '+activity.location
                                                    +'</div>'
                                                +'</div>'
                                                +'&nbsp;'
                                                +'<div class="row">'
                                                    +'<div class="col">'
                                                        +'<img src="assets/img/read.png" class="img-fluid" alt="Responsive image">'
                                                    +'</div>'

                                                    +'<div class="col">'
                                                            +activity.description
                                                    +'</div>'
                                                +'</div>'												
                                            +'</div>'

                                        +'</div>';

                }
            });

            activities_element.innerHTML = html_content;
        }

    }
}

async function login(form_element) {
    let requestBody = new FormData(form_element);
    requestBody.append('action', 'login');

    let params = {
        method: 'POST',
        body: requestBody
    }

    fetch('ajax-post.php', params).then(response => { //Send the request 
        response.json().then(async function(res) { 
            localStorage.setItem('usr_id', res.usr_id);
            localStorage.setItem('usr_status', res.usr_status);
            localStorage.setItem('usr_name', res.usr_name);

            if(res.usr_id == '')
                alert('Erreur');
            else {
                let dates_resolve = await getDates(localStorage.getItem('usr_id'));
                let activities_resolve = await getActivities(localStorage.getItem('usr_id'));
                let groups_resolve = await getGroups();

                window.location.href = window.location.href;
            }
        });
    });
}

function initTypeAheads() {
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    $('#the-activities .typeahead').typeahead(
    {
        hint: true,
        highlight: true,
        minLength: 0
    },
    {
        name: 'activities',
        source: substringMatcher(activities)
    });

    $('#the-locations .typeahead').typeahead(
    {
        hint: true,
        highlight: true,
        minLength: 0
    },
    {
        name: 'locations',
        source: substringMatcher(locations)
    });
}

function populateAddEntryForm(form_element) {
    let request = indexedDB.open("FeedBackDB", db_version);
    var db;

    //Date and group field
    request.onsuccess = function(event) {
        db = event.target.result;
        
        //Date
        let dates = db.transaction(["dates"], "readwrite")
        .objectStore("dates")
        .getAll();

        dates.onsuccess = function(event) {
            let result = event.target.result;

            let options = '';

            result.forEach(date => {
                let date_object = new Date(date);
                let interval = Math.ceil((date_object.getTime() - Date.now()) / (1000 * 60 * 60 * 24));

                let now = new Date();



                let selected = date_object.getDay() == now.getDay() && date_object.getMonth() == now.getMonth() && date_object.getFullYear() == now.getFullYear() ? ' selected' : '';

                if(parseInt(interval) >= 0)
                    options += '<option value="'+date+'"'+selected+'>'+date_object.toLocaleDateString('en-GB', {weekday: 'long', day: 'numeric', month: 'long'})+'</option>';
                else
                    options += '<option value="'+date+'" style="background-color:red;color:#fff;">'+date_object.toLocaleDateString('en-GB', {weekday: 'long', day: 'numeric', month: 'long'})+'</option>';
            });

            form_element.querySelector('#select_date').innerHTML = options;
        }

        //Group
        let groups_request = db.transaction(["groups"], "readwrite").objectStore("groups").getAll();

        groups_request.onsuccess = function(event) {
            let result = event.target.result;

            let options = '';

            result.forEach(group => {
                options += '<option value="'+group.id+'">'+group.name+'</option>';
            });

            form_element.querySelector('#select_group').innerHTML = options;
        }
    }

    //Hours fields
    form_element.querySelectorAll('#hours_row select.hour').forEach(element => {
        for(let i = 0; i <= 23; i++) {
            let n = i;
            if(i < 10)	n = '0'+i;

            element.innerHTML += '<option value="'+n+'">'+n+'</option>';
        }
    });

    form_element.querySelectorAll('#hours_row select.minutes').forEach(element => {
        for(let i = 0; i <= 59; i++) {
            let n = i;
            if(i < 10)	n = '0'+i;

            element.innerHTML += '<option value="'+n+'">'+n+'</option>';
        }
    });

    //Before init, take the ones from cache
    initTypeAheads();
}

function submitAddEntry(form) {
    let requestBody = new FormData(form);
    requestBody.append('usr_id', localStorage.getItem('usr_id'));
    requestBody.append('action', 'add_activity');


    let params = {
        method: 'POST',
        body: requestBody
    }

    fetch('ajax-post.php', params).then(response => { //Send the request 
        response.text().then(res => { 
            if(res != '') {
                alert(res);
            }
            else {
                window.location.href = window.location.origin;
            }
        });
    })
    .catch(err => { //If it fails, cache the request to execute it later

        let dbOpenRequest = indexedDB.open("FeedBackDB", db_version);
        var db;

        dbOpenRequest.onsuccess = function(openEvent) { //On DB opened
            db = openEvent.target.result;
            
            let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

            getRequests.onsuccess = function(event) { //On get cached requests
                let cachedRequests = event.target.result[0];

                if(!Array.isArray(cachedRequests))
                    cachedRequests = [];

                let obj = {};

                for(var pair of requestBody.entries()) {
                    obj[pair[0]] = pair[1];
                }
                cachedRequests.push(obj); //Add the request to the cachedRequests

                db.transaction(["requests"], "readwrite") //Clear the table
                    .objectStore("requests").clear();

                db.transaction(["requests"], "readwrite") //Add the cachedRequests to the DB
                    .objectStore("requests")
                    .add(cachedRequests);

                window.location.href = window.location.origin;
            }

            
        }
        
    });
}

function validateHour()
{
    v_hoi = document.getElementById('hoi').value;
    v_mii = document.getElementById('mii').value;
    v_hof = document.getElementById('hof').value;
    v_mif = document.getElementById('mif').value;
    if(v_hoi > v_hof)
    {
        alert('Warning: the end of the activity seems to be the next day?');
    }
    if(v_hoi == v_hof)
    {
        if(v_mii > v_mif)
        {
            alert('the initial hour is equal than the final and the initial minutes are greater than the final minutes. Are you sure that info is valid?');
        }
    }
}

function populateModifyEntryForm(form_element, id) {
    let request = indexedDB.open("FeedBackDB", db_version);
    var db;

    //Date and group field
    request.onsuccess = function(event) {
        db = event.target.result;
        
        //Date
        let requestActivities = db.transaction(["activites"], "readwrite")
        .objectStore("activites")
        .getAll();

        requestActivities.onsuccess = function(event) {
            let result = event.target.result;

            let options = '';

            result.forEach(activity => {
                if(activity.id == id) {
                    form_element.querySelector('#id_field').value = activity.id;
                    form_element.querySelector('#date_field').value = activity.date;
                    form_element.querySelector('#activity_field').value = activity.category;
                    form_element.querySelector('#location_field').value = activity.location;
                    form_element.querySelector('#description_field').value = activity.description;
                }
            });

        }

    }

    //Before init, take the ones from cache
    initTypeAheads();
}

function submitModifyEntry(form) {
    let requestBody = new FormData(form);
    requestBody.append('usr_id', localStorage.getItem('usr_id'));
    requestBody.append('action', 'modify_activity');


    let params = {
        method: 'POST',
        body: requestBody
    }

    fetch('ajax-post.php', params).then(response => { //Send the request 
        response.text().then(res => { 
            window.location.href = window.location.origin;
        });
    })
    .catch(err => { //If it fails, cache the request to execute it later

        let dbOpenRequest = indexedDB.open("FeedBackDB", db_version);
        var db;

        dbOpenRequest.onsuccess = function(openEvent) { //On DB opened
            db = openEvent.target.result;
            
            let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

            getRequests.onsuccess = function(event) { //On get cached requests
                let cachedRequests = event.target.result[0];

                if(!Array.isArray(cachedRequests))
                    cachedRequests = [];

                let obj = {};

                for(var pair of requestBody.entries()) {
                    obj[pair[0]] = pair[1];
                }
                cachedRequests.push(obj); //Add the request to the cachedRequests

                db.transaction(["requests"], "readwrite") //Clear the table
                    .objectStore("requests").clear();

                db.transaction(["requests"], "readwrite") //Add the cachedRequests to the DB
                    .objectStore("requests")
                    .add(cachedRequests);

                window.location.href = window.location.origin;
            }

            
        }
        
    });
}

function populateSummaryForm(form_element) {
    let request = indexedDB.open("FeedBackDB", db_version);
    var db;

    //Date and group field
    request.onsuccess = function(event) {
        db = event.target.result;
        
        //Date
        let dates = db.transaction(["dates"], "readwrite")
        .objectStore("dates")
        .getAll();

        dates.onsuccess = function(event) {
            let result = event.target.result;

            let options = '';

            result.forEach(date => {
                let date_object = new Date(date);
                let interval = Math.ceil((date_object.getTime() - Date.now()) / (1000 * 60 * 60 * 24));

                let now = new Date();



                let selected = date_object.getDay() == now.getDay() && date_object.getMonth() == now.getMonth() && date_object.getFullYear() == now.getFullYear() ? ' selected' : '';

                options += '<option value="'+date+'"'+selected+'>'+date_object.toLocaleDateString('en-GB', {weekday: 'long', day: 'numeric', month: 'long'})+'</option>';
            });

            form_element.querySelector('#select_date').innerHTML = options;
        }

    }

}

function submitSummary(form) {
    let requestBody = new FormData(form);
    requestBody.append('usr_id', localStorage.getItem('usr_id'));
    requestBody.append('action', 'add_summary');


    let params = {
        method: 'POST',
        body: requestBody
    }

    fetch('ajax-post.php', params).then(response => { //Send the request 
        response.text().then(res => { 
            if(res != '') {
                alert(res);
            }
            else {
                window.location.href = window.location.origin;
            }
        });
    })
    .catch(err => { //If it fails, cache the request to execute it later

        let dbOpenRequest = indexedDB.open("FeedBackDB", db_version);
        var db;

        dbOpenRequest.onsuccess = function(openEvent) { //On DB opened
            db = openEvent.target.result;
            
            let getRequests = db.transaction(["requests"], "readwrite")
                        .objectStore("requests")
                        .getAll();

            getRequests.onsuccess = function(event) { //On get cached requests
                let cachedRequests = event.target.result[0];

                if(!Array.isArray(cachedRequests))
                    cachedRequests = [];

                let obj = {};

                for(var pair of requestBody.entries()) {
                    obj[pair[0]] = pair[1];
                }
                cachedRequests.push(obj); //Add the request to the cachedRequests

                db.transaction(["requests"], "readwrite") //Clear the table
                    .objectStore("requests").clear();

                db.transaction(["requests"], "readwrite") //Add the cachedRequests to the DB
                    .objectStore("requests")
                    .add(cachedRequests);

                window.location.href = window.location.origin;
            }

            
        }
        
    });
}

if(localStorage.getItem('usr_status') > 0) {
    if(window.location.pathname != '/del.php') {
        getDates(localStorage.getItem('usr_id'));
        getActivities(localStorage.getItem('usr_id'));
        getGroups();
    }
}
