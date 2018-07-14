<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $faq = ($id) ? Faq::find($id) : null;
        $faqs = Faq::all();

        return view('admin/faq', compact('faqs', 'faq'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $faqs = Faq::all();

        return view('admin/faq/add', compact('faqs'));
    }

    /**
     * Create a new faq instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Faq
     */
    public function create(Request $request) {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = Faq::create($data);
        return redirect('/admin/faq/' . $faq->id);
    }

    /**
     * Edit form for faq data
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);

        return view('admin/faq/edit', compact('faq'));
    }


    /**
     * Save updated user data
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $faq = Faq::find($id);

        $validates = $this->validate(request(), [
            'question' => 'string|nullable',
            'answer' => 'string|nullable',
            'position' => 'numeric|nullable'
        ]);

        if ($validates) {
            $newData = [];

            if (!request('question') == '') {
                $newData['question'] = request('question');
            }
            if (!request('answer') == '') {
                $newData['answer'] = request('answer');
            }
            if (!request('position') == '') {
                $newData['position'] = request('position');
            }

            $faq->update($newData);

            return redirect('/admin/faq/' . $id);

        }

        echo 'FAQ value doesn\'t validate' ;
        die;
    }

}
