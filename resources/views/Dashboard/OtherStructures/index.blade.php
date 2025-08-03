@extends('Dashboard.layouts.master')

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main-sidebar_trans.other_structures') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/other_structures_trans.structure_list') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('other-structures.create') }}" class="btn btn-primary btn-icon ml-2">
                    <i class="mdi mdi-plus"></i> {{ trans('Dashboard/other_structures_trans.add_structure') }}
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
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ trans('Dashboard/other_structures_trans.structure_list') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-control select2" id="type-filter">
                                <option value="">{{ trans('Dashboard/other_structures_trans.all_types') }}</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                        {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2" id="partnership-filter">
                                <option value="">{{ trans('Dashboard/other_structures_trans.all_partnerships') }}</option>
                                @foreach($partnershipTypes as $key => $value)
                                    <option value="{{ $key }}" {{ request('partnership_type') == $key ? 'selected' : '' }}>
                                        {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2" id="status-filter">
                                <option value="">{{ trans('Dashboard/other_structures_trans.all_statuses') }}</option>
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                        {{ trans('Dashboard/other_structures_trans.' . $key) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="search-input" 
                                   placeholder="{{ trans('Dashboard/other_structures_trans.search_structures') }}"
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.name') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.code') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.type') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.city') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.partnership_type') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.status') }}</th>
                                    <th class="border-bottom-0">{{ trans('Dashboard/other_structures_trans.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($otherStructures as $structure)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($structure->logo)
                                                    <img src="{{ asset('storage/' . $structure->logo) }}" 
                                                         alt="{{ $structure->name }}" 
                                                         class="avatar avatar-sm rounded-circle mr-2">
                                                @else
                                                    <div class="avatar avatar-sm rounded-circle mr-2 bg-primary-transparent">
                                                        <i class="fe fe-building"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $structure->name }}</strong>
                                                    @if($structure->contact_person)
                                                        <br><small class="text-muted">{{ $structure->contact_person }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-outline-primary">{{ $structure->code }}</span></td>
                                        <td>
                                            <span class="badge badge-outline-info">
                                                {{ trans('Dashboard/other_structures_trans.' . $structure->type) }}
                                            </span>
                                        </td>
                                        <td>{{ $structure->city }}</td>
                                        <td>
                                            <span class="badge badge-outline-secondary">
                                                {{ trans('Dashboard/other_structures_trans.' . $structure->partnership_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($structure->status == 'active')
                                                <span class="badge badge-success">{{ trans('Dashboard/other_structures_trans.active') }}</span>
                                            @elseif($structure->status == 'inactive')
                                                <span class="badge badge-warning">{{ trans('Dashboard/other_structures_trans.inactive') }}</span>
                                            @elseif($structure->status == 'suspended')
                                                <span class="badge badge-danger">{{ trans('Dashboard/other_structures_trans.suspended') }}</span>
                                            @else
                                                <span class="badge badge-dark">{{ trans('Dashboard/other_structures_trans.terminated') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                        type="button">{{ trans('Dashboard/other_structures_trans.Processes') }}<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" href="{{ route('other-structures.show', $structure->id) }}">
                                                        <i class="text-primary ti-eye"></i>&nbsp;&nbsp;{{ trans('Dashboard/other_structures_trans.view_structure') }}
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('other-structures.edit', $structure->id) }}">
                                                        <i class="text-success ti-user"></i>&nbsp;&nbsp;{{ trans('Dashboard/other_structures_trans.edit_structure') }}
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $structure->id }}">
                                                        <i class="text-danger ti-trash"></i>&nbsp;&nbsp;{{ trans('Dashboard/other_structures_trans.delete_structure') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('Dashboard.OtherStructures.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('Dashboard/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('Dashboard/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Filter functionality
            $('#type-filter, #partnership-filter, #status-filter').on('change', function() {
                applyFilters();
            });

            $('#search-input').on('keyup', function() {
                applyFilters();
            });

            function applyFilters() {
                var type = $('#type-filter').val();
                var partnership = $('#partnership-filter').val();
                var status = $('#status-filter').val();
                var search = $('#search-input').val();

                var url = new URL(window.location.href);
                url.searchParams.set('type', type);
                url.searchParams.set('partnership_type', partnership);
                url.searchParams.set('status', status);
                url.searchParams.set('search', search);

                window.location.href = url.toString();
            }
        });
    </script>
@endsection
