<?php

declare(strict_types=1);

namespace Tests\Unit\Common;

use Illuminate\Contracts\Support\Arrayable;
use InvalidArgumentException;
use Modules\Common\Domain\Abstractions\TypedCollection;
use PHPUnit\Framework\TestCase;
use stdClass;

class AllowedType
{
    public function __construct(public string $value) {}
}
class TestTypedCollection extends TypedCollection
{
    public static function getAllowedType(): string
    {
        return AllowedType::class;
    }
}

class TypedCollectionTest extends TestCase
{
    private function createValidItem(): AllowedType
    {
        return new AllowedType('test');
    }

    /** @test */
    public function it_creates_collection_with_valid_items()
    {
        $validItems = [
            $this->createValidItem(),
            $this->createValidItem(),
        ];

        $collection = new TestTypedCollection($validItems);

        $this->assertCount(2, $collection);
        $this->assertContainsOnlyInstancesOf(AllowedType::class, $collection);
    }

    /** @test */
    public function it_throws_exception_for_invalid_constructor_items()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Element must be of type Tests\\\Unit\\\Common\\\AllowedType, given: (string|integer)/');

        new TestTypedCollection([new AllowedType('valid'), 'invalid_string', 123]);
    }

    /** @test */
    public function add_method_validates_type()
    {
        $collection = new TestTypedCollection;
        $validItem = $this->createValidItem();

        $collection->add($validItem);
        $this->assertCount(1, $collection);

        $this->expectException(InvalidArgumentException::class);
        $collection->add('invalid_string');
    }

    /** @test */
    public function push_method_validates_multiple_items()
    {
        $collection = new TestTypedCollection;

        $this->expectException(InvalidArgumentException::class);

        $collection->push(
            $this->createValidItem(),
            'invalid_string',
            $this->createValidItem()
        );
    }

    /** @test */
    public function put_method_validates_type()
    {
        $collection = new TestTypedCollection;
        $validItem = $this->createValidItem();

        $collection->put('key1', $validItem);
        $this->assertTrue($collection->has('key1'));

        $this->expectException(InvalidArgumentException::class);
        $collection->put('key2', new stdClass);
    }

    /** @test */
    public function merge_method_validates_items()
    {
        $collection = new TestTypedCollection([$this->createValidItem()]);
        $invalidItems = ['invalid_key' => 'invalid_string'];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Element must be of type Tests\Unit\Common\AllowedType, given: string');

        $collection->merge($invalidItems);
    }

    /** @test */
    public function it_handles_arrayable_items_correctly()
    {
        $arrayable = new class implements Arrayable
        {
            public function toArray()
            {
                return [
                    new AllowedType('item1'),
                    new AllowedType('item2'),
                ];
            }
        };

        $collection = new TestTypedCollection($arrayable);

        $this->assertCount(2, $collection);
    }

    /** @test */
    public function it_provides_correct_allowed_type()
    {
        $this->assertEquals(
            AllowedType::class,
            TestTypedCollection::getAllowedType()
        );
    }

    /** @test */
    public function it_throws_detailed_type_error_messages()
    {
        try {
            new TestTypedCollection([new stdClass]);
        } catch (InvalidArgumentException $e) {
            $this->assertStringContainsString('Tests\Unit\Common\AllowedType', $e->getMessage());
            $this->assertStringContainsString('stdClass', $e->getMessage());

            return;
        }

        $this->fail('Exception with type information was not thrown');
    }
}
