//$(document).ready(function() {
//    $('#example').DataTable();
//});

//$(document).ready(function(){  
//    $('body').tooltip({
//        selector: "[rel=tooltip]",
//        placement: "top"
//    });    
//  }); 
/*
$.validate({
    modules : 'location, date, security, file',
    onModulesLoaded : function() {
      $('#country').suggestCountry();
    }
  });
*/  

$.validate({
	form : '#fileupload',
	 modules : 'file',
});

$('#description').restrictLength( $('#pres-max-length') );  

$(document).ready(function() {
	$('#tickets').dataTable( {
	"aaSorting": [[ 0, "desc" ]]
	});

	$('table.ticket-list').DataTable( {
	  	"paging":   false,
	    "ordering": true,
	    "searching": true,    
	    "info":     false
	});	
	
	$('body').tooltip({
	  selector: "[rel=tooltip]",
	  placement: "top"
  });   	
});

//$('#form').validator()
$('#myModal').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
$('#myModalEdit').on('hidden.bs.modal', function () {
	  $(this).removeData('bs.modal');
});
$('#myModalNew').on('hidden.bs.modal', function () {
	  $(this).removeData('bs.modal');
});
