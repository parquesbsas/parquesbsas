<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Recuperar Contraseña</h2>
				<p style="color: #999; font-size: 18px">No hay problema! Indícanos tu dirección de email y te la enviaremos en segundos.</p>
			</div>
		</div>
		<hr>
		<br/><br/><br/>

		<div class="row">
			<div class="col-md-12">

				<?php echo form_open("recuperar_contrasena/peticion", array("id" => "form-reset_password", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="email_forget" class="control-label">Email : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input id ="email_forget" name="email" type="text" class="form-control" placeholder="Email">
							<p class="erroremail_forget text-danger"></p>
						</div>
					</div>
					<br/>
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
							<button type='submit' class="btn btn-default" onclick="cargando_reg()">Recuperar</button>
						</div>
					</div>
					<p id="cargar" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_recuperar_contraseña" class="errorform_recuperar_contraseña text-danger" style="font-weight: bold;"></p>
					<br/><br/>
				</form>
			</div>
		</div>
	</div>
</div>

