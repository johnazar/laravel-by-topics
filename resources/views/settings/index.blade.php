<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="">
                        <x-button>Users</x-button>
                    </a>
                    <a href="{{route('posts.index')}}">
                        <x-button>Posts</x-button>
                    </a>
                    <a href="{{route('files.index')}}">
                        <x-button>Files</x-button>
                    </a>
                    <a href="">
                        <x-button>Tags</x-button>
                    </a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        Macros demo: <br>
                        input: asdas <br>
                        output: {{\Illuminate\Support\Str::partNumber('asdas')}}

                    </p>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
