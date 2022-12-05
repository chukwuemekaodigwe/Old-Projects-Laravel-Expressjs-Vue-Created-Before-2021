<?php

namespace App\Http\Controllers;

use Ixudra\Curl\Facades\Curl;

class QuizController extends Controller
{
    //

    public function index()
    {

        return view('quiz');
    }

    public function test_quiz()
    {

        $response = Curl::to('https://questions.aloc.ng/api/q/3?subject=mathematics')
            ->get();

        $result = json_decode($response, true);

        $store = app('App\Http\Controllers\QuestionsController')->store($result);
        

        return view('cbtarena', ['questions' => $result]);

    }

}
