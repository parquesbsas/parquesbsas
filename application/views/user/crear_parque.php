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
							<label style="color: #000000;" class="control-label">Nombre : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="crearParqueNombre" type="text" class="form-control" placeholder="Nombre del parque">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Descripcion : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<textarea class="form-control" id="crearParqueDescripcion" style="max-width: 100%" rows="2" style="color: #000000;" placeholder="Descripcion"></textarea>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Direccion : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="crearParqueDireccion" type="text" class="form-control" placeholder="Direccion">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Barrio :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>

						<div class="col-sm-4">
							<select id="crearParqueBarrio" class="form-control">
								<?foreach($barrios as $barrio) { ?>
									<option value="<?echo $barrio->id_barrio;?>"><? echo $barrio->barrio;?></option>
								<? } ?>
							</select>
						</div>
		 			</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Comuna :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>

						<div class="col-sm-4">
							<select id="crearParqueComuna" class="form-control">
								<?foreach($comunas as $comuna) { ?>
									<option value="<?echo $comuna->id_comuna;?>"><? echo $comuna->comuna;?></option>
								<? } ?>
							</select>
						</div>
		 			</div>

		 			<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;">Cargar Imagen</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>
						<div class="col-sm-8">
							<input accept="image/jpeg" type="file" id="crearParqueImagen" class="form-control">
							<p>Tipo de Imagen: jpg | Tamaño maximo: 2mb | Resoluciones maximas: 1680 alto x 1054 ancho</p>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Url Parque :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
						</div>
						<div class="col-sm-8">
							<input id="crearParqueUrl" type="text" class="form-control" placeholder="Url parque">
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label class="control-label">Patio de Juegos :</label>
						</div>
						<div class="col-sm-10">
							<input type="checkbox" id="crearParquePatioJuego" value="1">
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label class="control-label">Wifi :</label>
						</div>
						<div class="col-sm-10">
							<input type="checkbox" id="crearParqueWifi" value="1">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Latitud :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="crearParqueLatitud" type="text" class="form-control" placeholder="Latitud">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Longitud :</label> &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="crearParqueLongitud" type="text" class="form-control" placeholder="Longitud">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label  class="control-label col-xs-4"></label>
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_crear_parque()">Crear Parque</button>
						</div>
					</div>
					<p id="cargar_crear_parque" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_crear_parque" class="errorcrear_parque text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=base_url();?>plantilla/js/parque_admin.js"></script>