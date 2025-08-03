<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OtherStructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $structureId = $this->route('other_structure') ? $this->route('other_structure')->id : null;

        return [
            // Basic Information
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                'min:3',
                'regex:/^[A-Z0-9]+$/',
                Rule::unique('other_structures', 'code')->ignore($structureId),
            ],
            'type' => [
                'required',
                'string',
                Rule::in([
                    'hospital',
                    'clinic',
                    'medical_center',
                    'laboratory',
                    'pharmacy',
                    'radiology_center',
                    'emergency_center',
                    'rehabilitation_center',
                    'nursing_home',
                    'other'
                ]),
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            // Address Information
            'address' => [
                'required',
                'string',
                'max:500',
                'min:5',
            ],
            'city' => [
                'required',
                'string',
                'max:100',
                'min:2',
            ],
            'state' => [
                'nullable',
                'string',
                'max:100',
            ],
            'postal_code' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[A-Z0-9\s\-]+$/i',
            ],
            'country' => [
                'required',
                'string',
                'max:100',
                'min:2',
            ],

            // Contact Information
            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\s\-\(\)]+$/',
            ],
            'fax' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\s\-\(\)]+$/',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'website' => [
                'nullable',
                'url',
                'max:255',
            ],
            'contact_person' => [
                'nullable',
                'string',
                'max:255',
                'min:2',
            ],
            'contact_phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\s\-\(\)]+$/',
            ],
            'contact_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            // Legal Information
            'license_number' => [
                'nullable',
                'string',
                'max:100',
            ],
            'registration_number' => [
                'nullable',
                'string',
                'max:100',
            ],
            'tax_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            // Partnership Information
            'partnership_type' => [
                'required',
                'string',
                Rule::in(['referral', 'collaboration', 'supplier', 'emergency', 'insurance', 'other']),
            ],
            'partnership_start_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
            'partnership_end_date' => [
                'nullable',
                'date',
                'after:partnership_start_date',
            ],

            // Status
            'status' => [
                'required',
                'string',
                Rule::in(['active', 'inactive', 'suspended', 'terminated']),
            ],

            // Services and Capabilities
            'services_offered' => [
                'nullable',
                'array',
            ],
            'services_offered.*' => [
                'string',
                'max:255',
            ],
            'specialties' => [
                'nullable',
                'array',
            ],
            'specialties.*' => [
                'string',
                'max:255',
            ],
            'equipment' => [
                'nullable',
                'array',
            ],
            'equipment.*' => [
                'string',
                'max:255',
            ],

            // Rating and Additional Info
            'rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

            // Logo
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // 2MB
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            ],

            // Working Hours
            'working_hours' => [
                'nullable',
                'array',
            ],
            'working_hours.monday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.tuesday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.wednesday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.thursday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.friday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.saturday' => [
                'nullable',
                'string',
                'max:50',
            ],
            'working_hours.sunday' => [
                'nullable',
                'string',
                'max:50',
            ],

            // Boolean Fields
            'emergency_services' => [
                'boolean',
            ],
            'accepts_insurance' => [
                'boolean',
            ],

            // Insurance Companies
            'accepted_insurance_companies' => [
                'nullable',
                'array',
            ],
            'accepted_insurance_companies.*' => [
                'string',
                'max:255',
            ],

            // Coordinates
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
                'regex:/^-?\d{1,2}\.\d{1,8}$/',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
                'regex:/^-?\d{1,3}\.\d{1,8}$/',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => trans('Dashboard/other_structures_trans.structure_name'),
            'code' => trans('Dashboard/other_structures_trans.structure_code'),
            'type' => trans('Dashboard/other_structures_trans.structure_type'),
            'description' => trans('Dashboard/other_structures_trans.description'),
            'address' => trans('Dashboard/other_structures_trans.address'),
            'city' => trans('Dashboard/other_structures_trans.city'),
            'state' => trans('Dashboard/other_structures_trans.state'),
            'postal_code' => trans('Dashboard/other_structures_trans.postal_code'),
            'country' => trans('Dashboard/other_structures_trans.country'),
            'phone' => trans('Dashboard/other_structures_trans.phone'),
            'fax' => trans('Dashboard/other_structures_trans.fax'),
            'email' => trans('Dashboard/other_structures_trans.email'),
            'website' => trans('Dashboard/other_structures_trans.website'),
            'contact_person' => trans('Dashboard/other_structures_trans.contact_person'),
            'contact_phone' => trans('Dashboard/other_structures_trans.contact_phone'),
            'contact_email' => trans('Dashboard/other_structures_trans.contact_email'),
            'license_number' => trans('Dashboard/other_structures_trans.license_number'),
            'registration_number' => trans('Dashboard/other_structures_trans.registration_number'),
            'tax_number' => trans('Dashboard/other_structures_trans.tax_number'),
            'partnership_type' => trans('Dashboard/other_structures_trans.partnership_type'),
            'partnership_start_date' => trans('Dashboard/other_structures_trans.partnership_start_date'),
            'partnership_end_date' => trans('Dashboard/other_structures_trans.partnership_end_date'),
            'status' => trans('Dashboard/other_structures_trans.status'),
            'services_offered' => trans('Dashboard/other_structures_trans.services_offered'),
            'specialties' => trans('Dashboard/other_structures_trans.specialties'),
            'equipment' => trans('Dashboard/other_structures_trans.equipment'),
            'rating' => trans('Dashboard/other_structures_trans.rating'),
            'notes' => trans('Dashboard/other_structures_trans.notes'),
            'logo' => trans('Dashboard/other_structures_trans.logo'),
            'working_hours' => trans('Dashboard/other_structures_trans.working_hours'),
            'emergency_services' => trans('Dashboard/other_structures_trans.emergency_services'),
            'accepts_insurance' => trans('Dashboard/other_structures_trans.accepts_insurance'),
            'accepted_insurance_companies' => trans('Dashboard/other_structures_trans.accepted_insurance_companies'),
            'latitude' => trans('Dashboard/other_structures_trans.latitude'),
            'longitude' => trans('Dashboard/other_structures_trans.longitude'),
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('Dashboard/other_structures_trans.name_required'),
            'code.required' => trans('Dashboard/other_structures_trans.code_required'),
            'code.unique' => trans('Dashboard/other_structures_trans.code_unique'),
            'type.required' => trans('Dashboard/other_structures_trans.type_required'),
            'address.required' => trans('Dashboard/other_structures_trans.address_required'),
            'city.required' => trans('Dashboard/other_structures_trans.city_required'),
            'email.email' => trans('Dashboard/other_structures_trans.email_invalid'),
            'website.url' => trans('Dashboard/other_structures_trans.website_invalid'),
            'rating.between' => trans('Dashboard/other_structures_trans.rating_invalid'),
            'latitude.between' => trans('Dashboard/other_structures_trans.coordinates_invalid'),
            'longitude.between' => trans('Dashboard/other_structures_trans.coordinates_invalid'),
            'code.regex' => 'The code must contain only uppercase letters and numbers.',
            'phone.regex' => 'The phone number format is invalid.',
            'contact_phone.regex' => 'The contact phone number format is invalid.',
            'fax.regex' => 'The fax number format is invalid.',
            'postal_code.regex' => 'The postal code format is invalid.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'logo.dimensions' => 'The logo dimensions must be between 100x100 and 2000x2000 pixels.',
            'partnership_end_date.after' => 'The partnership end date must be after the start date.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Convert boolean fields
        $this->merge([
            'emergency_services' => $this->boolean('emergency_services'),
            'accepts_insurance' => $this->boolean('accepts_insurance'),
        ]);

        // Clean and format code
        if ($this->has('code')) {
            $this->merge([
                'code' => strtoupper(trim($this->code)),
            ]);
        }

        // Clean email fields
        if ($this->has('email')) {
            $this->merge([
                'email' => strtolower(trim($this->email)),
            ]);
        }

        if ($this->has('contact_email')) {
            $this->merge([
                'contact_email' => strtolower(trim($this->contact_email)),
            ]);
        }
    }
};
