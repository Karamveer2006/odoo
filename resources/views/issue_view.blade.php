<x-structure />
<x-header />

<section id="issue-view-page">
    <div class="container py-4">
        <!-- Back Navigation -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Issues
            </a>
        </div>

        <!-- Issue Details Card -->
        <div class="issue-detail-container">
            <div class="row g-0">
                <!-- Image Gallery Section -->
                <div class="col-lg-6">
                    <div class="issue-gallery">
                        @if($issue->photos && count($issue->photos) > 0)
                            <div id="issueDetailCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($issue->photos as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" 
                                             class="d-block w-100" 
                                             alt="Issue Image {{ $index + 1 }}"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal"
                                             data-image-src="{{ asset('storage/' . $image->path) }}"
                                             style="cursor: pointer;">
                                    </div>
                                    @endforeach
                                </div>
                                
                                @if(count($issue->photos) > 1)
                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#issueDetailCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#issueDetailCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                
                                <!-- Indicators -->
                                <div class="carousel-indicators">
                                    @foreach($issue->photos as $index => $image)
                                    <button type="button" 
                                            data-bs-target="#issueDetailCarousel" 
                                            data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index == 0 ? 'active' : '' }}" 
                                            aria-current="{{ $index == 0 ? 'true' : 'false' }}">
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        @else
                            <div class="no-image-placeholder">
                                <i class="fas fa-image"></i>
                                <p>No images available</p>
                            </div>
                        @endif
                        
                        <!-- Category Badge -->
                        <div class="issue-category-overlay">
                            <span class="category-badge {{ strtolower($issue->category?->name) }}">
                                {{ strtoupper($issue->category?->name) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Issue Information Section -->
                <div class="col-lg-6">
                    <div class="issue-details">
                        <!-- Issue Header -->
                        <div class="issue-header">
                            <h1 class="issue-title">{{ $issue->title }}</h1>
                            <div class="issue-status-badge">
                                <span class="status-badge {{ strtolower($issue->status) }}">
                                    <i class="fas fa-circle"></i>
                                    {{ ucfirst($issue->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Issue Meta Info -->
                        <div class="issue-meta-info">
                            <div class="meta-item">
                                <i class="fas fa-user"></i>
                                <span>Reported by <strong>{{ $issue->reporter->username ?? 'Anonymous' }}</strong></span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $issue->created_at->format('F j, Y \a\t g:i A') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $issue->address ?? 'Location not specified' }}</span>
                            </div>
                        </div>

                        <!-- Issue Description -->
                        <div class="issue-description">
                            <h3>Description</h3>
                            <p>{{ $issue->description }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="issue-actions">
                            {{-- @if(auth()->check() && auth()->id() == $issue->user_id) --}}
                            {{-- <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Issue
                            </a> --}}
                            {{-- @endif --}}
                            
                            <button class="btn btn-outline-secondary" onclick="shareIssue()">
                                <i class="fas fa-share-alt"></i> Share
                            </button>
                            
                            <button class="btn btn-outline-danger" onclick="reportIssue()">
                                <i class="fas fa-flag"></i> Report
                            </button>
                        </div>

                        <!-- Issue Progress -->
                        @if($issue->status_updates && count($issue->status_updates) > 0)
                        <div class="issue-progress">
                            <h3>Progress Updates</h3>
                            <div class="progress-timeline">
                                @foreach($issue->status_updates as $update)
                                <div class="timeline-item">
                                    <div class="timeline-marker {{ strtolower($update->status) }}"></div>
                                    <div class="timeline-content">
                                        <h4>{{ ucfirst($update->status) }}</h4>
                                        <p>{{ $update->comment ?? 'Status updated' }}</p>
                                        <small>{{ $update->created_at->format('M j, Y \a\t g:i A') }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        @if($issue->latitude && $issue->longitude)
        <div class="issue-map-section mt-4">
            <h3 class="mb-3">Location</h3>
            <div id="issueMap" class="issue-map"></div>
        </div>
        @endif

    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Issue Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Issue Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Include Leaflet for Map -->
    <script src="assets/js/leaflet.js"></script>
    
    <script>
        // Initialize map if coordinates are available
        @if($issue->latitude && $issue->longitude)
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('issueMap').setView([{{ $issue->latitude }}, {{ $issue->longitude }}], 16);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Add marker for the issue
            L.marker([{{ $issue->latitude }}, {{ $issue->longitude }}])
                .addTo(map)
                .bindPopup('<strong>{{ $issue->title }}</strong><br>{{ $issue->address }}')
                .openPopup();
        });
        @endif

        // Image modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            
            // Handle image clicks
            document.querySelectorAll('[data-bs-target="#imageModal"]').forEach(img => {
                img.addEventListener('click', function() {
                    modalImage.src = this.dataset.imageSrc;
                });
            });
        });

        // Share functionality
        function shareIssue() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $issue->title }}',
                    text: '{{ Str::limit($issue->description, 100) }}',
                    url: window.location.href
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(function() {
                    alert('Link copied to clipboard!');
                });
            }
        }

        // Report functionality
        function reportIssue() {
            if(confirm('Are you sure you want to report this issue as inappropriate?')) {
                // Here you would make an AJAX call to report the issue
                alert('Issue has been reported. Thank you for keeping our community safe.');
            }
        }
    </script>
</section>

<x-footer />
