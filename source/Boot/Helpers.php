<?php


/**
 * Returns Application base URL.
 *
 * @param string|null $path
 * @return string
 */
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

/**
 * Returns API base URL.
 *
 * @param string $resource
 * @return string
 */
function api(string $resource): string
{
    return url("api/$resource");
}

/**
 * Returns Frontend resources base URL.
 *
 * @param string $resource
 * @param string $theme
 * @return string
 */
function assets(string $resource, string $theme = "web"): string
{
    return url("themes/$theme/$resource");
}

/**
 * Build a Friendly URL.
 *
 * @param string $string
 * @return string
 */
function buildFriendlyURL(string $string = ""): string
{
    $string = strtolower($string);
    $string = iconv('utf-8', 'ascii//TRANSLIT', $string);
    $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    return trim($string, '-');
}

/**
 * Delete a file tree.
 *
 * @param $dir
 * @return bool
 */
function delTree($dir): bool
{
    $files = array_diff(scandir(__PROJECT_DIR__ . $dir), array('.', '..'));

    foreach ($files as $file) {
        $path = __PROJECT_DIR__ . "$dir/$file";

        (is_dir($path)) ? delTree($path) : unlink($path);
    }
    return rmdir(__PROJECT_DIR__ . $dir);
}