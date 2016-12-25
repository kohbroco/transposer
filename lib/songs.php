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
        $files = windows::scandir(config::songlibroot());
        return $files;
    }

    public static function get_content($title)
    {
        require_once(__DIR__ . '/../config.php');
        $song_filepath = config::songlibroot() . "/$title";
        $content = file_get_contents($song_filepath);
        return $content;
    }
}