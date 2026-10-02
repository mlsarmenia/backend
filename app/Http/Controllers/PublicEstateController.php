<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Scopes\EstateScope;
use Illuminate\Contracts\View\View;

class PublicEstateController extends Controller
{
    public function show(int $estate): View
    {
        $estate = Estate::withoutGlobalScope(EstateScope::class)
            ->whereKey($estate)
            ->where('is_published', true)
            ->with([
                'ceiling_height_type',
                'contract_type',
                'estate_type',
                'location_community',
                'location_province',
                'location_street',
                'estateDocuments' => fn ($query) => $query->where('is_public', true),
            ])
            ->firstOrFail();

        return view('estates.show', [
            'estate' => $estate,
        ]);
    }
}
