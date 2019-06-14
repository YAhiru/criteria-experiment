<?php
declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Model;

final class Authority
{
    const DEFAULT = 1;
    const ADMIN = 9;

    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    private function setValue(int $value): void
    {
        if ( ! self::isValid($value)) {
            throw new \InvalidArgumentException('given value is invalid.');
        }
        $this->value = $value;
    }

    public static function isValid(int $value): bool
    {
        return in_array($value, [self::DEFAULT, self::ADMIN], true);
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
