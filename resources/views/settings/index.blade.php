<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        @forelse($notifications as $notification)
        <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
            [{{ $notification->created_at->format("d.m.Y H:m") }}] {{ $notification->data['id'] }}. ID: {{ $notification->data['title'] }}.
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                ✖
            </a>
        </div>
        @if($loop->last)
            <a href="#" id="mark-all" class="float-right">
                Mark all as read
            </a>
        @endif
        @empty
            There are no new notifications
        @endforelse
        </div>
    </div>

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

    @prepend('notification')
    <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('markNotification') }}", {
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    id
                }
            });
        }
        $(function() {
            $('.mark-as-read').click(function() {
                console.log($(this).data('id'));
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });
            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                })
            });
        });
        </script>
        
    @endprepend
    @stack('notification')
</x-app-layout>
