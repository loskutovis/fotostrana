<?php

namespace Fotostrana;

use Fotostrana\Exception\EOFException;

class FileIterator implements \SeekableIterator
{
    /**
     * @var int $position
     */
    private $position;

    /**
     * @var File $file
     */
    private $file;

    /**
     * FileIterator constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->position = 0;
        $this->file = $file;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current(): string
    {
        return $this->file->getLine($this->position);
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key(): int
    {
       return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid(): bool
    {
        return $this->position < $this->file->getNumberOfLines();
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Seeks to a position
     * @link https://php.net/manual/en/seekableiterator.seek.php
     * @param int $position The position to seek to.
     * @return void
     * @since 5.1.0
     */
    public function seek($position): void
    {
        if ($position < 0) {
            $position = $this->file->getNumberOfLines() + $position;
        }

        $this->position = $position;

        if (!$this->valid()) {
            throw new EOFException();
        }
    }
}
