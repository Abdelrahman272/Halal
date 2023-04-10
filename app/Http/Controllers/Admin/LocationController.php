<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::with('user')->paginate();

        return view('admin.locations.index', compact('locations'));
    }



    public function show($id)
    {
        $locations = Location::findOrFail($id);
        $locationsString = '';
        foreach ($locations as $location) {
            $locationsString .= '&markers=color:red%7C'.$location->latitude.','.$location->longitude;
        }
        return view('admin.locations.show', compact('locationsString'));
    }


    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully');
    }
}
