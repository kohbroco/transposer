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
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../../lib/windows.php');
class songs
{
    /**
     * Returns all songs that are stored within the song library root directory
     * @return array
     * @throws \lib\directory_not_found_exception
     */
    public static function get_all_songs(){
        $files = windows::scandir(config::songlibroot());
        return $files;
    }

    /**
     * Returns the content of the song within a song library root directory given a valid title
     * @param $title
     * @return string
     */
    public static function get_content($title)
    {
        require_once(__DIR__ . '/../config.php');
        $song_filepath = config::songlibroot() . "/$title";
        $content = "";
        if(file_exists($song_filepath)){
            $content = file_get_contents($song_filepath);
        }
        return $content;
    }

    /**
     * @param $query
     * @return array
     * @throws \lib\directory_not_found_exception
     */
    public static function search($query){
        $song_titles_all = windows::scandir(config::songlibroot());
        $results = [];
        foreach($song_titles_all as $song_title){
            if(trim($query) == ""){
                return $song_titles_all;
            }
            else{
                $lowercase_query = strtolower(trim($query));
                $query_tokens = preg_split('"(\n|\s)+"', $lowercase_query);
                $lowercase_songtitle = mb_strtolower(trim($song_title));
                $song_title_tokens = preg_split('"(\n|\s)+"', $lowercase_songtitle);
                $matches = 0;
                $threshold = 1;
                $matches_limit = (double) count($query_tokens);

                foreach($query_tokens as $query_token){
                    $found = false;
                    $query_token_clean = trim($query_token);
                    foreach($song_title_tokens as $song_title_token){
                        $song_title_token_clean = trim($song_title_token);
                        if($song_title_token_clean != "" && $query_token_clean != ""){
                            if(mb_strpos($song_title_token_clean, $query_token_clean) !== false){
                                $found = true;
                                break;
                            }
                        }
                    }
                    if($found === true){
                        $matches += 1;
                    }
                    $rating = $matches / $matches_limit;
                    if($rating >= $threshold){
                        $results []= $song_title;
                    }
                }
            }
        }
        return $results;
    }
}