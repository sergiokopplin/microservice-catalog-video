<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(
        protected string $id
    )
    {
        $this->ensureIsValid($id);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->id;
    }

    protected function ensureIsValid(string $id)
    {
        if (!RamseyUUid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> dow not allow the value <%s>.', static::class, $id));
        }
    }
}