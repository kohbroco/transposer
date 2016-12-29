<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 25/12/2016
 * Time: 10:54 PM
 */
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../controllers/songs.php');
$title = isset($_GET['title']) ? $_GET['title'] : null;
if(!$title){
    require_once(__DIR__ . '/../../lib/web/generic.php');
    \lib\web\generic::redirect(\transposer\config::webroot() . '/songs/all.php');
}
\transposer\controllers\songs::get_content($title, 'json');