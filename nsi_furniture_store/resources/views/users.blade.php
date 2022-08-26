<x-layout>
    <main>
        @if ($users->count())
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Addresses</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->addresses as $address)   
                    {{ $address->name }} 
                    {{ $address->number }}
                    <br>
                    @endforeach
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No users yet. Please check back later.</p>
        @endif

        @if (count($usersRaw))
            @foreach($usersRaw as $raw)
                <p>User:</p>
                <p>Name: {{ $raw->u_name }}</p> <br>
                <p>Email: {{ $raw->email }}</p> <br>
                <p>address: {{ $raw->address }}</p> <br>
            @endforeach
        @endif
    </main>
</x-layout>