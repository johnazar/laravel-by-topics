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
                <div class="p-6">
                    <form action="{{route('posts.store')}}" method="post">
                        @csrf
                        <label for="title">{{__('Post title')}}</label>
                        <input type="text" name="title" id="post_title" value="{{old('title')}}" class="w-full">
                        <label for="files[]" class="block">{{__('Attachments')}}
                        <select multiple name="files[]" class="block">
                            @foreach (\App\Models\File::all() as $file)
                                <option value="{{$file->id}}">{{$file->uri}}</option>
                            @endforeach
                            </select>
                        <x-button class="block">{{__('Add')}}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-6">
                        <h2 class="font-bold">Published</h2>
                        <ul class="space-y-2">
                            @foreach ($published_posts as $post)
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
                    <div class="p-6">
                        <h2 class="font-bold">Not Published</h2>
                        <ul class="space-y-2">
                            @foreach ($draft_posts as $post)
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
    </div>
</x-app-layout>
