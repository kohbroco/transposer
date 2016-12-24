<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 24/12/2016
 * Time: 9:23 PM
 */

namespace transposer\controllers;
class songs
{
    public static function get_all_songs(){
        require_once(__DIR__  . '/../lib/songs.php');
        $songs = \transposer\lib\songs::get_all_songs();
        $list = implode("\n", $songs);
        return $list;
    }
}