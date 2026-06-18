<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $currency = $request->input('currency');

// Store the selected currency in the session
        session(['currency' => $currency]);

        return redirect()->back()->with('success', 'Currency set successfully.');
    }
}
