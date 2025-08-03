<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OtherStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OtherStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OtherStructure::query();

        // Apply filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('partnership_type')) {
            $query->where('partnership_type', $request->partnership_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('code', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $otherStructures = $query->orderBy('name')->paginate(15);

        $types = OtherStructure::getTypes();
        $partnershipTypes = OtherStructure::getPartnershipTypes();
        $statuses = OtherStructure::getStatuses();

        return view('Dashboard.OtherStructures.index', compact(
            'otherStructures',
            'types',
            'partnershipTypes',
            'statuses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = OtherStructure::getTypes();
        $partnershipTypes = OtherStructure::getPartnershipTypes();
        $statuses = OtherStructure::getStatuses();

        return view('Dashboard.OtherStructures.create', compact(
            'types',
            'partnershipTypes',
            'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:other_structures,code',
            'type' => 'required|in:hospital,clinic,medical_center,laboratory,pharmacy,radiology_center,emergency_center,rehabilitation_center,nursing_home,other',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:100',
            'registration_number' => 'nullable|string|max:100',
            'tax_number' => 'nullable|string|max:100',
            'partnership_type' => 'required|in:referral,collaboration,supplier,emergency,insurance,other',
            'partnership_start_date' => 'nullable|date',
            'partnership_end_date' => 'nullable|date|after:partnership_start_date',
            'status' => 'required|in:active,inactive,suspended,terminated',
            'services_offered' => 'nullable|array',
            'specialties' => 'nullable|array',
            'equipment' => 'nullable|array',
            'rating' => 'nullable|numeric|min:0|max:5',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'working_hours' => 'nullable|array',
            'emergency_services' => 'boolean',
            'accepts_insurance' => 'boolean',
            'accepted_insurance_companies' => 'nullable|array',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $data = $request->except(['logo']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('other_structures/logos', 'public');
            $data['logo'] = $logoPath;
        }

        // Generate code if not provided
        if (empty($data['code'])) {
            $data['code'] = $this->generateCode($data['name'], $data['type']);
        }

        OtherStructure::create($data);

        return redirect()->route('other-structures.index')
            ->with('success', trans('Dashboard/other_structures_trans.structure_added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(OtherStructure $otherStructure)
    {
        return view('Dashboard.OtherStructures.show', compact('otherStructure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OtherStructure $otherStructure)
    {
        $types = OtherStructure::getTypes();
        $partnershipTypes = OtherStructure::getPartnershipTypes();
        $statuses = OtherStructure::getStatuses();

        return view('Dashboard.OtherStructures.edit', compact(
            'otherStructure',
            'types',
            'partnershipTypes',
            'statuses'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OtherStructure $otherStructure)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:other_structures,code,' . $otherStructure->id,
            'type' => 'required|in:hospital,clinic,medical_center,laboratory,pharmacy,radiology_center,emergency_center,rehabilitation_center,nursing_home,other',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:100',
            'registration_number' => 'nullable|string|max:100',
            'tax_number' => 'nullable|string|max:100',
            'partnership_type' => 'required|in:referral,collaboration,supplier,emergency,insurance,other',
            'partnership_start_date' => 'nullable|date',
            'partnership_end_date' => 'nullable|date|after:partnership_start_date',
            'status' => 'required|in:active,inactive,suspended,terminated',
            'services_offered' => 'nullable|array',
            'specialties' => 'nullable|array',
            'equipment' => 'nullable|array',
            'rating' => 'nullable|numeric|min:0|max:5',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'working_hours' => 'nullable|array',
            'emergency_services' => 'boolean',
            'accepts_insurance' => 'boolean',
            'accepted_insurance_companies' => 'nullable|array',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $data = $request->except(['logo']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($otherStructure->logo) {
                Storage::disk('public')->delete($otherStructure->logo);
            }
            
            $logoPath = $request->file('logo')->store('other_structures/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $otherStructure->update($data);

        return redirect()->route('other-structures.index')
            ->with('success', trans('Dashboard/other_structures_trans.structure_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OtherStructure $otherStructure)
    {
        // Delete logo file
        if ($otherStructure->logo) {
            Storage::disk('public')->delete($otherStructure->logo);
        }

        $otherStructure->delete();

        return redirect()->route('other-structures.index')
            ->with('success', trans('Dashboard/other_structures_trans.structure_deleted_successfully'));
    }

    /**
     * Generate a unique code for the structure
     */
    private function generateCode($name, $type)
    {
        $prefix = strtoupper(substr($type, 0, 3));
        $nameCode = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 3));
        $baseCode = $prefix . $nameCode;
        
        $counter = 1;
        $code = $baseCode . sprintf('%03d', $counter);
        
        while (OtherStructure::where('code', $code)->exists()) {
            $counter++;
            $code = $baseCode . sprintf('%03d', $counter);
        }
        
        return $code;
    }

    /**
     * Get structures by type (AJAX)
     */
    public function getByType(Request $request)
    {
        $type = $request->get('type');
        $structures = OtherStructure::active()
            ->where('type', $type)
            ->select('id', 'name', 'code', 'city')
            ->orderBy('name')
            ->get();

        return response()->json($structures);
    }

    /**
     * Get nearby structures (AJAX)
     */
    public function getNearby(Request $request)
    {
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');
        $radius = $request->get('radius', 50); // Default 50km

        $structures = OtherStructure::active()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->filter(function ($structure) use ($latitude, $longitude, $radius) {
                $distance = $structure->getDistance($latitude, $longitude);
                return $distance !== null && $distance <= $radius;
            })
            ->map(function ($structure) use ($latitude, $longitude) {
                $structure->distance = $structure->getDistance($latitude, $longitude);
                return $structure;
            })
            ->sortBy('distance')
            ->values();

        return response()->json($structures);
    }
};
