<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Enviar Documento</h2>
			</div>
		</div>
		
		<hr>
		<br>

		<div class="row">
			<div class="col-md-12">
	 			<?php echo form_open("reclamo/enviarEmail", array("id" => "form-admin-reclamo", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="email_comuna" class="control-label" style="color: #000000;">Email Comuna : &nbsp;&nbsp;&nbsp;
							</label>
						</div>
						<div class="col-sm-8">
							<input id ="email_comuna" name="email_comuna" type="text" class="form-control" placeholder="Email Comuna">
							<p class="error_reclamo_email_comuna text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="email_ong" class="control-label" style="color: #000000;">Email ONG : &nbsp;&nbsp;&nbsp;
							</label>
						</div>
						<div class="col-sm-8">
							<input id ="email_ong" name="email_ong" type="text" class="form-control" placeholder="Email ONG">
							<p class="error_reclamo_email_ong text-danger"></p>
						</div>
					</div>								
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="reclamo_documento" class="control-label" style="color: #000000;">Cargar Documento : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>					
						<div class="col-sm-8">
							<input accept=".docx" type="file" name="fileDocumento" id="fileDocumento" class="form-control">
							<p class="error_fileDocument text-danger"></p>
						</div>
					</div>
					<hr>				

					<div class="form-group">
						<div class="col-sm-2">
							<label for="comentario" style="color: #000000;">Comentarios : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>	
						<div class="col-sm-8">
							<textarea id="comentario_reclamo_email" class="form-control" name="comentario" style="max-width: 100%" rows="2" style="color: #000000;" placeholder="Escriba sus comentarios..."></textarea>
							<p class="error_reclamo_comentario text-danger"></p>
						</div>
					</div>	
					<hr>
					
					<div class="form-group">
						<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button id="enviar_email_reclamo" type='submit' class="btn btn-default" onclick="cargando_reclamos_enviar_email()">Enviar</button>
						</div>
					</div>
					<p id="cargar_form_enviar_reclamo_email" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_enviar_reclamo_documento_email" class="errorform_enviar_reclamo_documento_email text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>