<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pod;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PodController extends Controller
{

    public function create()
    {
        return view('createPod');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
        $validated['status'] = "available";
        // 'status' => 'required|boolean',
        Pod::create($validated);

        return redirect()->route('pods.create')->with('success', 'Pod created successfully!');
    }




    public function allPods()
    {
        $pods = Pod::all();
        return view('AllPods', compact('pods'));
    }

    // public function AvailablePods()
    // {
    //     $pods = Pod::all();
    //     $booking = Booking::all();
    //     return view('AvailablePods', compact('pods'));
    // }
    public function AvailablePods()
    {
        // Fetch all pods
        $pods = Pod::all();
    
        
        return view('AvailablePods', compact('pods'));
    }


    public function destroy($id)
    {
        $pod = Pod::findOrFail($id);
        $pod->delete();

        return redirect()->route('pods.index')->with('success', 'Pod deleted successfully!');
    }



    public function book()
    {
        $pods = Pod::all();
        return view('bookpods', compact('pods'));
    }

    public function bookSlot(Request $request, $id)
    {
        $pod = Pod::findOrFail($id);
        // dd($pod);

        
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->pod_id = $pod->id;
        $booking->start_time = $pod->start_time;
        $booking->end_time = $pod->end_time;
        $booking->save();

        $pod->status = "booked";
        $pod->save();

        return redirect()->route('pods.available')->with('success', 'Pod booked successfully!');
    }

    public function extendBooking(Request $request, $id)
    {
        $pod = Pod::findOrFail($id);
        // dd($pod->end_time);
        // dd($pod);

        $nextAvailablePod = Pod::where('start_time', '=', $pod->end_time)
        ->where('status', 'available')
        ->orderBy('start_time')
        ->first();

        if ($nextAvailablePod and $pod->user_id == auth()->id()) {
            $booking = new Booking();
            $booking->user_id = auth()->id();
            $booking->pod_id = $nextAvailablePod->id;
            $booking->start_time = $nextAvailablePod->start_time;
            $booking->end_time = $nextAvailablePod->end_time;
            $booking->save();

            $nextAvailablePod->status = "booked";
            $nextAvailablePod->save();


            return redirect()->route('pods.available')->with('success', 'Booking extended until the next available pod.');
        } else {
            return redirect()->route('pods.available')->with('error', 'No available pod found to extend the booking.');
        }
    }


    public function show($id)
    {
        $pod = Pod::findOrFail($id);
        $booking = Booking::where('pod_id', $pod->id)->first();
        $bookedBy = $booking ? $booking->user : null;
        return view('podShow', compact('pod', 'bookedBy'));
    }

}
