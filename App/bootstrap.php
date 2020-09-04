<?php

use App\Db\MySql;
use App\Service\CartService;
use App\Model\User;

define('APP_DIR' , realpath(__DIR__ . "/../" ));
define('APP_PUBLIC_DIR',APP_DIR . '/public');
define('APP_UPLOAD_DIR',APP_PUBLIC_DIR . '/upload');
define('APP_UPLOAD_PRODUCT_DIR',APP_UPLOAD_DIR .'/products');

if(!file_exists(APP_UPLOAD_DIR)){
    mkdir(APP_UPLOAD_DIR);
}
if(!file_exists(APP_UPLOAD_PRODUCT_DIR)){
    mkdir(APP_UPLOAD_PRODUCT_DIR);
}
require_once APP_DIR . '/vendor/autoload.php';
$config = require_once APP_DIR . '/config/config.php';



function DataBase(){
    global $config;
    $mysql = new MySql($config['db']['host'] , $config['db']['user'] ,$config['db']['password'] ,$config['db']['db_name']);
    return $mysql;
}
function smarty(){
    global $config;
    static $smarty;

    if (is_null($smarty)) {
        $smarty = new Smarty();
        $smarty->template_dir = $config['template']['template_dir'];
        $smarty->compile_dir = $config['template']['compile_dir'];
        $smarty->cache_dir = $config['template']['cache_dir'];
    }

    return $smarty;
}

function deleteDir($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

function user(){
    static $user;

    /**
     * @var $user User
     */
    if (is_null($user)) {
        $user = new User();

        if (isset($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];
            $user = \App\Service\UserService::getUserById($user_id);
        }
    }
   return $user;
}
session_start();
//smarty()->assign_by_ref('user',user());
