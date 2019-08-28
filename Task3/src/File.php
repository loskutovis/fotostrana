<?php

namespace Fotostrana;

use Fotostrana\Exception\EOFException;

/**
 * Class File
 * @package Fotostrana
 */
class File
{
    /**
     * @var bool|resource $instance
     */
    private $instance;

    /**
     * @var array $linesLength
     */
    private $linesLength;

    /**
     * File constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->linesLength = [];
        $this->instance = fopen($filename, 'r');

        $this->setLinesPositions();
    }

    private function setLinesPositions(): void
    {
        $count = 0;
        
        while (fgets($this->instance)) {
            $this->linesLength[$count++] = ftell($this->instance);
        }
    }

    /**
     * @param $linePosition
     * @return string
     */
    public function getLine($linePosition): string
    {
        if ($linePosition >= $this->getNumberOfLines()) {
            throw new EOFException();
        }

        $seekPosition = $linePosition > 0 ? $this->linesLength[$linePosition - 1] : 0;

        fseek($this->instance, $seekPosition);

        return fgets($this->instance);
    }

    /**
     * @return int
     */
    public function getNumberOfLines(): int
    {
        return count($this->linesLength);
    }
}
