<?php
/**
 * Created by PhpStorm.
 * User: Conrad
 * Date: 24/12/2016
 * Time: 8:43 PM
 */

namespace transposer;
require_once(__DIR__ . '/../config.php');
class config
{
    const ENVIRONMENT = \config::ENVIRONMENT;
    /**
     * Returns the root path of the data folder
     * @return null|string
     */
    public static function dataroot(){
        require_once(__DIR__ . '/../environments.php');
        switch (self::ENVIRONMENT){
            case \environment::DEVELOPMENT:
                return 'C:\inetpub\data\transposer\transposer_songs';
            case \environment::PRODUCTION:
                return 'C:\inetpub\data\transposer\transposer_songs';
        }
        return null;
    }

    public static function temproot(){
        switch (self::ENVIRONMENT){
            case \environment::DEVELOPMENT:
                return 'C:\inetpub\data\transposer\temp';
            case \environment::PRODUCTION:
                return 'C:\inetpub\data\transposer\temp';
        }
        return null;
    }
}