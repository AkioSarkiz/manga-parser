<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ParsedManga;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ParsedMangaRepository
{
    protected const PAGINATION_SIZE = 10;

    private function getPaginationSize(): int
    {
        return static::PAGINATION_SIZE;
    }

    public function create(array $data): ParsedManga
    {
        return ParsedManga::create($data);
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return ParsedManga::paginate(
            $this->getPaginationSize()
        );
    }
}
