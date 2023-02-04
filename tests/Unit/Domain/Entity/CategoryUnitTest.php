<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New Desc',
            isActive: true,
        );

        $this->assertNotEmpty($category->id());
        $this->assertNotEmpty($category->createdAt());
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New Desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated(): void
    {
        $category = new Category(
            name: 'New Cat',
            isActive: false,
        );

        $this->assertFalse($category->isActive);

        $category->activate();

        $this->assertTrue($category->isActive);
    }

    public function testDisabled(): void
    {
        $category = new Category(
            name: 'New Cat',
            isActive: true,
        );

        $this->assertTrue($category->isActive);
        
        $category->disable();
        
        $this->assertFalse($category->isActive);
    }

    public function testUpdate(): void
    {
        $id = RamseyUuid::uuid4()->toString();
        $createdAt = '2023-01-01 12:12:12';
        $category = new Category(
            id: $id,
            name: 'New Cat',
            description: 'New Desc',
            isActive: true,
            createdAt: $createdAt,
        );

        $category->update(
            name: 'New Name',
            description: 'New Description',
        );
        
        $this->assertEquals($id, $category->id());
        $this->assertEquals($createdAt, $category->createdAt());
        $this->assertEquals('New Name', $category->name);
        $this->assertEquals('New Description', $category->description);
    }

    public function testExceptionName()
    {
        try {
            new Category(
                name: 'Na',
                description: 'New Desc'
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testExceptionDescription()
    {
        try {
            new Category(
                name: 'Name Cat',
                description: random_bytes(999999)
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}