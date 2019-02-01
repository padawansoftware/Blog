<?php

namespace Core\Library\Validation;

use Core\Entity\Asset;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\ImageValidator;

class ImageAssetValidator extends ImageValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value instanceof Asset) {
            parent::validate($value->getFile(), $constraint);
        }
    }
}
