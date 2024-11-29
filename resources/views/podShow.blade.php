<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pod Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">{{ $pod->name }}</h3>
                    {{-- <p>Pod ID : {{ $pod->id }}</p> --}}
                    <p><b>Pod Description</b> : {{ $pod->description }}</p>
                    <p><b>Start Time:</b> {{ $pod->start_time}}</p>
                    <p><b>End Time:</b> {{ $pod->end_time }}</p>
                    <p><b>Status:</b> {{ $pod->status == 'available' ? 'available' : 'booked' }}</p>
                    <p><b>Booked By: </b>{{ $bookedBy->name }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
