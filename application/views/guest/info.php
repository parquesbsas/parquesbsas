<div class="section section-info">
	<div class="container" >
		<div class="row">
			<div class="col-md-12">
				<link href="<?=base_url()?>plantilla/css/like.css" rel="stylesheet"  type="text/css">
			</div>
		</div>
		<!-- INFORMACION DEL PARQUE -->
		<div class="row">
			<div class="col-md-12">
				<div class="section section-info">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<h4 class="text-center"><strong><?=$parque->nombre;?></strong></h4>
									<!-- MEGUSTA O NO EL PARQUE  -->

									<?php if($this->session->userdata('login')) { ?>
										<div class = "col-md-10" style="display: flex;flex-direction: column;align-items: center;; width:100%">
											<ul class="votos" style="position: relative;">
												<li class="voting_btn up_button" data-voto="likes" data-id="<?php echo $parque->id_parque;?>">
													<span><?php echo $parque->likes;?></span>
												</li>
												<li class="voting_btn dw_button" data-voto="hates" data-id="<?php echo $parque->id_parque;?>">
													<span><?php echo $parque->hates;?></span>
												</li>
											</ul>
											<p id="message_voto_parque">
										</div>
									<?php } else {?>
										<br><br><br>
									<?}?>
						
									<span><strong>Descripcion: </strong>
									</br>
									<?php echo($parque->descripcion)?></span>
									</br>
									<span><strong>Direccion: </strong><?php echo($parque->direccion)?></span>
									</br>
									<span><strong>Patio de juegos: </strong><?php echo $patioJuegos = !empty($parque->patio_juegos) ? "Si" : "No" ?></span>
									</br>
									<span><strong>Barrio: </strong><?php echo($parque->descripcion)?></span>
									</br>
									<span><strong>Comuna: </strong><?php echo($parque->comuna)?></span>
									</br>
									<span><strong>Wifi: </strong><?php echo $wifi = empty($parque->id_wifi) ? "No" : "Si"?></span>
								</div>
							</div>
							<br><br><br>
							<div class="col-md-6">
								<img style="width:890px; height:500.63px;" src="<?echo $imagen = empty($parque->imagen) ? base_url('public/img/parques/54AC9F290.jpg') : base_url('public/img/parques').'/'.$parque->imagen;?>" class="img-responsive img-rounded">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<hr>


<!-- 2 bloque -->
<div class="section section-info">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center" style="color: #000000;border-bottom: none;">Informacion del Parque</h3>
			<div class="row" id="caja_info">
			<?php if(!empty($parque->estaciones_salud)) {?>
				<div class="col-md-4" id="caja_estaciones_salud">
					<div class="thumbnail" style="background-color:#FFFFFF;">
						<h3 class="text-center" style="color: #000000;border-bottom: none;">Estaciones Saludables</h3>
						<img class="img-responsive img-rounded center-block" alt="Bootstrap Thumbnail First" style="width:584.33px; height:328.63px;" src="<?php echo base_url('public/img/estaciones_saludables.jpg')?>"/>
						<br>
						<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;">
						<p class="text-center" style="font-size: 15px;">
							<strong>En la ciudad de Buenos Aires, las estaciones saludables son puestos de promoción de la salud y prevención de enfermedades.</strong>
						</p>
						<p class="text-center"><a class="btn btn-primary" id="mod_estacion_saludable">Ver Informacion</a></p>
					</div>
				</div>
			<?php } if(!empty($parque->ferias)) {?>		
				<div class="col-md-4" id="caja_ferias">
					<div class="thumbnail" style= "background-color: #FFFFFF;">
						<h3 class="text-center" style="color: #000000;border-bottom: none;">Ferias comunes e itinerantes</h3>
						<img class="img-responsive img-rounded center-block" alt="Bootstrap Thumbnail Second" style="width:584.33px; height:328.63px;" src="<?php echo base_url('public/img/feria_itinerante.jpg')?>"/>
						</br>
						<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;">
						<p class="text-center" style="font-size: 15px;">
							<strong>Encontra las ferias comunes e itinerantes de la ciudad de buenos aires en los parques mas cercanos de tu hogar.</strong>
						</p>
						<p class="text-center"><a class="btn btn-primary" id="mod_ferias">Ver Informacion</a></p>
					</div>
				</div>
			<?php } if(!empty($parque->actividades)) {?>	
				<div class="col-md-4" id="caja_actividades">
					<div class="thumbnail" style= "background-color: #FFFFFF;">
						<h3 class="text-center" style="color: #000000;border-bottom: none;">Actividades</h3>
						<img class="img-responsive img-rounded center-block" alt="Bootstrap Thumbnail Third" style="width:584.33px; height:328.63px;" src="<?php echo base_url('public/img/actividades.jpg')?>"/>
						</br>
						<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;">
						<p class="text-center" style="font-size: 15px;">
							<strong>Averigua que activades se realizan gratituamente en los diferentes parques de la ciudad de Buenos Aires.</strong>
						</p>
						<p class="text-center"><a class="btn btn-primary" id="mod_actividades">Ver Informacion</a></p>
					</div>
				</div>
			<?}?>
			</div>
		</div>
	</div>
