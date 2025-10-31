<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('role:landlord', ['except' => ['index', 'show']]);
    }

    /**
     * Display the property creation form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $properties = Property::with('landlord')->latest()->paginate(12);
        return view('properties.index', compact('properties'));
    }


    public function create()
    {
        return view('landlord.property.create');
    }

    /**
     * Store a newly created property.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $landlord = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'property_type' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
        
        // Add landlord ID to property data
        $validated['landlord_id'] = $landlord->id;
        
        // Create the property
        $property = Property::create($validated);
        
        return redirect()->route('landlord.properties')
            ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified property.
     *
     * @param \App\Models\Property $property
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Property $property)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to view this property.');
        }
        
        // Get active tenants for the property
        $tenants = $property->activeTenants()->get();
        
        // Get inactive tenants for the property
        $inactiveTenants = $property->tenants()
            ->wherePivot('active', false)
            ->get();
            
        // Get reviews for the property
        $reviews = $property->reviews()
            ->with(['tenant', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('landlord.property.show', compact(
            'landlord', 
            'property', 
            'tenants', 
            'inactiveTenants', 
            'reviews'
        ));
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param \App\Models\Property $property
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Property $property)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to edit this property.');
        }
        
        return view('landlord.property.edit', compact('property'));
    }

    /**
     * Update the specified property.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Property $property)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to update this property.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'property_type' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
        
        // Update the property
        $property->update($validated);
        
        return redirect()->route('landlord.properties')
            ->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified property.
     *
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Property $property)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to delete this property.');
        }
        
        // Delete the property
        $property->delete();
        
        return redirect()->route('landlord.properties')
            ->with('success', 'Property deleted successfully.');
    }
}
