<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$row = 1;

if (!$DataFile = fopen("http://gvsulib.com/temp/iii_searches.csv", "r")) {echo "Failure: cannot open file"; die;};
while ($data = fgetcsv($DataFile, 1000, ",")) {
		$row++;
		$results[] = array($data[0], $data[1], $data[2]);
	}

if ($results) {
		
	$searchType = array();
	
	foreach ($results as $key => $value) {
		
		// Build chart for link location
		
		$searchy = $value[1];
		
		if($searchy != "") {
			if(isset($searchType[$searchy]))
		        $searchType[$searchy] += 1;
		    else
		        $searchType[$searchy] = 1;
		}
	}	
	ksort($searchType);
	
}

?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(clickChart);
	

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Search Type');
        data.addColumn('number', 'Number');
        data.addRows([
	
	<?php
	
		foreach ($searchType as $key => $value) {
			
			echo "['" . $key . "', " . $value . "],";
		
		}
	
	?>
        
        ]);

        // Set chart options
        var options = {'title':'Millennium Searches by Type',
                       'width':960,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }


	function clickChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Search Type');
        data.addColumn('number', 'Number');
        data.addRows([

			<?php

				foreach ($searchType as $key => $value) {

					echo "['" . $key . "', " . $value . "],";

				}

			?>
        ]);

        // Set chart options
        var options = {'title':'Millennium searches by type',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('clicks_div'));
        chart.draw(data, options);
      }

    </script>

	<link rel="stylesheet" type="text/css" href="http://gvsu.edu/cms3/assets/741ECAAE-BD54-A816-71DAF591D1D7955C/libui.css" />
	
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>

	<div class="line">
		<div class="size1of3 unit">
			<div id="clicks_div"></div>
		</div>
		
		<div class="size1of3 unit">
			<div id="link_div"></div>
		</div>
		
		<div class="size1of3 unit">
			<div id="page_div"></div>
		</div>
	</div>
		
 </body>
</html>