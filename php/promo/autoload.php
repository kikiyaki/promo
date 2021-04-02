<?php
/**
 * Load all files in directories: 'src', 'lib'
 */


loadFiles(__DIR__ . "/lib");
loadFiles(__DIR__ . "/src");

/**
 * Recursive load all files in directory
 * todo make composer autoloading
 *
 * @param string $dir
 */
function loadFiles($dir)
{
    $files = scandir($dir);
    $files = array_filter($files, function($fileName) {
        return $fileName != '.' && $fileName != '..';
    });

    foreach ($files as $fileName) {
        if (is_dir("$dir/$fileName")) {
            loadFiles("$dir/$fileName");
        } else {
            require_once "$dir/$fileName";
        }
    }
}
