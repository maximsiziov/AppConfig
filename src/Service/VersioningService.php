<?php

namespace App\Service;

use App\Dto\AssetDto;
use App\Dto\DefinitionDto;
use App\Dto\ResponseDto;
use App\Entity\Asset;
use App\Entity\Definition;
use App\Repository\AssetRepository;
use App\Repository\DefinitionRepository;
use App\Service\Strategies\MajorMinorStrategy;
use App\Service\Strategies\MajorStrategy;
use Doctrine\ORM\EntityManagerInterface;

class VersioningService
{
    private MajorMinorStrategy $majorMinorStrategy;
    private MajorStrategy $majorStrategy;
    private EntityManagerInterface $entityManager;

    private $exceptions;

    public function __construct(
        EntityManagerInterface $entityManager,
        MajorMinorStrategy     $majorMinorStrategy,
        MajorStrategy          $majorStrategy
    )
    {
        $this->entityManager = $entityManager;
        $this->majorMinorStrategy = $majorMinorStrategy;
        $this->majorStrategy = $majorStrategy;
    }


    public function getVersions($appVersion, $assetsVersion, $definitionsVersion, $platform): ResponseDto
    {
        $assets = $this->resolveAssets($appVersion, $assetsVersion, $platform);
        $definitions = $this->resolveDefinitions($appVersion, $definitionsVersion, $platform);

        $response = new ResponseDto();
        $response->assets = $assets;
        $response->definitions = $definitions;
        $response->version = [
            "required" => "12.2.423",
            "store"=> "13.7.556"
        ];

        $response->backendEntryPoint = [
            "jsonrpc_url" => "api.application.com/jsonrpc/v2"
        ];

        $response->notifications = [
            "jsonrpc_url" => "notifications.application.com/jsonrpc/v1"
        ];

        if (!empty($this->exceptions))
            $response->exceptions = $this->exceptions;

        return $response;
    }

    private function resolveAssets($appVersion, $assetsVersion, $platform): AssetDto
    {
        $repository = $this->entityManager->getRepository(Asset::class);
        $inputtedVersion = !empty($assetsVersion) ? $assetsVersion : $appVersion;
        $result = new AssetDto();
        /** @var Asset $version */
        $version = $this->majorStrategy->getVersion($inputtedVersion, $repository, $platform);
        if (!empty($version)) {
            $result->version = $version->getMajorVersion() . "." .$version->getMinorVersion() . "." . $version->getPatchVersion();
            $result->hash = $version->getHash();
            $result->url = [
                "dhm.cdn.application.com",
                "ehz.cdn.application.com",
                "vqe.cdn.application.com",
                "swg.cdn.application.com",
                "zdx.cdn.application.com"
            ];
        } else {
            $this->exceptions[] = 'Не найдена подходящаа версия Assets';
        }
        return $result;
    }

    private function resolveDefinitions($appVersion, $definitionsVersion, $platform): DefinitionDto
    {
        $repository = $this->entityManager->getRepository(Definition::class);
        $inputtedVersion = !empty($definitionsVersion) ? $definitionsVersion : $appVersion;
        /** @var Definition $version */
        $version = $this->majorMinorStrategy->getVersion($inputtedVersion, $repository, $platform);
        $result = new DefinitionDto();
        if (!empty($version)) {
            $result->version = $version->getMajorVersion() . "." . $version->getMinorVersion() . "." . $version->getPatchVersion();
            $result->hash = $version->getHash();
            $result->url = [
                "dhm.cdn.application.com",
                "ehz.cdn.application.com",
                "vqe.cdn.application.com",
                "swg.cdn.application.com",
                "zdx.cdn.application.com"
            ];
        } else {
            $this->exceptions[] = 'Не найдена подходящаа версия Definitions';
        }

        return $result;
    }
}