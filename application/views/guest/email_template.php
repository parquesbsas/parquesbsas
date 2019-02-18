<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
						<td align="center" bgcolor="#34815f" style="padding: 10px 0 10px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;display:flex;align-items: center;">
							<div>
								<img src="cid:logo"  style="display: block; height:80px;padding-left: 140px;"/>
							</div>
							<span style="color:white;font-size: 24px;margin-left:20px;margin-top: 20px;">Parques Bs As</span>

						</td>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Hola <?php echo $usuario->nombre?> bienvenido a Parques Bs As!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										Se ha registrado  correctamente a la aplicacion Parques Bs As. Ingrese a la siguiente url para poder activar su usuario:
										<br><br><br>
										<div style="text-align: center;font-size:20px;">
										<span><a href="<?=base_url().'registro/activar/'.$usuario->email.'/'.$usuario->token;?>" style="color: #ffffff;"><font color="black">Activar Cuenta</font></a></span>
										</div>
										<br>
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="cid:google" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Encontra nuestra app en Google Play y disfruta de la misma funcionalidades de la aplicacion web desde tu smartphone.
															</td>
														</tr>
													</table>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">
													&nbsp;
												</td>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="cid:web" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Al activar su cuenta podra acceder a funcionalidades nuevas tanto como poder dar de alta reclamos, completar encuestas, etc; la aplicacion web es responsive por lo que se adapta a cualquier resolucion.
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; Parques Bs As 2018<br/>
										<a href="#" style="color: #ffffff;"><font color="#ffffff">parquesbsas@gmail.com</font></a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>