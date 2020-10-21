<?php

namespace app\config;

use app\models\SystemConfig;

class Helper
{


    const SONG_PATH = '/web/uploads/songs/';
    const SONG_COVER_PATH = '/web/uploads/song-covers/';
    const SONG_COVER_EXT = '.jpg';

    public static function getBaseUrl()
    {
        if (isset($_SERVER['SERVER_NAME'])) {

            $host = $_SERVER['SERVER_NAME'];
            $port = $_SERVER['SERVER_PORT'];
            $base_url = "";
            $uri = $_SERVER['REQUEST_URI'];

            if ($host == "localhost") {
                $base_url = "http://" . $host;
                $sub_host = '/repertoire';
                $base_url = $base_url . $sub_host;
            } else {
                $base_url = "http://" . $host;
                $sub_host  =  '/app';
                $base_url = $base_url . $sub_host;
            }

            return $base_url;
        }
    }

    public static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function isUserLoginEnabled(){
        $user_login_setting = SystemConfig::find()
        ->where(['name' => 'USER_LOGIN'])
        ->one();

        return $user_login_setting->is_enabled;
    }
}
