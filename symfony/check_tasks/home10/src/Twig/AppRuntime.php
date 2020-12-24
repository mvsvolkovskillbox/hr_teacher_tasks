<?php

namespace App\Twig;

use App\Service\MarkdownParser;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    private $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parseMarkdown($value)
    {
        return $this->markdownParser->parse($value);
    }
}