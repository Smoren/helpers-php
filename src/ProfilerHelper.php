<?php


namespace Smoren\Helpers;

/**
 * Класс-профилировщик
 * @package Smoren\Helpers
 */
class ProfilerHelper
{
    protected $mgu;
    protected $ts;
    protected $dbQueryCount = 0;
    protected $dbQueryTime = 0;

    /**
     * @param bool $tiny
     * @return static
     */
    public static function start(bool $tiny = false): self
    {
        return new static($tiny);
    }

    /**
     * ProfilerHelper constructor.
     * @param bool $tiny
     */
    public function __construct(bool $tiny = false)
    {
        $this->ts = microtime(true);

        if(!$tiny) {
            $this->mgu = memory_get_usage();
        } else {
            $this->dbQueryCount = 0;
            $this->dbQueryTime = 0;
            $this->mgu = 0;
        }
    }

    /**
     * Подсчитывает выделенное количество памяти
     * @param bool $pretty Приятный глазу формат
     * @return int
     */
    public function getMemoryAllocated(bool $pretty = false)
    {
        $memoryUsage = memory_get_usage() - $this->mgu;

        if($pretty === false) {
            return $memoryUsage;
        }

        return number_format($memoryUsage, 0, '.', ' ') . ' bytes';
    }

    /**
     * @return float
     */
    public function getTimeSpent(): float
    {
        return microtime(true) - $this->ts;
    }
}