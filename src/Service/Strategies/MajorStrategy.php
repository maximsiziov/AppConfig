<?php

namespace App\Service\Strategies;

class MajorStrategy extends AbstractStrategy
{
    public function getVersion($inputtedVersion, $repository, $platform)
    {
        [$major, $minor, $patch] = explode('.', $inputtedVersion);

        return $repository->findMajorVersion($major, $platform);
    }
}