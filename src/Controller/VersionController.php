<?php

namespace App\Controller;

use App\Service\VersioningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
class VersionController extends AbstractController
{
    /**
     * @Route("/config", name="app_config_get", methods={"GET"})
     * @param HttpFoundation\Request $request
     * @param VersioningService $service
     * @return HttpFoundation\JsonResponse
     */
    public function getConfig(
        HttpFoundation\Request $request,
        VersioningService $service
    ):HttpFoundation\JsonResponse
    {
        $appVersion = $request->get('appVersion');
        $assetsVersion = $request->get('assetsVersion');
        $definitionsVersion = $request->get('definitionsVersion');
        $platform = $request->get('platform');
        if(empty($platform) || empty($appVersion))
            return new HttpFoundation\JsonResponse(['Отсутствуют необходимые параметры'], '400');

        $response = $service->getVersions($appVersion, $assetsVersion, $definitionsVersion, $platform);

        if(!empty($response->exceptions))
            return new HttpFoundation\JsonResponse($response->exceptions, '400');



        return new HttpFoundation\JsonResponse($response);
    }
}