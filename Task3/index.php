<?php
require_once __DIR__ . '/vendor/autoload.php';

use Fotostrana\{File, FileIterator};

$file = new File(__DIR__ . '/sample_file.txt');
$fileIterator = new FileIterator($file);

echo $fileIterator->current();
echo PHP_EOL;

$fileIterator->seek(10);
echo $fileIterator->current();
echo PHP_EOL;

$fileIterator->rewind();
echo $fileIterator->current();
echo PHP_EOL;

$fileIterator->next();
$fileIterator->next();

echo $fileIterator->key();
echo PHP_EOL;

echo $fileIterator->current();
echo PHP_EOL;

$fileIterator->seek(100);
