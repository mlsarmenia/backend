<?php

namespace App\Http\Requests\Concerns;

trait ValidatesEstateNumericFields
{
    protected function prepareForValidation(): void
    {
        $normalized = [];

        foreach (['price_amd', 'price_amd_initial', 'price_amd_selled'] as $attribute) {
            $value = $this->input($attribute);

            if (is_string($value)) {
                $normalized[$attribute] = str_replace(',', '', $value);
            }
        }

        $this->merge($normalized);
    }

    protected function withEstateNumericRules(array $rules): array
    {
        foreach ($this->estateNumericRules() as $attribute => $numericRules) {
            $rules[$attribute] = [
                ...(array) ($rules[$attribute] ?? []),
                ...$numericRules,
            ];
        }

        return $rules;
    }

    private function estateNumericRules(): array
    {
        return [
            'floor' => ['nullable', 'integer', 'min:0'],
            'building_floor_count' => ['nullable', 'integer', 'min:0'],
            'room_count' => ['nullable', 'integer', 'min:0'],
            'room_count_modified' => ['nullable', 'integer', 'min:0'],
            'area_total' => ['nullable', 'numeric', 'min:0'],
            'area_residential' => ['nullable', 'numeric', 'min:0'],
            'price_amd' => ['nullable', 'numeric', 'min:0'],
            'price_amd_initial' => ['nullable', 'numeric', 'min:0'],
            'price_amd_selled' => ['nullable', 'numeric', 'min:0'],
            'refund_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
