<?php

namespace Truongbo\Textscore\Entities;

class ToParagraph
{
    public static function toParagraph(array $sentences, $limit = 15)
    {

        usort($sentences, function ($first, $second) {
            return $first->score < $second->score;
        });

        $sentences = array_slice($sentences, 0, $limit);

        usort($sentences, function ($first, $second) {
            return $first->index > $second->index;
        });

        $text_paragraph = '';

        foreach ($sentences as $sentence) {
            if (preg_match('~^\p{Lu}~u', $sentence->content)) {
                $text_paragraph .= '. ' . $sentence->content;
            } else {
                $text_paragraph .= ' ' . $sentence->content;
            }
        }

        return ucfirst(ltrim($text_paragraph, ' .'));
    }

    public static function originText(array $sentences)
    {
        $text_paragraph = '';

        foreach ($sentences as $sentence) {
            if (preg_match('~^\p{Lu}~u', $sentence->content)) {
                $text_paragraph .= '. ' . $sentence->content;
            } else {
                $text_paragraph .= ' ' . $sentence->content;
            }
        }

        return ucfirst(ltrim($text_paragraph, ' .'));
    }
}