<?php

namespace Truongbo\Textscore\Entities;

class TermScore
{
    public static function input(array $sentences, string $origin_text)
    {
        $term_origin_text = array_flip(array_unique(explode(" ", $origin_text)));

        $new_term_origin_text = [];

        foreach ($term_origin_text as $term => $key) {
            $term = self::clean($term);
            if (isset($new_term_origin_text[$term])) {
                $new_term_origin_text[$term]++;
            } else {
                $new_term_origin_text[$term] = 1;
            }
        }

        $max_term = max($new_term_origin_text);

        return self::score($sentences, $new_term_origin_text, $max_term);
    }

    public static function score(array $sentences, array $term_origin_text, $max_term)
    {
        arsort($term_origin_text);
        foreach ($sentences as $sentence) {

            $term_array = array_flip(array_unique(explode(" ", $sentence->content)));
            $new_term_array = [];
            $with_term = [];

            foreach ($term_array as $key => $value) {
                $key = self::clean($key);
                $new_term_array[$key] = round(($term_origin_text[$key] / $max_term), 2);
                $with_term[$key] = log(count($term_origin_text) / $term_origin_text[$key]);
            }

            $sentence->score = round($sentence->score + (array_sum($new_term_array) * array_sum($with_term)) / 10, 2);
        }
        return $sentences;
    }

    public static function clean(string $term)
    {
        return strtolower(trim($term, " \t\n\r\0\x0B.,:;\'\"\\/~!@#$%^&*()_+|"));
    }
}