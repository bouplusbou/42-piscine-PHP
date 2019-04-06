$(document).ready(function(){

	var cookiesObj = {};

	if (document.cookie) {
		cookiesObj = JSON.parse(document.cookie);
		var timestamps = Object.keys(cookiesObj);
		timestamps.forEach((timestamp) => {
			$('#ft_list').prepend("<div id=\"" + timestamp + "\">" + cookiesObj[timestamp] + "</div>");
		});
	}

	$('#submit').click(function(){
		var todo = prompt("What's new today ?");
		if (todo) {
			var timestamp = new Date().getTime().toString();
			$('#ft_list').prepend("<div id=\"" + timestamp + "\">" + todo + "</div>");

			if (document.cookie)
				cookiesObj = JSON.parse(document.cookie);
			cookiesObj[timestamp] = todo;
			var cookiesString = JSON.stringify(cookiesObj)
			document.cookie = cookiesString;
		}
	});

	$('#ft_list').on( "click", "div", function( event ) {
		if (confirm('Are you sure you want to delete this item?')) {

			$(this).remove();

			cookiesObj = JSON.parse(document.cookie);
			delete cookiesObj[$( this ).attr('id')];
			var cookiesString = JSON.stringify(cookiesObj)
			document.cookie = cookiesString;
		}
	});
});