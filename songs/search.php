<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 25/12/2016
 * Time: 10:54 PM
 */
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../controllers/songs.php');
$query = isset($_GET['q']) ? $_GET['q'] : null;
\transposer\controllers\songs::search($query, 'json');