<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Create')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('posts.store')}}" method="post" class="space-y-6">
                        @csrf
                        <label for="title">{{__('Post title')}}</label>
                        <input type="text" name="title" id="post_title" value="{{$post->title}}" class="w-full">
                        <x-button>{{__('Create')}}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('partials.channels.dropdown',['field'=>'my_channels']) --}}
</x-app-layout>