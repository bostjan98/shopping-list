@extends('auth.layouts')

@section('content')
    <div class="container">
        <h1>Edit Item</h1>

        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="quantity"><b>Quantity:</b></label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}">
            </div>

            <div class="form-group">
                <label for="measure"><b>Measure:</b></label>
                <select class="form-control" id="measure" name="measure">
                    <option value="kos" {{ $item->measure === 'kos' ? 'selected' : '' }}>kos</option>
                    <option value="ml" {{ $item->measure === 'ml' ? 'selected' : '' }}>ml</option>
                    <option value="g" {{ $item->measure === 'g' ? 'selected' : '' }}>g</option>
                    <option value="kg" {{ $item->measure === 'kg' ? 'selected' : '' }}>kg</option>
                    <option value="l" {{ $item->measure === 'l' ? 'selected' : '' }}>l</option>
                </select>
            </div>

            <div class="form-group">
                <label for="items"><b>Items:</b></label>
                <input type="text" class="form-control" id="items" name="Items" value="{{ $item->Items }}">
            </div>
<div style="padding:10px 5px;"><button type="submit" class="btn btn-primary">Update Item</button></div>

        </form>
    </div>
@endsection
