<?php

namespace Jonathanm10\PineconeClient\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class TypedArray
{
    public function __construct(public readonly string $type)
    {
    }
}
