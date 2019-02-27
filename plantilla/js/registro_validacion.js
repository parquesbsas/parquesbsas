 // CARGANDO

function cargando_actualizar_perfil() {
	var cargando = $("#cargar_actualizar_perfil");
	cargando.css({"display":"block"});
}

function cargando_sesion() {
	var cargando = $("#cargar_sesion");
	cargando.css({"display":"block"});
}

function cargando_reg() {
	var cargando = $("#cargar");
	cargando.css({"display":"block"});
}

function cargando_encuesta() {
	var cargando = $("#cargar_encuesta");
	cargando.css({"display":"block"});
}

function cargando_reclamo() {
	var cargando = $("#cargar_reclamo");
	cargando.css({"display":"block"});
}

function cargando_reclamos_enviar_email() {
	var cargando = $("#cargar_form_enviar_reclamo_email");
	cargando.css({"display":"block"});
}

function cargando_actualizar_parques() {
	var cargando = $("#cargar_form_cargar_parque_excel");
	cargando.css({"display":"block"});
}

function cargando_actualizar_parque() {
	var cargando = $("#cargar_form_admin_actualizar_parque");
	cargando.css({"display":"block"});
}

function cargando_actualizar_actividad_parque() {
	var cargando = $("#cargar_form_admin_actualizar_actividad_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_actividad() {
	var cargando = $("#cargar_form_admin_crear_actividad");
	cargando.css({"display":"block"});
}

function cargando_crear_actividad_parque() {
	var cargando = $("#cargar_form_admin_crear_actividad_parque");
	cargando.css({"display":"block"});
}

function cargando_actualizar_estacion_salud_parque() {
	var cargando = $("#cargar_form_admin_actualizar_estacion_salud_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_estacion_salud_parque() {
	var cargando = $("#cargar_crear_estacion_salud_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_punto_verde_parque() {
	var cargando = $("#cargar_crear_punto_verde_parque");
	cargando.css({"display":"block"});
}

function cargando_actualizar_punto_verde_parque() {
	var cargando = $("#cargar_form_admin_actualizar_punto_verde_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_feria_comun_parque() {
	var cargando = $("#cargar_crear_feria_comun_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_itinerante_comun_parque() {
	var cargando = $("#cargar_crear_feria_itinerante_parque");
	cargando.css({"display":"block"});
}

function cargando_actualizar_feria_itinerante_parque() {
	var cargando = $("#cargar_form_admin_actualizar_feria_itinerante_parque");
	cargando.css({"display":"block"});
}

function cargando_crear_parque() {
	var cargando = $("#cargar_crear_parque");
	cargando.css({"display":"block"});
}


$(document).ready(function() {
	$('#form-user').on("submit" , function(e) {
		var cargando = $("#cargar");
		var base_url = $("#base_url").val();
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {
				if(json.res == "error" || json.res == "error_captcha" || json.res == "existe" || json.res == "fallo_db" || json.res == "erroremail" || json.res == "registrado") {
					cargando.fadeOut();
				}
			},

			success: function(data) {
				json = JSON.parse(data);

				$(".errornombre,.errorapellido,.errornumero_documento,.erroremail_reg,.errorpassword,.errorpassword_confirm,.errorerrortipodni,.correcto, .errorform_registro").html("").css({"display":"none"});

				if(json.res == "error")	{

					if(json.nombre)	{

						$("#icon-nombre").remove();
						$(".errornombre").append(json.nombre).css({"display":"block"});
						$("#nombre").parent().parent().attr("class","form-group has-error has-feedback");
						$('#nombre').parent().append("<span id='icon-nombre' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-nombre").remove();
						$("#nombre").parent().parent().attr("class","form-group has-success has-feedback");
						$('#nombre').parent().append("<span id='icon-nombre' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.apellido)	{

						$("#icon-apellido").remove();
						$(".errorapellido").append(json.apellido).css({"display":"block"});
						$("#apellido").parent().parent().attr("class","form-group has-error has-feedback");
						$('#apellido').parent().append("<span id='icon-apellido' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-apellido").remove();
						$("#apellido").parent().parent().attr("class","form-group has-success has-feedback");
						$('#apellido').parent().append("<span id='icon-apellido' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.numero_documento)	{

						$("#icon-numero_documento").remove();
						$(".errornumero_documento").append(json.numero_documento).css({"display":"block"});
						$("#numero_documento").parent().parent().attr("class","form-group has-error has-feedback");
						$('#numero_documento').parent().append("<span id='icon-numero_documento' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					}	else {

						$("#icon-numero_documento").remove();
						$("#numero_documento").parent().parent().attr("class","form-group has-success has-feedback");
						$('#numero_documento').parent().append("<span id='icon-numero_documento' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.email_reg)	{

						$("#icon-email").remove();
						$(".erroremail_reg").append(json.email_reg).css({"display":"block"});
						$("#email_reg").parent().parent().attr("class","form-group has-error has-feedback");
						$('#email_reg').parent().append("<span id='icon-email' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					}	else {

						$("#icon-email").remove();
						$("#email_reg").parent().parent().attr("class","form-group has-success has-feedback");
						$('#email_reg').parent().append("<span id='icon-email' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.password) {

						$("#icon-pass").remove();
						$(".errorpassword").append(json.password).css({"display":"block"});
						$("#password").parent().parent().attr("class","form-group has-error has-feedback");
						$('#password').parent().append("<span id='icon-pass' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-pass").remove();
						$("#password").parent().parent().attr("class","form-group has-success has-feedback");
						$('#password').parent().append("<span id='icon-pass' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.password_confirm) {

						$("#icon-password_confirm").remove();
						$(".errorpassword_confirm").append(json.password_confirm).css({"display":"block"});
						$("#password_confirm").parent().parent().attr("class","form-group has-error has-feedback");
						$('#password_confirm').parent().append("<span id='icon-password_confirm' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-password_confirm").remove();
						$("#password_confirm").parent().parent().attr("class","form-group has-success has-feedback");
						$('#password_confirm').parent().append("<span id='icon-password_confirm' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

				} if(json.res == "fallo_db") {
					$(".errorform_registro").css({"display":"block"});
					$("#error_form_registro").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url +"Error404");
					}, 3000);
				} else if(json.res == "existe") {
					$(".errorform_registro").css({"display":"block"});
					$("#error_form_registro").append(json.message);

				} else if(json.res == "erroremail") {
					$(".errorform_registro").css({"display":"block"});
					$("#error_form_registro").append(json.message);

				} else if(json.res == "registrado") {
					$(".errorform_registro").css({"display":"block", "color":"green"});
					$("#error_form_registro").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 3000);
				} else if(json.res == "error_captcha") {
					$(".errorform_registro").css({"display":"block"});
					$("#error_form_registro").append(json.message);
				}
			},

			error: function (xhr , exception) {
			}

		});
		e.preventDefault();

	});
 });








// SCRIPT PARA VALIDAR REENVIO DE ACTIVACION DE EMAIL ***** FALTA COMPLETAR
$(document).ready(function() {
	$('#form-resend_email').on("submit" , function(e) {
		var cargando = $("#cargar");
		var base_url = $("#base_url").val();
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {
				if(json.res == "erroremail" || json.res == "no_existe" || json.res == "activado" || json.res == "error" || json.res == "enviado" || json.res == "error_captcha" || json.res == "fallo_db") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);

				$(".erroremail_resend,.correcto, #form_error_email_reenviar, .erroremail_resend").html("").css({"display":"none"});

				if(json.res == "error") {

					if(json.email_resend) {

						$("#icon-email_resend").remove();
						$("#form_error_email_reenviar").append(json.email_resend).css({"display":"block"});
						$("#email_resend").parent().parent().attr("class","form-group has-error has-feedback");
						$('#email_resend').parent().append("<span id='icon-email_resend' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					}

				} else if(json.res == "error_captcha") {

					if(json.message) {

						$("#icon-email_resend").remove();
						$(".erroremail_resend").css({"display":"block"});
						$("#error_email_resend").append(json.message);
					}

				} else if(json.res == "erroremail") {

					if(json.message) {

						$("#icon-email_resend").remove();
						$(".erroremail_resend").append(json.email_resend).css({"display":"block"});
						$("#error_email_resend").append(json.message);

					}

				} else if(json.res == "fallo_db") {

					$("#icon-email_resend").remove();
					$(".erroremail_resend").css({"display":"block"});
					$("#error_email_resend").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url +"Error404");
					}, 3000);

				} else if(json.res == "activado") {

					$("#icon-email_resend").remove();
					$(".erroremail_resend").css({"display":"block"});
					$("#error_email_resend").append(json.message);

				} else if(json.res == "enviado") {

					$("#icon-email_resend").remove();
					$("#email_resend").parent().parent().attr("class","form-group has-success has-feedback");
					$('#email_resend').parent().append("<span id='icon-email_resend' class='glyphicon glyphicon-ok form-control-feedback'></span>");
					$("#icon-email_resend").remove();
					$(".erroremail_resend").css({"display":"block", "color":"green"});
					$("#error_email_resend").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 3000);

				} else if(json.res == "no_existe") {
					$("#icon-email_resend").remove();
					$(".erroremail_resend").css({"display":"block"});
					$("#error_email_resend").append(json.message);
				}

			},

			error: function (xhr , exception) {
			}

		});
		e.preventDefault();
	});

});


// Actualizar
$(document).ready(function() {
	$('#form-update').on("submit", function(e) {

		var cargando = $("#cargar_actualizar_perfil");
		var base_url = $("#base_url").val();
		var def = this;
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {

				if(json.res == "actualizado") {
					cargando.css({"display":"none"});
				}

				if(json.res == "error" || json.res == "no_existe" || json.res == "fail_db") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);
				$(".errornombre_act,.errorapellido_act,.errorpassword_act,.errornumero_documento_act,.correcto,.errorform_actualizar").html("").css({"display":"none"});

				if(json.res == "error") {

					if(json.apellido_act) {

						$("#icon-apellido_act").remove();
						$(".errorapellido_act").append(json.apellido_act).css({"display":"block"});
						$("#apellido_act").parent().parent().attr("class","form-group has-error has-feedback");
						$('#apellido_act').parent().append("<span id='icon-apellido_act' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-apellido_act").remove();
						$("#apellido_act").parent().parent().attr("class","form-group has-success has-feedback");
						$('#apellido_act').parent().append("<span id='icon-apellido_act' class='glyphicon glyphicon-ok form-control-feedback'></span>");
					}

					if(json.nombre_act) {

						$("#icon-nombre_act").remove();
						$(".errornombre_act").append(json.nombre_act).css({"display":"block"});
						$("#nombre_act").parent().parent().attr("class","form-group has-error has-feedback");
						$('#nombre_act').parent().append("<span id='icon-nombre_act' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-nombre_act").remove();
						$("#nombre_act").parent().parent().attr("class","form-group has-success has-feedback");
						$('#nombre_act').parent().append("<span id='icon-nombre_act' class='glyphicon glyphicon-ok form-control-feedback'></span>");
					}

					if(json.numero_documento_act) {

						$("#icon-numero_documento_act").remove();
						$(".errornumero_documento_act").append(json.numero_documento_act).css({"display":"block"});
						$("#numero_documento_act").parent().parent().attr("class","form-group has-error has-feedback");
						$('#numero_documento_act').parent().append("<span id='icon-numero_documento_act' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-numero_documento_act").remove();
						$("#numero_documento_act").parent().parent().attr("class","form-group has-success has-feedback");
						$('#numero_documento_act').parent().append("<span id='icon-numero_documento_act' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.password_act) {

						$("#icon-password_act").remove();
						$(".errorpassword_act").append(json.password_act).css({"display":"block"});
						$("#password_act").parent().parent().attr("class","form-group has-error has-feedback");
						$('#password_act').parent().append("<span id='icon-password_act' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-password_act").remove();
						$("#password_act").parent().parent().attr("class","form-group has-success has-feedback");
						$('#password_act').parent().append("<span id='icon-password_act' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

				} if(json.res == "fail_db") {

					$(".errorform_actualizar").css({"display":"block"});
					$("#error_form_actualizar").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);

				} else if(json.res == "actualizado") {
					$(".errorform_actualizar").css({"display":"block", "color":"green"});
					$("#error_form_actualizar").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				} else if(json.res == "no_existe") {
					$(".errorform_actualizar").css({"display":"block"});
					$("#error_form_actualizar").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}
			},

			error: function(xhr , exception) {
			}

		});
		e.preventDefault();
	});
});


// SCRIPT PARA Peticion recuperar contraseña
$(document).ready(function() {
	$("#form-reset_password").on("submit", function(e) {
		var cargando = $("#cargar");
		var base_url = $("#base_url").val();
		var def = this;
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {
				if (json.res == "enviado" || json.res == "error" || json.res == "fallo_db" || json.res == "no_existe" || json.res == "erroremail" || json.res == "error_captcha") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);

				$(".erroremail_forget,.correcto, .errorform_recuperar_contraseña").html("").css({"display":"none"});

				if(json.res == "error")	{

					if(json.email_forget) {

						$("#icon-email_forget").remove();
						$(".erroremail_forget").append(json.email_forget).css({"display":"block"});
						$("#email_forget").parent().parent().attr("class","form-group has-error has-feedback");
						$('#email_forget').parent().append("<span id='icon-email_forget' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-email_forget").remove();
						$("#email_forget").parent().parent().attr("class","form-group has-success has-feedback");
						$('#email_forget').parent().append("<span id='icon-email_forget' class='glyphicon glyphicon-ok form-control-feedback'></span>");
					}

				} else if(json.res == "erroremail") {
					$("#icon-email_forget").remove();
					$(".errorform_recuperar_contraseña").css({"display":"block"});
					$("#error_form_recuperar_contraseña").append(json.message);

				} else if(json.res == "fallo_db") {
					$("#icon-email_forget").remove();
					$(".errorform_recuperar_contraseña").css({"display":"block"});
					$("#error_form_recuperar_contraseña").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url +"Error404");
					}, 3000);

				} else if(json.res == "error_captcha") {
					$("#icon-email_forget").remove();
					$(".errorform_recuperar_contraseña").css({"display":"block"});
					$("#error_form_recuperar_contraseña").append(json.message);

				} else if(json.res == "no_existe") {
					$("#icon-email_forget").remove();
					$(".errorform_recuperar_contraseña").css({"display":"block"});
					$("#error_form_recuperar_contraseña").append(json.message);

				} else if(json.res == "enviado") {
					$("#icon-email_forget").remove();
					$(".errorform_recuperar_contraseña").css({"display":"block", "color":"green"});
					$("#error_form_recuperar_contraseña").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 3000);
				}
			},

			error: function (xhr , exception) {
			}

		});
		e.preventDefault();
	});
 });

