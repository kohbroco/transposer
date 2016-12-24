<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 24/12/2016
 * Time: 9:09 PM
 */
require_once(__DIR__ . '/../controllers/songs.php');
$list = nl2br(\transposer\controllers\songs::get_all_songs());
echo $list;