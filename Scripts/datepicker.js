$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    format: 'dd/mm/yyyy',
    today: 'Aujourd\'hui',
    clear: 'Effacer',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
});