<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSubmission;
use Illuminate\Http\Request;

class API extends Controller
{
    public function handleSubmissions(Request $request)
    {
        ProcessSubmission::dispatch($request->all());
        return response()->json([
            'status' => true,
        ],202);
    }
}
