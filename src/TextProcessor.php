<?php

namespace Truongbo\Textscore;

use Truongbo\Textscore\Entities\Duplicate;
use Truongbo\Textscore\Entities\StopWordScore;
use Truongbo\Textscore\Entities\TermScore;
use Truongbo\Textscore\Entities\ToParagraph;

class TextProcessor
{
    protected array $contents = [];
    protected array $skip_sentence_short = [
        'min_word'     => 5, //Loại bỏ những câu có dưới 5 từ
        'min_alphabet' => 32 //Lõại bỏ những câu có dưới 32 từ
    ];

    public function process($content)
    {
        $content = $this->removeNoiseCharacters($content);
        $this->cleanContent($content);
        $this->ignoreChar();
        $this->skipSentenceShort();
        return $this->textScore();
    }

    protected function removeNoiseCharacters($content): string
    {
        $content = preg_replace("/([^\n])\n\n([^\n])/ui", "$1 $2", $content);
        $content = preg_replace("/\n\n+/ui", "\n", $content);
        return preg_replace("/\n/", "", $content);
    }

    protected function cleanContent($content): void
    {
        $paragraphs = explode(".", $content);
        foreach ($paragraphs as $paragraph) {
            $text = trim($paragraph);
            $text = preg_replace("/\s\s+/ui", " ", $text);
            if (!$text) continue;

            $this->contents[] = $this->normalizeSentence($text);
        }
    }

    protected function normalizeSentence($text): string
    {
        $text = preg_replace("/^[^\p{L}\p{N}]+\s/ui", "", $text);
        $text = preg_replace("/[^\p{L}]{12,}/ui", " ", $text);

        return preg_replace("/\s[^\p{L}\p{N}]+$/ui", "", $text);
    }

    protected function ignoreChar(): void
    {
        $this->contents = array_filter($this->contents, function ($value) {
            return (!preg_match('/^[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $value));
        });
    }

    protected function skipSentenceShort(): void
    {
        $contents = $this->contents;
        $this->contents = [];
        foreach ($contents as $content) {
            if (mb_strlen($content) >= $this->skip_sentence_short['min_alphabet'] && str_word_count($content) >= $this->skip_sentence_short['min_word']) {
                $this->contents[] = $content;
            }
        }
    }

    protected function textScore(): array
    {
        $text_score = [];
        foreach ($this->contents as $key => $content) {
            $text_score[] = new TextScore($key, $content);
        }

        $origin_text = ToParagraph::originText($text_score);

        $sentences = Duplicate::markDuplicatedSentences($text_score);
        $sentences_stopwords = StopWordScore::score($sentences);
        $term_frequency_score = TermScore::input($sentences_stopwords, $origin_text);
        return Duplicate::score($term_frequency_score);
    }

    public function getCount(): int
    {
        return count($this->contents);
    }
}