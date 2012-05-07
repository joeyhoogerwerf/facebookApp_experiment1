<?php 
    $app_id = "241580542558312";
    
	$canvas_page = "https://apps.facebook.com/thegenderapp/";

    $auth_url = "http://www.facebook.com/dialog/oauth?client_id=" 
           . $app_id . "&redirect_uri=" . urlencode($canvas_page);

    $signed_request = $_REQUEST["signed_request"];

    list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

    $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

    if (empty($data["user_id"])) {
           echo("<script> top.location.href='" . $auth_url . "'</script>");
    } else {
           echo ("Welcome User: " . $data["user_id"]);
    } 
?>
<!DOCTYPE html>
<html>
<head>
	<title>The Gender App! "</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script
</head>
<body>
	<h1>The Gender App!</h1>
	
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>

	<script>
		FB.init({appId: '241580542558312', status: true, cookie: true, xfbml: true});
		
		FB.getLoginStatus(function(response){
			
			if(response.session){
				
				console.log("hoot" + response);
				
				FB.api('/me', function(response) { 
					
					var userGender = response.gender;
						
					$('#magic').append('<p>You are a ' + userGender + '!</p>');
				});
			}
			
			else{
				alert('Somezing went wrong!');
			}
		});
	</script>	
	
	<div id="magic"></div>
		
</body>	
</html>