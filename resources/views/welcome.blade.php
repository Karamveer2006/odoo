<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leaflet + Geocoding Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    #map {
      height: 400px;
      width: 100%;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<h3>Geocode Address & Reverse Geocode Location</h3>

<!-- Address Input -->
<input type="text" id="address" placeholder="Enter address" style="width: 300px;">
<button onclick="geocodeAddress()">Get Coordinates</button>

<!-- Latitude/Longitude Display -->
<div style="margin-top: 10px;">
  <label>Latitude: <input type="text" id="latitude" readonly></label>
  <label>Longitude: <input type="text" id="longitude" readonly></label>
</div>

<!-- Reverse Geocode Button -->
<button onclick="reverseGeocode()">Get Address from Coordinates</button>
<div id="reverse-address" style="margin-top: 10px; font-weight: bold;"></div>

<!-- Map Container -->
<div id="map"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  // Initialize map
  const map = L.map('map').setView([23.0225, 72.5714], 13); // default to Ahmedabad

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
  }).addTo(map);

  let marker;

  // Forward Geocode (Address → Lat/Lng)
  function geocodeAddress() {
    const address = document.getElementById("address").value;
    if (!address) return;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
      .then(res => res.json())
      .then(data => {
        if (data.length === 0) {
          alert("Address not found.");
          return;
        }

        const lat = data[0].lat;
        const lon = data[0].lon;

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lon;

        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lon]).addTo(map).bindPopup("Location").openPopup();
        map.setView([lat, lon], 15);
      });
  }

  // Reverse Geocode (Lat/Lng → Address)
  function reverseGeocode() {
    const lat = document.getElementById("latitude").value;
    const lon = document.getElementById("longitude").value;

    if (!lat || !lon) {
      alert("Enter coordinates first.");
      return;
    }

    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
      .then(res => res.json())
      .then(data => {
        document.getElementById("reverse-address").textContent = "Address: " + (data.display_name || "Not found");
      });
  }

  // Optional: Click on map to set lat/lng
  map.on("click", function (e) {
    const { lat, lng } = e.latlng;
    document.getElementById("latitude").value = lat;
    document.getElementById("longitude").value = lng;

    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map).bindPopup("Selected").openPopup();
  });
</script>

</body>
</html>
