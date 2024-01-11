<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ShoppingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $items = Item::where('deleteItem', 0)->get();
            return view('items.index', compact('items'));
        };
        return redirect()->route('login');
    }

    public function IndexApi()
    {
        $items = Item::where('deleteItem', 0)->get();

        echo json_encode($items);

    }

    public function editForm($id)
    {
        if(Auth::check())
        {
            $item = Item::findOrFail($id);
            return view('items.edit_form', compact('item'));
        };
        return redirect()->route('login');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $item = Item::findOrFail($id);
        $item->quantity = $request->input('quantity');
        $item->measure = $request->input('measure');
        $item->Items = $request->input('Items');
        $item->user_id = $user->id;
        $item->save();

        $this->logAction('edit', $item->id);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function createForm()
    {
        if(Auth::check())
        {
            return view('items.create_form');
        };
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $item = new Item;
        $item->quantity = $request->input('quantity');
        $item->measure = $request->input('measure');
        $item->Items = $request->input('Items');
        $item->insertDate = date('Y-m-d H:i:s',time());
        $item->user_id = $user->id;
        $item->save();

        $this->logAction('create', $item->id);
        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    public function toggleNakupljeno(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $item = Item::findOrFail($id);
            $item->nakupljeno = $request->input('nakupljeno');
            $item->user_id = $user->id;
            $item->save();
            $this->logAction('buy', $item->id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error($e);

            // Return a response with an error message
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function toggleNakupljenoAjax(Request $request, $id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
        $item->nakupljeno = !$item->nakupljeno;
        $item->buyDate = (($item->nakupljeno == 1)?date('Y-m-d H:i:s',time()):$item->buyDate);
        $item->user_id = $user->id;
        $item->save();

        $this->logAction('buy', $item->id);

        $response = ($item->nakupljeno)?1:0;
        return response()->json(['success' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item,$id)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $item = Item::findOrFail($id);
            $item->deleteItem = 1;
            $item->deleteDay = date('Y-m-d H:i:s',time());
            $item->user_id = $user->id;
            $item->save();

            $this->logAction('delete', $item->id);

            return response()->json(['message' => 'Item deleted successfully']);
        };
        return redirect()->route('login');
    }

    private function logAction($action, $item_id)
{
    // Log the action in shopping_logs table
    $user = Auth::user(); // Get the currently authenticated user

    ShoppingLog::create([
        'item_id' => $item_id,
        'action' => $action,
        'user_id' => $user->id,
    ]);
}
}
