<x-structure />
<x-header />
<section id="report-issue-page">
    <div class="container py-4">
        <!-- Modern Header -->
        <div class="brand-header mb-4">
            <h2><i class="fas fa-exclamation-triangle" style="color: rgb(50,184,198);"></i> Report a Civic Issue</h2>
            <p class="text-muted">Help improve your community by reporting local issues</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="container-fluid">
            <div class="form-section">
                <form action="{{ route('issue.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-floating mb-3">
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               placeholder="e.g. Pothole near main gate"
                               value="{{ old('title') }}" 
                               required>
                        <label for="title">Issue Title</label>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  placeholder="Describe the issue in detail..."
                                  style="height: 120px;"
                                  required>{{ old('description') }}</textarea>
                        <label for="description">Short Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-floating mb-3">
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" 
                                name="category_id" 
                                required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ Crypt::encrypt($cat->id) }}" 
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="category_id">Select Category</label>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address Input -->
                    <div class="mb-3">
                        <label class="form-label">Search Address</label>
                        <div class="input-group">
                            <input type="text" 
                                   name="address" 
                                   id="search-address" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   placeholder="Enter address..."
                                   value="{{ old('address') }}">
                            <button type="button" class="btn btn-outline-secondary" onclick="geocodeAddress()">
                                <i class="fas fa-search"></i> Find
                            </button>
                        </div>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Map -->
                    <div class="mb-3">
                        <label class="form-label">Select Location on Map</label>
                        <div id="map" class="border @error('latitude') is-invalid @enderror @error('longitude') is-invalid @enderror" 
                             style="height: 300px; border-radius: 0.75rem; overflow: hidden;"></div>
                        @error('latitude')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('longitude')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}" required>
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}" required>

                    <!-- Photo Upload -->
                    <div class="mb-4">
                        <label for="images" class="form-label">Upload Photos (max 5)</label>
                        <input type="file" 
                               name="images[]" 
                               id="images" 
                               class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                               accept="image/*" 
                               capture="environment" 
                               multiple>
                        <div class="form-text">
                            <i class="fas fa-info-circle"></i> 
                            Supported formats: JPG, PNG, GIF. Max file size: 4MB each.
                        </div>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="image-preview mt-3 d-flex flex-wrap gap-2"></div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-3">
                        <i class="fas fa-upload"></i> Submit Issue Report
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/leaflet.js"></script>

    <script>
        let map = L.map('map').setView([{{ old('latitude', '23.0225') }}, {{ old('longitude', '72.5714') }}], 13);
        let marker;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18
        }).addTo(map);

        function placeMarker(lat, lng) {
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 15);
            $('#latitude').val(lat);
            $('#longitude').val(lng);
            
            // Remove validation errors when location is selected
            $('#map').removeClass('is-invalid');
            $('.invalid-feedback').hide();
        }

        function reverseGeocode(lat, lon) {
            if (!lat || !lon) {
                alert("Enter coordinates first.");
                return;
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById("search-address").value = (data.display_name || "");
            });
        }

        // Address to lat/lng
        function geocodeAddress() {
            const address = $('#search-address').val();
            if (!address) {
                alert('Please enter an address to search.');
                return;
            }

            // Show loading state
            const button = event.target;
            const originalHtml = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
            button.disabled = true;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        placeMarker(data[0].lat, data[0].lon);
                    } else {
                        alert("Address not found. Please try a different search term.");
                    }
                })
                .catch(error => {
                    alert("Error searching for address. Please try again.");
                    console.error('Geocoding error:', error);
                })
                .finally(() => {
                    // Reset button state
                    button.innerHTML = originalHtml;
                    button.disabled = false;
                });
        }

        // Click on map
        map.on('click', function (e) {
            placeMarker(e.latlng.lat, e.latlng.lng);
            reverseGeocode(e.latlng.lat, e.latlng.lng);
        });

        // Image preview with better error handling
        $('#images').on('change', function () {
            const preview = $('.image-preview');
            preview.empty();
            const files = this.files;
            
            if (files.length > 5) {
                alert('You can upload up to 5 images.');
                this.value = "";
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // Validate file size (4MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" is too large. Maximum size is 4MB.`);
                    this.value = "";
                    preview.empty();
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = $(`
                        <div class="position-relative">
                            <img src="${e.target.result}" 
                                 class="img-thumbnail" 
                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem;" 
                                 alt="Preview ${i + 1}">
                            <button type="button" 
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle" 
                                    style="width: 25px; height: 25px; padding: 0; margin: -5px;"
                                    onclick="removeImage(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `);
                    preview.append(imgContainer);
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove image function
        function removeImage(button) {
            $(button).parent().remove();
            // Reset file input if no images left
            if ($('.image-preview').children().length === 0) {
                $('#images').val('');
            }
        }

        // Initialize map with user location or old values
        $(document).ready(function () {
            const oldLat = "{{ old('latitude') }}";
            const oldLng = "{{ old('longitude') }}";
            
            if (oldLat && oldLng) {
                // Use old values if form was submitted with errors
                placeMarker(parseFloat(oldLat), parseFloat(oldLng));
                map.setView([parseFloat(oldLat), parseFloat(oldLng)], 15);
            } else if (navigator.geolocation) {
                // Get user's current location
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    placeMarker(lat, lng);
                    map.setView([lat, lng], 15);
                    reverseGeocode(lat, lng);
                }, function(error) {
                    console.warn('Geolocation error:', error);
                    // Keep default map center if geolocation fails
                });
            }
        });

        // Form validation before submit
        $('form').on('submit', function(e) {
            const lat = $('#latitude').val();
            const lng = $('#longitude').val();
            
            if (!lat || !lng) {
                e.preventDefault();
                alert('Please select a location on the map before submitting.');
                $('#map').addClass('is-invalid');
                return false;
            }
        });
    </script>

    <style>
        /* Additional styles for the image preview */
        .image-preview img {
            transition: transform 0.2s ease;
        }
        
        .image-preview img:hover {
            transform: scale(1.05);
        }
        
        .form-text {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }
        
        /* Map container styling */
        #map {
            box-shadow: 0 2px 8px var(--shadow-color);
        }
        
        #map.is-invalid {
            border-color: #ef4444 !important;
        }
        
        /* Loading states */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</section>
<x-footer />
