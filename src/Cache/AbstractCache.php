<?php

namespace Mustache\Cache;

use Mustache\Cache;
use Mustache\Exception\InvalidArgumentException;
use Mustache\Logger;

/**
 * Abstract Mustache Cache class.
 *
 * Provides logging support to child implementations.
 *
 * @abstract
 */
abstract class AbstractCache implements Cache
{
    private $logger = null;
    /**
     * Get the current logger instance.
     *
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
    /**
     * Set a logger instance.
     *
     * @param Logger $logger
     */
    public function setLogger($logger = null)
    {
        if ($logger !== null && !($logger instanceof Logger || \is_a($logger, 'Builderius\\Psr\\Log\\LoggerInterface'))) {
            throw new InvalidArgumentException('Expected an instance of Logger or Psr\\Log\\LoggerInterface.');
        }
        $this->logger = $logger;
    }
    /**
     * Add a log record if logging is enabled.
     *
     * @param string $level   The logging level
     * @param string $message The log message
     * @param array  $context The log context
     */
    protected function log($level, $message, array $context = array())
    {
        if (isset($this->logger)) {
            $this->logger->log($level, $message, $context);
        }
    }
}
