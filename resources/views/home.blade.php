<x-structure />
<x-header />
<div class="container mt-4">
    <div class="row g-3 justify-content-center">
      <div class="col-md-3 col-6">
        <select class="form-select" id="category-filter">
          <option selected>Category</option>
          @foreach ($categories as $item)
              <option value="{{Crypt::encrypt($item->id)}}">{{$item->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3 col-6">
        <select class="form-select" id="status-filter">
          <option selected>Status</option>
          <option value="1">Reported</option>
          <option value="2">In Progress</option>
          <option value="3">Resolved</option>
        </select>
      </div>
      <div class="col-md-3 col-6">
        <select class="form-select" id="distance-filter">
          <option selected>Distance</option>
          <option value="1">1Km</option>
          <option value="2">3Km</option>
          <option value="3">5Km</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Cards -->
  <div class="container mt-5">
    <div class="row" id="issue-card-container">
        
    </div>
  </div>
  <script>
    $(document).ready(function () {
        window.latitude = 23.0225;
        window.longitude = 72.5714; 
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                window.latitude = position.coords.latitude;
                window.longitude = position.coords.longitude;
            }, function() {
                console.warn('Geolocation permission denied or not supported.');
            });
        } else {
            console.warn('Geolocation is not supported by this browser.');
        }
        function loadIssues() {

            $.ajax({
                url: '{{$fetchIssuesUrl}}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: $("#status-filter").val() == "Status" ? null : $("#status-filter").val(), 
                    category: $("#category-filter").val() == "Category" ? null : $("#category-filter").val(), 
                    distance: $("#distance-filter").val() == "Distance" ? null : $("#distance-filter").val(), 
                    latitude: window.latitude, 
                    longitude: window.longitude 
                },
                success: function (response) {
                    $('#issue-card-container').empty();
                    response.data.forEach(issue => {
                        const card_id = `issue-${Math.random().toString(36).substring(2, 15)}`;
                        var photos_content = "";
                        var photos_nav = "";
                        var photos = issue.photos.map(photo => photo.photo_path);
                        if (photos.length === 0) {
                            // photos = ['assets/images/default-issue.jpg']; // Default image if no photos
                        }else {
                            photos_content = photos.map((photo, index) => `
                                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                    <img src="../storage/app/public/${photo}" class="d-block w-100" alt="Issue Image ${index + 1}">
                                </div>
                            `).join('');
                            photos_nav = photos.map((photo, index) => `
                                <button type="button" data-bs-target="#${card_id}" data-bs-slide-to="${index}" class="${index === 0 ? 'active' : ''}" aria-current="${index === 0 ? 'true' : 'false'}"></button>
                            `).join('');
                        }   

                        const card = `<div class="col-md-4 mt-2">
                            <div class="issue-card">
                                <div id="${card_id}" class="carousel slide issue-image" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        ${photos_content}
                                    </div>
                                    
                                    <!-- Carousel Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#${card_id}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#${card_id}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    
                                    <!-- Image Indicators (Optional) -->
                                    <div class="carousel-indicators">
                                        ${photos_nav}
                                    </div>
                                    
                                    <!-- Category Badge -->
                                    <div class="issue-category">
                                        <span class="category-badge roads">ROADS</span>
                                    </div>
                                </div>
                                
                                <div class="issue-content">
                                    <h3 class="issue-title">Large pothole on Main Street</h3>
                                    <p class="issue-description">Deep pothole near the intersection of Main St and Oak Ave causing vehicle damage</p>
                                    <div class="issue-meta">
                                        <div class="issue-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Main Street & Oak Avenue</span>
                                        </div>
                                        <div class="issue-date">
                                            <i class="fas fa-clock"></i>
                                            <span>1/30/2025 04:00 PM • Reported</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
`;
                        $('#issue-card-container').append(card);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching issues:', error);
                }
            });
        }
        loadIssues();
    });
  </script>
<x-footer />