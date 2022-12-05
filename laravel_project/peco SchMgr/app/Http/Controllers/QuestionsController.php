<?php

namespace App\Http\Controllers;

use App\questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     *  "subject": "chemistry",
  /*   "status": 200,
    "data": {
        "id": 175,
        "question": "N2(g)  +  3H2(g)  \u21cc   2NH2(g)   \u0394 H = - 90kJ  In the equation above, the yield of ammonia can be decreased by",
        "option": {
            "a": "Adding a catalyst",
            "b": "Removing ammonia",
            "c": "Increasing the pressure",
            "d": "Increasing the temperature"
        },
        "section": "",
        "image": "",
        "answer": "d",
        "solution": "",
        "examtype": "utme",
        "examyear": "2005"
    }
*/
   public function store(array $questions)
    {
        foreach ($questions['data'] as $question) {

            $result = questions::firstOrCreate([
            'question_no' => $question['id'],
            'subject' => $questions['subject'],
            'question' => $question['question'],
            'option_a' => $question['option']['a'],
            'option_b' => $question['option']['b'],
            'option_c' => $question['option']['c'],
            'option_d' => $question['option']['d'],
            'answer' => $question['answer'],
            'examyear' => $question['examyear'],
            'examtype' => $question['examtype']
            
                ]);
        }

       


    }
/**
 * insert into `questions` (`question_no`, `subject`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`, `examtype`, `updated_at`, `created_at`) values (36, mathematics, The expression ax2 + bx takes the value 6 when x = 1 and 10 when x = 2. Find its value when  x = 5       , 10, 12, 6, .-10, a, post-utme, 2019-10-31 13:59:19, 2019-10-31 13:59:19)) ◀"

 */



    /**
     * Display the specified resource.
     *
     * @param  \App\questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(questions $questions)
    {
        //
    }
}
