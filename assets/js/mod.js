if(window.location.pathname == '/mod.php') {
    let form = document.querySelector('form#modForm');
		
	var urlParams = new URLSearchParams(window.location.search);
	var entry_id = urlParams.get('didf_id');
	
	populateModifyEntryForm(form, entry_id);

	form.addEventListener('submit', function(event) {
		
		event.preventDefault();

		submitModifyEntry(this);
		
    });	

}