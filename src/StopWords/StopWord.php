<?php

namespace Truongbo\Textscore\StopWords;

use Truongbo\Textscore\StopWords\Exceptions\StopWordsLanguageNotExists;
use LanguageDetection\Language;

final class StopWord
{
    const MAX_SCORE = 1;
    const MIN_SCORE = 0;
    const DEFAULT_LANGUAGE = 'en';

    private static array $available_languages = [
        'ar',
        'bg',
        'ca',
        'cz',
        'da',
        'de',
        'el',
        'en',
        'eo',
        'es',
        'et',
        'fi',
        'fr',
        'hi',
        'hr',
        'hu',
        'id',
        'it',
        'ka',
        'lt',
        'lv',
        'nl',
        'no',
        'pl',
        'pt',
        'ro',
        'ru',
        'sk',
        'sv',
        'tr',
        'uk',
        'vi'
    ];

    private static array $data_stop_word_cache;

    protected static string $language;

    protected static string $text;

    private static function detectLanguage(string $text)
    {
        $detector = new Language();
        self::$language = $detector->detect($text);
    }

    public static function input(string $text, string $language = null, bool $remove_stopword = false)
    {
        if (empty(self::$language) && is_null($language)) {
            self::detectLanguage($text);
        } elseif (!is_null($language) && (empty(self::$language) || self::$language != $language)) {
            self::$language = $language;
        }

        if (!in_array(self::$language, self::$available_languages)) {
            throw new StopWordsLanguageNotExists('Language not support : ' . self::$language);
        }

        self::getDataStopWords();

        $array_text = explode(" ", $text);

        $text_stopword = [];

        foreach ($array_text as $key => $simple_text) {
            $simple_text_lower = strtolower($simple_text);
            if (in_array($simple_text_lower, self::$data_stop_word_cache[self::$language])) {
                if (isset($text_stopword[$simple_text_lower])) {
                    $text_stopword[$simple_text_lower]++;
                } else {
                    $text_stopword[$simple_text_lower] = 1;
                }
            } else {
                if (!isset($text_stopword[$simple_text])) {
                    $text_stopword[$simple_text_lower] = 0;
                } else {
                    $text_stopword[$simple_text_lower . "[key_stopword:$key]"] = 0;
                }
            }
        }

        $score_text_stopword = self::score($text_stopword);
        if ($remove_stopword) $text_processed = self::removeStopword($text_stopword);

        return [
            'text' => $text,
            'language' => self::$language,
            'text_processed' => $text_processed ?? $text,
            'stopwords' => $text_stopword,
            'score' => $score_text_stopword,
        ];
    }

    private static function getDataStopWords()
    {
        if (isset(self::$data_stop_word_cache[self::$language])) {
            return self::$data_stop_word_cache[self::$language];
        }

        $file = __DIR__ . '/stopwords_list/' . self::$language . '.php';

        if (file_exists($file)) {
            self::$data_stop_word_cache[self::$language] = require $file;
        } else {
            self::$data_stop_word_cache[self::$language] = [];
        }
    }

    private static function score(array $text_stopword)
    {
        $total_word = count($text_stopword);
        $total_word_has_stopword = count(array_filter($text_stopword, function ($value) {
            return $value > 0;
        }));

        if ($total_word_has_stopword == 0) return self::MAX_SCORE;
        if ($total_word / $total_word_has_stopword == 1) return self::MIN_SCORE;

        return self::MAX_SCORE - round(($total_word_has_stopword / $total_word), 2);
    }

    private static function removeStopword(array $text_stopword)
    {
        $text = array_filter($text_stopword, function ($value) {
            return $value < 1;
        });

        return preg_replace("/\[key_stopword:\d+\]/", "", implode(" ", array_keys($text)));
    }

}
