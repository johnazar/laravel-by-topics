<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
        <a href="{{route('posts.create')}}">
        <x-button>
            {{__('Create')}}
        </x-button>
        </a>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="space-y-2">
                        @foreach ($posts as $post)
                        <li>
                            <a href="{{route('posts.edit',$post->id)}}">
                                {{$post->title}} 
                            </a>
                            <form action="{{route('posts.destroy',$post->id)}}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <button>
                                    ❌
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>