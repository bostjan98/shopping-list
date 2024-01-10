<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ItemLivewire extends Component
{
    public function render()
    {
        $items = Item::all();

        return view('livewire.items.index', compact('items'));
    }
}
