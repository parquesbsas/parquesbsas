<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">¿No te ha llegado el email de confirmación de registro?</h2>
				<p style="color: #999; font-size: 18px ">Ingresa tu email con el que te registraste y lo volveremos a intentar.</p>
			</div>
		</div>
		<hr>
		<br/><br/><br/>

		<div class="row">
			<div class="col-md-12">

				<?php echo form_open("reenviar_email/enviar", array("id" => "form-resend_email", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" class="control-label">Email : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input id ="email_resend" name="email_resend" type="text" class="form-control" placeholder="Email">
							<p id= "form_error_email_reenviar"></p>
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
							<button type='submit' class="btn btn-default" onclick="cargando_reg()">Enviar</button>&nbsp;
						</div>
					</div>

					<p id="cargar"><font color="green">Cargando....</font></p>
					<p id="error_email_resend" class="erroremail_resend text-danger" style="font-weight: bold;"></p>
					<br/><br/>
				</form>
			</div>
		</div>
	</div>
</div>