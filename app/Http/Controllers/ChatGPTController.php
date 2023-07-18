<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatGPTController extends Controller
{
    public function index(Request $request)
    {
        try {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])
                ->post("https://api.openai.com/v1/chat/completions", [
                    "model" => "gpt-3.5-turbo",
                    'messages' => [
                        [
                            "role" => "user",
                            "content" => $request->message
                        ]
                    ]
                ])
                ->json();

            return response()->json(["status" => true, "data" => $response], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()], 400);
        }
    }
}
