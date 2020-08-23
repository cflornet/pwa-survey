if(window.location.pathname == '/write.php') {
    

	//--------------------------------------------------
	

	let form = document.querySelector('form#addEntryForm');

	populateAddEntryForm(form);
		

	form.addEventListener('submit', function(event) {
		
		event.preventDefault();

		submitAddEntry(this);
		
	});	


}