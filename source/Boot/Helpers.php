<?php

function url(string $path = null): string
{
    if(strpos($_SERVER['HTTP_HOST'], "localhost")){
        if($path){
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_TEST;
    }
    if($path){
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE;
}

function buildStringFriendlyURL(string $string = ""): string
{
    $string = strtolower($string);
    $string = preg_replace('/\s+/', '-', $string); // troca " " por "-"
    $string = preg_replace('/[^a-zA-Z0-9-]/', '', $string); // remove caracteres não convencionais
    return $string;
}