</div>

<?php if($this->session->userdata("login") && !empty($this->session->userdata("id"))) { ?>

<hr style="border-top: 2px solid #e5e5e5;">
<!-- 3 bloque scrollbars html bootstrap padding -->
<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h3 class="text-center" style="color: #000000;border-bottom: none;">Reclamo</h3>
			<hr>
			<br><br>
				<div class="row">
					<div class="col-md-6">
						<img src="<?echo base_url('public/img/reclamo.png')?>" class="img-responsive img-rounded 	center-block">
					</div>
					<div class="col-md-6">
						<h3 class="text-center" style="color: #000000;border-bottom: none;">Formulario</h3>
						<hr>
						<br>
						<p class="text-center" style="font-weight: bold">Completa el formulario ingresando el tipo de reclamo, una imagen como evidencia y comentarios.
						<br>Esto nos servira para darle mas peso a tus denuncias.	 
						</p>
						<br>
						<hr>
						<br>
						<p class="text-center" style="font-weight: bold">Validacion de imagen
						<br>
						<br>-Tipo de Imagen: jpg
						<br>-Tamaño maximo: 2mb
						<br>-Resoluciones maximas: 1680 alto x 1054 ancho
						</p>
						<br>
						<p class="text-center"><a class="btn btn-primary" id="mod_reclamo">Realizar Reclamo</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


<!-- ventana modal reclamos -->
<div id="modal_reclamos" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<?php $attributes = array("name" => "form-user-claim", "id" => "form-user-claim", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
			echo form_open_multipart("reclamo/crear", $attributes);?>			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" style="color: #000000;">
							<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
							<?echo $parque->nombre;?>
						</h4>
				</div>
				<div class="modal-body" id="myModalBody">
					<p class="errorFormatImage text-danger"></p>
					<div class="form-group">
						<div>
							<label for ="tipo_reclamo" style="color: #000000;">Lista de Reclamos :</label>
							<select id="tipo_reclamo" name="tipo_reclamo" class="form-control">
								<? foreach ($parque->reclamos as $reclamo ) { ?>
									<option value="<?echo $reclamo->id_reclamo;?>"><? echo $reclamo->descripcion;?></option>
								<? } ?>
							</select>
							<p class="error_tipo_reclamo text-danger"></p>
						</div>
					</div>

					<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;"/>

					<div class="form-group">
						<div>
							<label for="fileImagen" style="color: #000000;">Cargar Imagen</label>
							<input accept="image/jpeg" type="file" name="fileImagen" id="fileImagen" class="form-control">
							<p class="error_fileImagen text-danger"></p>
						</div>
					</div>

					<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;"/>

					<div class="form-group">
						<div>
							<label for="comentario" style="color: #000000;">Comentarios :</label>
								<textarea id="comentario" class="form-control" name="comentario" style="max-width: 100%" rows="3" style="color: #000000;" placeholder="Escriba sus comentarios respecto al reclamo"></textarea>
								<input type= "hidden" name="id_parque_reclamo" id="id_parque_reclamo" value="<?echo $parque->id_parque;?>">
								<input type= "hidden" name="id_usuario_reclamo" id="id_usuario_reclamo" value="<?echo $this->session->userdata("id")?>">
								<p class="error_comment text-danger"></p>
						</div>
					</div>
					<p class="error_reclamo text-danger" style="font-weight: bold;"></p>
					<p class="reclamoRegistrado" style="color:green; font-weight:bold;"></p>
					<p id="cargar_reclamo"><font color="green" style="font-weight:bold;">Cargando....</font></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type='submit' class="btn btn-default" onclick="cargando_reclamo()">Enviar Reclamo</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- bloque Encuesta-->
<hr style="border-top: 2px solid #e5e5e5;">
<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h3 class="text-center" style="color: #000000;border-bottom: none;">Encuestas</h3>
			<br><br>
				<div class="row">
					<div class="col-md-6">
						<div hidden= "true" id="contenedor_grafico">
							<canvas id="myChart"></canvas>
						</div>
						<div id="contenedor_estadisticas_cantidad_reclamos">
							<canvas id="chart_estadistica_encuesta_parque" width="840" height="440"></canvas>
						</div>
						<p id="id_parque_estadisticas_encuestas" value="<?echo $parque->id_parque;?>"></p>			
					</div>	
					<div class="col-md-6">
						<img style="width:200px; height:200px;" src="<?echo base_url('public/img/icono_encuesta.png')?>" class="img-responsive img-rounded center-block">
						<br><hr><br><br>
						<p class="text-center" style="font-weight:bold;">Podra completar estas encuestas para calificar al parque(solo puede completarlas una vez al mes).</p>
						<br><br><br>
						<p class="text-center"><a class="btn btn-primary" id="mod_encuestas">Realizar Encuestas</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>

<!-- Ventana Modal Encuestas-->
<div id="modal_encuestas" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array("name" => "form-user-encuesta", "id" => "form-user-encuesta", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
			echo form_open_multipart("encuesta/realizar", $attributes);?>			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" style="color: #000000;">
							<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
							<?echo $parque->nombre;?>
						</h4>
				</div>
				<div class="modal-body" id="myModalBody">
					<div class="piola_mal alert-success text-center" style="display:none;"></div>
					<div class="form-group">
						<div>
							<label for ="tipo_encuesta" style="color: #000000;">Lista de Encuestas :</label>
							<select id="tipo_encuesta" name="tipo_encuesta" class="form-control">
								<? foreach ($encuestas as $encuesta ) { ?>
									<option value="<?echo $encuesta->id_encuesta;?>"><? echo $encuesta->descripcion;?></option>
								<? } ?>
							</select>
							<p class="error_tipo_encuesta text-danger"></p>
						</div>
					</div>

					<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;"/>

					<div class="form-group">
						<div> <!-- NO BORRAR ACOMODA EL MODAL -->
							<label style="color: #000000;">Calificaciones</label>
								<?foreach($calificaciones as $calificacion) { ?>
									<div class="radio">
										<label style="color: #000000;"><input type="radio" name="calificacion" value="<?echo $calificacion->id_calificacion?>"><? echo $calificacion->descripcion?>
										</label>
									</div>
								<? } ?>
								<input type= "hidden" name="id_parque_encuesta" id="id_parque_encuesta" value="<?echo $parque->id_parque;?>">
								<input type= "hidden" name="id_usuario_encuesta" id="id_usuario_encuesta" value="<?echo $this->session->userdata("id")?>">
							<p class="error_calificacion_encuesta text-danger"></p>
							<p class="error_encuesta text-danger" style="font-weight: bold;"></p>
							<p class="enviado_encuesta" style="font-weight: bold; color:green;"></p>
						</div>
					</div>
				<p id="cargar_encuesta" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type='submit' class="btn btn-default" onclick="cargando_encuesta()">Realizar Encuesta</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	idParque = $('#id_parque_estadisticas_encuestas').attr('value');
	$.post("<?php echo base_url();?>estadisticas/obtenerEstadisticasEncuestaPorParque", {id_parque : idParque}, function(data) {
		var obj = JSON.parse(data);
		console.log(obj);

		encuesta = [];
		total = [];
		backgroundColor = "rgba(54, 162, 235, 0.2)";
		borderColor = "rgba(54, 162, 235, 1)";
		$.each(obj, function(i,item) {
			encuesta.push(item.descripcion);
			total.push(item.total);
		});
		
		var ctx = $("#chart_estadistica_encuesta_parque");
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: encuesta,
				datasets: [{
					label: "Cantidad de Encuestas",
					data: total,
					backgroundColor: backgroundColor,
					borderColor: borderColor,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true,
							stepSize: 1
						}
					}]
				}
			}
		});		
	});
