<?php

namespace App\Http\Requests\Concerns;

trait ValidatesEstatePhotos
{
    private function requiresPhotosAndMainSelection(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail): void {
            $photos = $this->photoPaths($value);

            if ($photos === []) {
                $fail('Առնվազն մեկ նկար պետք է վերբեռնված լինի։');

                return;
            }

            $mainPhoto = $this->input('temporary_photos_main');
            $photoNames = array_map('basename', $photos);

            if (! is_string($mainPhoto)
                || trim($mainPhoto) === ''
                || ! in_array(basename($mainPhoto), $photoNames, true)) {
                $fail('Պետք է ընտրվի գլխավոր նկար։');
            }
        };
    }

    /**
     * @return array<int, string>
     */
    private function photoPaths(mixed $value): array
    {
        $photos = is_string($value) ? json_decode($value, true) : $value;

        if (! is_array($photos)) {
            return [];
        }

        return array_values(array_filter(
            $photos,
            static fn (mixed $photo): bool => is_string($photo) && trim($photo) !== ''
        ));
    }
}
