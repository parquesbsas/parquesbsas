<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left"><strong>Resultado de busqueda:</strong></h2>
				<div class="row">
					<div class="col-md-12">
						<span style="font-size:16px;">Se han encontrado los siguientes resultados.</span>
						</br></br>
						</br></br>

						<?php if(!empty($parques)) {
							foreach($parques as $key => $parque) { ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-<?echo($key)?>"><?php echo($parque->nombre)?></a>
								</div>
								<div id="panel-element-<?echo($key)?>" class="panel-collapse collapse">
									<a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="<?=base_url()?>busqueda/parque/<?=$parque->url_parque."/".$parque->id_parque?>"> Ver Parque
									</a>
								</div>
							</div>
							</br>
						<?php }
						} else {?>
							<strong><p style="color: #black; font-size: 18px ">No se encontro ningun parque.</p></strong>
							<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<?php }?>	
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>