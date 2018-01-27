// <?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// session_start();
// ?>

	console.log("hiii");
	function showproducts()
	{
		var table=document.getElementsByTagName("table")[0].children[0];
		var row = document.createElement("tr");
		var product=document.createElement("td");
		product.textContent="tea";
		var price=document.createElement("td");
		price.textContent="5" + " EGP";
		var image=document.createElement("td");
		image.textContent="image";
		var actions=document.createElement("td");
		var available=document.createElement("a");
		available.textContent="Available";
		available.href="page5.php"
		var edit= document.createElement("a");
		edit.textContent="Edit";
		edit.href="page5.php"
		var delet= document.createElement("a");
		delet.textContent="Delete";
		delet.href="page5.php"
		actions.appendChild(available);
		actions.appendChild(edit);
		actions.appendChild(delet);
		row.appendChild(product);
		row.appendChild(price);
		row.appendChild(image);
		row.appendChild(actions);
		table.appendChild(row);
	}

