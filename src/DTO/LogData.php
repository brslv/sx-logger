<?php

namespace Sx\Logger\DTO;

use Sx\Logger\Services\Moment;

/**
 * Class LogData.
 *
 * @package Sx\Logger\DTO
 */
class LogData
{
    public $originalContent;
    public $content;
    public $context;
    public $datetime;
    public $timestap;

    /**
     * Constructor.
     *
     * @param string $originalContent The original, non-parsed content to be logged.
     * @param string $content The parsed content to be logged.
     * @param array $context The context data.
     */
    public function __construct($originalContent, $context, $content)
    {
        $this->originalContent = $originalContent;
        $this->content = $content;
        $this->context = $context;
        $this->datetime = Moment::now();
        $this->timestamp = Moment::toTimestamp($this->datetime);
    }
}
