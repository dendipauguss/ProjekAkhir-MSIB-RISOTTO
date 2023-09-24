<div class="container-fluid bg-gradient-light">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Device 4</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Average CO2 -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">CO2</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="co2"></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-smog fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Average Temperature -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Suhu</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="suhu"></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-thermometer-empty fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Average Humidity -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelembapan</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="humidity"></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-percent fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Device Online -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status device</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="status_device"></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rocket fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">

        <!-- Tampilan Chart Suhu -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Suhu</h6>
                </div>
                <div class="card-body text-center">
                    <iframe width="80%" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1964269/charts/4?api_key=KEUTWRUZTMWIWFCT&bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Data+Suhu+Device+4&type=line"></iframe>
                </div>
            </div>
        </div>
        <!-- Tampilan Chart Kelembapan -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kelembapan</h6>
                </div>
                <div class="card-body text-center">
                    <iframe width="80%" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1964269/charts/5?api_key=KEUTWRUZTMWIWFCT&bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Data+Kelembapan+Device+4&type=line"></iframe>
                </div>
            </div>
        </div>
        <!-- Tampilan Chart CO2 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">CO2</h6>
                </div>
                <div class="card-body text-center">
                    <iframe width="80%" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1964269/charts/6?api_key=KEUTWRUZTMWIWFCT&bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Data+CO2+Device+4&type=line"></iframe>
                </div>
            </div>
        </div>
        <!-- Tampilan Lokasi Google Maps -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lokasi Perangkat</h6>
                </div>
                <div class="card-body text-center">
                    <div id="googleMap" style="width:100%; height:300px;"></div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
      setInterval(() => {
        $.getJSON("https://blynk.cloud/external/api/get?token=5SOiUa5MTN4MVfV1pmTxVQod0STm3z78&v0&v1&v2", function(hasil) {
          console.log(hasil);
          let rataSuhu = parseFloat(hasil.v0);
          let rataHum = parseFloat(hasil.v1);
          let rataCO2 = parseFloat(hasil.v2);
          document.getElementById("suhu").innerHTML = rataSuhu + "° C";
          document.getElementById("humidity").innerHTML = rataHum + " %";
          document.getElementById("co2").innerHTML = rataCO2 + " ppm";
        });
        
        $.getJSON("https://blynk.cloud/external/api/isHardwareConnected?token=5SOiUa5MTN4MVfV1pmTxVQod0STm3z78", function(hasil) {
          console.log(hasil);
          if (hasil == false) {
              document.getElementById("status_device").innerHTML = "OFF";
          } else {
              document.getElementById("status_device").innerHTML = "ON";
          }
        });
      }, 10000);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>