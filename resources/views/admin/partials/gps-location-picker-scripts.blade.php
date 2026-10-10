<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    #gpsInlineMap,
    #pickLocationMap {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #d8d6de;
        min-height: 280px;
        background: #eef3f6;
    }
    #gpsInlineMap { height: 280px; }
    #pickLocationMap { height: 400px; }
    .gps-current-dot {
        width: 14px;
        height: 14px;
        background: #2563eb;
        border: 2px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.25);
    }
    .gps-search-results {
        position: absolute;
        z-index: 2000;
        left: 0;
        right: 0;
        top: 100%;
        max-height: 260px;
        overflow-y: auto;
        margin-top: 4px;
    }
    .gps-search-results .list-group-item {
        cursor: pointer;
        font-size: 13px;
        line-height: 1.35;
        white-space: normal;
    }
    .gps-search-results .list-group-item:hover,
    .gps-search-results .list-group-item:focus {
        background: #f3f2f7;
    }
</style>

<script>
(function () {
    var DEFAULT_LAT = 31.5204;
    var DEFAULT_LNG = 74.3587;
    var SEARCH_URL = @json(route('admin.geocode.search'));
    var inlineMap, modalMap, inlineMarker, modalMarker;
    var inlineCurrentDot, modalCurrentDot;
    var searchTimer = null;

    function parseCoord(value) {
        var n = parseFloat(value);
        return isNaN(n) ? null : n;
    }

    function getCoords() {
        return {
            lat: parseCoord($('#latitude').val()),
            lng: parseCoord($('#longitude').val())
        };
    }

    function hasSavedCoords() {
        var c = getCoords();
        return c.lat !== null && c.lng !== null;
    }

    function updatePreview(lat, lng) {
        if (lat === null || lng === null) {
            $('#gps-coords-preview').text('No location selected yet');
            return;
        }
        $('#gps-coords-preview').text('Selected: ' + lat.toFixed(6) + ', ' + lng.toFixed(6));
    }

    function setHint(message, isError) {
        var el = $('#gps-location-hint');
        if (!el.length) return;
        el.toggleClass('text-danger', !!isError);
        el.toggleClass('text-muted', !isError);
        el.html(message);
    }

    function currentDotIcon() {
        return L.divIcon({
            className: '',
            html: '<div class="gps-current-dot"></div>',
            iconSize: [14, 14],
            iconAnchor: [7, 7]
        });
    }

    function showCurrentLocationOnMap(map, lat, lng, isModal) {
        var ll = L.latLng(lat, lng);
        if (isModal) {
            if (modalCurrentDot) modalCurrentDot.setLatLng(ll);
            else modalCurrentDot = L.marker(ll, { icon: currentDotIcon(), interactive: false }).addTo(map);
            map.setView(ll, Math.max(map.getZoom(), 15));
        } else {
            if (inlineCurrentDot) inlineCurrentDot.setLatLng(ll);
            else inlineCurrentDot = L.marker(ll, { icon: currentDotIcon(), interactive: false }).addTo(map);
            map.setView(ll, Math.max(map.getZoom(), 15));
        }
    }

    function placeMarkerOnMaps(lat, lng, zoom) {
        ensureInlineMap();
        var ll = L.latLng(lat, lng);
        var z = zoom || 16;

        $('#latitude').val(lat.toFixed(6));
        $('#longitude').val(lng.toFixed(6));
        updatePreview(lat, lng);

        if (inlineMap) {
            if (inlineMarker) inlineMarker.setLatLng(ll);
            else inlineMarker = L.marker(ll).addTo(inlineMap);
            inlineMap.setView(ll, z);
            setTimeout(function () { inlineMap.invalidateSize(); }, 100);
        }

        if (modalMap) {
            if (modalMarker) modalMarker.setLatLng(ll);
            else modalMarker = L.marker(ll).addTo(modalMap);
            modalMap.setView(ll, z);
            setTimeout(function () { modalMap.invalidateSize(); }, 100);
        }
    }

    function setCoords(lat, lng, sourceMap) {
        placeMarkerOnMaps(lat, lng, 15);
    }

    function initMap(containerId, onReady) {
        var el = document.getElementById(containerId);
        if (!el || typeof L === 'undefined') return null;

        var coords = getCoords();
        var start = (coords.lat !== null && coords.lng !== null)
            ? [coords.lat, coords.lng]
            : [DEFAULT_LAT, DEFAULT_LNG];
        var zoom = (coords.lat !== null && coords.lng !== null) ? 14 : 11;

        var map = L.map(el, { scrollWheelZoom: true }).setView(start, zoom);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;
        if (coords.lat !== null && coords.lng !== null) {
            marker = L.marker(start).addTo(map);
        }

        map.on('click', function (e) {
            placeMarkerOnMaps(e.latlng.lat, e.latlng.lng, Math.max(map.getZoom(), 15));
            setHint('Pin set from map click.', false);
        });

        setTimeout(function () { map.invalidateSize(); }, 200);

        if (typeof onReady === 'function') onReady(map, marker);
        return { map: map, marker: marker };
    }

    function ensureInlineMap() {
        if (inlineMap) {
            setTimeout(function () { inlineMap.invalidateSize(); }, 150);
            return;
        }
        var result = initMap('gpsInlineMap', function (map, marker) {
            inlineMap = map;
            inlineMarker = marker;
        });
        if (result) {
            inlineMap = result.map;
            inlineMarker = result.marker;
        }
    }

    function ensureModalMap() {
        if (modalMap) {
            setTimeout(function () {
                modalMap.invalidateSize();
            }, 200);
            var coords = getCoords();
            if (coords.lat !== null && coords.lng !== null) {
                var ll = L.latLng(coords.lat, coords.lng);
                if (modalMarker) modalMarker.setLatLng(ll);
                else modalMarker = L.marker(ll).addTo(modalMap);
                modalMap.setView(ll, 14);
            }
            return;
        }
        var result = initMap('pickLocationMap', function (map, marker) {
            modalMap = map;
            modalMarker = marker;
        });
        if (result) {
            modalMap = result.map;
            modalMarker = result.marker;
        }
    }

    function hideSearchResults(which) {
        if (!which || which === 'main') $('#gps-search-results').addClass('d-none').empty();
        if (!which || which === 'modal') $('#gps-search-results-modal').addClass('d-none').empty();
    }

    function renderSearchResults($box, items) {
        $box.empty();
        if (!items.length) {
            $box.append(
                $('<div class="list-group-item text-muted"></div>').text('No places found. Try a fuller name + city.')
            );
            $box.removeClass('d-none');
            return;
        }

        items.forEach(function (item) {
            var $btn = $('<button type="button" class="list-group-item list-group-item-action"></button>');
            $btn.text(item.label);
            $btn.on('click', function () {
                placeMarkerOnMaps(item.latitude, item.longitude, 17);
                $('#gps-place-search').val(item.label);
                $('#gps-place-search-modal').val(item.label);
                hideSearchResults();
                setHint('Selected: <strong>' + $('<div>').text(item.label).html() + '</strong> — pin map pe mark ho gaya.', false);
            });
            $box.append($btn);
        });
        $box.removeClass('d-none');
    }

    function searchPlaces(query, target) {
        var q = (query || '').trim();
        if (q.length < 3) {
            setHint('Kam az kam 3 letters likho (e.g. Educator School Samnabad).', true);
            return;
        }

        var $box = target === 'modal' ? $('#gps-search-results-modal') : $('#gps-search-results');
        $box.removeClass('d-none').html('<div class="list-group-item text-muted">Searching...</div>');
        setHint('Searching places...', false);

        $.ajax({
            url: SEARCH_URL,
            method: 'GET',
            data: { q: q },
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        }).done(function (res) {
            var items = (res && res.data) ? res.data : [];
            renderSearchResults($box, items);
            if (items.length) {
                setHint(items.length + ' places mile — list se select karo, pin auto set hoga.', false);
            } else {
                setHint('Exact school OSM pe na mila. Area/city try karo (e.g. <em>Samanabad Lahore</em>), phir map pe exact pin click karo.', true);
            }
        }).fail(function (xhr) {
            $box.addClass('d-none').empty();
            var msg = (xhr.responseJSON && xhr.responseJSON.message)
                ? xhr.responseJSON.message
                : 'Search fail (server). Page refresh karke dubara try karo.';
            setHint(msg, true);
        });
    }

    function useMyLocation(centerOnly) {
        if (!navigator.geolocation) {
            setHint('Browser location supported nahi karta. Search ya manually use karo.', true);
            return;
        }

        setHint('Getting your location...', false);

        navigator.geolocation.getCurrentPosition(
            function (pos) {
                var lat = pos.coords.latitude;
                var lng = pos.coords.longitude;

                ensureInlineMap();
                if (inlineMap) showCurrentLocationOnMap(inlineMap, lat, lng, false);
                if (modalMap) showCurrentLocationOnMap(modalMap, lat, lng, true);

                if (!centerOnly || !hasSavedCoords()) {
                    placeMarkerOnMaps(lat, lng, 15);
                }

                setHint(
                    'Blue dot = aap ki current location. Exact pin set karne ke liye map pe click karo.',
                    false
                );
            },
            function (err) {
                var msg = 'Location permission denied ya unavailable.';
                if (err.code === 1) msg = 'Location blocked — browser address bar se Allow karo.';
                if (err.code === 2) msg = 'GPS signal nahi mila. Thori der baad try karo.';
                if (err.code === 3) msg = 'Location timeout. Dubara try karo.';
                setHint(msg, true);
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    }

    $(function () {
        ensureInlineMap();

        if (!hasSavedCoords()) {
            setTimeout(function () { useMyLocation(true); }, 400);
        }

        $('#latitude, #longitude').on('input change', function () {
            var coords = getCoords();
            if (coords.lat === null || coords.lng === null) {
                updatePreview(null, null);
                return;
            }
            placeMarkerOnMaps(coords.lat, coords.lng, 14);
        });

        $('#btn-pick-location-map').on('click', function () {
            var modalElement = document.getElementById('pickLocationModal');
            $(modalElement).one('shown.bs.modal', ensureModalMap);
            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        });

        $('#btn-use-my-location').on('click', function () {
            useMyLocation(false);
        });

        $('#btn-clear-location').on('click', function () {
            $('#latitude').val('');
            $('#longitude').val('');
            $('#gps-place-search').val('');
            $('#gps-place-search-modal').val('');
            updatePreview(null, null);
            hideSearchResults();
            if (inlineMarker && inlineMap) inlineMap.removeLayer(inlineMarker);
            if (modalMarker && modalMap) modalMap.removeLayer(modalMarker);
            inlineMarker = null;
            modalMarker = null;
            setHint('Tip: search box mein school name likho (jaise <em>The Educator School Samnabad</em>), result select karo.', false);
        });

        function bindSearch(inputId, buttonId, target) {
            $('#' + inputId).on('input', function () {
                var q = $(this).val();
                clearTimeout(searchTimer);
                if ((q || '').trim().length < 3) {
                    hideSearchResults(target === 'modal' ? 'modal' : 'main');
                    return;
                }
                searchTimer = setTimeout(function () {
                    searchPlaces(q, target);
                }, 450);
            });

            $('#' + inputId).on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchPlaces($(this).val(), target);
                }
            });

            $('#' + buttonId).on('click', function () {
                searchPlaces($('#' + inputId).val(), target);
            });
        }

        bindSearch('gps-place-search', 'btn-gps-search', 'main');
        bindSearch('gps-place-search-modal', 'btn-gps-search-modal', 'modal');

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#gps-place-search, #btn-gps-search, #gps-search-results, #gps-place-search-modal, #btn-gps-search-modal, #gps-search-results-modal').length) {
                hideSearchResults();
            }
        });

        if (typeof feather !== 'undefined') feather.replace();
    });
})();
</script>
