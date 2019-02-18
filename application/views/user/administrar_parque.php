<div class="section section-info">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Parque</h2>
				<p style="text-align: left;">
					<a type="button" class="btn btn-success btn-rounded" href="<?echo base_url()."parques/crear"?>">Agregar Nuevo Parque</a>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-responsive-md table-striped text-center" id="tablaAdminParque">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Descripcion</th>
								<th class="text-center">Direccion</th>
								<th class="text-center">Patio de Juegos</th>
								<th class="text-center">Wifi</th>
								<th class="text-center">Latitud</th>
								<th class="text-center">Longitud</th>
								<th class="text-center">Url Parque</th>
								<th class="text-center">Barrio</th>
								<th class="text-center">Comuna</th>
								<th class="text-center">Activo</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td id="tablaAdminParqueId" class="pt-3-half"><?echo $parque->id_parque?></td>
								<td id="tablaAdminParqueNombre" class="pt-3-half" contenteditable="true"><?echo $parque->nombre?></td>
								<td id="tablaAdminParqueDescripcion" class="pt-3-half" contenteditable="true"><?echo $parque->descripcion?></td>
								<td id="tablaAdminParqueDireccion" class="pt-3-half" contenteditable="true"><?echo $parque->direccion?></td>
								<td data="<?echo $parque->patio_juegos?>" class="center"><input id="tablaAdminParqueJuegos" type="checkbox" <?=!empty($parque->patio_juegos) ? "checked" : "";?>></td>
								<td data="<?echo $parque->id_wifi?>" class="center"><input id="tablaAdminParqueWiFi" type="checkbox" <?=!empty($parque->id_wifi) ? "checked" : "";?>></td>								
								<td id="tablaAdminParqueLatitud" class="pt-3-half" contenteditable="true"><?echo $parque->latitud?></td>
								<td id="tablaAdminParqueLongitud" class="pt-3-half" contenteditable="true"><?echo $parque->longitud?></td>
								<td id="tablaAdminParqueUrlParque" class="pt-3-half" contenteditable="true"><?echo $parque->url_parque?></td>
								<td class="center">
									<select id="tablaAdminParqueBarrio" size ="1">
										<?foreach($barrios as $barrio) {?>
											<option value="<?echo($barrio->id_barrio)?>"><?echo($barrio->barrio)?></option>
										<?}?>
									</select>
								</td>
								<td class="center">
									<select id="tablaAdminParqueComuna" size ="1">
										<?foreach($comunas as $comuna) {?>
											<option value="<?echo($comuna->id_comuna)?>"><?echo($comuna->comuna)?></option>
										<?}?>
									</select>
								</td>
								<td data="<?echo $parque->activo?>" class="center"><input id="tablaAdminParqueActivo" type="checkbox" <?=!empty($parque->activo) ? "checked" : "";?>></td>
								<td>
									<p><button onclick="cargando_actualizar_parque()" style="width:76px;height:30px;" id="actualizarInformacionParque" type="button" class="btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<p id="cargar_form_admin_actualizar_parque" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				<p id="error_form_admin_actualizar_parque" class="errorform_admin_actualizar_parque text-danger" style="font-weight: bold;"></p>
			</div>
		</div>

		<hr>
		</br>

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Actividades</h2>
				<p style="text-align: left;">
					<a id="modal_agregar_actividad" type="button" class="btn btn-success btn-rounded">Agregar Actividad</a> &nbsp;&nbsp;&nbsp;
					<a id="modal_agregar_actividad_parque" type="button" class="btn btn-success btn-rounded">Agregar Actividad Parque</a>
				</p>
			</div>
		</div>

		<?php if(!empty($parque->parque_actividades)) {?>
			<div class="row">
				<div class="col-md-12">
					<p style="text-align: right;">
					</p>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-md table-striped text-center">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Horario de comienzo</th>
								<th class="text-center">Horario de finalizacion</th>
								<th class="text-center">Dias</th>
								<th class="text-center">Activo</th>
								<th class="text-center">Accion</th>
							</tr>
							<?php foreach($parque->parque_actividades as $parque_actividad) {
									foreach($parque_actividad as $actividadDetalle) {
							?>
							<tr>
								<td name="tablaAdminParqueActividadId" class="pt-3-half"><?echo $actividadDetalle->id_parque_actividad?></td>
								<td class="pt-3-half"><?echo $actividadDetalle->nombre?></td>
								<td name="tablaAdminParqueActividadDesde" class="pt-3-half" contenteditable="true"><?echo $actividadDetalle->desde?></td>
								<td name="tablaAdminParqueActividadHasta" class="pt-3-half" contenteditable="true"><?echo $actividadDetalle->hasta?></td>
								<td name="tablaAdminParqueActividadDia" class="pt-3-half" contenteditable="true"><?echo $actividadDetalle->dia?></td>
								<td name="tablaAdminParqueActividadActivo" data="<?echo $actividadDetalle->activo?>" class="center"><input name="tablaParqueActividadActivo" type="checkbox" <?=!empty($actividadDetalle->activo) ? "checked" : "";?>></td>
								<td>
									<p><button onclick="cargando_actualizar_actividad_parque()" style="width:76px;height:30px;" type="button" class="parqueActividadActualizar btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
								</td>
							</tr>
							<?}}?>
						</table>
					</div>
					<p id="cargar_form_admin_actualizar_actividad_parque" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_admin_actualizar_actividad_parque" text-danger" style="font-weight: bold;"></p>
				</div>
			</div>
		<?php } ?>

		<hr>
		</br>

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Estacion saludable</h2>
				<?php if(empty($parque->estaciones_salud)) {?>
					<p style="text-align: left;">
						<a id="modal_agregar_estacion_saludable" type="button" class="btn btn-success btn-rounded">Agregar Estacion Saludable</a>
					</p>

					<!-- Ventana Modal Agregar Estacion Saludable-->
					<div id="modal_agregar_estacion_saludable_show" class="modal fade" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<?php $attributes = array("name" => "form-agregar-estacion-saludable-parque", "id" => "form-agregar-estacion-saludable-parque", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
								echo form_open_multipart("encuesta/realizar", $attributes);?>			
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title" style="color: #000000;">
												<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
												<?echo $parque->nombre;?>
											</h4>
									</div>
									
									<div class="modal-body" id="myModalBody">
										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Servicios: &nbsp;&nbsp;&nbsp;
													<span style="font-size:85%;" class="label label-warning">Requerido</span>
												</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Servicios">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Fecha : &nbsp;&nbsp;&nbsp;
													<span style="font-size:85%;" class="label label-warning">Requerido</span>
												</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Fecha">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Latitud :</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Latitud">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Longitud :</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Longitud">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<p id="cargar_encuesta" style="font-weight: bold;"><font color="green">Cargando....</font></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
										<button type='submit' class="btn btn-default" onclick="cargando_encuesta()">Crear</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if(!empty($parque->estaciones_salud)) {?>
			</br>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-md table-striped text-center" id="tablaAdminParque">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Servicios</th>
									<th class="text-center">Fechas</th>
									<th class="text-center">Latitud</th>
									<th class="text-center">Longitud</th>
									<th class="text-center">activo</th>
									<th class="text-center">Accion</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td name="tablaAdminParqueEstacionSaludId" class="pt-3-half"><?echo $parque->estaciones_salud->id_estacion_salud?></td>
									<td name="tablaAdminParqueEstacionSaludNombre" class="pt-3-half" contenteditable="true"><?echo $parque->estaciones_salud->servicios?></td>
									<td name="tablaAdminParqueEstacionSaludDescripcion" class="pt-3-half" contenteditable="true"><?echo $parque->estaciones_salud->fecha?></td>
									<td name="tablaAdminParqueEstacionSaludLatitud" class="pt-3-half" contenteditable="true"><?echo $parque->estaciones_salud->latitud?></td>
									<td name="tablaAdminParqueEstacionSaludLongitud" class="pt-3-half" contenteditable="true"><?echo $parque->estaciones_salud->longitud?></td>
									<td name="tablaAdminParqueEstacionSaludActivo" data="<?echo $parque->activo?>" class="center"><input name="parqueEstacionSaludActivo" type="checkbox" <?=!empty($parque->estaciones_salud->activo) ? "checked" : "";?>>
									</td>
									<td>
										<p><button style="width:76px;height:30px;" type="button" class="parqueEstacionSaludActualizar btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		<?php }?>

		<hr>
		</br>

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Ferias comunes</h2>
				<p style="text-align: left;">
					<a id="modal_agregar_feria_comun" type="button" class="btn btn-success btn-rounded">Agregar Feria Comun</a>
				</p>
			</div>
		</div>

		<?php if(!empty($parque->ferias["Ferias Comunes"])) {?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-md table-striped text-center" id="tablaAdminParque">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Fechas</th>
								<th class="text-center">Latitud</th>
								<th class="text-center">Longitud</th>
								<th class="text-center">Activo</th>
								<th class="text-center">Accion</th>
							</tr>
							<?php foreach($parque->ferias["Ferias Comunes"] as $parqueFeriaComun) {?>
							<tr>
								<td name="tablaAdminParqueFeriaComunId" class="pt-3-half"><?echo $parqueFeriaComun->id_feria_comun?></td>
								<td name="tablaAdminParqueFeriaComunTipo" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaComun->tipo?></td>
								<td name="tablaAdminParqueFeriaComunFecha" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaComun->fecha?></td>
								<td name="tablaAdminParqueFeriaComunLatitud" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaComun->latitud?></td>
								<td name="tablaAdminParqueFeriaComunLongitud" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaComun->longitud?></td>
								<td name="tablaAdminParqueFeriaComunActivo" data="<?echo $parqueFeriaComun->activo?>" class="center"><input name="parqueFeriaComunActivo" type="checkbox" <?=!empty($parqueFeriaComun->activo) ? "checked" : "";?>></td>							
								<td>
									<p><button style="width:76px;height:30px;" type="button" class="parqueFeriaComunActualizar btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
								</td>
							</tr>
							<?}?>
						</table>
					</div>
				</div>
			</div>
		<?php }?>

		<hr>
		</br>

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Ferias itinerantes</h2>
				<p style="text-align: left;">
					<a id="modal_agregar_feria_itinerante" type="button" class="btn btn-success btn-rounded">Agregar Feria Itinerante</a>
				</p>
			</div>
		</div>

		<?php if(!empty($parque->ferias["Ferias Itinerantes"])) {?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-md table-striped text-center" id="tablaAdminParque">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Direccion</th>
								<th class="text-center">Dias</th>
								<th class="text-center">Latitud</th>
								<th class="text-center">Longitud</th>
								<th class="text-center">Activo</th>
								<th class="text-center">Accion</th>
							</tr>
							<?php foreach($parque->ferias["Ferias Itinerantes"] as $parqueFeriaItinerante) {?>
							<tr>
								<td name="tablaAdminParqueFeriaItineranteId" class="pt-3-half"><?echo $parqueFeriaItinerante->id_feria_itinerantes?></td>
								<td name="tablaAdminParqueFeriaItineranteDireccion" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaItinerante->direccion?></td>
								<td name="tablaAdminParqueFeriaItineranteDia" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaItinerante->dias?></td>
								<td name="tablaAdminParqueFeriaItineranteLatitud" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaItinerante->latitud?></td>
								<td name="tablaAdminParqueFeriaItineranteLongitud" class="pt-3-half" contenteditable="true"><?echo $parqueFeriaItinerante->longitud?></td>
								<td name="tablaAdminParqueFeriaItineranteActivo" data="<?echo $parqueFeriaItinerante->activo?>" class="center"><input name="parqueFeriaItineranteActivo" type="checkbox" <?=!empty($parqueFeriaItinerante->activo) ? "checked" : "";?>></td>							
								<td>
									<p><button style="width:76px;height:30px;" type="button" class="parqueFeriaItineranteActualizar btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
								</td>
							</tr>
							<?}?>
						</table>
					</div>
				</div>
			</div>
		<?php }?>

		<hr>
		</br>

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Punto verde</h2>
				<?php if(empty($parque->puntos_verdes)) {?>
					<p style="text-align: left;">
						<a id="modal_agregar_punto_verde" type="button" class="btn btn-success btn-rounded">Agregar Punto Verde</a>
					</p>
					<!-- Ventana Modal Agregar Estacion Saludable-->
					<div id="modal_agregar_punto_verde_show" class="modal fade" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<?php $attributes = array("name" => "form-agregar-punto-verde-parque", "id" => "form-agregar-punto-verde-parque", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
								echo form_open_multipart("encuesta/realizar", $attributes);?>			
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title" style="color: #000000;">
												<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
												<?echo $parque->nombre;?>
											</h4>
									</div>
									
									<div class="modal-body" id="myModalBody">
										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Tipo: &nbsp;&nbsp;&nbsp;
													<span style="font-size:85%;" class="label label-warning">Requerido</span>
												</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Tipo">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Materiales : &nbsp;&nbsp;&nbsp;
													<span style="font-size:85%;" class="label label-warning">Requerido</span>
												</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Materiales">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Dias y Horarios : &nbsp;&nbsp;&nbsp;
													<span style="font-size:85%;" class="label label-warning">Requerido</span>
												</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Dias y Horarios">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>										

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Latitud :</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Latitud">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<div class="form-group">
											<div>
												<label for="nombre" class="control-label" style="color: #000000;">Longitud :</label>
											</div>
											<div>
												<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Longitud">
												<p class="errornombre_contacto text-danger"></p>
											</div>
										</div>

										<hr/>

										<p id="cargar_encuesta" style="font-weight: bold;"><font color="green">Cargando....</font></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
										<button type='submit' class="btn btn-default" onclick="cargando_encuesta()">Crear</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if(!empty($parque->puntos_verdes)) {?>
			</br>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-md table-striped text-center" id="tablaAdminParque">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Materiales</th>
								<th class="text-center">Dias y horarios</th>
								<th class="text-center">Latitud</th>
								<th class="text-center">Longitud</th>
								<th class="text-center">Activo</th>
								<th class="text-center">Accion</th>
							</tr>
							<tr>
								<td name="tablaAdminParquePuntoVerdeId" class="pt-3-half"><?echo $parque->puntos_verdes->id_punto_verde?></td>
								<td name="tablaAdminParquePuntoVerdeTipo" class="pt-3-half" contenteditable="true"><?echo $parque->puntos_verdes->tipo?></td>
								<td name="tablaAdminParquePuntoVerdeMateriales" class="pt-3-half" contenteditable="true"><?echo $parque->puntos_verdes->materiales?></td>
								<td name="tablaAdminParquePuntoVerdeDia" class="pt-3-half" contenteditable="true"><?echo $parque->puntos_verdes->dias_horarios?></td>
								<td name="tablaAdminParquePuntoVerdeLatitud" class="pt-3-half" contenteditable="true"><?echo $parque->puntos_verdes->latitud?></td>
								<td name="tablaAdminParquePuntoVerdeLongitud" class="pt-3-half" contenteditable="true"><?echo $parque->puntos_verdes->longitud?></td>
								<td name="tablaAdminParquePuntoVerdeActivo" data="<?echo $parque->puntos_verdes->activo?>" class="center"><input name="parquePuntoVerdeActivo" type="checkbox" <?=!empty($parque->puntos_verdes->activo) ? "checked" : "";?>></td>							
								<td>
									<p><button style="width:76px;height:30px;" type="button" class="parquePuntoVerdeActualizar btn btn-success btn-rounded btn-sm my-0">Actualizar</button></p>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>			
		<?php }?>

	</div>
</div>



<!-- Ventana Modal Agregar Actividad-->
<div id="modal_agregar_actividad_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
						<?echo $parque->nombre;?>
					</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Nombre de la actividad: &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<input id="crear_actividad_nombre" type="text" class="form-control" placeholder="Nombre de la actividad">
					</div>
				</div>

				<hr/>

				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Descripcion : &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<input id="crear_actividad_descripcion" type="text" class="form-control" placeholder="Descripcion">
					</div>
				</div>

				<p id="cargar_form_admin_crear_actividad" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				<p id="error_form_admin_crear_actividad" text-danger" style="font-weight: bold;"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button onclick="cargando_crear_actividad()" id="crearActividad" type="button" class="btn btn-default">Crear</button>				
			</div>
		</div>
	</div>
</div>



<!-- Ventana Agregar Actividad al Parque-->
<div id="modal_agregar_actividad_parque_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
						<?echo $parque->nombre;?>
					</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Actividad: &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<select id="crear_parque_actividad_id" class="form-control">
							<? foreach ($parque->actividades as $actividad ) { ?>
								<option value="<?echo $actividad->id_actividad;?>"><? echo $actividad->nombre;?></option>
							<? } ?>
						</select>
					</div>
				</div>

				<hr/>

				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Horario de comienzo : &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<input id="crear_parque_actividad_horario_comienzo" type="text" class="form-control" placeholder="Horario de comienzo">
					</div>
				</div>

				<hr/>

				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Horario de finalizacion : &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<input id="crear_parque_actividad_horario_finalizacion" type="text" class="form-control" placeholder="Horario de finalizacion">
					</div>
				</div>

				<hr/>

				<div class="form-group">
					<div>
						<label class="control-label" style="color: #000000;">Dias : &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</label>
					</div>
					<div>
						<input id="crear_parque_actividad_dias" type="text" class="form-control" placeholder="Dias">
					</div>
				</div>

				<p id="cargar_form_admin_crear_actividad_parque" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				<p id="error_form_admin_crear_actividad_parque" text-danger" style="font-weight: bold;"></p>			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type='button' class="btn btn-default" id="crearActividadParque" onclick="cargando_crear_actividad_parque()">Crear</button>
			</div>
		</div>
	</div>
</div>

<!-- Ventana Modal Agregar Feria Comun-->
<div id="modal_agregar_feria_comun_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array("name" => "form-agregar-feria-comun-parque", "id" => "form-agregar-feria-comun-parque", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
			echo form_open_multipart("encuesta/realizar", $attributes);?>			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" style="color: #000000;">
							<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
							<?echo $parque->nombre;?>
						</h4>
				</div>
				
				<div class="modal-body" id="myModalBody">
					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Tipo: &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Tipo">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Fechas : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Fechas">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Latitud :</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Latitud">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Longitud :</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Longitud">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<p id="cargar_encuesta" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type='submit' class="btn btn-default" onclick="cargando_encuesta()">Crear</button>
				</div>
			</form>
		</div>
	</div>
</div>	


<!-- Ventana Modal Agregar Feria itinerante-->
<div id="modal_agregar_feria_itinerante_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array("name" => "form-agregar-feria-itinerante-parque", "id" => "form-agregar-feria-itinerante-parque", "role" => "form-group", "method"=>"POST", "enctype" => "multipart/form-data");
			echo form_open_multipart("encuesta/realizar", $attributes);?>			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" style="color: #000000;">
							<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
							<?echo $parque->nombre;?>
						</h4>
				</div>
				
				<div class="modal-body" id="myModalBody">
					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Direccion: &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Direccion">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Dias : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Dias">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Latitud :</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Latitud">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<div class="form-group">
						<div>
							<label for="nombre" class="control-label" style="color: #000000;">Longitud :</label>
						</div>
						<div>
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Longitud">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>

					<hr/>

					<p id="cargar_encuesta" style="font-weight: bold;"><font color="green">Cargando....</font></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type='submit' class="btn btn-default" onclick="cargando_encuesta()">Crear</button>
				</div>
			</form>
		</div>
	</div>
</div>	


<script>
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
</script>




<script>
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
					formData.append($(this).attr("name"), $(this).is(":checked")); // se agregan los checkbox
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
					$("#error_form_admin_actualizar_actividad_parque").append(json.message).css({"display":"block", "color":"green"}); // Se reutilizo el p de error en la ventana modal de reclamo
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}						
			}
		})

/*		console.log(formData);

		var values = {};
		$('.activty input.pt-3-half').each(function(n, el){
			console.log(el);
	   		values[ $(el).attr('id') ] = $(el).val();
		});
*/
	});
});
</script>


<script>
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
</script>



<script>
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
</script>