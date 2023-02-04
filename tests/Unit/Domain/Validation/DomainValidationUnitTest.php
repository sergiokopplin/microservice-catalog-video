<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = '';
            DomainValidation::notNull($value);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        try {
            $value = '';
            $message = 'Custom Message';
            DomainValidation::notNull($value, $message);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $message);
        }
    }

    public function testStrMaxLength()
    {
        try {
            $value = 'Test';
            $message = 'Custom Message';
            DomainValidation::strMaxLength($value, 3, $message);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $message);
        }
    }

    public function testStrMinLength()
    {
        try {
            $value = 'Test';
            $message = 'Custom Message';
            DomainValidation::strMinLength($value, 8, $message);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $message);
        }
    }

    public function testCanNullAndMaxLength()
    {
        try {
            $value = 'teste';
            $message = 'Custom Message';
            DomainValidation::strCanNullAndMaxLength($value, 3, $message);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $message);
        }
    }
}
