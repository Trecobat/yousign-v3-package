<?php

namespace Trecobat\LaravelDocuGenerateClient;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class YousignSrApiClient
{
    private string $apiKey;
    private string $apiVerion = "v3";

    /**
     * Construction du client YOUSIGN
     */
    public function __construct()
    {
    }

}
