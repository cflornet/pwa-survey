if(window.location.pathname == '/write.php') {
    function validateHour()
	{
		v_hoi = document.getElementById('hoi').value;
		v_mii = document.getElementById('mii').value;
		v_hof = document.getElementById('hof').value;
		v_mif = document.getElementById('mif').value;
		if(v_hoi > v_hof)
		{
			alert('the initial hour is greater than the final. Are you sure that info is valid?');
		}
		if(v_hoi == v_hof)
		{
			if(v_mii > v_mif)
			{
				alert('the initial hour is equal than the final and the initial minutes are greater than the final minutes. Are you sure that info is valid?');
			}
		}
	}

	//--------------------------------------------------
	

	let form = document.querySelector('form#addEntryForm');
		

	form.addEventListener('submit', function(event) {
		
		event.preventDefault();

		let requestBody = new FormData(form);
		requestBody.append('usr_id', localStorage.getItem('usr_id'));
		requestBody.append('action', 'add_entry');


		let params = {
			method: 'POST',
			body: requestBody
		}

		fetch('ajax-write.php', params).then(response => { //Send the request 
			response.text().then(res => { 
				console.log(res); 
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
					let cachedRequests = event.target.result[0].content;
					
					if(cachedRequests !== undefined)
						cachedRequests = JSON.parse(cachedRequests);

					console.log(cachedRequests);

					if(!Array.isArray(cachedRequests))
						cachedRequests = [];

					let obj = {};

					for(var pair of requestBody.entries()) {
						obj[pair[0]] = pair[1];
					}
					cachedRequests.push(obj); //Add the request to the cachedRequests

					cachedRequests = JSON.stringify(cachedRequests);


					db.transaction(["requests"], "readwrite") //Clear the table
						.objectStore("requests").clear();

					db.transaction(["requests"], "readwrite") //Add the cachedRequests to the DB
						.objectStore("requests")
						.add({
							'date': new Date().toString(),
							'content': cachedRequests
						});

					
				}

				
			}
			
		});

		
	});	

	//---------------------------------------------------------

	let formData = new FormData();

	formData.append('action', 'get_write_form');
	formData.append('usr_id', localStorage.getItem('usr_id'));

	let params = {
		method: 'POST',
		body: formData
	};

	fetch('ajax-write.php', params).then(response => { //Get available dates 
		response.text().then(content => {
			form.innerHTML = content; //Echo form

			let request = indexedDB.open("FeedBackDB", db_version);
			var db;

			request.onsuccess = function(event) {
				db = event.target.result;
				
				let deleteRequest = db.transaction(["get_write_form"], "readwrite")
										.objectStore("get_write_form").clear();

				db.transaction(["get_write_form"], "readwrite")
				.objectStore("get_write_form")
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

			let dates = db.transaction(["get_write_form"], "readwrite")
			.objectStore("get_write_form")
			.getAll();

			dates.onsuccess = function(event) {
				let result = event.target.result;

				form.innerHTML = result[0].content; //Echo form
				console.log(result);
			}

		}
	});
}