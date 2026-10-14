@extends('admin.includes.main')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
        {{-- Header Section --}}
        <div class="content-header row mb-2">
            <div class="content-header-left col-md-8 col-12 mb-1">
                <div class="d-flex align-items-center">
                    <div class="avatar bg-gradient-primary p-2 me-2 shadow-sm rounded-3">
                        <i data-feather="search" class="font-medium-3 text-white"></i>
                    </div>
                    <div>
                        <h2 class="content-header-title mb-0" style="color: #1f2937; font-weight: 700;">Find a Rider / Driver</h2>
                        <p class="text-muted mb-0">Browse verified school drivers & rickshaw riders by locality and assign transport for your children.</p>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-4 col-12 text-md-end">
                <a href="{{ route('guardian.dashboard') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
                    <i data-feather="arrow-left" class="me-25"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="content-body">
            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show p-2 mb-2" role="alert" style="border-radius: 10px;">
                <div class="alert-body d-flex align-items-center">
                    <i data-feather="check-circle" class="me-1"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show p-2 mb-2" role="alert" style="border-radius: 10px;">
                <div class="alert-body d-flex align-items-center">
                    <i data-feather="alert-circle" class="me-1"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Children Overview Panel --}}
            @if($students->isNotEmpty())
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card" style="border: 1px solid rgba(99, 102, 241, 0.15); border-radius: 14px; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);">
                        <div class="card-header pb-1 border-bottom">
                            <h5 class="card-title mb-0 d-flex align-items-center fw-bolder">
                                <i data-feather="users" class="text-primary me-50"></i> Children's Current Transport Status
                            </h5>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row g-2">
                                @foreach($students as $student)
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="p-2 border rounded-3 bg-light d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-start mb-50">
                                                <h6 class="mb-0 fw-bold text-dark">{{ $student->name }}</h6>
                                                <span class="badge bg-light-primary text-primary" style="font-size: 0.75rem;">Roll: {{ $student->roll_number }}</span>
                                            </div>
                                            <p class="text-muted small mb-1">
                                                <i data-feather="book" style="width: 12px; height: 12px;"></i> Class: {{ $student->class ?? 'N/A' }} | 
                                                <i data-feather="home" style="width: 12px; height: 12px;"></i> {{ $student->school->name ?? 'School' }}
                                            </p>
                                            <div class="mb-1">
                                                <span class="small text-muted">Assigned Driver:</span>
                                                @if($student->driver)
                                                    <div class="fw-semibold text-success d-flex align-items-center mt-25">
                                                        <i data-feather="check" style="width: 14px; height: 14px;" class="me-25"></i>
                                                        {{ $student->driver->name }}
                                                        @if($student->driver->vehicles->isNotEmpty())
                                                            <small class="text-muted ms-1">({{ $student->driver->vehicles->first()->number_plate }})</small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="fw-semibold text-danger d-flex align-items-center mt-25">
                                                        <i data-feather="alert-circle" style="width: 14px; height: 14px;" class="me-25"></i>
                                                        No driver assigned
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" 
                                                    class="btn btn-outline-primary btn-sm w-100 quick-assign-filter-btn" 
                                                    data-student-id="{{ $student->id }}" 
                                                    data-student-name="{{ $student->name }}"
                                                    style="border-radius: 6px;">
                                                <i data-feather="refresh-cw" style="width: 13px; height: 13px;" class="me-25"></i> 
                                                {{ $student->driver ? 'Change Driver' : 'Assign Driver' }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Search & Filtering Card --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card" style="border: 1px solid rgba(99, 102, 241, 0.15); border-radius: 14px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                        <div class="card-body p-3">
                            <form id="riderSearchForm" action="{{ route('guardian.riders.search') }}" method="GET">
                                <div class="row g-2 align-items-end">
                                    {{-- Area Input with Datalist --}}
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <label for="areaInput" class="form-label fw-bold text-dark">
                                            <i data-feather="map-pin" style="width: 14px; height: 14px;" class="text-primary me-25"></i> Search Area / Locality:
                                        </label>
                                        <div class="input-group">
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="areaInput" 
                                                   name="area" 
                                                   placeholder="e.g. Johar Town, Model Town, Gulberg..." 
                                                   list="areaOptions" 
                                                   value="{{ request('area') }}" 
                                                   autocomplete="off" 
                                                   style="border-radius: 8px 0 0 8px;">
                                            <datalist id="areaOptions">
                                                @foreach($distinctAreas as $area)
                                                    <option value="{{ $area }}">
                                                @endforeach
                                            </datalist>
                                            <button class="btn btn-outline-secondary" type="button" id="clearAreaBtn" title="Clear Area" style="border-radius: 0 8px 8px 0;">
                                                <i data-feather="x" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- City Filter --}}
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="citySelect" class="form-label fw-bold text-dark">
                                            <i data-feather="navigation" style="width: 14px; height: 14px;" class="text-primary me-25"></i> City:
                                        </label>
                                        <select class="form-select" id="citySelect" name="city" style="border-radius: 8px;">
                                            <option value="">All Cities</option>
                                            @foreach($distinctCities as $city)
                                                <option value="{{ $city }}" {{ request('city', 'Lahore') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Vehicle Type Filter --}}
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="vehicleTypeSelect" class="form-label fw-bold text-dark">
                                            <i data-feather="truck" style="width: 14px; height: 14px;" class="text-primary me-25"></i> Vehicle Type:
                                        </label>
                                        <select class="form-select" id="vehicleTypeSelect" name="vehicle_type" style="border-radius: 8px;">
                                            <option value="all" {{ request('vehicle_type') == 'all' ? 'selected' : '' }}>All Vehicle Types</option>
                                            <option value="van" {{ request('vehicle_type') == 'van' ? 'selected' : '' }}>School Van</option>
                                            <option value="rickshaw" {{ request('vehicle_type') == 'rickshaw' ? 'selected' : '' }}>Rickshaw</option>
                                            <option value="bus" {{ request('vehicle_type') == 'bus' ? 'selected' : '' }}>School Bus</option>
                                            <option value="car" {{ request('vehicle_type') == 'car' ? 'selected' : '' }}>Car / Coaster</option>
                                        </select>
                                    </div>

                                    {{-- Submit & Reset Buttons --}}
                                    <div class="col-lg-2 col-md-6 col-12 d-flex gap-1">
                                        <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" id="searchSubmitBtn" style="border-radius: 8px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                                            <i data-feather="search" style="width: 15px; height: 15px;" class="me-50"></i>
                                            <span>Search</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" id="resetFiltersBtn" title="Reset Filters" style="border-radius: 8px;">
                                            <i data-feather="rotate-ccw" style="width: 15px; height: 15px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            {{-- Popular Area Quick Tags --}}
                            @if($distinctAreas->isNotEmpty())
                            <div class="mt-2 pt-1 border-top d-flex align-items-center flex-wrap gap-1">
                                <span class="text-muted small fw-semibold">Popular Areas:</span>
                                @foreach($distinctAreas->take(6) as $areaTag)
                                <button type="button" class="badge badge-light-primary border-0 p-50 quick-area-tag" data-area="{{ $areaTag }}" style="cursor: pointer; transition: all 0.2s ease;">
                                    <i data-feather="map-pin" style="width: 11px; height: 11px;" class="me-25"></i> {{ $areaTag }}
                                </button>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Results Summary Header --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-2">
                    <h4 class="mb-0 fw-bold" style="color: #1f2937;">Available Riders & Drivers</h4>
                    <span class="badge bg-primary rounded-pill px-2 py-50" id="resultsCountBadge">{{ $drivers->count() }} Available</span>
                </div>
                <div id="searchingSpinner" class="d-none text-primary align-items-center small">
                    <span class="spinner-border spinner-border-sm me-50" role="status" aria-hidden="true"></span>
                    <span>Updating drivers...</span>
                </div>
            </div>

            {{-- Driver Cards Grid --}}
            <div class="row g-2" id="driversGrid">
                @forelse($drivers as $driver)
                @php
                    $primaryVehicle = $driver->vehicles->first();
                    $isActiveRider = $driver->vehicles()->whereHas('activeTrips')->exists();
                    $vehicleType = strtolower($primaryVehicle->type ?? 'van');
                    $badgeClass = match($vehicleType) {
                        'rickshaw' => 'bg-light-warning text-warning',
                        'bus' => 'bg-light-info text-info',
                        'car' => 'bg-light-success text-success',
                        default => 'bg-light-primary text-primary',
                    };
                @endphp
                <div class="col-xl-4 col-md-6 col-12 driver-card-item">
                    <div class="card h-100 rider-card" style="border: 1px solid rgba(99, 102, 241, 0.15); border-radius: 14px; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                            <div>
                                {{-- Driver Top: Avatar, Name & Status --}}
                                <div class="d-flex align-items-center mb-2">
                                    <div class="position-relative me-2">
                                        <img src="{{ $driver->avatar_url }}" 
                                             alt="{{ $driver->name }}" 
                                             class="rounded-circle shadow-sm" 
                                             width="58" 
                                             height="58" 
                                             style="object-fit: cover; border: 2px solid #6366f1;">
                                        <span class="position-absolute bottom-0 end-0 p-1 {{ !$isActiveRider ? 'bg-success' : 'bg-warning' }} border border-white rounded-circle" title="{{ !$isActiveRider ? 'Available' : 'Currently on a trip' }}"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0 fw-bold text-dark text-truncate" title="{{ $driver->name }}">{{ $driver->name }}</h5>
                                            <span class="badge {{ $badgeClass }} text-uppercase" style="font-size: 0.7rem;">
                                                {{ $primaryVehicle->type ?? 'Van' }}
                                            </span>
                                        </div>
                                        <div class="text-muted small text-truncate mt-25">
                                            <i data-feather="phone" style="width: 12px; height: 12px;" class="me-25"></i>
                                            <a href="tel:{{ $driver->phone }}" class="text-muted">{{ $driver->phone ?? 'Contact on request' }}</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Vehicle Details Box --}}
                                <div class="p-2 mb-2 rounded-3" style="background-color: #f8fafc; border: 1px solid rgba(0,0,0,0.05);">
                                    <div class="row g-1 text-center">
                                        <div class="col-4 border-end">
                                            <small class="text-muted d-block">Plate #</small>
                                            <strong class="text-dark small text-truncate d-block">{{ $primaryVehicle->number_plate ?? 'Assigned' }}</strong>
                                        </div>
                                        <div class="col-4 border-end">
                                            <small class="text-muted d-block">Capacity</small>
                                            <strong class="text-dark small">{{ $primaryVehicle->capacity ?? 10 }} Seats</strong>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Model</small>
                                            <strong class="text-dark small text-truncate d-block">{{ $primaryVehicle->model ?? 'Standard' }}</strong>
                                        </div>
                                    </div>
                                </div>

                                {{-- Coverage Areas --}}
                                <div class="mb-2">
                                    <div class="text-muted small fw-semibold mb-50">
                                        <i data-feather="map-pin" style="width: 12px; height: 12px;" class="text-primary me-25"></i> Service Zones:
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($driver->serviceAreas as $area)
                                        <span class="badge bg-light text-secondary border px-1 py-50" style="font-size: 0.75rem;">
                                            {{ $area->area_name }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Card Footer Action --}}
                            <div class="pt-2 border-top">
                                <button type="button" 
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center open-assign-modal-btn" 
                                        data-driver-id="{{ $driver->id }}" 
                                        data-driver-name="{{ $driver->name }}" 
                                        data-driver-phone="{{ $driver->phone }}" 
                                        data-driver-avatar="{{ $driver->avatar_url }}" 
                                        data-driver-vehicle="{{ $primaryVehicle->type ?? 'Vehicle' }} ({{ $primaryVehicle->number_plate ?? 'N/A' }})"
                                        data-driver-capacity="{{ $primaryVehicle->capacity ?? 10 }}"
                                        style="border-radius: 8px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                                    <i data-feather="user-plus" style="width: 16px; height: 16px;" class="me-50"></i>
                                    <span>Select & Assign to Child</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12" id="noDriversCard">
                    <div class="card text-center p-4" style="border: 2px dashed rgba(99, 102, 241, 0.2); border-radius: 14px;">
                        <div class="card-body">
                            <div class="avatar bg-light-warning p-2 mb-2 mx-auto" style="width: 60px; height: 60px;">
                                <i data-feather="alert-triangle" class="font-medium-5 text-warning"></i>
                            </div>
                            <h4 class="fw-bold">No Riders Found in this Area</h4>
                            <p class="text-muted mb-2">There are currently no active drivers or rickshaw riders registered for the specified filters.</p>
                            <button type="button" class="btn btn-outline-primary" id="clearAllFiltersBtn">
                                <i data-feather="rotate-ccw" class="me-25"></i> Clear Search Filters
                            </button>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal: Assign Driver to Student --}}
