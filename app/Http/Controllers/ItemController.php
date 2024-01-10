<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    public function IndexApi()
    {
        $items = Item::all();

        echo json_encode($items);
    }

    public function editForm($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit_form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->quantity = $request->input('quantity');
        $item->measure = $request->input('measure');
        $item->Items = $request->input('Items');
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function createForm()
    {
        return view('items.create_form');
    }

    public function store(Request $request)
    {
        $item = new Item;
        $item->quantity = $request->input('quantity');
        $item->measure = $request->input('measure');
        $item->Items = $request->input('Items');
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    public function toggleNakupljeno(Request $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->nakupljeno = $request->input('nakupljeno');
            $item->save();

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
        // Logic to toggle the 'nakupljeno' field for a specific item
        $item = Item::findOrFail($id);
        $item->nakupljeno = !$item->nakupljeno;
        $item->save();

        return response()->json(['success' => true]);
    }

}
