<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class QuoteController extends Controller
{
   
    public function index(){
        $quotes = Quote::orderby('updated_at', 'desc')->paginate(20);
        return view('admin/quote', ['quotes'=> $quotes]);
      
    }

    public function add_quote(){
return view('admin/add_quote');
        
    }

    public function store(Request $request){
        //var_dump($request->quote); die();
        $this->validate($request, [
            'title' => ['required'],
            'quote'=> ['required', 'min:10'],
        ]);

        $quote = new Quote;
        $quote->title = ucwords($request->title);
        $quote->body = $request->quote;
        $quote->author = $request->author;
        $quote->status = '1';
        $quote->save();
        
    $request->session()->flash('message', 'Quote published successfully');
    $request->session()->flash('alert-class', 'alert-success');
    return redirect('/dash/quotes/all');
}


public function reuse(Request $request, Quote $quote){
$quote->update(['status'=> 1]);
$request->session()->flash('message', 'Quote (<b>'.$quote->title.'</b>) republished successfully');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect('/dash/quotes/all');
}

public function destroy(Request $request, Quote $quote){
    $result = $quote->delete();
    
    if($result == true){
        $request->session()->flash('message', 'Quote successfully deleted!');
        $request->session()->flash('alert-class', 'alert-success');
    }else{
        $request->session()->flash('message', 'Quote not deleted, please retry!');
        $request->session()->flash('alert-class', 'alert-danger');
    }

    return redirect('/dash/quotes/all');
}

}