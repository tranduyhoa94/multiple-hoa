<?php

session_start();

header('Content-type: text/html;charset=utf-8');
define('DOCROOT', dirname(__FILE__));
error_reporting(E_ALL);
ini_set('display_errors', 1);

function debug($params)
{
    echo '<pre>';
    print_r($params);
    die();
}

//require_once './global.php';
include_once './includes/functions.php';
include_once './includes/ChipVN/ClassLoader/Loader.php';
//load_file('includes/ChipVN/ClassLoader/Loader.php');
ChipVN_ClassLoader_Loader::registerAutoload();

//$config = load_file('includes/config.php');

//$config = $config['flickr'];

$callback = 'http' . (getenv('HTTPS') == 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

//$uploader = ChipVN_ImageUploader_Manager::make('Flickr');
$uploader = new ChipVN_ImageUploader_Plugins_Flickr();

//$api = random_element($config['api_keys']);
$api = [
    'key' => '168ec0d5de10a7a5e35421af55b448dd',
    'secret' => '949a17b4e8b4935b',
];

$uploader->setApi($api['key']);
$uploader->setSecret($api['secret']);
$token = $uploader->getOAuthToken($callback);


//write_flickr_token($config['token_file'], $token['username'], $token['oauth_token'], $token['oauth_token_secret']);

echo "Done!<br />";
echo 'oauth_token: ' . $token['oauth_token'] . '<br/>';
echo 'oauth_token_secret: ' . $token['oauth_token_secret'] . '<br/>';
echo '<a href="' . $callback . '">Click here to add new token (must use other yahoo account).</a>';
