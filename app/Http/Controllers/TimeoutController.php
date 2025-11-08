<?php

namespace App\Http\Controllers;

class TimeoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function limiteExcedido()
    {
        $result = 0;
        
        // Simulate a long computation task
        for ($i = 0; $i < 5000000000000; $i++) {
            $result += $i; // Heavy computation
        }

        return response()->json([
            'message' => 'Finished computation',
            'result' => $result
        ]);

        return response()->json(['message' => 'Timeout Controller']);
    }

    public function limiteOk()
    {
        $result = 0;
        
        // Simulate a long computation task
        for ($i = 0; $i < 500000; $i++) {
            $result += $i; // Heavy computation
        }

        return response()->json([
            'message' => 'Finished computation',
            'result' => $result
        ]);

        return response()->json(['message' => 'Timeout Controller']);
    }

}
