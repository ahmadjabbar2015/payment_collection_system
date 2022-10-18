$('#monthly_div').hide();
$('#product').on('change' , function (param) { 
    let default_value = $(this).find(':selected').data('price');
    console.log(default_value);
    $('#product_price').prop("disabled" , false);
    $('#product_price').val(default_value);
 });

 $('#billing_cycle').on('change' , function (param) { 
    
    if($(this).find(':selected').val() == 'monthly'){
        // $('#monthly_div').show();
        // $('.monthly_div_row[0]').html()
        // alert("H");
    }else{
        // $('#monthly_div').hide();
    }

  });
// var div_html = '<div class="col-md-3">\
// <label for="month">Hello</label>\
// <input type="input" name="tell" class="form-control">\
// </div>'
// var theMonths = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
// var now = new Date();

// for (var i = 0; i < 12; i++) {
//   var future = new Date(now.getFullYear(), now.getMonth() + i, 1);
//   var month = theMonths[future.getMonth()];
//   var year = future.getFullYear();
//   console.log(month, year);
// }