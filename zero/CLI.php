<?php

namespace Zero;

class CLI
{
    public function __construct()
    {
        
    }

   public static function out($text, $color = null, $newLine = true)
    {
        $styles = [
            'green' => "\033[0;32m%s\033[0m",
            'red' => "\033[31;31m%s\033[0m",
            'yellow' => "\033[33;33m%s\033[0m"
        ];
        $format = '%s';
        if (isset($styles[$color]))
            $format = $styles[$color];
        
        if($newLine)
            $format .= PHP_EOL;
        printf($format, $text);
    }
}