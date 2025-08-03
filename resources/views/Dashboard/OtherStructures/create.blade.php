@extends('Dashboard.layouts.master')

@section('css')
    <!--Internal  Nice-select css  -->
    <link href="{{ URL::asset('Dashboard/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal Fileupload css-->
    <link href="{{ URL::asset('Dashboard/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!--Internal Fancy uploader css-->
    <link href="{{ URL::asset('Dashboard/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main-sidebar_trans.other_structures') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/other_structures_trans.add_structure') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('other-structures.index') }}" class="btn btn-secondary btn-icon ml-2">
                    <i class="mdi mdi-arrow-left"></i> {{ trans('Dashboard/other_structures_trans.back') }}
                </a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @include('Dashboard.messages_alert')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('other-structures.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title">{{ trans('Dashboard/other_structures_trans.add_structure') }}</h5>
                                <hr>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ trans('Dashboard/other_structures_trans.structure_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">{{ trans('Dashboard/other_structures_trans.structure_code') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" 
                                           value="{{ old('code') }}" required>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">{{ trans('Dashboard/other_structures_trans.structure_type') }} <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control select2 @error('type') is-invalid @enderror" required>
                                        <option value="">{{ trans('Dashboard/other_structures_trans.select_option') }}</option>
                                        @foreach($types as $key => $value)
                                            <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                                {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="partnership_type">{{ trans('Dashboard/other_structures_trans.partnership_type') }} <span class="text-danger">*</span></label>
                                    <select name="partnership_type" id="partnership_type" class="form-control select2 @error('partnership_type') is-invalid @enderror" required>
                                        <option value="">{{ trans('Dashboard/other_structures_trans.select_option') }}</option>
                                        @foreach($partnershipTypes as $key => $value)
                                            <option value="{{ $key }}" {{ old('partnership_type') == $key ? 'selected' : '' }}>
                                                {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('partnership_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ trans('Dashboard/other_structures_trans.description') }}</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                              rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="card-title">{{ trans('Dashboard/other_structures_trans.address') }}</h6>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">{{ trans('Dashboard/other_structures_trans.address') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                           value="{{ old('address') }}" required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ trans('Dashboard/other_structures_trans.city') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" 
                                           value="{{ old('city') }}" required>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ trans('Dashboard/other_structures_trans.state') }}</label>
                                    <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" 
                                           value="{{ old('state') }}">
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postal_code">{{ trans('Dashboard/other_structures_trans.postal_code') }}</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" 
                                           value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">{{ trans('Dashboard/other_structures_trans.country') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" 
                                           value="{{ old('country', 'Morocco') }}" required>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ trans('Dashboard/other_structures_trans.status') }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control select2 @error('status') is-invalid @enderror" required>
                                        @foreach($statuses as $key => $value)
                                            <option value="{{ $key }}" {{ old('status', 'active') == $key ? 'selected' : '' }}>
                                                {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="card-title">{{ trans('Dashboard/other_structures_trans.contact_information') }}</h6>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ trans('Dashboard/other_structures_trans.phone') }}</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ trans('Dashboard/other_structures_trans.email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">{{ trans('Dashboard/other_structures_trans.website') }}</label>
                                    <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" 
                                           value="{{ old('website') }}">
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_person">{{ trans('Dashboard/other_structures_trans.contact_person') }}</label>
                                    <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" 
                                           value="{{ old('contact_person') }}">
                                    @error('contact_person')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="logo">{{ trans('Dashboard/other_structures_trans.logo') }}</label>
                                    <input type="file" name="logo" id="logo" class="dropify @error('logo') is-invalid @enderror" 
                                           data-default-file="" accept="image/*" />
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('Dashboard/other_structures_trans.save') }}
                                    </button>
                                    <a href="{{ route('other-structures.index') }}" class="btn btn-secondary">
                                        {{ trans('Dashboard/other_structures_trans.cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('Dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('Dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('Dashboard/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{ URL::asset('Dashboard/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/telephoneinput/inttelephoneinput.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
            
            // Auto-generate code based on name and type
            $('#name, #type').on('change', function() {
                if ($('#name').val() && $('#type').val()) {
                    var name = $('#name').val().replace(/[^A-Za-z0-9]/g, '').substring(0, 3).toUpperCase();
                    var type = $('#type').val().substring(0, 3).toUpperCase();
                    var code = type + name + '001';
                    $('#code').val(code);
                }
            });
        });
    </script>
@endsection
