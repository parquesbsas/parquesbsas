<div class="section section-info">
	<div class="container">
		<div class="row">
		<h2 class="text-left">Busqueda Personalizada</h2>
			<div class="col-md-12">
			</br>
				<div class="row">
					<div class="col-md-12">
						<?php echo form_open("busqueda_personalizada/buscar", array("id" => "form_busqueda_personalizada", "class" => "form-horizontal")) ?>

							<div class="form-group">
								<div class="col-sm-2">
									<label for="actividades" class="control-label">Actividades :</label>
								</div>
								<div class="col-sm-10	">
										<? foreach($busqueda_personalizada["actividades"] as $actividad) { ?>
											<label class="checkbox-inline"><input type="checkbox" name="busqueda_personalizada_actividades_<?echo($actividad->id_actividad)?>" value="<?echo($actividad->id_actividad)?>"><?echo($actividad->nombre)?></label>
											</br>
										<? } ?>
								</div>
							</div>							

							<div class="form-group">
								<div class="col-sm-2">
									<label for="busqueda_personalizada_ferias_itinerantes" class="control-label">Ferias Itinerantes :</label>
								</div>
								<div class="col-sm-10">
										<input type="checkbox" name="busqueda_personalizada_ferias_itinerantes" value="1">
									</div>
							</div>

							<div class="form-group">
								<div class="col-sm-2">
									<label for="ferias_comunes" class="control-label">Ferias Comunes :</label>
								</div>
								<div class="col-sm-2">
									<select id="busqueda_personalizada_ferias_comunes" name="busqueda_personalizada_ferias_comunes" class="form-control">
										<? foreach($busqueda_personalizada["ferias_comunes"] as $feria) { ?>
											<option value="<?echo $feria->tipo;?>"><? echo $feria->tipo;?></option>
										<? } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-2">
									<label for="busqueda_personalizada_centro_salud" class="control-label">Centro de Salud :</label>
								</div>
								<div class="col-sm-10">
									<input type="checkbox" name="busqueda_personalizada_centro_salud" value="1">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-2">
									<label for="busqueda_personalizada_patio_juego" class="control-label">Patio de Juegos :</label>
								</div>
								<div class="col-sm-10">
									<input type="checkbox" name="busqueda_personalizada_patio_juego" value="1">
								</div>
							</div>

							<div class="form-group">
								<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
								<div class="col-sm-offset-2 col-sm-10">
									<button type='submit' class="btn btn-default" onclick="cargando_reg()">Buscar</button>
									&nbsp;
								</div>
							</div>

						<p id="errorbusquedapersonalizada" style="display:none;"><font color="red"></font></p>
						<p id="cargar"><font color="green">Cargando....</font></p>
						</br>
						</form>
						<div class="row" id="resultado_busqueda_personalizada">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--
SELECT p.nombre, p.id_parque FROM `parques` p, ferias_comunes fc, estaciones_salud es, ferias_itinerantes fi, parques_actividades pa WHERE p.patio_juegos = 1 and p.id_parque = fc.id_parque and p.id_parque = es.id_parque and p.id_parque = fi.id_parque and fc.tipo = "MANUALIDADES Y ANTIGÜEDADES" and p.id_parque = pa.id_parque and pa.id_actividad = 1 group by p.nombre

ACTUALIZADO

SELECT p.nombre, p.id_parque FROM `parques` p, ferias_comunes fc, estaciones_salud es, ferias_itinerantes fi, parques_actividades pa WHERE p.patio_juegos = 1 and p.id_parque = fc.id_parque and p.id_parque = es.id_parque and p.id_parque = fi.id_parque and fc.tipo in ("MANUALIDADES Y ANTIGÜEDADES", "ARTESANIAS") and p.id_parque = pa.id_parque and pa.id_actividad in (4) group by p.nombre
https://stackoverflow.com/questions/33987679/select-products-by-multiple-attributes-using-and-instead-or-concatenator-data
 -->