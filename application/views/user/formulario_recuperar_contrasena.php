<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Recuperar Contraseña</h2>
				<p style="color: #999; font-size: 18px">Ingresa la contraseña nueva.</p>
			</div>
		</div>
		<hr>
		<br><br><br>

		<div class="row">
			<div class="col-md-12">
				<?php echo form_open("recuperar_contrasena/validarFormulario", array("id" => "form-validated_reset_password", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="password_new" class="control-label">Contraseña : &nbsp;&nbsp;&nbsp;
							<span style="font-size:85%;" class="label label-warning">Requerido</span></label>
						</div>

						<div class="col-sm-10">
							<input type="password" name="contraseña" class="form-control" id="password_new" placeholder="Contraseña">
							<p class="errorpassword_new text-danger"></p>
						</div>
					</div>

					<input type="hidden" name="email_pass" class="form-control" value="<?echo $email?>">
					<br>
					<hr>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->recaptcha->render();?>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="control-label col-xs-4"></label>
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_reg()">Actualizar</button>
						</div>
					</div>
				
					<p id="cargar" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_recuperar_contraseña" class="errorrecuperar_contraseña text-danger" style="font-weight: bold;"></p>
					<br/>
				</form>
			</div>
		</div>
	</div>
</div>

