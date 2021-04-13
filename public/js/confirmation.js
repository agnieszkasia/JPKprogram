$('#settlementTable').on('click', '.deletebtn', function (){
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function (){
        return $(this).text();
    }).get();

    $('#delete_invoice_id').val(data[0]);
    $('#delete_modal_form').attr('action', '/settlement/'+data[0]+'/delete');
    $('#deleteModal').modal('show');

});

$('#purchaseInvoicesTable').on('click', '.deletebtn', function (){
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function (){
        return $(this).text();
    }).get();

    $('#delete_invoice_id').val(data[0]);
    $('#delete_modal_form').attr('action', '/purchaseinvoice/'+data[0]+'/delete');
    $('#deleteModal').modal('show');

});

$('#invoicesTable').on('click', '.deletebtn', function (){
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function (){
        return $(this).text();
    }).get();

    $('#delete_invoice_id').val(data[0]);
    $('#delete_modal_form').attr('action', '/invoice/'+data[0]+'/delete');
    $('#deleteModal').modal('show');

});
