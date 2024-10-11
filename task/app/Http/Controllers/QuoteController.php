<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuoteController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/quote/list",
     *     @OA\Response(response="200", description="List of 15 quotes by Homer Simpson")
     * )
     */

    public function getFamousQuote(Request $request)
    {
        Log::info('Get famous quote');

        $data = Http::get('https://thesimpsonsquoteapi.glitch.me/quotes',[
            'character' => $request->body['character'] ?? 'ho',
            'count' => 15
        ])->json();

        return response()->json([
            "data" => $data,
            "message" => "famous quote",
            "error" => false
        ], 200);
    }
}
