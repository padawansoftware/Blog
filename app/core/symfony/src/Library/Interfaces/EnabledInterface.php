<?php
namespace Core\Library\Interfaces;

/**
 + Provides a way to check whether the interface-implementing class instance is enabled or not
 */
interface EnabledInterface
{
    public function isEnabled():bool;
}