</script>


<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		var count = $("#caja_info").children().length;
		if(count == 1) {
			//	$('#td_id').removeClass('change_me').addClass('new_class');
			$("#caja_info").children("div").removeClass("col-md-4").addClass("col-md-12");
		//	console.log($("#info_img_estaciones_saludables"));
		//	document.getElementById("info_img_estaciones_saludables").css(["width:584.33px", "height:328.63px"]);
		} else if (count == 2) {
			$("#caja_info").children("div").removeClass("col-md-4").addClass("col-md-6");
			$('#caja_actividades img').width("750px").height("350px");
			$('#caja_ferias img').width("750px").height("350px");
			$('#caja_estaciones_salud img').width("750px").height("350px");
			
			console.log(document.getElementById("caja_actividades"));
		}
	});
</script>

<!-- ventana modal estaciones saludables -->
<div id="modal_estacion_saludable" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
						<?echo $parque->nombre;?>
					</h4>
			</div>
			<div class="modal-body" id="myModalBody">
				<div class="form-group">
					 <label style="color: #000000;">Servicios :</label>
						<p style="color: #000000;">
							<?php echo $parque->estaciones_salud->servicios?>
						</p>
				</div>
				<div class="form-group">
					<label style="color: #000000;">Fechas :</label>
						<p style="color: #000000;">
							<?php echo $parque->estaciones_salud->fecha?>
						</p>
				</div>
				<br>
			</div>
			<div class="modal-footer">
					<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
			</div>
		</div>
	</div>