// SCRIPT PARA RESET PASSWORD ***** FALTA COMPLETAR
$(document).ready(function() {
	$("#form-validated_reset_password").on("submit" , function(e) {
		var cargando = $("#cargar");
		var base_url = $("#base_url").val();
		var def = this;
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {
				if(json.res == "error" || json.res == "fallo_db" || json.res == "no_existe" || json.res == "actualizado" || json.res == "error_captcha") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);

				$(".errorpassword_new,.correcto, .errorrecuperar_contraseña").html("").css({"display":"none"});

				if(json.res == "error") {

					if(json.message) {

						$("#icon-password_new").remove();
						$(".errorpassword_new").append(json.message).css({"display":"block"});
						$("#password_new").parent().parent().attr("class","form-group has-error has-feedback");
						$('#password_new').parent().append("<span id='icon-password_new' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-password_new").remove();
						$("#password_new").parent().parent().attr("class","form-group has-success has-feedback");
						$('#password_new').parent().append("<span id='icon-password_new' class='glyphicon glyphicon-ok form-control-feedback'></span>");
					}

				} else if(json.res == "error_captcha") {
					$("#icon-password_new").remove();
					$(".errorrecuperar_contraseña").css({"display":"block"});
					$("#error_recuperar_contraseña").append(json.message);

				} else if(json.res == "fallo_db") {
					$("#icon-password_new").remove();
					$(".errorrecuperar_contraseña").css({"display":"block"});
					$("#error_recuperar_contraseña").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url +"Error404");
					}, 3000);

				} else if(json.res == "no_existe") {
					$("#icon-password_new").remove();
					$(".errorrecuperar_contraseña").css({"display":"block"});
					$("#error_recuperar_contraseña").append(json.message);

				} else if(json.res == "actualizado") {
					$("#icon-password_new").remove();
					$(".errorrecuperar_contraseña").css({"display":"block", "color":"green"});
					$("#error_recuperar_contraseña").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 3000);
				}
			},

			error: function (xhr , exception) {
			}

		});
    	e.preventDefault();
	});
});


