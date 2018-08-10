<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hid = null)
    {
        $id = Faq::decodeHid($hid);
        $faq = ($id) ? Faq::find($id) : null;
        $faqs = Faq::all();

        return view('faq', compact('faqs', 'faq'));
    }

}
