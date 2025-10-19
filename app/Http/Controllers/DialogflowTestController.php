<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DialogflowService;
use Exception;

class DialogflowTestController extends Controller
{
    protected DialogflowService $dialogflow;

    public function __construct(DialogflowService $dialogflow)
    {
        $this->dialogflow = $dialogflow;
    }

    
    public function test()
    {
        return view('df_test');
    }

    
    public function send(Request $request)
    {
        $text = $request->input('message', 'Hello');
        $sessionId = $request->session()->getId(); 

        try {
            $result = $this->dialogflow->detectIntent($sessionId, $text);

            return response()->json([
                'query_text' => $result->getQueryText(),
                'intent' => $result->getIntent()->getDisplayName(),
                'response' => $result->getFulfillmentText(),
                'parameters' => $result->getParameters()->serializeToJsonString(),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
