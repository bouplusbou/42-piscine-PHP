<?php
function get_products() {
	if (file_exists("./database/products")) {
		$fp = fopen("./database/products", "r");
		if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
			$file_products = file_get_contents("./database/products");
			fflush($fp);            // libère le contenu avant d'enlever le verrou
			flock($fp, LOCK_UN);    // Enlève le verrou
		} else {
			echo "Impossible de verrouiller le fichier !";
		}
		fclose($fp);
		return unserialize($file_products);
	}
}
function get_categories() {
	if (file_exists("./database/categories")) {
		$fp = fopen("./database/categories", "r");
		if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
			$file_categories = file_get_contents("./database/categories");
			fflush($fp);            // libère le contenu avant d'enlever le verrou
			flock($fp, LOCK_UN);    // Enlève le verrou
		} else {
			echo "Impossible de verrouiller le fichier !";
		}
		fclose($fp);
		return unserialize($file_categories);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/listing.css" type="text/css">
	<title>Catalogue</title>
</head>
<body>
	<div id="header">
		<a href="listing.php"><img src="" alt="LOGO"></a>
		<a href="listing.php?category=All">All</a>
		<a href="listing.php?category=Clothing">Clothing</a>
		<a href="listing.php?category=Wood">Wood</a>
		<a href="listing.php?category=Papercuts">Papercuts</a>
		<p>Compte</p>
		<a href="account.php">Mon Compte</a>
		<a href="logout.php">Déconnection</a>
		<a href="cart.php">Panier</a>
	</div>
	<div class="wrapper">
		<?php
			$category = "All";
			if (in_array($_GET['category'], get_categories())) {
				$category = $_GET['category'];
			}
		?>
		<h2><?=$category?></h2>
		<?php
			$products = get_products();
			foreach ($products as $product) {
				if ($product)
		?>
			<div class="product">
				<img src="<?=$product['img']?>" alt="" width="400px">
			</div>
		<?php } ?>
	</div>
</body>
</html>