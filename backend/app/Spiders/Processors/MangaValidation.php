<?php

declare(strict_types=1);

namespace App\Spiders\Processors;

use Illuminate\Support\Facades\Validator;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

class MangaValidation implements ItemProcessorInterface
{
    use Configurable;

    public function processItem(ItemInterface $item): ItemInterface
    {
        $validator = Validator::make($item->all(), [
            'raw_data' => 'required|string',
            'parsed_data' => 'required|array',
            'key' => 'required|unique:parsed_mangas,key',
            'source' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $item->drop(json_encode([
                'data' => $item->all(),
                'errors' => $validator->errors()->toArray(),
            ]));
        }

        return $item;
    }
}
