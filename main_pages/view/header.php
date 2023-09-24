<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Sistem Monitoring Asap Rokok</title>

<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  function initialize() {
    var propertiPeta = {
      center: new google.maps.LatLng(-6.973261, 110.479407),
      zoom: 9,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

    // membuat Marker
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(-6.973261, 110.479407),
      map: peta
    });

  }

  // event jendela di-load  
  google.maps.event.addDomListener(window, 'load', initialize);
</script>