<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Laravel\Passport\Client;

class authorizeResource extends Controller
{
    public function authorize($ability, $arguments = [])        {
        $client = Client::where('id', env('CLIENT_ID'))->first();

        if (!$client) {
            abort(404);
        }

        $state = Str::random(40);
        session(['state' => $state]);

        $query = http_build_query([
            'client_id' => env('CLIENT_ID'),
            'redirect_uri' => env('REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect(env('API_URL') . '/authorize?' . $query);
    }
}
