<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Create Post Button -->
            <div class="flex justify-end">
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Create New Post') }}
                </a>
            </div>

            <!-- Posts List -->
            @forelse ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg {{ $post->trashed() ? 'opacity-60 border-2 border-red-100' : '' }}">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-1">
                                    <h3 class="font-bold text-xl {{ $post->trashed() ? 'text-red-500' : 'text-indigo-600' }}">
                                        <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                                    </h3>
                                    @if($post->trashed())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Trashed
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500">
                                    By <span class="font-semibold text-gray-700">{{ $post->user->name }}</span> • {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if(Auth::id() === $post->user_id || Auth::user()->isAdmin())
                                <div class="flex items-center space-x-3">
                                    @if($post->trashed())
                                        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-gray-400 hover:text-green-600 transition-colors duration-200" title="Restore Post">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        @if(Auth::id() === $post->user_id)
                                            <a href="{{ route('posts.edit', $post->id) }}" class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        @endif
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if($post->image)
                            <div class="mt-4 border-2 border-gray-100 rounded-2xl overflow-hidden shadow-sm {{ $post->trashed() ? 'grayscale' : '' }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto max-h-[360px] object-cover">
                            </div>
                        @endif

                        <div class="mt-4 text-gray-700 leading-relaxed line-clamp-3">
                            {{ $post->description }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        {{ __("No posts found. Start by creating one!") }}
                    </div>
                </div>
            @endforelse

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
