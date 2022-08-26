<x-layout>
    <main>
        
        @if ($categories->count())
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Category</th>
                <th scope="col">Furniture</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                <td>{{ $category->name }}</td>
                <td>
                    @foreach($category->furniture as $item)
                        {{ $item->name }}
                        <br>
                    @endforeach
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No categories yet. Please check back later.</p>
        @endif

        @if (count($categoriesRaw))
            @foreach($categoriesRaw as $raw)
                <p>Category: {{ $raw->c_name }}</p> <br>
                <p>Furniture: {{ $raw->f_name }}</p> <br>
            @endforeach
        @endif
    </main>
</x-layout>