@php
    $pickerTitle = $title ?? 'GPS Location';
    $pickerHelp = $help ?? 'School/place search karo, list se select karo — map pe pin auto set ho jayega. Ya manually type / map pe click bhi kar sakte ho.';
    $pickerLat = $latitude ?? old('latitude');
    $pickerLng = $longitude ?? old('longitude');
@endphp

<div class="col-12">
    <h5 class="mb-1 mt-3">{{ $pickerTitle }}</h5>
    <p class="text-muted small mb-2">{{ $pickerHelp }}</p>
</div>

<div class="col-12">
    <div class="mb-1 row">
        <div class="col-sm-3">
            <label class="col-form-label" for="gps-place-search">Search place</label>
        </div>
        <div class="col-sm-9">
            <div class="position-relative">
                <div class="input-group">
                    <span class="input-group-text"><i data-feather="search"></i></span>
                    <input
                        type="text"
                        id="gps-place-search"
                        class="form-control"
                        placeholder="e.g. school Samanabad Lahore"
                        autocomplete="off"
                    />
                    <button type="button" class="btn btn-primary" id="btn-gps-search">Search</button>
                </div>
                <div id="gps-search-results" class="gps-search-results list-group shadow-sm d-none"></div>
            </div>
            <small class="text-muted">Pakistan / Lahore results only. Example: <strong>school Samanabad Lahore</strong> — phir list se select karo.</small>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="mb-1 row">
        <div class="col-sm-3">
            <label class="col-form-label" for="latitude">Coordinates</label>
        </div>
        <div class="col-sm-9">
            <div class="row g-2">
                <div class="col-md-6">
                    <input
                        type="number"
                        step="any"
                        id="latitude"
                        class="form-control @error('latitude') is-invalid @enderror"
                        name="latitude"
                        placeholder="Latitude (e.g. 31.5204)"
                        value="{{ $pickerLat }}"
                    />
                    @error('latitude')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input
                        type="number"
                        step="any"
                        id="longitude"
                        class="form-control @error('longitude') is-invalid @enderror"
                        name="longitude"
                        placeholder="Longitude (e.g. 74.3587)"
                        value="{{ $pickerLng }}"
                    />
                    @error('longitude')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-2 d-flex flex-wrap gap-2 align-items-center">
                <button type="button" class="btn btn-outline-primary btn-sm" id="btn-pick-location-map">
                    <i data-feather="map-pin"></i> Pick on Map
                </button>
                <button type="button" class="btn btn-outline-success btn-sm" id="btn-use-my-location">
                    <i data-feather="navigation"></i> My Location
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-clear-location">
                    Clear
                </button>
                <small class="text-muted" id="gps-coords-preview">
                    @if($pickerLat && $pickerLng)
                        Selected: {{ $pickerLat }}, {{ $pickerLng }}
                    @else
                        No location selected yet
                    @endif
                </small>
            </div>

            <div id="gpsInlineMap" class="gps-inline-map mt-2"></div>
            <small class="text-muted d-block mt-1" id="gps-location-hint">
                Tip: pura area/city likho — <em>school Samanabad Lahore</em>. Sirf <em>the educ</em> se result nahi aayega.
            </small>
        </div>
    </div>
</div>

<div class="modal fade" id="pickLocationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pick location on map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 position-relative">
                    <div class="input-group">
                        <input type="text" id="gps-place-search-modal" class="form-control" placeholder="Search place..." autocomplete="off" />
                        <button type="button" class="btn btn-primary" id="btn-gps-search-modal">Search</button>
                    </div>
                    <div id="gps-search-results-modal" class="gps-search-results list-group shadow-sm d-none"></div>
                </div>
                <div id="pickLocationMap"></div>
                <div class="mt-2 small text-muted">Search se select karo ya map pe click karo — pin auto set hoga.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
