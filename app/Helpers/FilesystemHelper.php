<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class FilesystemHelper
{
    public static function createDirectoryTree($files) {
        $directory_tree = [];

        foreach($files as $file) {
            $dirs = explode('/', $file);

            if (!is_array($dirs)) {
                dd($dirs);
            }

            $tree = [];
            $tmp = &$tree;
            $count = 0;
            while (isset($dirs[$count])) {
                $tmp[$dirs[$count]] = [];
                $tmp = &$tmp[$dirs[$count]];
                $count++;
            }
            $tmp[$dirs[$count - 1]] = $dirs[$count - 1];
            $dirs = $tree;

            $directory_tree = array_merge_recursive($directory_tree, ...$dirs);
        }

        return $directory_tree;
    }
}
