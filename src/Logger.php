<?php

namespace Squiz\PhpCodeExam;

class Logger
{
    public function log($message, string $fileName)
    {
        if (is_dir(__DIR__ . '/../logs')) {
            $file = fopen($fileName,'a+');
            fwrite($file, $message . "\n", 128);
            fclose($file);
            return;
        }

        mkdir(__DIR__ . '/../logs');
    }
}
