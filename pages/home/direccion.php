<?php
		/* Si llegamos aquí es porque existen datos de usuario para registrar. */
		$location = $_POST['location'];
		error_log($location);
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<title>Nombre de mi página</title>
		
		<meta charset="utf-8">
		
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
		
		<style type="text/css">
			.autocomplete-container {
				position: relative;
			}
		</style>
		<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/dist/index.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/styles/minimal.css">
	</head>
	
	<body>
		<div id="autocomplete" class="autocomplete-container"></div>
		<script>
			const autocompleteInput = new autocomplete.GeocoderAutocomplete(
                        document.getElementById("autocomplete"), 
                        'd0431744786849ceb7c2285e7ede4185', 
                        { /* Geocoder options */ });

			autocompleteInput.on('select', (location) => {
				let fd = new FormData();
				fd.append("location", location)
				fetch(window.location.href, {
					method: "post",
					body: fd
				}).then((res) => console.log(res))
			});

			autocompleteInput.on('suggestions', (suggestions) => {
				// process suggestions here
			});
		</script>

		
		
		
	</body>
	
</html>