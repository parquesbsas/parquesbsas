<?//eñ id="body_mod" de abajo CORRIGE EL DESPLAZAMIENTO NO BORRAR
//Barra de navegacion?>
<body id="body_mod" style=" background-color :#FFFFFF">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"  href ="<?=base_url()?>" >
						<span><img height="30" alt="Brand"  src="<?=base_url('public/img').'/'.$logo?>"></span>
						<span>Parques BsAs</span>
				</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar-ex-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active">
						<a href="<?php echo(base_url() ."parques")?>">Parques</a>
					</li>
					<li>
						<a href="<?php echo(base_url() ."estadisticas")?>">Estadisticas</a>
					</li>

					<li class="active">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Buscar por &nbsp;<i class="fa fa-caret-down"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo(base_url() ."busqueda/barrio")?>">Barrios</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo(base_url() ."busqueda/comuna")?>">Comunas</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo(base_url() ."busqueda_personalizada")?>">Busqueda Personalizada</a></li>
						</ul>
					</li>

					<?php $attributes = array("class" => "navbar-form navbar-left", "name" => "busqueda_parque_form", "id" => "busqueda_parque_form", "role" => "form", "method"=>"post"); echo form_open("busqueda/parque", $attributes);?>
						<div class="form-group">
							<div class="input-group">
								<input id="buscar_parque" name="buscar_parque" type="text" class="form-control" placeholder="Buscar parque...">
								<div class="input-group-btn">
									<button class="btn btn-default" name="submit" type="submit" style="background-color:#34815f; border-color:#34815f; height:34px;">
										<i class="glyphicon glyphicon-search"></i>
									</button>
								</div>
							</div>
						</div>

					  <!--
						<div class="form-group">
							<div class="input-group">
								<input id="buscar_parque" name="buscar_parque" type="text" class="form-control" placeholder="Buscar parque...">
							</div>
						</div>
						<button class="btn btn-success" name="submit" type="submit" style="background-color:#34815f; border-color:#34815f;"><span class="glyphicon glyphicon-search"></span></button>
						-->
					<?php echo form_close();?>

					<?php if($this->session->userdata("login")) { ?>

						<li class="active">
							<a href="" data-toggle="dropdown" role="button" aria-expanded="false"> <? echo($this->session->user_name)?>&nbsp; <i class="fa fa-caret-down"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?=base_url()?>perfil/">Pefil</a></li>
								<li class="divider"></li>
								<li><a href="<?=base_url()?>reclamo">Mis Reclamos</a></li>
								<li class="divider"></li>
								<?php if($this->session->perfil == "2") {?>
									<li><a href="<?=base_url()?>reclamo/documentos">Documentos</a></li>
									<li class="divider"></li>
									<li> <a href="<?=base_url()?>reclamo/enviarEmail" data-toggle="modal">Enviar Email Documento</a> </li>
									<li class="divider"></li>
									<li><a href="<?=base_url()?>administrador">Actualizar Administradores</a></li>
									<li class="divider"></li>
									<li><a href="<?=base_url()?>parques/editar">Crear/Administrar Parques</a></li>
									<li class="divider"></li>
								<?}?>
								<li> <a href="" id="modal_delete_user" data-toggle="modal">Eliminar Cuenta</a> </li>
								<li class="divider"></li>
								<li> <a href="<?=base_url()?>sesion/logout">Cerrar Sesion</a> </li>
							</ul>
						</li>
					<?php } else {?>
						<li class="active">
							<a href="" id="modal_login" data-toggle="modal">Iniciar Sesion</a>
						</li>
					<?}?>
				</ul>
			</div>
		</div>
	</nav>


<!-- Ventana modal Iniciar Sesion-->
<div id="Modal_login" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array("name" => "form_sesion", "id" => "form_sesion", "role" => "form", "method"=>"post");
				echo form_open("sesion/login", $attributes);?>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>"> Iniciar Sesion
					</h4>

				</div>

				<div class="modal-body">
					<div class="form-group">
						<div>
							<label for="email" style="color: #000000;">Email</label>
							<input class="form-control" id="email_login" name="email" placeholder="Ingresar Email" type="text" value=""/>
							<p class="erroremail_sesion text-danger"></p>
						</div>
					</div>

					<div class="form-group">
						<div>
							<label for="contraseña" style="color: #000000;">Contraseña</label>
							<input class="form-control" id="password_login" name="contraseña" placeholder="Ingresar Contraseña" type="password" value=""/>
							<p class="errorcontraseña_sesion text-danger"></p>
						</div>
					</div>

					<div align=center >
						<a href ="<?=base_url("/google_login")?>">
							<img  style="width:300px; height:48px;" alt="Brand" class="img-responsive" src="<?=base_url("public/img/google.png")?>">
						</a>
					</div>

					<br>

					<div style="color: #000000;height: 30px;">
						<a href="<?=base_url()?>recuperar_contrasena">Olvidé mi contraseña</a>	|	<a href="<?=base_url()?>registro">Registrarse</a>
					</div>

					<hr style="margin-top:5px; margin-bottom :15px; border-top: 1px solid #e5e5e5;"/>

					<p style="color: #000000; font-size: 15px; font-weight: bold;" >No te llego el email de activacion?</p>
					<a href="<?=base_url()?>reenviar_email">Reenviar email de activacion</a>
					<br><br>
					<div>
						<p id="message_errorsesion" class="message_error_sesion text-danger" style="font-weight: bold;"></p>
						<p id="cargar_sesion"><font style="font-size:15px;font-weight: bold;" color="green">Cargando....</font></p>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-default" onclick="cargando_sesion()">Ingresar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>

			<?php echo form_close();?>
		</div>
	</div>
</div>



<!-- Eliminar Usuario -->
<div id="modal_delete_user_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" style="color: #000000;">
					<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
					 <label style="color: #000000;">Eliminar Cuenta</label>
				</h4>
			</div>
			<div class="modal-body" id="myModalBody">
				<div class="form-group">
					<label for="email" style="color: #000000;">Atencion!</label>
					<p style="color: #000000;">Se eliminaran todos tus datos de la app Parques Bs As, si estas de acuerdo pulse el boton eliminar.</p>
				</div>
				<div class="form-group" style="text-align: center;" >
					<a class="btn btn-warning" href="<?=base_url()?>perfil/eliminar">Eliminar</a>
					<br>
				</div>
				<div class="modal-footer">
					<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar"/>
				</div>
			</div>
		</div>
	</div>
</div>