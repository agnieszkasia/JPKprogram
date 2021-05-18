$('thead').on('click', '.addRow', function (){
    var tr = "<tr id='group[ ]'>" +
        "<td><input type='text' name='name[ ]' class='form-control'></td>" +
        "<td><input type='text' name='quantity[ ]' class='form-control'></td>" +
        "<td><input type='text' name='price[ ]' class='form-control'></td>" +
        "<th><a href='javascript:void(0)' class='btn btn-danger deleteRow'>Usuń</a> </th>" +
        "</tr>"

    $('tbody').append(tr);
});

$('tbody').on('click', '.deleteRow', function (){
    $(this).parent().parent().remove();
})

// $(function() {
//     $('#datetimepicker').datepicker();
// });
//
// $(function (){
//     $('#datepicker').datepicker(
//         // {
//         // format: 'mm/dd/yyyy',
//         // startDate: '-3d'
//     // }
//     );
// })
