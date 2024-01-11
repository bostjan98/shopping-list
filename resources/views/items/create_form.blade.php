

@extends('auth.layouts')

@section('content')
    <div class="container">
        <h1>Create Item</h1>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="quantity"><b>Quantity:</b></label>
                <input type="text" class="form-control" id="quantity" name="quantity">
            </div>

            <div class="form-group">
                <label for="measure"><b>Measure:</b></label>
                <select class="form-control" id="measure" name="measure">
                    <option value="kos">kos</option>
                    <option value="ml">ml</option>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="l">l</option>
                </select>
            </div>

            <div class="form-group">
                <label for="items"><b>Items:</b></label>
                <input type="text" class="form-control" id="items" name="Items">
            </div>

            <div style="padding:10px 5px;"><button type="submit" class="btn btn-primary">Create Item</button></div>
        </form>
    </div>
@endsection

