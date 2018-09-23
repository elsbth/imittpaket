<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\ItemCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ItemCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($hid = null)
    {
        $id = ItemCategory::decodeHid($hid);
        $currentCategory = ($id) ? ItemCategory::find($id) : null;
        $categories = ItemCategory::getAll();

        return view('admin/itemcategories', compact('categories', 'currentCategory'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:50',
            'icon' => 'required|max:50'
        ]);

        $category = ItemCategory::create($data);

        if ($category) {
            $message = 'Category ' . $category->name . ' created.';
        } else {
            $message = 'Something went wrong.';
        }

        return redirect(route('admin.itemcategories'))->with('message', $message);
    }

    public function edit($hid)
    {
        $id = ItemCategory::decodeHid($hid);
        $category = ItemCategory::find($id);

        return view('admin/itemcategory/edit', compact('category'));
    }

    public function store(Request $request, $hid)
    {
        $redirectTo = 'admin.itemcategory.edit';

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'icon' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $data = $input = $request->all();

//        $hid = $data['list_id'];
        $id = ItemCategory::decodeHid($hid);

        $currentCategory = ($id) ? ItemCategory::find($id) : null;

        if ($currentCategory) {

            $currentCategory->fill($data);
            $changes = $currentCategory->getDirty();

            if ($changes) {
                $currentCategory->save();

                $changedFields = array_keys($changes);
                $message = 'Item category updated: ' . join(', ', $changedFields);
            } else {
                $message = 'No changes detected.';
            }
        } else {
            $message = 'Item category could not be found.';
        }

        return redirect(route($redirectTo, $currentCategory->hid()))->with('message', $message);
    }

    public function delete($hid) {

        $id = ItemCategory::decodeHid($hid);
        $currentCategory = ($id) ? ItemCategory::find($id) : null;

        if ($currentCategory) {
            $name = $currentCategory->name;
            $result = $currentCategory->delete();

            $message = $result ? 'The itemcategory "' . $name . '" was deleted.' : 'Something went wrong' ;
        } else {
            $message = 'Item category could not be found';
        }

        return redirect(route('admin.itemcategories.create'))->with('message', $message);
    }
}
