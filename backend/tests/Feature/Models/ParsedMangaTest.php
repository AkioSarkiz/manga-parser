<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use App\Models\ParsedManga;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ParsedMangaTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make(): void
    {
        $model = ParsedManga::factory()->make();

        $this->assertInstanceOf(ParsedManga::class, $model);
        $this->assertModelMissing($model);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create(): void
    {
        $model = ParsedManga::factory()->create();

        $this->assertInstanceOf(ParsedManga::class, $model);
        $this->assertModelExists($model);
    }
}
