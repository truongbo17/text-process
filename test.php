<?php

use Truongbo\Textscore\Entities\ToParagraph;
use Truongbo\Textscore\TextProcessor;

include_once './vendor/autoload.php';

$file_content = fopen("./input.txt", "r") or die("Unable to open file!");
$text = fread($file_content, filesize("./input.txt"));
fclose($file_content);

$time_start = microtime(true);

$text_score = (new TextProcessor())->process($text);

var_dump(ToParagraph::toParagraph($text_score, 5));
echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);