<div class="modal fade" id="assignRiderModal" tabindex="-1" aria-labelledby="assignRiderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid rgba(99, 102, 241, 0.2); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden;">
            <form id="assignDriverForm" action="{{ route('guardian.riders.assign') }}" method="POST">
                @csrf
                <input type="hidden" name="driver_id" id="modalDriverId">

                {{-- Modal Header --}}
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%); border-bottom: 1px solid rgba(99, 102, 241, 0.15); padding: 1.25rem 1.5rem;">
                    <h5 class="modal-title d-flex align-items-center fw-bolder" id="assignRiderModalLabel" style="color: #1f2937;">
                        <span class="avatar-icon-badge me-2 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 8px; color: #fff;">
                            <i data-feather="user-check" style="width: 18px; height: 18px;"></i>
                        </span>
                        Assign Rider to Child
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body p-3">
                    {{-- Selected Driver Highlight Card --}}
                    <div class="p-2 mb-3 rounded-3 d-flex align-items-center" style="background: #f8fafc; border: 1px solid rgba(99, 102, 241, 0.15);">
                        <img id="modalDriverAvatar" src="" alt="Driver" class="rounded-circle me-2 shadow-sm" width="54" height="54" style="object-fit: cover; border: 2px solid #6366f1;">
                        <div class="overflow-hidden">
                            <h6 class="mb-0 fw-bold text-dark text-truncate" id="modalDriverName">Driver Name</h6>
                            <small class="text-muted d-block" id="modalDriverVehicle">Vehicle Type</small>
                            <small class="text-primary fw-semibold" id="modalDriverContact">Phone</small>
                        </div>
                    </div>

                    {{-- Student Selection Dropdown --}}
                    <div class="mb-3">
                        <label for="modalStudentSelect" class="form-label fw-bold text-dark">
                            Select Student / Child <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="modalStudentSelect" name="student_id" required style="border-radius: 8px; padding: 0.65rem 1rem;">
                            <option value="">-- Choose which child this rider will transport --</option>
                            @foreach($students as $st)
                            <option value="{{ $st->id }}">
                                {{ $st->name }} (Roll #{{ $st->roll_number }}) 
                                @if($st->driver) - Currently with: {{ $st->driver->name }} @else - (Unassigned) @endif
                            </option>
                            @endforeach
                        </select>
                        <div class="form-text small text-muted">
                            Assigning this rider will re-link future pickup trips to this driver and vehicle.
                        </div>
                    </div>

                    {{-- Notes Input --}}
                    <div class="mb-2">
                        <label for="modalNotes" class="form-label fw-bold text-dark">
                            Special Instructions / Pickup Landmark (Optional):
                        </label>
                        <textarea class="form-control" 
                                  id="modalNotes" 
                                  name="notes" 
                                  rows="2" 
                                  placeholder="e.g. Near Main Gate, pickup at 7:30 AM..." 
                                  style="border-radius: 8px;"></textarea>
                    </div>

                    <div id="modalErrorAlert" class="alert alert-danger d-none py-2 px-3 small" role="alert"></div>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer d-flex justify-content-end gap-2" style="background: #f8fafc; border-top: 1px solid rgba(0,0,0,0.05); padding: 1rem 1.5rem;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center" id="confirmAssignBtn" style="border-radius: 8px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                        <i data-feather="check" style="width: 15px; height: 15px;" class="me-50"></i>
                        <span id="confirmAssignBtnText">Confirm Assignment</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
/**
 * Guardian Rider Search & Assignment Interface
 */
$(document).ready(function() {
    const searchForm = $('#riderSearchForm');
    const areaInput = $('#areaInput');
    const citySelect = $('#citySelect');
    const vehicleTypeSelect = $('#vehicleTypeSelect');
    const driversGrid = $('#driversGrid');
    const resultsCountBadge = $('#resultsCountBadge');
    const searchingSpinner = $('#searchingSpinner');
    const assignModalEl = document.getElementById('assignRiderModal');
    let assignModal = null;

    if (assignModalEl && typeof bootstrap !== 'undefined') {
        assignModal = bootstrap.Modal.getOrCreateInstance(assignModalEl);
    }

    // Quick tag clicks
    $('.quick-area-tag').on('click', function() {
        const area = $(this).data('area');
        areaInput.val(area);
        triggerAjaxSearch();
    });

    // Clear area button
    $('#clearAreaBtn').on('click', function() {
        areaInput.val('');
        triggerAjaxSearch();
    });

    // Reset filters button
    $('#resetFiltersBtn, #clearAllFiltersBtn').on('click', function() {
        areaInput.val('');
        citySelect.val('');
        vehicleTypeSelect.val('all');
        triggerAjaxSearch();
    });

    // Quick assign filter button for each child
    $('.quick-assign-filter-btn').on('click', function() {
        const studentId = $(this).data('student-id');
        $('#modalStudentSelect').val(studentId);
        // Scroll down to drivers list smoothly
        $('html, body').animate({
            scrollTop: $('#driversGrid').offset().top - 120
        }, 300);
        if (typeof toastr !== 'undefined') {
            toastr.info('Select an available driver below to assign to ' + $(this).data('student-name'), 'Select Rider');
        }
    });

    // Trigger search on select changes
    citySelect.on('change', triggerAjaxSearch);
    vehicleTypeSelect.on('change', triggerAjaxSearch);

    // Debounced search on area input typing
    let typingTimer;
    areaInput.on('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(triggerAjaxSearch, 350);
    });

    // Form submit prevention (uses AJAX)
    searchForm.on('submit', function(e) {
        e.preventDefault();
        triggerAjaxSearch();
    });

    function triggerAjaxSearch() {
        const params = {
            area: areaInput.val(),
            city: citySelect.val(),
            vehicle_type: vehicleTypeSelect.val(),
        };

        searchingSpinner.removeClass('d-none').addClass('d-flex');

        $.ajax({
            url: "{{ route('guardian.riders.search') }}",
            type: 'GET',
            data: params,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                searchingSpinner.removeClass('d-flex').addClass('d-none');
                if (response.success && response.data) {
                    renderDriverCards(response.data);
                    resultsCountBadge.text(response.count + ' Available');
                }
            },
            error: function(xhr) {
                searchingSpinner.removeClass('d-flex').addClass('d-none');
                console.error('Failed to search riders:', xhr);
            }
        });
    }

    function renderDriverCards(drivers) {
        if (drivers.length === 0) {
            driversGrid.html(`
                <div class="col-12" id="noDriversCard">
                    <div class="card text-center p-4" style="border: 2px dashed rgba(99, 102, 241, 0.2); border-radius: 14px;">
                        <div class="card-body">
                            <div class="avatar bg-light-warning p-2 mb-2 mx-auto" style="width: 60px; height: 60px;">
                                <i data-feather="alert-triangle" class="font-medium-5 text-warning"></i>
                            </div>
                            <h4 class="fw-bold">No Riders Found in this Area</h4>
                            <p class="text-muted mb-2">There are currently no active drivers or rickshaw riders registered for the specified filters.</p>
                            <button type="button" class="btn btn-outline-primary" id="clearAllFiltersBtnDynamic">
                                <i data-feather="rotate-ccw" class="me-25"></i> Clear Search Filters
                            </button>
                        </div>
                    </div>
                </div>
            `);
            $('#clearAllFiltersBtnDynamic').on('click', function() {
                areaInput.val('');
                citySelect.val('');
                vehicleTypeSelect.val('all');
                triggerAjaxSearch();
            });
            if (typeof feather !== 'undefined') feather.replace();
            return;
        }

        let html = '';
        drivers.forEach(function(driver) {
            const v = driver.vehicle || {};
            const vType = (v.type || 'Van').toLowerCase();
            let badgeClass = 'bg-light-primary text-primary';
            if (vType === 'rickshaw') badgeClass = 'bg-light-warning text-warning';
            else if (vType === 'bus') badgeClass = 'bg-light-info text-info';
            else if (vType === 'car') badgeClass = 'bg-light-success text-success';

            const areasHtml = driver.service_areas.map(function(area) {
                return `<span class="badge bg-light text-secondary border px-1 py-50" style="font-size: 0.75rem;">${area}</span>`;
            }).join(' ');

            html += `
                <div class="col-xl-4 col-md-6 col-12 driver-card-item">
                    <div class="card h-100 rider-card" style="border: 1px solid rgba(99, 102, 241, 0.15); border-radius: 14px; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);">
                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="position-relative me-2">
                                        <img src="${driver.avatar_url}" 
                                             alt="${driver.name}" 
                                             class="rounded-circle shadow-sm" 
                                             width="58" 
                                             height="58" 
                                             style="object-fit: cover; border: 2px solid #6366f1;">
                                        <span class="position-absolute bottom-0 end-0 p-1 ${driver.is_available ? 'bg-success' : 'bg-warning'} border border-white rounded-circle"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0 fw-bold text-dark text-truncate" title="${driver.name}">${driver.name}</h5>
                                            <span class="badge ${badgeClass} text-uppercase" style="font-size: 0.7rem;">
                                                ${v.type || 'Van'}
                                            </span>
                                        </div>
                                        <div class="text-muted small text-truncate mt-25">
                                            <i data-feather="phone" style="width: 12px; height: 12px;" class="me-25"></i>
                                            <a href="tel:${driver.phone}" class="text-muted">${driver.phone}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2 mb-2 rounded-3" style="background-color: #f8fafc; border: 1px solid rgba(0,0,0,0.05);">
                                    <div class="row g-1 text-center">
                                        <div class="col-4 border-end">
                                            <small class="text-muted d-block">Plate #</small>
                                            <strong class="text-dark small text-truncate d-block">${v.number_plate || 'Assigned'}</strong>
                                        </div>
                                        <div class="col-4 border-end">
                                            <small class="text-muted d-block">Capacity</small>
                                            <strong class="text-dark small">${v.capacity || 10} Seats</strong>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Model</small>
                                            <strong class="text-dark small text-truncate d-block">${v.model || 'Standard'}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="text-muted small fw-semibold mb-50">
                                        <i data-feather="map-pin" style="width: 12px; height: 12px;" class="text-primary me-25"></i> Service Zones:
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                        ${areasHtml}
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 border-top">
                                <button type="button" 
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center open-assign-modal-btn" 
                                        data-driver-id="${driver.id}" 
                                        data-driver-name="${driver.name}" 
                                        data-driver-phone="${driver.phone}" 
                                        data-driver-avatar="${driver.avatar_url}" 
                                        data-driver-vehicle="${v.type || 'Vehicle'} (${v.number_plate || 'N/A'})"
                                        data-driver-capacity="${v.capacity || 10}"
                                        style="border-radius: 8px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                                    <i data-feather="user-plus" style="width: 16px; height: 16px;" class="me-50"></i>
                                    <span>Select & Assign to Child</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        driversGrid.html(html);
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    // Open Assign Modal Handler (delegated)
    $(document).on('click', '.open-assign-modal-btn', function() {
        const btn = $(this);
        const driverId = btn.data('driver-id');
        const driverName = btn.data('driver-name');
        const driverPhone = btn.data('driver-phone');
        const driverAvatar = btn.data('driver-avatar');
        const driverVehicle = btn.data('driver-vehicle');

        $('#modalDriverId').val(driverId);
        $('#modalDriverName').text(driverName);
        $('#modalDriverPhone').text(driverPhone);
        $('#modalDriverContact').text(driverPhone);
        $('#modalDriverAvatar').attr('src', driverAvatar);
        $('#modalDriverVehicle').text(driverVehicle);
        $('#modalErrorAlert').addClass('d-none').text('');

        if (assignModal) {
            assignModal.show();
        } else {
            $('#assignRiderModal').modal('show');
        }

        if (typeof feather !== 'undefined') feather.replace();
    });

    // Handle Assignment Form Submission (AJAX with feedback)
    $('#assignDriverForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = $('#confirmAssignBtn');
        const btnText = $('#confirmAssignBtnText');
        const errorAlert = $('#modalErrorAlert');
        const studentId = $('#modalStudentSelect').val();

        if (!studentId) {
            errorAlert.removeClass('d-none').text('Please select a student / child first.');
            return;
        }

        submitBtn.prop('disabled', true);
        btnText.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Assigning...');
        errorAlert.addClass('d-none');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                submitBtn.prop('disabled', false);
                btnText.text('Confirm Assignment');

                if (response.success) {
                    if (assignModal) {
                        assignModal.hide();
                    } else {
                        $('#assignRiderModal').modal('hide');
                    }

                    if (typeof toastr !== 'undefined') {
                        toastr.success(response.message, 'Rider Assigned!');
                    }

                    // Reload page after a brief moment to update transport card status
                    setTimeout(function() {
                        window.location.reload();
                    }, 1200);
                } else {
                    errorAlert.removeClass('d-none').text(response.message || 'Failed to assign rider.');
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                btnText.text('Confirm Assignment');

                let errMsg = 'An error occurred during assignment.';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                }
                errorAlert.removeClass('d-none').html(errMsg);
            }
        });
    });
});
</script>
@endsection
