<aside class="col-span-1 space-y-6 text-gray-600">

    <div class="p-4 space-y-4 bg-white shadow">
        <div>
            {{-- Start Discusson Button --}}
            <a href="{{ route('threads.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25" }}>
                {{ __('Start a new discussion') }}
            </a>
        </div>

        @auth
        @if(request()->routeIs('threads.show'))
        <div class="pb-4 space-y-4">

            @can(App\Policies\ThreadPolicy::UNSUBSCRIBE, $thread)
            {{-- Unubscribe to thread button --}}
            <x-links.main href="{{ route('threads.unsubscribe', [$thread->category->slug(), $thread->slug()]) }}">
                {{ __('Unsubscribe to Thread') }}
            </x-links.main>
            <p class="text-sm text-gray-500 ">
                Unsubscribe from this thread.
            </p>

            @elsecan(App\Policies\ThreadPolicy::SUBSCRIBE, $thread)
            {{-- Subscribe to thread button --}}
            <x-links.main href="{{ route('threads.subscribe', [$thread->category->slug(), $thread->slug()]) }}">
                {{ __('Subscribe to Thread') }}
            </x-links.main>
            <p class="text-sm text-gray-500 ">
                Subscribe to this thread.
            </p>
            @endcan

        </div>
        @endif
        @endauth
    </div>

    <div class="p-4 space-y-4 bg-white shadow">
        <ul class="space-y-4 text-gray-500">
        <li>
            <a href='{{ route('threads.index') }}' class="flex items-center justify-between font-bold">
                All Thread
                <span class="px-2 text-white bg-green-300 rounded">{{ \App\Models\Thread::count() }}</span>
            </a>
        </li>
            @foreach (\App\Models\Tag::all() as $tags)
                <li>
                <a href="{{ route('threads.tags.index', $tags->slug()) }}" class="flex items-center justify-between">
                    {{ $tags->name() }}
                    <span class="px-2 text-white bg-green-300 rounded">{{ $tags->threadCount() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- <div class="p-4 space-y-4 bg-white shadow">
        <ul class="space-y-4 text-gray-500">
            <li>
                <a href="#" class="flex items-center space-x-2">
                    <x-heroicon-s-star class="w-5 h-5 text-yellow-500" />
                    <span>Popular this week</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-2">
                    <x-heroicon-s-fire class="w-5 h-5 text-red-600" />
                    <span>Popular all time</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-2">
                    <x-heroicon-s-chat class="w-5 h-5 text-blue-400" />
                    <span>No replies yet</span>
                </a>
            </li>
        </ul>
    </div> --}}

        {{-- <div class="p-4 space-y-4 bg-white shadow ">
        <ul class="space-y-4">
            @foreach (\App\Models\Category::all() as $category)
            <li>
                <a class="flex items-center justify-between" readonly>
                    {{ $category->name() }}
                    <span class="px-2 text-white bg-green-300 rounded">{{ $category->threadCount() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div> --}}


</aside>
