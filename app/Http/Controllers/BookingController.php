<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pod_id' => 'required|exists:pods,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $pod = Pod::find($request->pod_id);

        if ($pod->status !== 'available') {
            return response()->json(['error' => 'Pod is not available'], 422);
        }

        $overlap = Booking::where('pod_id', $pod->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($overlap) {
            return response()->json(['error' => 'Time slot overlaps with another booking'], 422);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'pod_id' => $pod->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $pod->update(['status' => 'booked']);

        return response()->json(['message' => 'Booking successful', 'booking' => $booking]);
    }

    // public function extend(Request $request, Booking $booking)
    // {
    //     $request->validate([
    //         'end_time' => 'required|date|after:booking.end_time',
    //     ]);

    //     $overlap = Booking::where('pod_id', $booking->pod_id)
    //         ->where('id', '!=', $booking->id)
    //         ->where(function ($query) use ($request) {
    //             $query->whereBetween('start_time', [$booking->start_time, $request->end_time])
    //                 ->orWhereBetween('end_time', [$booking->start_time, $request->end_time]);
    //         })->exists();

    //     if ($overlap) {
    //         return response()->json(['error' => 'Extended slot overlaps with another booking'], 422);
    //     }

    //     $booking->update(['end_time' => $request->end_time]);

    //     return response()->json(['message' => 'Booking extended successfully', 'booking' => $booking]);
    // }
}
