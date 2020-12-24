<?php

namespace App\Service;

use Demontpx\ParsedownBundle\Parsedown;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownParser
{
    /**
     * @var Parsedown
     */
    private $parsedown;
    
    /**
     * @var AdapterInterface
     */
    private $cache;
    
    /**
     * @var bool
     */
    private $debug;
    
    public function __construct(Parsedown $parsedown, AdapterInterface $cache, bool $debug)
    {
        
        $this->parsedown = $parsedown;
        $this->cache     = $cache;
        $this->debug     = $debug;
    }
    
    /**
     * @param string $source
     * @return string
     */
    public function parse(string $source): string
    {
        if ($this->debug) {
            return $this->parsedown->text($source);
        }
        
        return $this->cache->get('markdown_' . md5($source), function () use ($source) {
            return $this->parsedown->text($source);
        });
    }
}
