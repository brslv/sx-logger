<?php

namespace Sx\Logger\Traits;

/**
 * Trait LoggerAwareTrait.
 *
 * @package Sx\Logger\Traits
 */
trait LoggerAwareTrait
{
    /** @var Sx\Logger\Logger */
    protected $logger;

    /**
     * Set a logger.
     *
     * @param Sx\Logger\Logger $logger
     * @return $this
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;

        return $this;
    }
}
