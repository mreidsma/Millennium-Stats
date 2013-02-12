// Change this to the directory where you saved iiiwrite.php and either mysqlconnect.php or iiidata.csv
	var path = "http://gvsulib.com/labs/iiistats/"; // NEEDS A TRAILING SLASH!

	// Millennium doesn't give me the stats on usage I want. That's fine.
	// I'll do it myself! <-- Quoting my 2.5 year old

	var ts = Math.round((new Date()).getTime() / 1000); // Timestamp
	var datastring, searchQuery, query;

	// Get value of search field
	
	if(document.getElementById("searcharg").length > 0 { // Keyword
		searchQuery = document.getElementById("searcharg").value;
	}

	// If another search screen grab 
	if(searchQuery == "") {
		// Specific search pages
		searchQuery = document.getElementById("SEARCH").value;
	}
	
	// Need to write code to capture the Advanced Search
	
	if(searchQuery != "") {
	
		searchQuery = encodeURI(searchQuery);
	
		// Get search type - could also grab from the URL and parse into readable value
		
		function getSelectedText(elementId) {
			var elt = document.getElementById(elementId);

			if (elt.selectedIndex == -1)
			return null;

			return elt.options[elt.selectedIndex].text;
		}

		var searchType = encodeURI(getSelectedText('searchtype'));
		var searchScope = encodeURI(getSelectedText('searchscope'));
		// Record the search and other details by doing a get request.
		
		datastring = datastring + ts + "/" + searchType + "/" + searchScope + "/" + searchQuery;
		datastring = path + datastring;
		
		// Silly hack to play nice with any browser. (I'm looking at you, IE and your fincky support of Cross-domain requests.
		
		var iFrame = document.createElement('iframe');
		iFrame.src = datastring;
		iFrame.width = '0';
		iFrame.height = '0';

		document.body.appendChild(iFrame);
	}
