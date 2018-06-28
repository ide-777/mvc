<?php

namespace modals;


class Directory
{
    function readFolder(string $path) : array
    {
        $_array = [];
        $files = scandir($path);
        foreach ($files as $file) {
            $item = [
                'name' => '',
                'isFile' => 1,
                'child' => [],
            ];

            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $item['name'] = $fullpath = $path . '/' . $file;


            if (is_dir($fullpath)) {
                $item['isFile'] = 0;
                $item['child'] = $this->readFolder($fullpath);
            }

            $_array[] = $item;
        }
//var_dump('----');
//var_dump($_array);
        return $_array;
    }
}