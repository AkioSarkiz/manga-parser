<?php

declare(strict_types=1);

namespace App\Spiders\Processors;

use App\Repositories\ParsedMangaRepository;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

class SaveMangaProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function __construct(
        private readonly ParsedMangaRepository $parsedMangaRepository,
    )
    {
        //
    }

    public function processItem(ItemInterface $item): ItemInterface
    {
        $this
            ->parsedMangaRepository
            ->create($item->all());

        return $item;
    }
}
