<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <b>{{ auth()->user()->name }} </b>{{ __("You're logged in!") }}
                </div>
                Slotes Details:
                <ul>
                    @if (auth()->user()->isAdmin())
                    <li><a href="{{ route('pods.add') }}" class="text-blue-500 underline">Add Pods</a></li>
                    @endif
                    @if (auth()->user()->isUser())
                    <li><a href="{{ route('pods.available') }}" class="text-blue-500 underline">Book Pods</a></li>
                    @endif
                    <li><a href="{{ route('pods.index') }}" class="text-blue-500 underline">All Slots with Status</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
