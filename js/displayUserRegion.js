/*
This script is used to display the region if the user is a driver
 */
$(document).ready(function () {
    toggleFields(); // call this first so we start out with the correct visibility depending on the selected form values
    // this will call our toggleFields function every time the selection value of our other field changes
    $(".roleUser").change(function () {
        toggleFields();
    });
});
// this toggles the visibility of other server
function toggleFields() {
    selection = $(".roleUser option:selected").text();
    switch (selection){
        case 'driver':
            $(".dependOnRegion").show();
            break;
        default:
            $(".dependOnRegion").hide();
    }
}