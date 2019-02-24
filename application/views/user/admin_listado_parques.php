<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="admin_listado_parques">
				<h2 class="text-left" "><b>Registros de parques</b></h2>
				<p style="text-align: left;">
					<a type="button" class="btn btn-success btn-rounded" href="<?echo base_url()."parques/crear"?>">Agregar Nuevo Parque</a>
				</p>
				<hr>
				<input class="form-control" type="text" id="myInput" onkeyup="buscarNombre()" placeholder="Buscar parque..." title="Buscar parque">
				<br/>
				<?php if(!empty($parques)) {
					foreach($parques as $key => $parque) { ?>
					<div class="panel panel-default" id= "<?php echo $parque->nombre ." ". $parque->direccion?>">
						<div class="panel-heading">
							 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-<?echo($key)?>"><?php echo($parque->nombre ." | Direccion : ". $parque->direccion ." | Estado : ". (empty($parque->activo) ? "Inactivo" : "Activo"))?></a>
						</div>
						<div id="panel-element-<?echo($key)?>" class="panel-collapse collapse">
							<a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="<?=base_url()?>parques/administrar/<?=$parque->id_parque?>">Detalle
							</a>
						</div>
					</div>
				<?php }
				} else {?>
					<strong><p style="color: #black; font-size: 18px ">No existen parques registrados.</p></strong>
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
	filter = input.value.toLowerCase();
	div = document.getElementById("admin_listado_parques");
	elements = div.getElementsByClassName("panel panel-default");
	for(i = 0; i < elements.length; i++) {
		td = elements[i];
		if(td) {
			txtValue = td.id.toLowerCase();
			if(txtValue.indexOf(filter) > -1) {
				elements[i].style.display = "";
			} else {
				elements[i].style.display = "none";
			}
		}
	}
}
</script>