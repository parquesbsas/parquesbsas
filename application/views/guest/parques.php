<div class="section section-info text-center"> 
	<div class="container">
		<link href="<?=base_url()?>plantilla/css/star_rating.css" rel="stylesheet"  type="text/css">
		<div class="row"> 
		<?php
		foreach($parques as $parque) {
			$imagen = empty($parque->imagen) ? base_url('public/img/parques/default.jpg') : base_url('public/img/parques').'/'.$parque->imagen;
		?>

			<div class="col-md-4 text-center">
				<img class="img-responsive img-rounded center-block" style="width:400px; height:270px;" src="<?=$imagen?>"> 
				<h2 class="text-center"><?php echo($parque->nombre)?></h2>
				<div class="text-center">
					<?php 
						$tamaño = 24;
						$cuenta = 0;
						$likes = intval($parque->likes);
						$hates = intval($parque->hates);
						$total = $likes + $hates;
						$porciento = 0;
						if($total > 0) {
							$cuenta = $likes/$total; 
							echo "<ul class='stars stars-". $tamaño ."' data-value='". $cuenta . "' data-votes='". $total ."' data-id='". $parque->id_parque ."'>";
							echo "<li data-vote='1'>1</li>";
							echo "<li data-vote='2'>2</li>";
							echo "<li data-vote='3'>3</li>";
							echo "<li data-vote='4'>4</li>";
							echo "<li data-vote='5'>5</li>";
						} else {
							echo "<ul class='stars stars-". $tamaño ."' data-value='". $cuenta . "' data-votes='". $total ."' data-id='". $parque->id_parque ."'>";
							echo "<li data-vote='1'>1</li>";
							echo "<li data-vote='2'>2</li>";
							echo "<li data-vote='3'>3</li>";
							echo "<li data-vote='4'>4</li>";
							echo "<li data-vote='5'>5</li>";
						}

						if($cuenta > 0) {
							$maximo_posible = 5 * $total; 
							$porciento = $likes / $total * 100; 
							echo "<div class='voted_percent votes-".$tamaño."' style='width:".$porciento."%'></div>";
						} else {
							echo "<div class='voted_percent votes-".$tamaño."' style='width:0%'></div>";
						}

						if(!empty($porciento)) {
							echo "<span data-txtoriginal='$porciento/5 en ".$total." votos'>".number_format($porciento)."% en ".$total." votos</span></ul>";
						} else {
							echo "<span data-txtoriginal='$porciento/5 en ".$total." votos'>".number_format($porciento)."% en ".$total." votos</span></ul>";
						}
					?>
				</div>
				<br>
				<div class="text-center">
					<a class="btn btn-primary" href="<?=base_url()?>busqueda/parque/<?=$parque->url_parque?>/<?=$parque->id_parque?>"> Ver Parque</a>
				</div>
				<br><br>
			</div>
		<?}?>	 
		</div>
		<?php echo $pagination ?>
	</div>
</div>
