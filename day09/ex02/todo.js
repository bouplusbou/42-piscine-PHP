const list = document.getElementById('ft_list');

let cookiesObj = {};

if (document.cookie) {
	cookiesObj = JSON.parse(document.cookie);
	const timestamps = Object.keys(cookiesObj);
	console.log(cookiesObj);
	timestamps.forEach((timestamp) => {
		let newContent = document.createTextNode(cookiesObj[timestamp]);
		let newDiv = document.createElement("div");
		newDiv.appendChild(newContent);
		newDiv.id = timestamp;
		list.prepend(newDiv);
	});
}

const submit = document.getElementById('submit');

submit.addEventListener("click", (event) => {
	let todo = window.prompt("What's new today ?");
	if (todo) {
		let newContent = document.createTextNode(todo);
		let newDiv = document.createElement("div");
		newDiv.appendChild(newContent);
		let timestamp = new Date().getTime().toString();
		newDiv.id = timestamp;
		list.prepend(newDiv);

		if (document.cookie)
			cookiesObj = JSON.parse(document.cookie);
		cookiesObj[timestamp] = todo;
		let cookiesString = JSON.stringify(cookiesObj)
		document.cookie = cookiesString;
	}
});

list.addEventListener("click", (event) => {
	if (confirm('Are you sure you want to delete this item?')) {
		console.log(event.target.id);

		document.getElementById(event.target.id).remove();
		
		cookiesObj = JSON.parse(document.cookie);
		delete cookiesObj[event.target.id];
		let cookiesString = JSON.stringify(cookiesObj)
		document.cookie = cookiesString;
	}
});