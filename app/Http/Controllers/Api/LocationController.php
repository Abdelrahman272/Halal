<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $locations = Location::get()->where('user_id', Auth::id());

        return $this->apiResponse($locations, 'Location retrieved successfully', 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'name' => 'required|string',
            'user_id' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'user_id' => $user,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return $this->apiResponse($location, 'Location stored successfully', 200);
    }

    public function update(Request $request, Location $location)
    {
        $user = Auth::user()->id;

        $location = Location::findOrFail($location->id);

        $request->validate([
            'name' => 'required|string',
            'user_id' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location->update([
            'name' => $request->name,
            'user_id' => $user,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return $this->apiResponse($location, 'Location updated successfully', 200);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return $this->apiResponse($location, 'Location deleted successfully', 200);
    }
}
