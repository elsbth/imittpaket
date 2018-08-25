<?php

namespace App\Http\Controllers;

use App\Item;
use App\MarkedItem;
use App\Giver;
use Auth;
use Illuminate\Http\Request;
use Validator;

class MarkedItemController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'item' => 'required',
            'user' => 'required_without:giver',
            'giver' => 'required_without:user',
            'marked_qty' => 'integer|nullable'
        ]);

        //TODO: Saving for later when users can mark items on a friend's list
        /*
        $userId = User::decodeHid($data['user_id']);
        $currentUser = Auth::user();

        if ($userId && $currentUser && $userId != Auth::user()->id)
        */
        $itemId = Item::decodeHid($data['item']);
        $item = Item::find($itemId);
        $giver = Giver::whereToken($data['giver'])->first();

        $msg = 'Could not select that item';

        if ($item && $giver) {
            $continue = true;

            $markedForItem = MarkedItem::where(['item_id' => $itemId])->get();

            if ($item->qty) {
                //Check if requested qty is still available and mark
                $markedQty = 0;
                $markedQtyForGiver = 0;
                foreach ($markedForItem as $id => $mark) {
                    if ($mark->giver_id != $giver->id &&  $mark->marked_qty) {
                        $markedQty += $mark->marked_qty;
                    } else {
                        $markedQtyForGiver += $mark->marked_qty;
                    }
                }

                $leftToMark = $item->qty - $markedQty;

                if ($data['marked_qty'] > $leftToMark) {
                    $continue = false;
                    $msg = 'There are only ' . $leftToMark . ' left to give for ' . $item->name . '.';
                }
            } else {
                //Check if item is already checked if item has no qty
                if ($markedForItem->count() > 0) {
                    $continue = false;
                    $msg = $item->name . ' is already selected by someone else.';
                }
            }

            if ($continue) {

                $marked = MarkedItem::where(['item_id' => $itemId, 'giver_id' => $giver->id])->first();

                if ($marked) {

                    if (!$data['marked_qty']) {
                        //Remove
                        $result = MarkedItem::destroy($marked->id);

                        if ($result) {
                            $msg = $item->name . ' was un-selected.';
                        }
                    } else {
                        $marked->marked_qty = $data['marked_qty'];
                        $result = $marked->save();

                        if ($result) {
                            $msg = 'Selected quantity to give for ' . $item->name . ' was updated.';
                        } else {
                            $msg = 'Could not change the selected quantity for ' . $item->name . '.';
                        }
                    }

                } else {
                    $data['item_id'] = $item->id;
                    $data['giver_id'] = $giver->id;

                    $qtyMsg = (isset($data['marked_qty'])) ? $data['marked_qty'] . ' of ' : '';

                    $mItem = MarkedItem::create($data);

                    if ($mItem) {
                        $msg = 'You selected to give ' . $qtyMsg . $item->name;
                    } else {
                        $msg = $item->name . ' could not be selected';
                    }
                }
            }
        }

        return redirect()->back()->with('message', $msg);
    }
}
