<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <!-- Add fields for quantity, measure, and Items -->
    <input type="text" name="quantity">
    <input type="text" name="measure">
    <input type="text" name="Items">
    <button type="submit">Create Item</button>
</form>
