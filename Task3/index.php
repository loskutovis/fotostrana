<?php
require_once __DIR__ . '/vendor/autoload.php';

$file = new SplFileObject(__DIR__. '/sample_file.txt');

var_dump($file->fgets());

$file->fseek(12);

var_dump($file->fgets());
