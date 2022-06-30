<?php

namespace Truongbo\Textscore\Entities;

use Truongbo\Textscore\StopWords\StopWord;
use HocVT\TikaSimple\TikaSimpleClient;

class StopWordScore
{
    /**
     * @throws \Truongbo\Textscore\StopWords\Exceptions\StopWordsLanguageNotExists
     */
    public static function score(array $text_scores)
    {
        foreach ($text_scores as $text_score) {
            if (filter_var($text_score->content, FILTER_VALIDATE_URL)) {
                $text_score->score = 0;
            } else {
                $text_score->score = (float)StopWord::input($text_score->content)['score'];
            }
        }

        return $text_scores;
    }
}