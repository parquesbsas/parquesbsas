<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">   
				<h2 class="text-left">Contacto</h2>
				<p style="font-size:18px">Envianos tus comentarios o sugerencias acerca de la aplicación</p>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php $attributes = array("name" => "form-contacto", "id" => "form-contacto", "class" => "form-horizontal", "method"=>"POST");
				echo form_open_multipart("contacto/enviar", $attributes);?>				
							
					<div class="form-group">
						<div class="col-sm-2">
							<label for="asunto" class="control-label" style="color: #000000;">Asunto : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="asunto_contacto" name="asunto" type="text" class="form-control" placeholder="Asunto">
							<p class="errorasunto_contacto text-danger"></p>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="nombre" class="control-label" style="color: #000000;">Nombre : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id="nombre_contacto" name="nombre" type="text" class="form-control" placeholder="Nombre">
							<p class="errornombre_contacto text-danger"></p>
						</div>
					</div>
					<hr>
					
					<div class="form-group">
						<div class="col-sm-2">
							<label for="email" class="control-label" style="color: #000000;">Email : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input id ="email_contacto" name="email" type="text" class="form-control" placeholder="Email">
							<p class="erroremail_contacto text-danger"></p>
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
							<textarea id="comentario_contacto" class="form-control" name="comentario" style="max-width: 100%" rows="2" style="color: #000000;" placeholder="Escriba sus comentarios..."></textarea>
							<p class="error_comment_contacto text-danger"></p>
						</div>
					</div>	
					<hr>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->recaptcha->render();?>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_contacto()">Enviar</button>
						</div>
					</div>
					<p id="error_email_contacto" class="erroremail_enviar_contacto text-danger" style="font-weight: bold;"></p>
					<p id="cargar_contacto"><font style="font-size:20px;font-weight: bold;" color="green">Cargando....</font></p>
				</form>
			</div>
		</div>
	</div>
</div>