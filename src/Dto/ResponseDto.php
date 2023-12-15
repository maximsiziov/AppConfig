<?php

namespace App\Dto;

class ResponseDto
{
    public array $version;
    public array $backendEntryPoint;
    public AssetDto $assets;
    public DefinitionDto $definitions;
    public array $notifications;

    public array $exceptions;
}