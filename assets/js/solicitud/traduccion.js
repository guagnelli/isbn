$(document).ready(function (){
	$("#traduccion").on("change",function(){
    if($("#traduccion").prop("checked")){
      $("#div_traduccion").show();
    }else{
    	apprise("Esta a punto de eliminar la información de traducción, ¿desea continuar?", 
			{verify: true}, 
			function (btnClick){
				if(btnClick){
					$("#div_traduccion").hide();
			      	var traduccion_id = $("#id").val();
			      	var action = base_url+"/index.php/solicitud/sec_traduccion";
			      	var solicitud = $("#sol").val();
			      	var form_data = {
			  			traduccion:[{
			  				id:traduccion_id,
			  				del:1}
			  			],
			  			solicitud_id:solicitud
			  		};
			      	ajax(action,form_data,'#tab_traduccion','#msg_general');
				}
    		});
    }
  });

});