// formulario reclamo
$(document).ready(function() {
	$('#form-user-claim').on("submit" , function(e) {

		var cargando = $("#cargar_reclamo");
		var base_url = $("#base_url").val();
		var def = this;
		var json;
		var comentario = $("#comentario").val();
		var imagen = $('#fileImagen')[0].files[0];

		var formData = new FormData();
		formData.append("fileImagen", $('#fileImagen')[0].files[0]);
		formData.append("comentario", $("#comentario").val());
		formData.append("id_parque_reclamo", $("#id_parque_reclamo").val());
		formData.append("id_usuario_reclamo", $("#id_usuario_reclamo").val());
		formData.append("tipo_reclamo", $("#tipo_reclamo").val());
		formData.append("g-recaptcha-response", grecaptcha.getResponse());

		$(".error_fileImagen").empty();
		$(".error_comment").empty();
		$("#fileImagen").parent().parent().removeClass("has-error");
		$("#comentario").parent().parent().removeClass("has-error");

		if(!imagen || imagen["type"] !== "image/jpeg") {

			$(".error_fileImagen").html("").css({"display":"none"});
			$("#icon-fileImagen").remove();
			$(".error_fileImagen").append("<p>Debe seleccionar una imagen .jpeg</p>").css({"display":"block"});
			$("#fileImagen").parent().parent().attr("class","form-group has-error has-feedback");
			$('#fileImagen').parent().append("<span id='icon-fileImagen' class='glyphicon glyphicon-remove form-control-feedback'></span>");
			cargando.fadeOut();

		} else {
			$.ajax({
				type: "POST",
				url: $(this).attr("action"),
				data: formData,
				contentType: false,
				processData: false,
				cache: false,
				beforeSend: function() {
				},

				complete: function() {
					if(json.res == "reclamo_registrado" || json.res == "error" || json.res == "error_reclamo" || json.res == "fallo_db" || json.res == "error_campos_vacios" || json.res == "error_vacio" || json.res == "error_captcha") {
						cargando.fadeOut();
					}
				},

				success: function(data) {

					json = JSON.parse(data);
					$(".error_comment,.error_fileImagen,.correcto,.errorFormatImage,.reclamoRegistrado,.error_reclamo").html("").css({"display":"none"});

						if(json.res == "error")	{

							if(json.comentario)	{

								$("#icon-comentario").remove();
								$(".error_comment").append(json.comentario).css({"display":"block"});
								$("#comentario").parent().parent().attr("class","form-group has-error has-feedback");
								$('#comentario').parent().append("<span id='icon-comentario' class='glyphicon glyphicon-remove form-control-feedback'></span>");

							} else {

								$("#icon-comentario").remove();
								$("#comentario").parent().parent().attr("class","form-group has-success has-feedback");
								$('#comentario').parent().append("<span id='icon-comentario' class='glyphicon glyphicon-ok form-control-feedback'></span>");

							}

							if(!json.fileImagen) {

								$("#icon-fileImagen").remove();
								$("#fileImagen").parent().parent().attr("class","form-group has-success has-feedback");
								$('#fileImagen').parent().append("<span id='icon-fileImagen' class='glyphicon glyphicon-ok form-control-feedback'></span>");

							}

							if(json.numero_documento) {

								$("#icon-numero_documento").remove();
								$(".errornumero_documento").append(json.numero_documento).css({"display":"block"});
								$("#numero_documento").parent().parent().attr("class","form-group has-error has-feedback");
								$('#numero_documento').parent().append("<span id='icon-numero_documento' class='glyphicon glyphicon-remove form-control-feedback'></span>");

							}	else {

								$("#icon-numero_documento").remove();
								$("#numero_documento").parent().parent().attr("class","form-group has-success has-feedback");
								$('#numero_documento').parent().append("<span id='icon-numero_documento' class='glyphicon glyphicon-ok form-control-feedback'></span>");

							}

						} if(json.res == "fallo_db") {
							$(".error_reclamo").append(json.message).css({"display":"block"});;

						} else if(json.res == "error_vacio") {
							$(".error_reclamo").append(json.message).css({"display":"block"});
							setTimeout(function() {
								window.location.reload();
							}, 2000);

						} else if(json.res == "error_reclamo") {
							$(".error_reclamo").append(json.message).css({"display":"block"});

						} else if(json.res == "error_campos_vacios") {
							$(".error_reclamo").append(json.message).css({"display":"block"});

						} else if(json.res == "error_captcha") {
							$(".error_reclamo").append(json.message).css({"display":"block"});
							grecaptcha.reset();
						} else if(json.res == "reclamo_registrado") {
							$(".reclamoRegistrado").append(json.message).css({"display":"block"}); // Se reutilizo el p de error en la ventana modal de reclamo
							setTimeout(function() {
								window.location.reload();
							}, 2000);
						}

					},

				error: function (xhr , exception) {
				}

			});
		}

		e.preventDefault();
	});

});

