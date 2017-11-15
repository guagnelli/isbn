$(document).ready(function (){
	$("input[name='rad_df']").on( "click", function() {
		if($(this).val() == "print"){
			$("#div_digital").hide();
			$("#div_print").show();
		}else if($(this).val() == "digital"){
			$("#div_print").hide();
			$("#div_digital").show();
		}		
	});
});
function show_div(tipo){
	if(tipo == "print"){
		$("#div_digital").hide();
		$("#div_print").show();
	}else if(tipo == "digital"){
		$("#div_print").hide();
		$("#div_digital").show();
	}	
}

 $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
 	$(this).val($(this).val().replace(/[^0-9\.]/g,''));
    /*if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }*/
});