//ACTUALIZAR PARQUE
$(document).ready(function() {
	$("#actualizarInformacionParque").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_parque");
		var base_url = $("#base_url").val();
		var parqueId = $("#tablaAdminParqueId").text();
		var parqueNombre = $("#tablaAdminParqueNombre").text();
		var parqueDescripcion = $("#tablaAdminParqueDescripcion").text();
		var parqueDireccion = $("#tablaAdminParqueDireccion").text();
		var parqueJuegos = $("#tablaAdminParqueJuegos").is(":checked");
		var parqueWiFi = $("#tablaAdminParqueWiFi").is(":checked");
		var parqueLatitud = $("#tablaAdminParqueLatitud").text();
		var parqueLongitud = $("#tablaAdminParqueLongitud").text();
		var parqueUrlParque = $("#tablaAdminParqueUrlParque").text();
		var parqueBarrio = $("#tablaAdminParqueBarrio option:selected").val();
		var parqueComuna = $("#tablaAdminParqueComuna option:selected").val();
		var parqueActivo = $("#tablaAdminParqueActivo").is(":checked");
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueId);
		formData.append("parqueNombre", parqueNombre);
		formData.append("parqueDescripcion", parqueDescripcion);
		formData.append("parqueDireccion", parqueDireccion);
		formData.append("parqueJuegos", parqueJuegos);
		formData.append("parqueWiFi", parqueWiFi);
		formData.append("parqueLatitud", parqueLatitud);
		formData.append("parqueLongitud", parqueLongitud);
		formData.append("parqueActivo", parqueActivo);
		formData.append("parqueUrlParque", parqueUrlParque);
		formData.append("parqueBarrio", parqueBarrio);
		formData.append("parqueComuna", parqueComuna);

		$(".errorform_admin_actualizar_parque").empty();

		$.ajax({
			url: base_url+"parques/editar/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			beforeSend: function(xhr, opts) {

				if(!parqueBarrio || !parqueComuna) {
					$(".errorform_admin_actualizar_parque").append("Debe seleccionar un barrio y una comuna").css({"display":"block"});
					cargando.fadeOut();
					xhr.abort();
				}
			},

			complete: function() {
				if(json.res == "parque_actualizado" || json.res == "error_actualizar_parque"  || json.res == "error_guardar" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$(".errorform_admin_actualizar_parque").html("").css({"display":"none"});

				if(json.res == "error_actualizar_parque") {
					$(".errorform_admin_actualizar_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "error_perfil") {
					$(".errorform_admin_actualizar_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "parque_actualizado") {
					$(".errorform_admin_actualizar_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// ACTUALIZAR ACTIVIDAD PARQUE
$(document).ready(function() {
	$(".parqueActividadActualizar.btn.btn-success.btn-rounded").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_actividad_parque");
		var base_url = $("#base_url").val();
		var id = $(this).parents("tr");
		var formData = new FormData();
		$("#error_form_admin_actualizar_actividad_parque").empty();

		id.find("td").each(function() {
			if(typeof $(this).attr("name") != "undefined") {

				formData.append($(this).attr("name"), $(this).text());

				$(this).find(':input').each(function() {
					formData.append($(this).attr("name"), $(this).is(":checked"));
				});
			}
		});

		$.ajax({
			url: base_url+"parques/editarActividadParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_actividad_actualizado" || json.res == "error_actualizar_activad_parque"  || json.res == "error_actualizar_actividad_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_actualizar_actividad_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_actualizar_actividad_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_actualizar_actividad_parque") {
					$("#error_form_admin_actualizar_actividad_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_actividad_actualizado") {
					$("#error_form_admin_actualizar_actividad_parque").append(json.message).css({"display":"block", "color":"green"});
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// CREAR ACTIVIDAD
$(document).ready(function() {
	$("#crearActividad").click(function() {

		var cargando = $("#cargar_form_admin_crear_actividad");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var actividadNombre = $("#crear_actividad_nombre").val();
		var actividadDescripcion = $("#crear_actividad_descripcion").val();
		var json;

		var formData = new FormData();
		formData.append("actividadNombre", actividadNombre);
		formData.append("actividadDescripcion", actividadDescripcion);

		$("#error_form_admin_crear_actividad").empty();

		$.ajax({
			url: base_url+"actividad/crear",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_actualizado" || json.res == "error_validacion_crear_actividad"  || json.res == "error_crear_actividad" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_crear_actividad").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_crear_actividad").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_crear_actividad" || json.res == "error_crear_actividad") {
					$("#error_form_admin_crear_actividad").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_actualizado") {
					$("#error_form_admin_crear_actividad").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


//CREAR ACTIVIDAD PARQUE
$(document).ready(function() {
	$("#crearActividadParque").click(function() {

		var cargando = $("#cargar_form_admin_crear_actividad_parque");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var parqueActividad = $("#tablaAdminParqueId").text();
		var actividadId = $("#crear_parque_actividad_id").val();
		var actividadHorarioComienzo = $("#crear_parque_actividad_horario_comienzo").val();
		var actividadHorarioFinalizacion = $("#crear_parque_actividad_horario_finalizacion").val();
		var actividadDias = $("#crear_parque_actividad_dias").val();
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueActividad);
		formData.append("actividadId", actividadId);
		formData.append("actividadHorarioComienzo", actividadHorarioComienzo);
		formData.append("actividadHorarioFinalizacion", actividadHorarioFinalizacion);
		formData.append("actividadDias", actividadDias);

		$("#error_form_admin_crear_actividad_parque").empty();

		$.ajax({
			url: base_url+"parques/crearActividadParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_actividad_creado" || json.res == "error_validacion_actualizar_actividad_parque"  || json.res == "error_actualizar_actividad_parque" || json.res == "error_perfil" || json.res == "error_crear_parque_actividad") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_crear_actividad_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_crear_actividad_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_actualizar_actividad_parque" || json.res == "error_actualizar_actividad_parque" || json.res == "error_crear_parque_actividad") {
					$("#error_form_admin_crear_actividad_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_actividad_creado") {
					$("#error_form_admin_crear_actividad_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


// ACTUALIZAR ESTACION SALUD
$(document).ready(function() {
	$(".parqueEstacionSaludActualizar.btn.btn-success.btn-rounded").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_estacion_salud_parque");
		var base_url = $("#base_url").val();
		var id = $(this).parents("tr");
		var formData = new FormData();
		$("#error_form_admin_actualizar_estacion_salud_parque").empty();

		id.find("td").each(function() {
			if(typeof $(this).attr("name") != "undefined") {

				formData.append($(this).attr("name"), $(this).text());

				$(this).find(':input').each(function() {
					formData.append($(this).attr("name"), $(this).is(":checked")); // se agregan los checkbox
				});
			}
		});

		$.ajax({
			url: base_url+"parques/editarEstacionSaludableParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_estacion_salud_actualizado" || json.res == "error_actualizar_estacion_salud_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_actualizar_estacion_salud_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_actualizar_estacion_salud_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_actualizar_estacion_salud_parque") {
					$("#error_form_admin_actualizar_estacion_salud_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_estacion_salud_actualizado") {
					$("#error_form_admin_actualizar_estacion_salud_parque").append(json.message).css({"display":"block", "color":"green"});
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// CREAR ESTACION SALUD
$(document).ready(function() {
	$("#crearEstacionSaludParque").click(function() {

		var cargando = $("#cargar_crear_estacion_salud_parque");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var parqueId = $("#tablaAdminParqueId").text();
		var estacionSaludServicio = $("#crear_estacion_salud_servicios").val();
		var estacionSaludFecha = $("#crear_estacion_salud_fecha").val();
		var estacionSaludLatitud = $("#crear_estacion_salud_latitud").val();
		var estacionSaludLongitud = $("#crear_estacion_salud_longitud").val();
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueId);
		formData.append("estacionSaludServicio", estacionSaludServicio);
		formData.append("estacionSaludFecha", estacionSaludFecha);
		formData.append("estacionSaludLatitud", estacionSaludLatitud);
		formData.append("estacionSaludLongitud", estacionSaludLongitud);

		$("#error_crear_estacion_salud_parque").empty();

		$.ajax({
			url: base_url+"parques/crearEstacionSaludableParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_estacion_salud_creado" || json.res == "error_validacion_crear_estacion_salud_parque"  || json.res == "error_crear_estacion_salud_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {

				json = JSON.parse(data);
				$("#error_crear_estacion_salud_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_crear_estacion_salud_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_crear_estacion_salud_parque" || json.res == "error_crear_estacion_salud_parque") {
					$("#error_crear_estacion_salud_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_estacion_salud_creado") {
					$("#error_crear_estacion_salud_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// CREAR PUNTO VERDE
$(document).ready(function() {
	$("#crearPuntoVerdeParque").click(function() {

		var cargando = $("#cargar_crear_punto_verde_parque");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var parqueId = $("#tablaAdminParqueId").text();
		var puntoVerdeTipo = $("#crear_punto_verde_tipo").val();
		var puntoVerdeMateriales = $("#crear_punto_verde_materiales").val();
		var puntoVerdeDiasHorarios = $("#crear_punto_verde_dias_horarios").val();
		var puntoVerdeLatitud = $("#crear_punto_verde_latitud").val();
		var puntoVerdeLongitud = $("#crear_punto_verde_longitud").val();
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueId);
		formData.append("puntoVerdeTipo", puntoVerdeTipo);
		formData.append("puntoVerdeMateriales", puntoVerdeMateriales);
		formData.append("puntoVerdeDiasHorarios", puntoVerdeDiasHorarios);
		formData.append("puntoVerdeLatitud", puntoVerdeLatitud);
		formData.append("puntoVerdeLongitud", puntoVerdeLongitud);

		$("#error_crear_punto_verde_parque").empty();

		$.ajax({
			url: base_url+"parques/crearPuntoVerdeParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_punto_verde_creado" || json.res == "error_validacion_crear_punto_verde_parque"  || json.res == "error_crear_punto_verde_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {

				json = JSON.parse(data);
				$("#error_crear_punto_verde_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_crear_punto_verde_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_crear_punto_verde_parque" || json.res == "error_crear_punto_verde_parque") {
					$("#error_crear_punto_verde_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_punto_verde_creado") {
					$("#error_crear_punto_verde_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// ACTUALIZAR PUNTO VERDE
$(document).ready(function() {
	$(".parquePuntoVerdeActualizar.btn.btn-success.btn-rounded").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_punto_verde_parque");
		var base_url = $("#base_url").val();
		var id = $(this).parents("tr");
		var formData = new FormData();
		$("#error_form_admin_actualizar_punto_verde_parque").empty();

		id.find("td").each(function() {
			if(typeof $(this).attr("name") != "undefined") {

				formData.append($(this).attr("name"), $(this).text());

				$(this).find(':input').each(function() {
					formData.append($(this).attr("name"), $(this).is(":checked")); // se agregan los checkbox
				});
			}
		});

		$.ajax({
			url: base_url+"parques/editarPuntoVerdeParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_punto_verde_actualizado" || json.res == "error_actualizar_punto_verde_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_actualizar_punto_verde_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_actualizar_punto_verde_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_actualizar_punto_verde_parque") {
					$("#error_form_admin_actualizar_estacion_salud_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_punto_verde_actualizado") {
					$("#error_form_admin_actualizar_punto_verde_parque").append(json.message).css({"display":"block", "color":"green"});
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


// CREAR FERIA COMUN
$(document).ready(function() {
	$("#crearFeriaComunParque").click(function() {

		var cargando = $("#cargar_crear_feria_comun_parque");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var parqueId = $("#tablaAdminParqueId").text();
		var feriaComunTipo = $("#crear_feria_comun_tipo").val();
		var feriaComunFechas = $("#crear_feria_comun_fechas").val();
		var feriaComunLatitud = $("#crear_feria_comun_latitud").val();
		var feriaComunLongitud = $("#crear_feria_comun_longitud").val();
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueId);
		formData.append("feriaComunTipo", feriaComunTipo);
		formData.append("feriaComunFechas", feriaComunFechas);
		formData.append("feriaComunLatitud", feriaComunLatitud);
		formData.append("feriaComunLongitud", feriaComunLongitud);

		$("#error_crear_feria_comun_parque").empty();

		$.ajax({
			url: base_url+"parques/crearFeriaComunParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_feria_comun_creado" || json.res == "error_validacion_crear_feria_comun_parque"  || json.res == "error_crear_feria_comun_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {

				json = JSON.parse(data);
				$("#error_crear_feria_comun_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_crear_feria_comun_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_crear_feria_comun_parque" || json.res == "error_crear_feria_comun_parque") {
					$("#error_crear_feria_comun_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_feria_comun_creado") {
					$("#error_crear_feria_comun_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});

// ACTUALIZAR FERIA COMUN
$(document).ready(function() {
	$(".parqueFeriaComunActualizar.btn.btn-success.btn-rounded").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_feria_comun_parque");
		var base_url = $("#base_url").val();
		var id = $(this).parents("tr");
		var formData = new FormData();
		$("#error_form_admin_actualizar_feria_comun_parque").empty();

		id.find("td").each(function() {
			if(typeof $(this).attr("name") != "undefined") {

				formData.append($(this).attr("name"), $(this).text());

				$(this).find(':input').each(function() {
					formData.append($(this).attr("name"), $(this).is(":checked")); // se agregan los checkbox
				});
			}
		});

		$.ajax({
			url: base_url+"parques/editarFeriaComunParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_feria_comun_actualizado" || json.res == "error_actualizar_feria_comun_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_actualizar_feria_comun_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_actualizar_feria_comun_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_actualizar_feria_comun_parque") {
					$("#error_form_admin_actualizar_feria_comun_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_feria_comun_actualizado") {
					$("#error_form_admin_actualizar_feria_comun_parque").append(json.message).css({"display":"block", "color":"green"});
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


// CREAR FERIA ITINERANTE
$(document).ready(function() {
	$("#crearFeriaItineranteParque").click(function() {

		var cargando = $("#cargar_crear_feria_itinerante_parque");
		var base_url = $("#base_url").val();
		var formData = new FormData();

		var parqueId = $("#tablaAdminParqueId").text();
		var feriaItineranteDireccion = $("#crear_feria_itinerante_direccion").val();
		var feriaItineranteDias = $("#crear_feria_itinerante_dias").val();
		var feriaItineranteLatitud = $("#crear_feria_itinerante_latitud").val();
		var feriaItineranteLongitud = $("#crear_feria_itinerante_longitud").val();
		var json;

		var formData = new FormData();
		formData.append("parqueId", parqueId);
		formData.append("feriaItineranteDireccion", feriaItineranteDireccion);
		formData.append("feriaItineranteDias", feriaItineranteDias);
		formData.append("feriaItineranteLatitud", feriaItineranteLatitud);
		formData.append("feriaItineranteLongitud", feriaItineranteLongitud);

		$("#error_crear_feria_itinerante_parque").empty();

		$.ajax({
			url: base_url+"parques/crearFeriaItineranteParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_feria_itinerante_creado" || json.res == "error_validacion_crear_feria_itinerante_parque"  || json.res == "error_crear_feria_itinerante_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {

				json = JSON.parse(data);
				$("#error_crear_feria_itinerante_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_crear_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_validacion_crear_feria_itinerante_parque" || json.res == "error_crear_feria_itinerante_parque") {
					$("#error_crear_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_feria_itinerante_creado") {
					$("#error_crear_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


// ACTUALIZAR FERIA ITINERANTE
$(document).ready(function() {
	$(".parqueFeriaItineranteActualizar.btn.btn-success.btn-rounded").click(function() {

		var cargando = $("#cargar_form_admin_actualizar_feria_itinerante_parque");
		var base_url = $("#base_url").val();
		var id = $(this).parents("tr");
		var formData = new FormData();
		$("#error_form_admin_actualizar_feria_itinerante_parque").empty();

		id.find("td").each(function() {
			if(typeof $(this).attr("name") != "undefined") {

				formData.append($(this).attr("name"), $(this).text());

				$(this).find(':input').each(function() {
					formData.append($(this).attr("name"), $(this).is(":checked")); // se agregan los checkbox
				});
			}
		});

		$.ajax({
			url: base_url+"parques/editarFeriaItineranteParque/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			complete: function() {
				if(json.res == "parque_feria_itinerante_actualizado" || json.res == "error_actualizar_feria_itinerante_parque" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success:function(data) {
				json = JSON.parse(data);
				$("#error_form_admin_actualizar_feria_itinerante_parque").html("").css({"display":"none"});

				if(json.res == "error_perfil") {
					$("#error_form_admin_actualizar_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
					setTimeout(function() {
						window.location.replace(base_url);
					}, 2000);
				}

				if(json.res == "error_actualizar_feria_itinerante_parque") {
					$("#error_form_admin_actualizar_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"#d9534f"});
				}

				if(json.res == "parque_feria_itinerante_actualizado") {
					$("#error_form_admin_actualizar_feria_itinerante_parque").append(json.message).css({"display":"block", "color":"green"});
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		})
	});
});


// formulario reclamo
$(document).ready(function() {
	$('#form-admin-crear-parque').on("submit" , function(e) {
		var cargando = $("#cargar_crear_parque");
		var base_url = $("#base_url").val();
		var def = this;
		var json;

		var imagen = $('#crearParqueImagen')[0].files[0];

		var formData = new FormData();
		formData.append("crearParqueNombre", $("#crearParqueNombre").val());
		formData.append("crearParqueDescripcion", $("#crearParqueDescripcion").val());
		formData.append("crearParqueDireccion", $("#crearParqueDireccion").val());
		formData.append("crearParqueBarrio", $("#crearParqueBarrio option:selected").val());
		formData.append("crearParqueComuna", $("#crearParqueComuna option:selected").val());
		formData.append("crearParqueImagen", $('#crearParqueImagen')[0].files[0]);
		formData.append("crearParqueUrl", $("#crearParqueUrl").val());
		formData.append("crearParquePatioJuego", $("#crearParquePatioJuego").is(":checked"));
		formData.append("crearParqueWifi", $("#crearParqueWifi").is(":checked"));
		formData.append("crearParqueLatitud", $("#crearParqueLatitud").val());
		formData.append("crearParqueLongitud", $("#crearParqueLongitud").val());

		$(".errorcrear_parque").empty();

		$.ajax({
			url: base_url+"parques/crear/",
			method:"POST",
			data:formData,
			contentType: false,
			processData: false,

			beforeSend: function(xhr, opts) {

				if(!imagen || imagen["type"] !== "image/jpeg") {
					$(".errorcrear_parque").append("<p>Debe seleccionar una imagen .jpeg</p>").css({"display":"block"});
					cargando.fadeOut();
					xhr.abort();
				}
			},

			complete: function() {
				if(json.res == "parque_creado" || json.res == "error_validacion_crear_parque"  || json.res == "fallo_crear_parque" || json.res == "error_crear_parque" || json.res == "error_validacion_crear_parque_coordenadas" || json.res == "error_perfil") {
					cargando.fadeOut();
				}
			},

			success: function(data) {

				json = JSON.parse(data);
				$(".errorcrear_parque").html("").css({"display":"none"});

					 if(json.res == "error_validacion_crear_parque" || json.res == "fallo_crear_parque" || json.res == "error_crear_parque" || json.res == "error_validacion_crear_parque_coordenadas") {
						$(".errorcrear_parque").append(json.message).css({"display":"block", "color":"#d9534f"});;

					} else if(json.res == "parque_creado") {
						$(".errorcrear_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
						setTimeout(function() {
							window.location.reload();
						}, 2000);

					} else if(json.res == "error_perfil") {
						$(".errorcrear_parque").append(json.message).css({"display":"block", "color":"#d9534f"}); // Se reutilizo el p de error en la ventana modal de reclamo
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