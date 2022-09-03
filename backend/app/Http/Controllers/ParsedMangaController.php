<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ParsedMangaResource;
use App\Services\ParsedMangaService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ParsedMangaController extends Controller
{
    public function __construct(
        private readonly ParsedMangaService $parsedMangaService,
    )
    {
        //
    }

    public function index(): AnonymousResourceCollection
    {
        return ParsedMangaResource::collection(
            $this->parsedMangaService->getList(),
        );
    }
}
