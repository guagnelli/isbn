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