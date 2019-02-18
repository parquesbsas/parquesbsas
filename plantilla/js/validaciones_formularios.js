function cargando_contacto() {
	var cargando = $("#cargar_contacto");
	cargando.css({"display":"block"});
}

$(document).ready(function() {
	$('#form-contacto').on("submit" , function(e) {
		var cargando = $("#cargar_contacto");
		var base_url = $("#base_url").val();
		var json;
			
		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
			processData: false,
			cache: false,
			beforeSend: function(){
			},

			complete: function() {
				if(json.res == "enviado") {
					cargando.css({"display":"none"});
				}

				if(json.res == "error" || json.res == "error_email" || json.res == "error_captcha") {
					cargando.fadeOut();
				}
			},

			success: function(data) {
				json = JSON.parse(data);

				$(".error_comment_contacto,.erroremail_contacto,.correcto,.errornombre_contacto,.comentarioEnviado,.errorasunto_contacto, .erroremail_enviar_contacto").html("").css({"display":"none"});

				if(json.res == "error")	{
					if(json.comentario_contacto) {

						$("#icon-comentario_contacto").remove();
						$(".error_comment_contacto").append(json.comentario_contacto).css({"display":"block"});
						$("#comentario_contacto").parent().parent().attr("class","form-group has-error has-feedback");
						$('#comentario_contacto').parent().append("<span id='icon-comentario_contacto' class='glyphicon glyphicon-remove form-control-feedback'></span>");					

					} else {

						$("#icon-comentario_contacto").remove();
						$("#comentario_contacto").parent().parent().attr("class","form-group has-success has-feedback");
						$('#comentario_contacto').parent().append("<span id='icon-comentario_contacto' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.asunto_contacto) {

						$("#icon-asunto_contacto").remove();
						$(".errorasunto_contacto").append(json.asunto_contacto).css({"display":"block"});
						$("#asunto_contacto").parent().parent().attr("class","form-group has-error has-feedback");
						$('#asunto_contacto').parent().append("<span id='icon-asunto_contacto' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-asunto_contacto").remove();
						$("#asunto_contacto").parent().parent().attr("class","form-group has-success has-feedback");
						$('#asunto_contacto').parent().append("<span id='icon-asunto_contacto' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}							

					if(json.nombre_contacto) {

						$("#icon-nombre_contacto").remove();
						$(".errornombre_contacto").append(json.nombre_contacto).css({"display":"block"});
						$("#nombre_contacto").parent().parent().attr("class","form-group has-error has-feedback");
						$('#nombre_contacto').parent().append("<span id='icon-nombre_contacto' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-nombre_contacto").remove();
						$("#nombre_contacto").parent().parent().attr("class","form-group has-success has-feedback");
						$('#nombre_contacto').parent().append("<span id='icon-nombre_contacto' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.email_contacto) {

						$("#icon-email_contacto").remove();
						$(".erroremail_contacto").append(json.email_contacto).css({"display":"block"});
						$("#email_contacto").parent().parent().attr("class","form-group has-error has-feedback");
						$('#email_contacto').parent().append("<span id='icon-email_contacto' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-email_contacto").remove();
						$("#email_contacto").parent().parent().attr("class","form-group has-success has-feedback");
						$('#email_contacto').parent().append("<span id='icon-email_contacto' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

				} else if(json.res == "error_email") {
					$(".erroremail_enviar_contacto").css({"display":"block"});
					$("#error_email_contacto").append(json.message);					
				} else if(json.res == "enviado") {
					$(".erroremail_enviar_contacto").css({"display":"block", "color":"green"});
					$("#error_email_contacto").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 3000);
				} else if(json.res == "error_captcha") {
					$(".erroremail_enviar_contacto").css({"display":"block"});
					$("#error_email_contacto").append(json.message);
				}
			},

			error: function (xhr , exception) {
			}

		});
			
		e.preventDefault();

	});

});