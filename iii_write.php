<?php
	header("Access-Control-Allow-Origin: *");
	
	// SETUP
	
	// Set this to true if you want to use the MySQL database. If you just want a CSV file, leave it as false.
	$database = false; 
	
	// NO NEED TO EDIT BELOW

	$navString = $_SERVER['REQUEST_URI']; 
	// Returns "/pathto/script/LinkPosition/Type/Page/"

	$parts = explode('/', $navString); // Break into an array

	// Grab fixed position fields
	//$parts[3] = Timestamp of search
	//$parts[4] = Search type (e.g. Keyword, Title...)
	//$parts[5] = Search query

	// WHOA THIS IS SOME CLUMSY CODE LET'S HOPE IT WORKS
	
	if($database == true) { // Save to MySQL database
	
	include(mysqlconnect.php); // Connect to database
	
	// Save record to database
	
	$result = mysql_query("INSERT INTO iii_searches VALUES ('', '$parts[3]', '$parts[4]', '$parts[5]')");
		if(!$result) {
			echo "There was a problem.";
		}
	
	} else { // Save to CSV file
	
	$data = array($parts[3],$parts[4],$parts[5],$parts[6],$parts[7],$parts[8]);
	
	// More sane CSV code thanks to Michael Oehrlich, oehrlich@thulb.uni-jena.de
	
	if (!$DataFile = fopen("iiidata.csv", "a")) {echo "Failure: cannot open file"; die;};
	if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
	fclose($DataFile);
	echo "file write successful";
	
	}

?>