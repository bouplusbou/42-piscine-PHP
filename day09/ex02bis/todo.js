$(document).ready(function(){
	var list = $('#ft_list');

	var cookiesObj = {};

	if (document.cookie) {
		cookiesObj = JSON.parse(document.cookie);
		var timestamps = Object.keys(cookiesObj);
		timestamps.forEach((timestamp) => {
			var newContent = document.createTextNode(cookiesObj[timestamp]);
			var newDiv = document.createElement("div");
			newDiv.appendChild(newContent);
			newDiv.id = timestamp;
			list.prepend(newDiv);
		});
	}


	$('#submit').click(function(){
		var todo = window.prompt("What's new today ?");
		if (todo) {
			var newContent = document.createTextNode(todo);
			var newDiv = document.createElement("div");
			newDiv.appendChild(newContent);
			var timestamp = new Date().getTime().toString();
			newDiv.id = timestamp;
			list.prepend(newDiv);

			if (document.cookie)
				cookiesObj = JSON.parse(document.cookie);
			cookiesObj[timestamp] = todo;
			var cookiesString = JSON.stringify(cookiesObj)
			document.cookie = cookiesString;
		}
	});

	// $('#ft_list').on("click", ".minusbtn", function () {
	// 	$(this).parent().prev('br').addBack().remove();
	// });

	$('#ft_list').on( "click", "div", function( event ) {
		if (confirm('Are you sure you want to delete this item?')) {

			$(this).remove();
		}
		console.log($( this ).attr('id'));
	});

	// $('#ft_list').click(function(){
	// 	if (confirm('Are you sure you want to delete this item?')) {

	// 		$(this).remove();

	// 		// cookiesObj = JSON.parse(document.cookie);
	// 		// delete cookiesObj[event.target.id];
	// 		// var cookiesString = JSON.stringify(cookiesObj)
	// 		// document.cookie = cookiesString;
	// 	}
	// });
});