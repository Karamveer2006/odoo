<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - CivicTrack</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 sidebar" id="sidebar-wrapper">
      <h3 class="text-info">CivicTrack</h3>
      <ul class="list-unstyled mt-4">
        <li><a href="#" class="text-white d-block py-2"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
        <li><a href="#" class="text-white d-block py-2"><i class="fas fa-exclamation-circle me-2"></i> Issues</a></li>
        <li><a href="#" class="text-white d-block py-2"><i class="fas fa-users me-2"></i> Users</a></li>
        <li><a href="#" class="text-white d-block py-2"><i class="fas fa-cog me-2"></i> Settings</a></li>
      </ul>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">
        <button class="btn btn-outline-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>
        <div class="ms-auto">
          <div class="dropdown">
            <a class="dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown"><i class="fas fa-user-circle fa-lg"></i> Admin</a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Analytics Cards -->
      <div class="container-fluid mt-4">
        <div class="row g-4">
          <div class="col-md-3">
            <div class="card text-white bg-primary h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5>Total Issues</h5>
                    <h3>120</h3>
                  </div>
                  <i class="fas fa-bug fa-2x"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card text-white bg-success h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5>Resolved</h5>
                    <h3>95</h3>
                  </div>
                  <i class="fas fa-check-circle fa-2x"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card text-white bg-warning h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5>Pending</h5>
                    <h3>25</h3>
                  </div>
                  <i class="fas fa-hourglass-half fa-2x"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card text-white bg-info h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5>Users</h5>
                    <h3>340</h3>
                  </div>
                  <i class="fas fa-users fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- More dashboard sections can go here -->

      </div>
    </div>
  </div>

  <!-- Bootstrap & JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("menu-toggle").addEventListener("click", function () {
      document.getElementById("sidebar-wrapper").classList.toggle("d-none");
    });
  </script>
</body>
</html>
