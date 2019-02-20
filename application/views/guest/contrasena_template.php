<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<title>Recuperar Contraseña</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
						<td align="center" bgcolor="#34815f" style="padding: 10px 0 10px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;display:flex;align-items: center;">
							<div>
								<img src="cid:logo"  style="display: block; height:73px;padding-left: 140px;"/>
							</div>
							<span style="color:white;font-size: 24px;margin-left:20px;margin-top: 22px;">Parques Bs As</span>

						</td>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Hola <?php echo $usuario->nombre?>!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										Si usted ha olvidado su contraseña, ingrese al siguiente link para cambiarlo:
										<br><br><br>
										<div style="text-align: center;font-size:20px;">
										<span><a href="<?=base_url().'recuperar_contrasena/formulario/'.$usuario->email.'/'.$usuario->token;?>" style="color: #ffffff;"><font color="black">Cambiar Contraseña</font></a></span>
										</div>
										<br>
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