</div>



<!-- ventana modal ferias -->
<
<div id="modal_ferias" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="overflow-y: initial">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
						<?echo $parque->nombre;?>
					</h4>
			</div>
			<div class="modal-body" id="myModalBody" style="overflow-y: auto; height: 300px;">
				<div class="form-group">
					 <p style="color: #000000; font-weight: bold; text-align: center; font-size: 19px;">Ferias</p>
				</div>
					<?php $init2 = 0;
						foreach($parque->ferias as $nombreFeria => $ferias) {
						$init2++;
					?>
					<div class="panel panel-success class" style="color:#000000; background-color:#FFFFFF;">
						<div class="panel-heading" style="color: #000000;">
							<center>
								<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-ferias-<?echo($init2)?>"><?php echo($nombreFeria)?>
								</a>
							</center>	
						</div>
						<div id="panel-element-ferias-<?echo($init2)?>" class="panel-collapse collapse">
							</br>
							<div class="row">
								<div class="col-md-12">
								<?php foreach($ferias as $feria) { ?>
									<span><strong>Dias: </strong><?echo $dias = !empty($feria->fecha) ? $feria->fecha : $feria->dias ?></span>
									</br>
									<span><strong>Descripcion: </strong><?echo $tipo = !empty($feria->tipo) ? $feria->tipo : "Son puntos móviles en los que se venden productos como frutas, verduras, carnes, huevos, pescados, lácteos y de panadería." ?></span>
									</br>
									<span><strong>Direccion: </strong><?echo $direccion = !empty($feria->direccion) ? $feria->direccion : $parque->direccion?></span>
									</br></br>
								<?}?>
								</div>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="modal-footer">
				<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
			</div>
		</div>
	</div>
</div>
 
<!-- ventana modal actividades -->
<div id="modal_actividades" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="overflow-y: initial">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
						<?echo $parque->nombre;?>
					</h4>
			</div>
			<div class="modal-body" id="myModalBody" style="overflow-y: auto; height: 300px;">
				<div class="form-group">
					 <p style="color: #000000; font-weight: bold; text-align: center; font-size: 19px;">Actividades</p>
				</div>
					<?php $init = 0;
						foreach($parque->actividades as $nombreActivadad => $actividades) {
						$init++;
					?>
					<div class="panel panel-success class" style="color:#000000; background-color:#FFFFFF;">
						<div class="panel-heading" style="color: #000000;">
							<center>
								<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-activity-<?echo($init)?>"><?php echo($nombreActivadad)?>
								</a>
							</center>	
						</div>
						<div id="panel-element-activity-<?echo($init)?>" class="panel-collapse collapse">
							</br>
							<div class="row">
								<div class="col-md-12">
								<?php	foreach($actividades as $actividad) { ?>
									<span><strong>Dia: </strong><?echo($actividad->dia)?></span>
									</br>
									<span><strong>Horario: </strong><?echo("Desde ". $actividad->desde ." Hasta " .$actividad->hasta)?></span>
									</br>
									<span><strong>Descripcion: </strong><?echo($actividad->descripcion)?></span>
									</br></br>
								<?}?>
								</div>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="modal-footer">
				<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
			</div>
		</div>
	</div>
</div>


<hr>
<!-- Bloque del mapa del Parque -->
<div class="section section-info">
	<div class="row">
		<div class="col-md-12">
			<span><?php echo $map["js"]; ?></span>
			<span><?php echo $map["html"]; ?></span>
		</div>
	</div>
</div>




<!-- ventana modal 1 -->

<div id="myModal2" class="modal fade" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" style="color: #000000;">
	 <img height="30" alt="Brand" src="http://localhost/parquesbeta2.0/public/img/logo.png">
								asdas <?=$parque->nombre;?></h4>
		 </div>
						<div  >
								<div class="form-group">
<input class="btn btn-success" id="zzz" data-toggle="modal" type="button" value="Otra Ventana" />
			</div>
								</div>
							 <br>
									 <div style="color: #000000;"><a href="#password-reset-box" class="reset-window">Olvide mi Contraseña?</a>       |
				 <a href="<?=base_url()?>registro" class="reset-window">Registrarse?</a></div>
								<div id="alert-msg"></div>
										 <div class="modal-footer">
								<input class="btn btn-default" id="submit" name="submit" type="button" value="Ingresar" />
								<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
						</div>
						</div>


				</div>
		</div>
<!-- </div>-->



<!-- ventana modal 2 -->



<div id="myModal22" class="modal fade" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" style="color: #000000;">
	 <img height="30" alt="Brand" src="http://localhost/parquesbeta2.0/public/img/logo.png">
								asdas <?=$parque->nombre;?></h4>

							 </div>

						<div  >

								<div class="form-group">


			<div  style="color: #000000; " id="sasa" name="s" ><a >Encuesta</a>
			</div>
								</div>
							 <br>
									 <div style="color: #000000;"><a href="#password-reset-box" class="reset-window">Olvide mi Contraseña?</a>       |
				 <a href="<?=base_url()?>registro" class="reset-window">Registrarse?</a></div>
								<div id="alert-msg"></div>
						</div>
						<div class="modal-footer">
								<input class="btn btn-default" id="submit" name="submit" type="button" value="Ingresar" />
								<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
						</div>

				</div>
		</div>
</div>




<?// habia 2</div></div> ?>