// formulario encuesta
$(document).ready(function() {

	$('#form-user-encuesta').on("submit" , function(e) {

		var cargando_encuesta = $("#cargar_encuesta");
		var base_url = $("#base_url").val();
		var def = this;
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
				if(json.res == "enviado_encuesta"){
					cargando_encuesta.css({"display":"none"});
				}

				if(json.res == "error" || json.res == "error_encuesta" || json.res == "enviado_encuesta" || json.res == "fallo_db") {
					cargando_encuesta.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);

				$(".error_tipo_encuesta,.error_calificacion_encuesta,.error_encuesta, .enviado_encuesta").html("").css({"display":"none"});

				if(json.res == "error") {

					if(json.tipo_encuesta) {

						$("#icon-tipo_encuesta").remove();
						$(".error_tipo_encuesta").append(json.tipo_encuesta).css({"display":"block"});
						$("#tipo_encuesta").parent().parent().attr("class","form-group has-error has-feedback");
						$('#tipo_encuesta').parent().append("<span id='icon-tipo_encuesta' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-tipo_encuesta").remove();
						$("#tipo_encuesta").parent().parent().attr("class","form-group has-success has-feedback");
						$('#tipo_encuesta').parent().append("<span id='icon-tipo_encuesta' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.calificacion_encuesta) {

						$("#icon-calificacion_encuesta").remove();
						$(".error_calificacion_encuesta").append(json.calificacion_encuesta).css({"display":"block"});
						$("#calificacion_encuesta").parent().parent().attr("class","form-group has-error has-feedback");
						$('#calificacion_encuesta').parent().append("<span id='icon-calificacion_encuesta' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-calificacion_encuesta").remove();
						$("#calificacion_encuesta").parent().parent().attr("class","form-group has-success has-feedback");
						$('#calificacion_encuesta').parent().append("<span id='icon-calificacion_encuesta' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

				} if(json.res == "error_encuesta") {

					$(".error_encuesta").append(json.message).css({"display":"block"});

				} if(json.res == "fallo_db") {

					$(".error_encuesta").append(json.message).css({"display":"block"});
					setTimeout(function() {
						window.location.replace(base_url +"Error404");
					}, 3000);

				} else if(json.res == "enviado_encuesta") {
					$(".enviado_encuesta").append(json.message).css({"display":"block"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}
			},

			error: function (xhr , exception) {
			}

		});

		e.preventDefault();

	});

});


$(document).ready(function() {
		$('#busqueda_barrio_form').on("submit" , function(e) {
			var cargando = $("#cargar");
			var base_url = $("#base_url").val();
			var def = this;
			var json;

			$.ajax({
				type: "POST",
				url: $(this).attr("action"),
				data:  new FormData(this),
				contentType: false,
				processData: false,
				cache: false,

				beforeSend: function() {
				},

				complete: function() {
					if(json.res == "enviado"){
						cargando.css({"display":"none"});
					}

					if(json.res == "error" || json.res == "error_resultado") {
						cargando.fadeOut();
	  				}
        		},

				success: function(data) {

					json = JSON.parse(data);

				 $(".errorbarrio").html("").css({"display":"none"});

					if(json.res == "error")	{

						if(json.barrio) {
							$('#resultado').children().remove();
							$(".errorbarrio").append(json.barrio).css({"display":"block"});
							$("#buscar_barrio").parent().parent().attr("class","form-group has-error has-feedback");
						}

					} if(json.res == "error_resultado")	{
						$('#resultado').children().remove();
						$(".errorbarrio").append(json.message).css({"display":"block","font-weight": "bold", "color":"#d9534f"});

					} else if(json.res == "exito") {
						$('#resultado').children().remove();
						$("#buscar_barrio").parent().parent().attr("class","form-group has-success has-feedback");
						$(".errorbarrio").append(json.message).css({"display":"block","font-weight": "bold", "color":"green"});
						const elementos = $("#resultado").children().length; // Contar elementos hijos
						$.each(json.data, function(index, value) {
							$('#resultado').html($('#resultado').html() +'<div class="panel panel-default"><div class="panel-heading"><a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-'+
								value.id_parque +'">'+ value.nombre +'</a></div>'+'<div id="panel-element-'+ value.id_parque +'" class="panel-collapse collapse"><a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="'+ base_url +"busqueda/parque/"+ value.url_parque +"/"+ value.id_parque +'">Ver Parque</a>'+'</div>'+"</div>");
						});
					}
				},

				error: function (xhr , exception) {
				}

			});

			e.preventDefault();

		});

 });


$(document).ready(function() {
		$('#busqueda_comuna_form').on("submit" , function(e) {
			var cargando = $("#cargar");
			var base_url = $("#base_url").val();
			var def = this;
			var json;

			$.ajax({
				type: "POST",
				url: $(this).attr("action"),
				data:  new FormData(this),
				contentType: false,
				processData: false,
				cache: false,

				beforeSend: function() {
				},

				complete: function() {
					if(json.res == "enviado"){
						cargando.css({"display":"none"});
					}

					if(json.res == "error" || json.res == "error_resultado") {
						cargando.fadeOut();
	  				}
        		},

				success: function(data) {

					json = JSON.parse(data);

				 $(".errorcomuna").html("").css({"display":"none"});

					if(json.res == "error")	{
						if(json.comuna) {
							$('#resultado_comuna').children().remove();
							$(".errorcomuna").append(json.comuna).css({"display":"block"});
							$("#buscar_comuna").parent().parent().attr("class","form-group has-error has-feedback");
						}

					} if(json.res == "error_resultado")	{
						$('#resultado_comuna').children().remove();
						$(".errorcomuna").append(json.message).css({"display":"block","font-weight": "bold", "color":"#d9534f"});

					} else if(json.res == "exito") {
						$('#resultado_comuna').children().remove();
						$("#buscar_comuna").parent().parent().attr("class","form-group has-success has-feedback");
						$(".errorcomuna").append(json.message).css({"display":"block","font-weight": "bold", "color":"green"});
						const elementos = $("#resultado_comuna").children().length;// Contar hijos

						$.each(json.data, function(index, value) {
							$('#resultado_comuna').html($('#resultado_comuna').html() +'<div class="panel panel-default"><div class="panel-heading"><a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-'+
								value.id_parque +'">'+ value.nombre +'</a></div>'+'<div id="panel-element-'+ value.id_parque +'" class="panel-collapse collapse"><a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="'+ base_url +"busqueda/parque/"+ value.url_parque +"/"+ value.id_parque +'">Ver Parque</a>'+'</div>'+"</div>");
						});

					}
				},

				error: function (xhr , exception) {
				}

			});

			e.preventDefault();

		});

 });

$(document).ready(function() {
	$('#form_busqueda_personalizada').on("submit" , function(e) {
		var cargando = $("#cargar");
		var base_url = $("#base_url").val();
		var def = this;
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
			processData: false,
			cache: false,

			beforeSend: function() {
			},

			complete: function() {
				if(json.res == "exito"){
					cargando.css({"display":"none"});
				}

				if(json.res == "error" || json.res == "error_resultado") {
					cargando.fadeOut();
  				}
    		},

			success: function(data) {

				json = JSON.parse(data);
				$("#errorbusquedapersonalizada").css({"display":"none"}).empty();

				if(json.res == "exito") {
					$("#errorbusquedapersonalizada").append(json.message).css({"display":"block","font-weight": "bold", "color":"green"});
					$('#resultado_busqueda_personalizada').children().remove();
					$(".errorcomuna").append(json.comuna).css({"display":"block"});
					const elementos = $("#resultado_busqueda_personalizada").children().length;// Contar hijos

					$.each(json.data, function(index, value) {

						$('#resultado_busqueda_personalizada').html($('#resultado_busqueda_personalizada').html() +'<div class="panel panel-default"><div class="panel-heading"><a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-'+
							value.id_parque +'">'+ value.nombre +'</a></div>'+'<div id="panel-element-'+ value.id_parque +'" class="panel-collapse collapse"><a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="'+ base_url +"busqueda/parque/"+ value.url_parque +"/"+ value.id_parque +'">Ver Parque</a>'+'</div>'+"</div>");
					});
				} else if(json.res == "error_resultado") {
					$('#resultado_busqueda_personalizada').children().remove();
					$("#errorbusquedapersonalizada").append(json.message).css({"display":"block","font-weight": "bold", "color":"#d9534f"});
				}
			},

			error: function (xhr , exception) {
			}

		});

		e.preventDefault();

	});

});



