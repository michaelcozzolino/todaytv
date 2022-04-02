<?php

namespace App\Classes;

class ValidTvTime
{
    public const ON_AIR = 'on-air';
    public const PRIME_TIME = 'prime-time';
    public const SECOND_NIGHT = 'second-night';

    public function __construct(string $timeName)
    {
        $this->timeName = $timeName;
    }

    public function __invoke()
    {
        return $this->isValid();
    }

    private function isValid()
    {
        return $this->onAir() || $this->isPrimeTime() || $this->isSecondNight();
    }

    private function isPrimeTime()
    {
        return $this->timeName === self::PRIME_TIME;
    }

    private function isSecondNight()
    {
        return $this->timeName === self::SECOND_NIGHT;
    }

    private function onAir()
    {
        return $this->timeName === self::ON_AIR;
    }

    public static function getTimes()
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
