<?php

if(Config::DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

ini_set("error_log", Config::LOGS_DIR);

function dd($str) {
	echo '<pre style="background:#ffe4e4;display:inline-block;margin:5px;padding:20px;border-radius:5px;">';
	var_dump($str);
	echo '</pre>';
}

function create_token($length = 50) {
	return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
}

function translit($str)
{

    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
    "."=>"_"," "=>"-","?"=>"_","/"=>"_","\\"=>"_",
    "*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
    ">"=>"_","|"=>"_"
    );
    return strtr($str,$tr);
}

function server_name() {
   
    preg_match('/([A-zА-яЁё]+).[A-z]+/um', $_SERVER['SERVER_NAME'], $matches);
    return $matches[1];
}

function siteHost() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName;
}