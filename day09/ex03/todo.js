$(document).ready(function(){

	$.ajax({
		url : "select.php", // on passe l'id le plus récent au fichier de chargement
		type : 'GET',
		success : function(html){
			$('#ft_list').prepend(html);
		}
	});

	$('#submit').click(function(){
		var todo = prompt("What's new today ?");
		if (todo) {
			var timestamp = new Date().getTime().toString();
			$('#ft_list').prepend("<div id=\"" + timestamp + "\">" + todo + "</div>");

			$.ajax({
				url : "insert.php",
				type : "POST",
				data : "id=" + timestamp + "&todo=" + todo
			});
		}
	});




	$('#ft_list').on( "click", "div", function( event ) {
		if (confirm('Are you sure you want to delete this item?')) {

			$(this).remove();

			$.ajax({
				url : "delete.php",
				type : "POST",
				data : "id=" + $( this ).attr('id')
			});
		}
	});
});