<div class="col-center">
	Custom RSS News Reader - written by Kent Thompson
	<hr/>
	<span>High Technology News for</span>

<script>
var d = new Date();
var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var monthname = ["January","February","March","April","May","June","July","August","September","October","November","December"];
document.write(weekday[d.getDay()]  + ", ");
document.write(monthname[d.getMonth()] + " ");
document.write(d.getDate() + ", ");
document.write(d.getFullYear());

window.onload = function() {
	showRSS();
};

function showRSS() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open( "GET", "https://kentthompson.org/app/views/getrss.php", false );
	xmlhttp.send();
	if( xmlhttp.status == 200 ) {
		//alert( xmlhttp.status );
		document.getElementById("rssOutput").innerHTML = xmlhttp.responseText;
		krcol();
		ksize();
		kbalance();
	}
}
</script>
<noscript>
	Today.
	<p>You need to enable JavaScript to see current news articles. Thank you.</p>
</noscript>
	<div class="rssFeed" id="rssOutput"></div>
	<p></p>
	<p></p>
</div>
<p></p>