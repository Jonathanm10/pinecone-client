<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

use InvalidArgumentException;
use Jonathanm10\PineconeClient\Attributes\TypedArray;
use ReflectionClass;
use ReflectionType;

class AbstractPayload
{
    public static function validate(array $params): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        $constructor = $reflectionClass->getConstructor();
        $className = $reflectionClass->getName();
        $constructorParams = [];
        foreach ($constructor->getParameters() as $parameter) {
            $attribute = $parameter->getName();
            $type = $parameter->getType();

            if (! array_key_exists($attribute, $params) && ! $parameter->isOptional()) {
                throw new InvalidArgumentException("Mandatory attribute '{$attribute}' is missing from '{$className}'");
            }

            $value = $params[$attribute] ?? $parameter->getDefaultValue();

            if (is_array($value) && self::isDto($type)) {
                $value = $type->getName()::fromArray($params[$attribute] ?? []);
            }

            // Validate array typing
            $property = $reflectionClass->getProperty($attribute);
            if ($attr = $property->getAttributes(TypedArray::class)[0] ?? null) {
                /** @var TypedArray $typedArrayAttribute */
                $typedArrayAttribute = $attr->newInstance();

                foreach ($value as $element) {
                    if (! is_a($element, $typedArrayAttribute->type)) {
                        throw new InvalidArgumentException("Invalid element type in array '{$attribute}' for '{$className}'");
                    }
                }
            }

            $constructorParams[] = $value;
        }

        return $constructorParams;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $params): static
    {
        $params = self::validate($params);

        return new static(...$params);
    }

    public function toArray(): array
    {
        $result = [];
        $properties = get_object_vars($this);

        foreach ($properties as $key => $value) {
            if ($value instanceof self) {
                $result[$key] = $value->toArray();
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    protected static function isDto(?ReflectionType $type): bool
    {
        if ($type === null || $type->isBuiltin()) {
            return false;
        }

        $className = $type->getName();

        return is_subclass_of($className, __CLASS__);
    }
}
