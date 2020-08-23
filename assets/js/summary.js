let form = document.querySelector('form#summaryForm');

populateSummaryForm(form);
    

form.addEventListener('submit', function(event) {
    
    event.preventDefault();

    submitSummary(this);
    
});	