// SCRIPT PARA VALIDAR REENVIO DE ACTIVACION DE EMAIL ***** FALTA COMPLETAR
$(document).ready(function() {
	$('#form_sesion').on("submit" , function(e) {
		var cargando = $("#cargar_sesion");
		var base_url = $("#base_url").val();
		var json;

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),

			beforeSend: function() {
			},

			complete: function() {
				if(json.res == "error" || json.res == "sesion" || json.res == "no_existe") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);

				$(".erroremail_sesion,.errorcontraseña_sesion, .message_error_sesion").html("").css({"display":"none"});

				if(json.res == "error") {

					if(json.email_login) {

						$("#icon-email_login").remove();
						$(".erroremail_sesion").append(json.email_login).css({"display":"block"});
						$("#email_login").parent().parent().attr("class","form-group has-error has-feedback");
						$('#email_login').parent().append("<span id='icon-email_login' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-email_login").remove();
						$("#email_login").parent().parent().attr("class","form-group has-success has-feedback");
						$('#email_login').parent().append("<span id='icon-email_login' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

					if(json.contraseña_login) {

						$("#icon-password_login").remove();
						$(".errorcontraseña_sesion").append(json.contraseña_login).css({"display":"block"});
						$("#password_login").parent().parent().attr("class","form-group has-error has-feedback");
						$('#password_login').parent().append("<span id='icon-password_login' class='glyphicon glyphicon-remove form-control-feedback'></span>");

					} else {

						$("#icon-password_login").remove();
						$("#password_login").parent().parent().attr("class","form-group has-success has-feedback");
						$('#password_login').parent().append("<span id='icon-password_login' class='glyphicon glyphicon-ok form-control-feedback'></span>");

					}

				} else if(json.res == "no_existe") {

					if(json.message) {

						$("#icon-message_errorsesion").remove();
						$(".message_error_sesion").css({"display":"block"});
						$("#message_errorsesion").append(json.message);
					}

				}else if(json.res == "sesion") {

					$("#icon-message_errorsesion").remove();
					$(".message_error_sesion").css({"display":"block"});
					$(".message_error_sesion").css({"display":"block", "color":"green"});
					$("#message_errorsesion").append(json.message);
					setTimeout(function() {
						window.location.replace(base_url);
					}, 1000);

				}

			},

			error: function (xhr , exception) {
			}

		});
		e.preventDefault();
	});

});

