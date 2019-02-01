<?php

namespace Core\Library\Serialization;

use Core\Library\Interfaces\EnabledInterface;
use JMS\Serializer\Context;
use JMS\Serializer\Exclusion\ExclusionStrategyInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\SerializationContext;

class EnabledExclusionStrategy implements ExclusionStrategyInterface
{
    /**
     * Whether the class should be skipped.
     */
    public function shouldSkipClass(ClassMetadata $metadata, Context $context): bool
    {
        if ($context instanceof SerializationContext) {
            $object = $context->getObject();
            if ($object instanceof EnabledInterface) {
                return ! $object->isEnabled();
            }
        }

        return false;
    }

    public function shouldSkipProperty(PropertyMetadata $property, Context $context): bool
    {
        return false;
    }
}
