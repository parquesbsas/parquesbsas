<?
//var_dump($result);
?>
<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Perfil</h2>
				<p style="font-size:18px">Actualiza tus datos personales.	</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12">
				<div id="the-message"></div>

				<?php echo form_open("perfil/actualizar", array("id" => "form-update", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Nombre : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>

						</div>	
						<div class="col-sm-10">
							<input id="nombre_act" name="nombre" type="text" class="form-control" placeholder="Nombre" value ="<?echo $result->nombre?>">
							<p class="errornombre_act text-danger"></p>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="apellido" class="control-label">Apellido : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input id="apellido_act" name="apellido" type="text" class="form-control" placeholder="Apellido" value ="<?echo $result->apellido?>">
							<p class="errorapellido_act text-danger"></p>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="tipo_dni" class="control-label">&nbsp;Documento :</label>
						</div>

						<div class="col-sm-4">
							<select id="tipo_dni_act" name="tipo_dni" class="form-control">
								<? foreach($tipo_dni as $key) { ?>
								<option value="<?echo $key->id_tipo_documento;?>"><?echo $key->descripcion;?></option>
								<? } ?>
							</select>
							<p class="errortipodni_act text-danger"></p>
						</div>

						<div class="col-sm-6">
							<input id="numero_documento_act" name="numero_documento_act" type="text" class="form-control" placeholder="Numero de documento" value ="<?echo $result->numero_documento?>">
							<p class="errornumero_documento_act text-danger"></p>
						</div>
					</div>

					<hr>					

					<?php if((!empty($result->id_google) && !empty($result->contrasenia)) || (empty($result->id_google) && !empty($result->contrasenia))) {?>
						<div class="form-group">
							<div class="col-sm-2">
								<label style="color: #000000;" for="password_act" class="control-label">Contraseña : &nbsp;&nbsp;&nbsp;
									<span style="font-size:85%;" class="label label-warning">Requerido</span>
								</label>
							</div>
							<div class="col-sm-10">
								<input type="password" name="password_act" class="form-control" id="password_act" placeholder="Contraseña..." value ="<?echo $result->contrasenia?>">
								<p class="errorpassword_act text-danger"></p>
							</div>
						</div>
						<hr>
					<?php }?>

					<?php if(empty($result->id_google)) { ?>
						<div class="form-group">
							<div class="col-sm-2">
								<label class="control-label">Vincular Cuenta :</label>
							</div>
							<div class="col-sm-10">
								<a href ="<?=base_url("/google_login")?>">
									<img style="width:300px; height:48px;" alt="Brand" class="img-responsive" src="<?=base_url("public/img/vincularGoogle.png")?>">
								</a>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<div class="col-sm-2">
								<label class="control-label">Cuenta Registrada con :</label>
							</div>
							<div class="col-sm-10">
								<img title="Parques BsAs" style="width:80px; height:80px;" class="img-responsive" src="<?=base_url("public/img/logo.png")?>">
							</div>
						</div>
					<?} else {?>

						<div class="form-group">
							<div class="col-sm-2">
								<label class="control-label">Cuenta Registrada con :</label>
							</div>
							<div class="col-sm-10">
								<img title="Google+" style="width:80px; height:80px;" class="img-responsive" src="<?=base_url("public/img/googleLogo.png")?>">
								<?php if(!empty($result->contrasenia)) {?>
									<img title="Parques BsAs" style="width:70px; height:70px;" class="img-responsive" src="<?=base_url("public/img/logo.png")?>">
								<?php }?>
							</div>
						</div>
					<?php }?>

					<input type="hidden" name="validar_contrasenia_act" id="validar_contrasenia_act" value="<?echo !empty($result->contrasenia);?>">
					<input type="hidden" name="id_user_act" id="id_user_act" value="<?echo $result->id_usuario;?>">

					<hr>

					<div class="form-group">
						<label class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_actualizar_perfil()">Actualizar</button>
						</div>
					</div>
					<p id="cargar_actualizar_perfil"><font style="font-size:20px;font-weight: bold;" color="green">Cargando....</font></p>
					<p id="error_form_actualizar" class="errorform_actualizar text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>

