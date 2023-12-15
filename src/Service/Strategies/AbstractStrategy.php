<?php

namespace App\Service\Strategies;

use App\Repository\SemVerRepositoryInterface;

abstract class AbstractStrategy
{
    abstract function getVersion($inputtedVersion, SemVerRepositoryInterface $repository, $platform);
}