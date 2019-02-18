<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Crear Parque</h2>
			</div>
		</div>
		
		<hr>
		<br>

		<div class="row">
			<div class="col-md-12">
	 			<?php echo form_open("parques/crear", array("id" => "form-admin-crear-parque", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Nombre : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input name="nombre" type="text" class="form-control" placeholder="Nombre del parque">
							<p class="errornombre text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="apellido" class="control-label">Descripcion : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<textarea id="comentario_contacto" class="form-control" name="comentario" style="max-width: 100%" rows="2" style="color: #000000;" placeholder="Descripcion"></textarea>
							<p class="error_comment_contacto text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Direccion : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input name="nombre" type="text" class="form-control" placeholder="Direccion">
							<p class="errornombre text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="busqueda_personalizada_patio_juego" class="control-label">Patio de Juegos :</label>
						</div>
						<div class="col-sm-10">
							<input type="checkbox" name="busqueda_personalizada_patio_juego" value="1">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="busqueda_personalizada_patio_juego" class="control-label">Wifi :</label>
						</div>
						<div class="col-sm-10">
							<input type="checkbox" name="busqueda_personalizada_patio_juego" value="1">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Latitud :
							</label>
						</div>
						<div class="col-sm-8">
							<input name="nombre" type="text" class="form-control" placeholder="Latitud">
							<p class="errornombre text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Longitud :
							</label>
						</div>
						<div class="col-sm-8">
							<input name="nombre" type="text" class="form-control" placeholder="Longitud">
							<p class="errornombre text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Url Parque :
							</label>
						</div>
						<div class="col-sm-8">
							<input name="nombre" type="text" class="form-control" placeholder="Url parque">
							<p class="errornombre text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Barrio :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>

						<div class="col-sm-4">
							<select id="barrio" name="barrio" class="form-control">
								<?foreach($barrios as $barrio) { ?>
									<option value="<?echo $barrio->id_barrio;?>"><? echo $barrio->barrio;?></option>
								<? } ?>
							</select>
							<p class="errorcrearparquebarriotext-danger"></p>
						</div>
		 			</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Comuna :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>

						<div class="col-sm-4">
							<select id="comuna" name="comuna" class="form-control">
								<?foreach($comunas as $comuna) { ?>
									<option value="<?echo $comuna->id_comuna;?>"><? echo $comuna->comuna;?></option>
								<? } ?>
							</select>
							<p class="errorcrearparquecomuna text-danger"></p>
						</div>
		 			</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="busqueda_personalizada_patio_juego" class="control-label">Activo :</label>
						</div>
						<div class="col-sm-10">
							<input type="checkbox" name="busqueda_personalizada_patio_juego" value="1">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_reg()">Crear Parque</button>
						</div>
					</div>
					<p id="cargar" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_registro" class="errorform_registro text-danger" style="font-weight: bold;"></p>

					<br>

					<div class="form-group">
						<div class="col-sm-2">
							<label class="control-label" style="color: #000000;">Cargar Excel : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>					
						<div class="col-sm-8">
							<input accept=".csv" type="file" name="fileExcel" id="fileExcel" class="form-control">
							<p class="error_fileExcel text-danger"></p>
						</div>
					</div>
					<hr>
					<br>
					<div class="form-group">
						<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button id="actualizar_parque" type='submit' class="btn btn-default" onclick="cargando_actualizar_parques()">Cargar Excel</button>
						</div>
					</div>
					<p id="cargar_form_cargar_parque_excel" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_cargar_parque_excel" class="errorform_enviar_reclamo_documento_email text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br><br><br><br>
