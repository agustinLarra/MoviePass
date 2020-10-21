<?php namespace Config;

#API KEY: b285f5e6eecdd8eda1b3f5a82415153b
define("API_KEY","b285f5e6eecdd8eda1b3f5a82415153b");

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMAGE_ROOT", "https://image.tmdb.org/t/p/w500");

///----------------DEFINES DE LA BS, !NO TOCAR! -----------

define("DB_HOST", "localhost");
define("DB_NAME", "DB_MoviePass");
define("DB_USER", "root");
define("DB_PASS", "");


?>