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
    public static function get_all_songs()
    {
        require_once(__DIR__ . '/../lib/songs.php');
        $songs = \transposer\lib\songs::get_all_songs();
        $list = json_encode($songs);
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

    /**
     * @param $query
     * @param $method
     */
    public static function search($query, $method)
    {
        require_once(__DIR__ . '/../lib/songs.php');
        $content = \transposer\lib\songs::search($query);
        switch ($method) {
            case 'html':
                $html_data = implode("<br>", $content);
                echo $html_data;
                break;
            case 'json' :
                $json = json_encode($content);
                echo $json;
                break;
        }

    }
}