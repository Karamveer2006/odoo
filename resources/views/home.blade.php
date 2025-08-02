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
          <option value="Reported">Reported</option>
          <option value="In Progress">In Progress</option>
          <option value="Resolved">Resolved</option>
        </select>
      </div>
      <div class="col-md-3 col-6">
        <select class="form-select" id="distance-filter">
          <option value="1">1Km</option>
          <option value="2">3Km</option>
          <option value="3">5Km</option>
        </select>
      </div>
      <div class="col-md-1 col-2">
        <button id="refreshIssuesTrigger" class="btn btn-sm btn-warning "><i class="fas fa-sync-alt"></i></button>
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
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                window.latitude = position.coords.latitude;
                window.longitude = position.coords.longitude;
            loadIssues();
                
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
                            photos_content = `<div class="d-flex justify-content-center align-items-center>"<i class="fas fa-image"></i>
                                <p>No images available</p></div>`; // Default image if no photos
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
                                        <a href='issues/${issue.id}'>
                                        ${photos_content}
                                        </a>
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
                                        <span class="category-badge roads">${issue.status}</span>
                                    </div>
                                </div>
                                
                                <div class="issue-content">
                                    <h3 class="issue-title"><a href='issues/${issue.id}' class='text-dark text-decoration-none'>${issue.title}</a></h3>
                                    <p class="issue-description">${issue.description.substring(0,70)}</p>
                                    <div class="issue-meta">
                                        <div class="issue-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>${issue.address}</span>
                                        </div>
                                        <div class="issue-date">
                                            <i class="fas fa-clock"></i>
                                            <span>${issue.created_at} • ${issue.category?.name}</span>
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
        $("#refreshIssuesTrigger").click(function () {
            loadIssues();
        });
        $("#category-filter, #status-filter, #distance-filter").change(function () {
            loadIssues();
        })
    });
  </script>
<x-footer />