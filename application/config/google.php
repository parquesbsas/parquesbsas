<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = "349286300413-odgs25ijmv7dlg8bbm5ag8qfpbjgpimk.apps.googleusercontent.com";
$config['google']['client_secret']    = "W7E_yXpMptIXplXqOLQ1QqGD";
$config['google']['redirect_uri']     = 'https://parques-bsas.herokuapp.com/google_login';
$config['google']['application_name'] = 'Parques Bs As';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();

?>