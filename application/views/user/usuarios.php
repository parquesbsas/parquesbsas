<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="test">
				<h2 class="text-left" "><b>Actualizar administradores</b></h2>
				<p style="font-size: 18px ">En el siguiente listado de usuarios podras actualizar su perfil.</p>
				<hr>
				<input class="form-control" type="text" id="myInput" onkeyup="buscarNombre()" placeholder="Buscar usuario..." title="Buscar usuario">
				<br/>
				<?php if(!empty($usuarios)) {
					foreach($usuarios as $key => $usuario) { ?>
					<div class="panel panel-default" id= "<?php echo $usuario->nombre ." ". $usuario->apellido?>">
						<div class="panel-heading">
							 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-<?echo($key)?>"><?php echo("Nombre : ". $usuario->nombre ." ". $usuario->apellido ."  | Perfil: ". $usuario->perfil)?></a>
						</div>
						<div id="panel-element-<?echo($key)?>" class="panel-collapse collapse">
							<div style="background-color:white;display:flex; align-items:center; align-items:center; justify-content:space-between;">
							
							<?foreach($perfiles as $perfil) {?>
								<a href="<?=base_url()?>administrador/actualizarAdministrador/<?echo $usuario->id_usuario?>/<?echo $perfil->id_tipo?>" type="button" style="color: #fff; background-color:<?=$usuario->id_tipo == $perfil->id_tipo ? "#5cb85c" : "#337ab7"?>; border-color:<?=$usuario->id_tipo == $perfil->id_tipo ? "#4cae4c" : "#2e6da4"?>; width: 47%; padding: 6px; font-size: 17px;" class="btn btn-secondary"><?echo $perfil->descripcion?></a>
								<?}?>
							</div>
						</div>
					</div>
				<?php }
				} else {?>
					<strong><p style="color: #black; font-size: 18px ">Usted todavia no ha realizado ningun reclamo.</p></strong>
				<?php }?>
			</div>
			</br><br/><br/><br/><br/></br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>
	</div>
</div>

<script>
function buscarNombre() {
	var input, filter, div, elements, td, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value;
	div = document.getElementById("test");
	elements = div.getElementsByClassName("panel panel-default");
	for(i = 0; i < elements.length; i++) {
		td = elements[i];
		if(td) {
			txtValue = td.id;
			if(txtValue.indexOf(filter) > -1) {
				elements[i].style.display = "";
			} else {
				elements[i].style.display = "none";
			}
		}
	}
}	
</script>