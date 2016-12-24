<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 24/12/2016
 * Time: 9:21 PM
 */

namespace transposer\lib;
use transposer\config;
use lib\windows;
class songs
{
    public static function get_all_songs(){
        require_once(__DIR__ . '/../config.php');
        require_once(__DIR__ . '/../../lib/windows.php');
        $files = windows::scandir(config::dataroot());
        return $files;
    }
}