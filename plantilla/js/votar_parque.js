$(document).ready(function() {
	var base_url = $("#base_url").val();

	$(".votos .voting_btn").click(function (e) {
		e.preventDefault();
		var voto_hecho = $(this).data('voto');
		var id = $(this).data("id");
		var li = $(this);
		var base_url = $("#base_url").val();
		var textmessage = $("#message_voto_parque");

		if(voto_hecho && id) {
			// .post("<?php echo base_url('voto/insertar') ?>",

			$.post(base_url +"voto/insertar", {'id':id, 'voto':voto_hecho}, function(data) { //console.log(data);
				
				if($.isNumeric(data)) { // me envia el nuevo total, si ya vote me envia un string con los datos a volver a votar
					li.addClass(voto_hecho+"_votado").find("span").text(data);
					textmessage.text("Gracias por votar!").css({"color":"green", "font-weight": "bold"}).show();
					//li.closest("ul").append("<span class='votado'>Gracias!</span>");
				} else if(data == false) {
					window.location.replace(base_url);
				} else {
					//$("li a").addClass('disabled');
					// li.addClass("disabled");
					li.addClass().css({'pointer-events':'none'});//esto bloquea el click del cursosr
					setTimeout(function(){ li.addClass().css({'pointer-events':'auto'});},5000); // y este lo habilita cada 5 seg y si no paso los 9 seg que le seteo
					//en la cookie me lo bloquea de vuelta ya que me envia 1
					textmessage.text("Ya has votado! "+ data +"").css({"color":"red", "font-weight": "bold"}).show();
				//	li.closest("ul").append("<span class='votado'>Ya has votado!"+ data +"</span>");
				}
			});
		//	setTimeout(function() {$('.votado').fadeOut('fast');}, 1000);
			setTimeout(function() {$(textmessage).fadeOut('fast');}, 1000);
		}
	});
});