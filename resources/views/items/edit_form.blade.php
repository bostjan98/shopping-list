<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Add fields for quantity, measure, and Items -->
    <input type="text" name="quantity" value="{{ $item->quantity }}">
    <input type="text" name="measure" value="{{ $item->measure }}">
    <input type="text" name="Items" value="{{ $item->Items }}">
    <button type="submit">Update Item</button>
</form>
