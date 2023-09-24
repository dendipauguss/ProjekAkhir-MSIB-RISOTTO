<?php

if (isset($_GET['go'])) {
	switch ($_GET['go']) {
			// Perangkat 1
		case 'perangkat1':
			include "modul/perangkat1.php";
			break;
			// Perangkat 2		
		case 'perangkat2':
			include "modul/perangkat2.php";
			break;
			// Perangkat 3		
		case 'perangkat3':
			include "modul/perangkat3.php";
			break;
			// Perangkat 4		
		case 'perangkat4':
			include "modul/perangkat4.php";
			break;
			// Perangkat 5		
		case 'perangkat5':
			include "modul/perangkat5.php";
			break;

			//kosong
		default:
			include "dashboard.php";
			break;
	}
}
