/**
 * Created by byhours on 29/01/15.
 */
$(document).ready(function(){
    initializeWidgets();
})

function initializeWidgets(){
    $('input.datepicker ').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    console.log("Widgets Initialized");
}
