<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ParsedMangaRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ParsedMangaService
{
    public function __construct(
        private readonly ParsedMangaRepository $parsedMangaRepository,
    )
    {
        //
    }

    public function getList(): LengthAwarePaginator
    {
        return $this->parsedMangaRepository->getPaginatedList();
    }
}
