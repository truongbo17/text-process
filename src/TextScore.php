<?php

namespace Truongbo\Textscore;

class TextScore
{
    public int $index;
    public bool $duplicate = false;
    public float $score = 00.00;
    public string $hash = '';
    public string $content = '';

    public function __construct(int $index, string $content)
    {
        $this->index = $index;
        $this->content = $content;
        $this->hash = self::sentenceHash($this->content);
    }

    public static function sentenceHash($sentence) : string {
        return md5($sentence);
    }
}