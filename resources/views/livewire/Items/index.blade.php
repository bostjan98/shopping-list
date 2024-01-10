<div>
    <h1>Items List (Livewire)</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantity</th>
                <th>Measure</th>
                <th>Item Name</th>
                <th>Insert Date</th>
                <th>Buy Date</th>
                <th>Nakupljeno</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->measure }}</td>
                    <td>{{ $item->Items }}</td>
                    <td>{{ $item->insertDate }}</td>
                    <td>{{ $item->buyDate }}</td>
                    <td>{{ $item->nakupljeno }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
