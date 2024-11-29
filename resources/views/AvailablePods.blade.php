<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Pods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold">Available Pods</h3>
                    <table class="min-w-full mt-4 border-collapse table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Id</th>
                                <th class="px-4 py-2 border-b">Name</th>
                                <th class="px-4 py-2 border-b">Description</th>
                                <th class="px-4 py-2 border-b">Start Time</th>
                                <th class="px-4 py-2 border-b">End Time</th>
                                <th class="px-4 py-2 border-b">Status</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pods as $pod)
                            <tr>
                                <td class="px-4 py-2 border-b"><a href="{{ route('pods.show', $pod->id) }}" class="text-red-500">{{ $pod->id }}</a></td>
                                <td class="px-4 py-2 border-b">{{ $pod->name }}</td>
                                <td class="px-4 py-2 border-b">{{ $pod->description }}</td>
                                <td class="px-4 py-2 border-b">{{ $pod->start_time}}</td>
                                <td class="px-4 py-2 border-b">{{ $pod->end_time}}</td>
                                <td class="px-4 py-2 border-b">{{ $pod->status}}</td>
                                {{-- <td class="px-4 py-2 border-b">{{ $bookedBy->name }}</td> --}}
                                <td class="px-4 py-2 border-b">
                                        @if ($pod->status == "available")
                                            <!-- Only show the book button if the pod is available -->
                                            <form action="{{ route('pods.book.slot', $pod->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-500">Book Now</button>
                                            </form>
                                        @else
                                            <form action="{{ route('pods.extend.booking', $pod->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-500">Extend Booking</button>
                                            </form>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
