<x-app-layout>

    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8">
        <h2 class=" uppercase py-8 text-center text-3xl font-bold">Categoria: {{ $category->name}}</h2>

        @foreach ($posts as $post)
            <x-card-post :post="$post" />
        @endforeach

        <div class=" pb-8">
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>