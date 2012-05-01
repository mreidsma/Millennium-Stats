$("form").submit(function() {

	// Millennium doesn't give me the stats on usage I want. That's fine.
	// I'll do it myself!

	var query = "";
	var ts = Math.round((new Date()).getTime() / 1000); // Timestamp
	var datastring = "";
	
	// Get value of search field
	
	// Keyword
	var searchQuery = $(this).children('input:text[name=searcharg]').val();
	
	// If another search screen grab 
	if(searchQuery == undefined) {
		// Specific search pages
		var searchQuery = $('#SEARCH').val();
	}
	
	// Need to write code to capture the Advanced Search
	
	if(searchQuery != undefined) {
	
		// Get search type - could also grab from the URL and parse into readable value
		var searchy = $("h2").text().trim().split(" ");
		var searchType = searchy[0];

			if(searchType == "") {
				searchy = $("#searchtype").find("option:selected").text().trim().split(" ");
				searchType = searchy[0];
			}
		
		// Record the search and other details
		// For now, into a .csv file for ease
		//
		// Headers: Timestamp, Search Type, Query
		
		datastring = datastring + ts + "," + searchType + "," + searchQuery;
		datastring = "data=" + datastring;
		$.ajax({
			dataType: "string",
			type: "POST",
			url: "http://gvsulib.com/temp/iii_write.php",
			data: datastring
		});
		datastring = "";
	}
	
});