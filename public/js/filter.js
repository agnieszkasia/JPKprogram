$('#start_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
    weekStartDay: 1
});
$('#end_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
    weekStartDay: 1
});
$('#sort').on('change', function(e){
    $(this).closest('form').submit();
});
