<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 24/12/2016
 * Time: 9:23 PM
 */

namespace transposer\controllers;

use transposer\config;

class songs
{
    public static function get_all_songs()
    {
        require_once(__DIR__ . '/../lib/songs.php');
        $songs = \transposer\lib\songs::get_all_songs();
        $list = implode("\n", $songs);
        return $list;
    }
    
    /**
     * @param $title
     * @param $method
     */
    public static function get_content($title, $method)
    {
        require_once(__DIR__ . '/../lib/songs.php');
        $content = \transposer\lib\songs::get_content($title);
        switch ($method) {
            case 'html':
                $html_data = nl2br($content);
                echo $html_data;
                break;
            case 'json' :
                $data = [];
                $data['title'] = $title;
                $data['content'] = $content;
                $json = json_encode($data);
                echo $json;
                break;
        }
    }
}