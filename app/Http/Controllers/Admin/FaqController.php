<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

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
    public function index($hid = null)
    {
        $id = Faq::decodeHid($hid);
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
        return redirect('/admin/faq/' . $faq->hid());
    }

    /**
     * Edit form for faq data
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($hid)
    {
        $id = Faq::decodeHid($hid);
        $faq = Faq::find($id);

        return view('admin/faq/edit', compact('faq'));
    }



    public function store(Request $request, $hid)
    {
        $redirectTo = 'admin.faq.edit';

        $validator = Validator::make($request->all(), [
            'question' => 'string',
            'answer' => 'string',
            'position' => 'numeric|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $data = $input = $request->all();

//        $hid = $data['list_id'];
        $id = Faq::decodeHid($hid);

        $currentFaq = ($id) ? Faq::find($id) : null;

        if ($currentFaq) {

            $currentFaq->fill($data);
            $changes = $currentFaq->getDirty();

            if ($changes) {
                $currentFaq->save();

                $changedFields = array_keys($changes);
                $message = 'Faq updated: ' . join(', ', $changedFields);
                $redirectTo = 'admin.faq.view';
            } else {
                $message = 'No changes detected.';
            }
        } else {
            $message = 'Faq could not be found.';
        }

        return redirect(route($redirectTo, $currentFaq->hid()))->with('message', $message);
    }

    /**
     * Save updated user data
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOLD($hid)
    {
        $id = Faq::decodeHid($hid);
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

            return redirect('/admin/faq/' . $hid);

        }

        echo 'FAQ value doesn\'t validate' ;
        die;
    }

}
