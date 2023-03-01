<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA Temperature App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />
</head>
<body>
<div class="container wrapper">
  <br>
  <div class="container">
            <form action="#" class="find-location">
                <input type="text" id="location" name="location" placeholder="Find your location..." style="background-color:grey;">
                <input type="button" id="find" value="Find">
            </form>
</div>
<div id="forecast_table"></div>
</div>
</body>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
		$('#find').on('click', function(event) {
			var location = $('#location').val();
			$.ajax({
				url: 'weatherapp.php',
				type: 'POST',
				data: {location: location},
				success:function(res) {
					alert("Success");
          $("#forecast_table").append(res);
				},
				error:function(error) {
					console.log(error.responseText);
				}
			});
		});
	</script>
</html>