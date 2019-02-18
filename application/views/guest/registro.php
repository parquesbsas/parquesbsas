<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Registro</h2>
			</div>
		</div>
		<hr>
		<br>

		<div class="row">
			<div class="col-md-12">
	 			<?php echo form_open("registro/crear", array("id" => "form-user", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="nombre" class="control-label">Nombre : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
							<p class="errornombre text-danger"></p>
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
							<input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido">
							<p class="errorapellido text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="numero_documento" class="control-label">Documento :</label>
						</div>

						<div class="col-sm-4">
							<select id="tipo_dni" name="tipo_dni" class="form-control">
								<?foreach($tipo_dni as $key) { ?>
									<option value="<?echo $key->id_tipo_documento;?>"><? echo $key->descripcion;?></option>
								<? } ?>
							</select>
							<p class="errortipodni text-danger"></p>
						</div>

						<div class="col-sm-6">
							<input id="numero_documento" name="numero_documento" type="text" class="form-control" placeholder="Numero de documento">
							<p class="errornumero_documento text-danger"></p>
						</div>
		 			</div>
					<hr>	 			

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="email_reg" class="control-label">Email : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input id ="email_reg" name="email_reg" type="text" class="form-control" placeholder="Email">
							<p class="erroremail_reg text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="password" class="control-label">Contraseña : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
							<p class="errorpassword text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label style="color: #000000;" for="password_confirm" class="control-label">Repetir Contraseña : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-10">
							<input type="password" class="form-control"  name="password_confirm" id="password_confirm" placeholder="Repetir Contraseña">
							<p class="errorpassword_confirm text-danger"></p>
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
						<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button type='submit' class="btn btn-default" onclick="cargando_reg()">Registrase</button>
							&nbsp;
							<button class="btn btn-danger">Cancelar</button>
						</div>
					</div>
					<p id="cargar" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_registro" class="errorform_registro text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>

<?


$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '+1 hour' , strtotime ( $fecha ) ) ;
$nuevafecha = strtotime ( '+13 minute' , strtotime ( $fecha ) ) ;
$nuevafecha = strtotime ( '+30 second' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

//echo date( "H-i-s", strtotime("+ minute" ) );







/*     $d = $hoy["mday"];
		 $m = $hoy["mon"];
		 $y = $hoy["year"];

		 $h = $hoy["hours"];
		 $mn = $hoy["minutes"];
		 $s = $hoy["seconds"];

$date = $d."-".$m."-".$y."</br>";
$hora = $h.":".$mn.":".$s."</br>";
$suma = $mn + 5 ."</br>";
$fecha_creacion = $d."-".$m."-".$y." ".$h.":".$mn.":".$s."</br>";
echo($fecha_creacion);
echo($date);
echo($hora);
echo($suma);
	 $contraseña = "12345678aA@";

	 $encrypted_string = $this->encrypt->encode($contraseña);
	 $encrypted_string2 = $this->encrypt->encode($contraseña);
	 //$opciones = [
	 // "salt" => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	 // ];

 //   $salame = password_hash($contraseña, PASSWORD_BCRYPT, $opciones);

echo $encrypted_string."</br>";

echo $encrypted_string2."</br>";

$des =$this->encrypt->decode($encrypted_string);
$des2 =$this->encrypt->decode($encrypted_string2);
if($des2 === $contraseña){
echo $des."</br>";
}
;
*/
?>