<?php

 require 'application/libraries/facebook/facebook.php';
 
 $config['App_ID'] = '1166957816769860';
 $config['App_Secret'] = 'f4b8ef505e1d6a7087c3ebfa169f87b8';

  $facebook = new Facebook(array(
  'appId'  => $config['App_ID'],
  'secret' => $config['App_Secret']
 ));

?>