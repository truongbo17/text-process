<?php

namespace Truongbo\Textscore\Entities;

use Truongbo\Textscore\TextScore;

class Duplicate
{
    public static function markDuplicatedSentences(array $sentences)
    {
        $sentences_hash = [];
        foreach ($sentences as $sentence) {
            if (isset($sentences_hash[$sentence->hash])) {
                $sentences_hash[$sentence->hash]++;
                $sentence->duplicate = true;
            } else {
                $sentences_hash[$sentence->hash] = 0;
            }
        }

        return $sentences;
    }

    public static function score(array $sentences)
    {
        foreach ($sentences as $sentence) {
            if ($sentence->duplicate) {
                $sentence->score = $sentence->score - 2;
                if ($sentence->score < 0) $sentence->score = 0.00;
            }
        }

        return $sentences;
    }
}