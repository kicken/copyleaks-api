<?php

namespace Kicken\Copyleaks\Test\Model;

use Kicken\Copyleaks\Model\ModelSerializer;
use PHPUnit\Framework\TestCase;

class ModelSerializerTest extends TestCase {
    private ModelSerializer $serializer;

    public function setUp() : void{
        $this->serializer = new ModelSerializer();
    }

    public function testDoesNotIncludeNullProperties(){
        $expected = '{"a":"a","c":"c"}';
        $model = (object)[
            'a' => 'a',
            'b' => null,
            'c' => 'c'
        ];
        $serialized = $this->serializer->serialize($model);
        $this->assertEquals($expected, $serialized);
    }

    public function testDoesNotIncludeAllNullChildren(){
        $expected = '{"a":"a","c":"c"}';
        $model = (object)[
            'a' => 'a',
            'b' => (object)[
                'a' => null
            ],
            'c' => 'c'
        ];
        $serialized = $this->serializer->serialize($model);
        $this->assertEquals($expected, $serialized);
    }

    public function testArrayOfObjectsStaysArray(){
        $expected = '{"a":"a","b":[{"a":"a"},{"a":"a"}],"c":"c"}';
        $model = (object)[
            'a' => 'a',
            'b' => [
                (object)[
                    'a' => 'a'
                ],
                (object)[
                    'a' => 'a'
                ],
            ],
            'c' => 'c'
        ];
        $serialized = $this->serializer->serialize($model);
        $this->assertEquals($expected, $serialized);
    }

    public function testEmptyArrayIsNotRemoved(){
        $expected = '{"a":"a","b":[],"c":"c"}';
        $model = (object)[
            'a' => 'a',
            'b' => [],
            'c' => 'c'
        ];
        $serialized = $this->serializer->serialize($model);
        $this->assertEquals($expected, $serialized);
    }

    public function testAllNullArrayElementsAreRemoved(){
        $expected = '{"a":"a","b":[],"c":"c"}';
        $model = (object)[
            'a' => 'a',
            'b' => [
                (object)[
                    'a' => null
                ],
                (object)[
                    'a' => null
                ],
            ],
            'c' => 'c'
        ];
        $serialized = $this->serializer->serialize($model);
        $this->assertEquals($expected, $serialized);
    }

}
