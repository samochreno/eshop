<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function ($model) {
            $model->slug = $model->generateUniqueSlug();
        });
    }

    public function generateUniqueSlug(): string
    {
        $slug = Str::slug($this->name);

        // Check if the slug already has a number at the end
        $number = null;
        if (preg_match('/-(\d+)$/', $slug, $matches)) {
            $number = $matches[1];
            $slug = Str::replaceLast("-$number", '', $slug);
        }

        $existingSlugs = $this->getExistingSlugs($slug);
        if (!in_array($slug, $existingSlugs)) {
            return $number ? "$slug-$number" : $slug;
        }

        return $this->findNextUniqueSlug($slug, $existingSlugs, $number);
    }

    private function getExistingSlugs(string $slug): array
    {
        return $this
            ->withTrashed()
            ->where('slug', 'LIKE', "$slug%")
            ->where('id', '!=', $this->id ?? null)
            ->pluck('slug')
            ->toArray();
    }

    private function findNextUniqueSlug(
        string $baseSlug,
        array $existingSlugs,
        int|null $lastNumber
    ): string
    {
        $i = $lastNumber ? ($lastNumber + 1) : 1;

        while (true) {
            $slug = $baseSlug.'-'.$i;

            if (!in_array($slug, $existingSlugs)) {
                return $slug;
            }

            $i++;
        }

    }
}
