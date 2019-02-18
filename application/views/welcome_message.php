<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

<?php

$xml = file_get_contents('https://recursos-data.buenosaires.gob.ar/ckan2/ecobici/estado-ecobici.xml');


 $inicio  = strpos($xml,'<Estaciones>');
 $fin  = strpos($xml,'</Estaciones>');

 
 $xml2 = substr($xml,$inicio, $fin-$inicio).'</Estaciones>';
 
 $data  = new SimpleXMLElement($xml2);
/*$lezama = array( 'id' => $data->Estacion[5]->EstacionId,
	             'nombre'=> $data->Estacion[5]->EstacionNombre,
	             'AnclajesTotales'=>$data->Estacion[5]->AnclajesTotales,
	             'AnclajesDisponibles'=>$data->Estacion[5]->AnclajesDisponibles);*/

$parques = array (
    array(
                 'id' => $data->Estacion[5]->EstacionId,
	             'nombre'=> $data->Estacion[5]->EstacionNombre,
	             'AnclajesTotales'=>$data->Estacion[5]->AnclajesTotales,
	             'AnclajesDisponibles'=>$data->Estacion[5]->AnclajesDisponibles
    ),
    array(
                 'id' => $data->Estacion[8]->EstacionId,
	             'nombre'=> $data->Estacion[8]->EstacionNombre,
	             'AnclajesTotales'=>$data->Estacion[8]->AnclajesTotales,
	             'AnclajesDisponibles'=>$data->Estacion[8]->AnclajesDisponibles
    ),
    array(
                  'id' => $data->Estacion[19]->EstacionId,
	             'nombre'=> $data->Estacion[19]->EstacionNombre,
	             'AnclajesTotales'=>$data->Estacion[19]->AnclajesTotales,
	             'AnclajesDisponibles'=>$data->Estacion[19]->AnclajesDisponibles
    ),
    array(
                 'id' => $data->Estacion[27]->EstacionId,
	             'nombre'=> $data->Estacion[27]->EstacionNombre,
	             'AnclajesTotales'=>$data->Estacion[27]->AnclajesTotales,
	             'AnclajesDisponibles'=>$data->Estacion[27]->AnclajesDisponibles
    )
);
 ?>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

	<p>Soy victor  <? echo var_dump($parques);?></p>
	<p>


<?php
$lezama=['nombre'];
//echo $lezama;
$lezama='nombre';
$findme   = 'Lezama';
$pos = strpos($lezama, $findme);

// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
// porque la posición de 'a' está en el 1° (primer) caracter.
/*if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$lezama'";
} else {
    echo "La cadena '$findme' fue encontrada en la cadena '$lezama'";
    echo " y existe en la posición $pos";
}*/

//echo $parques[0]['nombre'];

$lezama= 'Parque Lezama';
$Centenario= 'Parque Centenario ';
$Patricios= 'Parque Patricios';
$heras= 'Parque Las Heras';

// lo tengo q hacer es guardar el resultado de la consulta
// osea si pregunto por el parq lezama
// guardo en $dato='aca el nombre de la plaza q lo traigo por la consulta '
// y despues el array searh
// en el caso de parque centenario 
// tengo q acer un if si parque centenario es igual a tal cosa guardo 
// en una variable $data2 = 'el nombre del parque con el espacio '
// y pregunto

$key = array_search($lezama, array_column($parques, 'nombre'));
$key1 = array_search($Centenario, array_column($parques, 'nombre'));
$key2 = array_search($Patricios, array_column($parques, 'nombre'));
$key3 = array_search($heras, array_column($parques, 'nombre'));
$key4 = array_search('Parque', array_column($parques, 'nombre'));

//=== igual , != distinto
/*if ($key1 === Null)
 {
	
	echo "ups";
}else*/

 if ($key === false) {

	echo "No hay ";
	
}else {
     var_dump($key);
    var_dump($parques[$key]);
	echo "el nombre del parque es -- >" .$parques[$key]['nombre'];

	echo "  -- AnclajesTotales>" .$parques[$key]['AnclajesTotales'];
	
	echo "....AnclajesDisponibles >" .$parques[$key]['AnclajesDisponibles'];

	
	//var_dump($key);
}

   

/*echo '<pre>';
 var_dump($data);
 echo '</pre>';
 */
?>
	<? 
/*
echo $lezama['id'];
echo $lezama['nombre'];
echo $lezama['AnclajesTotales'];
echo $lezama['AnclajesDisponibles'];


 /*echo '<pre>';
 var_dump($data);
 echo '</pre>';
 */

$userdb=Array
(
    (0) => Array
        (
            'uid' => '100',
            'name' => 'Sandra Shush',
            'url' => 'urlof100'
        ),

    (1) => Array
        (
            'uid' => '5465',
            'name' => 'Stefanie Mcmohn',
            'pic_square' => 'urlof100'
        ),

    (2) => Array
        (
            'uid' => '40489',
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        )
);


$key2 = array_search('Michael', array_column($userdb, 'name'));
//var_dump($key2);

?>

	</p>
</div>

</body>
</html>