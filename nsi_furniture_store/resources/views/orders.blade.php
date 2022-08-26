<x-layout>
    <main>
        
        @if ($orders->count())
        <table class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">User Name</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="bg-info">
                <td>{{ $order->name }}</td>
                <td>{{ $order->user->name }}</td>
                <td></td>
                </tr>

                <tr>
                <th colspan="3" class="bg-primary">Items</th>
                </tr>

                <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                </tr>

                @foreach($order->furniture as $item)
                    <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No orders yet. Please check back later.</p>
        @endif

        @if (count($ordersRaw))
            @foreach($ordersRaw as $raw)
                <p>Order:</p>
                <p>Name: {{ $raw->o_name }}</p> <br>
                <p>User: {{ $raw->u_name }}</p> <br>
                <p>Item:</p>
                <p>Name: {{ $raw->f_name }}</p> <br>
                <p>Price: {{ $raw->price }}</p> <br>
                <p>Quantity: {{ $raw->quantity }}</p> <br>
                <p>Total: {{ $raw->total }}</p> <br>
            @endforeach
        @endif
    </main>
</x-layout>