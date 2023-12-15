<?php

namespace App\Service\Strategies;

class MajorMinorStrategy extends AbstractStrategy
{
    public function getVersion($inputtedVersion, $repository, $platform)
    {
        [$major, $minor, $patch] = explode('.', $inputtedVersion);

        return $repository->findMajorMinorVersion($major, $minor, $platform);
    }
}