<x-layout>
    <main>
        @if ($furniture->count())
        <table class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Categories</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($furniture as $one)
                <tr class="bg-info">
                <td>{{ $one->name }}</td>
                <td>{{ $one->description }}</td>
                <td>{{ $one->price }}</td>
                <td>
                    @if($one->categories->count())
                        @foreach($one->categories as $category)
                            {{$category->name}}
                            <br>
                        @endforeach
                    @endif
                </td>
                </tr>

                <tr>
                <th colspan="4" class="bg-primary">Comments</th>
                </tr>

                <tr>
                <th scope="col">Title</th>
                <th scope="col">Contet</th>
                <th scope="col">Posted</th>
                <th scope="col">Username</th>
                </tr>
                @if($one->comments->count())
                @foreach($one->comments as $comment)
                    <tr>
                    <td>{{ $comment->title }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                    <td>{{ $comment->user->name }}</td>
                    </tr>
                @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No furniture yet. Please check back later.</p>
        @endif

        @if (count($furnitureRaw))
            @foreach($furnitureRaw as $raw)
                <p>Furniture:</p>
                <p>Name: {{ $raw->f_name }}</p> <br>
                <p>Description: {{ $raw->description }}</p> <br>
                <p>Price: {{ $raw->price }}</p> <br>
                <p>Categories: {{$raw->furniture_categories}}</p>
                <p>Comment:</p>
                <p>Title: {{ $raw->title }}</p> <br>
                <p>Content: {{ $raw->content }}</p> <br>
                <p>Posted At: {{ $raw->created_at }}</p> <br>
                <p>User Name: {{ $raw->u_name }}</p> <br>
            @endforeach
        @endif
    </main>
</x-layout>