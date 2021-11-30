@props(['post'])

<article class=" mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    @if ($post->image)
        <img class=" w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
    @else
        <img class=" w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2021/03/16/10/04/street-6099209_960_720.jpg" alt="">
    @endif
    <div class=" px-6 py-4">
        <h2>
            <a class=" text-xl mb-2 font-bold" href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h2>
        <div class=" text-gray-700 text-base">
            {!! $post->extract !!}
        </div>
    </div>
    <div class=" px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag) }}"
                class=" inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>