// formulario reclamo
$(document).ready(function() {
	$('#form-admin-reclamo').on("submit" , function(e) {
		var cargando = $("#cargar_form_enviar_reclamo_email");
		var base_url = $("#base_url").val();
		var def = this;
		var json;
		var comentario = $("#comentario").val();
		var word = $('#fileDocumento')[0].files[0];

		var formData = new FormData();

		var emailOng = str = $("#email_ong").val().replace(/\s/g, "");// clean spaces
		var emailComuna = str = $("#email_comuna").val().replace(/\s/g, ""); // clean spaces

		formData.append("fileDocumento", $('#fileDocumento')[0].files[0]);
		formData.append("email_comuna", emailComuna);
		formData.append("email_ong", emailOng);
		formData.append("comentario", $("#comentario_reclamo_email").val());

		$("#comentario_reclamo_email").parent().parent().attr("class","form-group");
		$("#icon-comentario_reclamo_email").remove();

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: formData,
			contentType: false,
			processData: false,
			cache: false,

			beforeSend: function(xhr, opts) {

				if(!word || word["type"] !== "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
					$(".error_fileDocument").html("").css({"display":"none"});
					$("#icon-fileDocumento").remove();
					$(".error_fileDocument").append("<p>Debe seleccionar un documento .docx</p>").css({"display":"block"});
					$("#fileDocumento").parent().parent().attr("class","form-group has-error has-feedback");
					$('#fileDocumento').parent().append("<span id='icon-fileDocumento' class='glyphicon glyphicon-remove form-control-feedback'></span>");
					cargando.fadeOut();
					xhr.abort();

				} else {

					$("#icon-fileDocumento").remove();
					$("#fileDocumento").parent().parent().attr("class","form-group has-success has-feedback");
					$('#fileDocumento').parent().append("<span id='icon-fileDocumento' class='glyphicon glyphicon-ok form-control-feedback'></span>");

				}
			},

			complete: function() {
				if(json.res == "error_documento_email_vacio" || json.res == "error" || json.res == "fallo_db" || json.res == "error_destinatario" || json.res == "error_envio_email" || json.res == "reclamo_enviado" || json.res == "fallo_actualizar" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);
				$(".error_fileDocument, .error_reclamo_comentario,.correcto,.errorFormatImage,.reclamoRegistrado,.error_reclamo,.errorform_enviar_reclamo_documento_email").html("").css({"display":"none"});

					if(json.res == "error")	{

						if(json.comentario_documento_email)	{

							$("#icon-comentario_reclamo_email").remove();
							$(".error_reclamo_comentario").append(json.comentario_documento_email).css({"display":"block"});
							$("#comentario_reclamo_email").parent().parent().attr("class","form-group has-error has-feedback");
							$('#comentario_reclamo_email').parent().append("<span id='icon-comentario_reclamo_email' class='glyphicon glyphicon-remove form-control-feedback'></span>");
						}

						if(!json.documentFile) {
							$("#icon-fileDocumento").remove();
							$("#fileDocumento").parent().parent().attr("class","form-group has-success has-feedback");
							$('#fileDocumento').parent().append("<span id='icon-fileDocumento' class='glyphicon glyphicon-ok form-control-feedback'></span>");

						} else {
							$(".error_fileDocument").html("").css({"display":"none"});
							$("#icon-fileDocumento").remove();
							$(".error_fileDocument").append(json.documentFile).css({"display":"block"});
							$("#fileDocumento").parent().parent().attr("class","form-group has-error has-feedback");
							$('#fileDocumento').parent().append("<span id='icon-fileDocumento' class='glyphicon glyphicon-remove form-control-feedback'></span>");
						}

					} if(json.res == "fallo_db") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"#d9534f"});;

					} else if(json.res == "error_destinatario") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"#d9534f"});

					} else if(json.res == "error_envio_email") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"#d9534f"});

					} else if(json.res == "reclamo_enviado") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
						setTimeout(function() {
							window.location.reload();
						}, 2000);

					} else if(json.res == "fallo_actualizar") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"#d9534f"}); // Se reutilizo el p de error en la ventana modal de reclamo

					} else if(json.res == "error_perfil") {
						$(".errorform_enviar_reclamo_documento_email").append(json.message).css({"display":"block", "color":"#d9534f"}); // Se reutilizo el p de error en la ventana modal de reclamo
						setTimeout(function() {
							window.location.replace(base_url);
						}, 2000);
					}

				},

			error: function (xhr , exception) {
			}


		});

		e.preventDefault();
	});

});