<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Twitter Stream alpha</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<meta http-equiv="refresh" content="5" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<?php $search_term = "Cancer Research UK"; ?>
<div class="container">
	<div class="row-fluid banner">
		<img src="http://www.cancerresearchuk.org/sites/all/themes/custom/cruk/logo.png" alt="Home">
        <hgroup>
        <h2>Let's beat cancer sooner</h2>
        </hgroup>
	</div>
    <div class="row-fluid">        
    <h2 class="search_term">Searching for <span class="pink"><?php echo $search_term ?></span></h2>
<?php 
include_once "oauth-jgp.php";
// lets run a search.
$bearer_token = get_bearer_token(); // get the bearer token
$results = search_for_a_term($bearer_token, $search_term); //  search for the work 'XXX'
invalidate_bearer_token($bearer_token); // invalidate the token

$response = json_decode($results, true);
$rand_no = rand(1,14);
$image_url = $response[statuses][$rand_no][user][profile_image_url];
$image_url_bigger=str_replace("_normal","",$image_url);

echo "<div class='tweet_box'>";
echo "<img src='";
echo $image_url_bigger;
echo "' class='profile_picture'/>";
echo "<h1>@";
print_r($response[statuses][$rand_no][user][screen_name]);
echo "</h1>";
echo "<h2>";
print_r($response[statuses][$rand_no][text]);
echo "</h2>";
echo "<h2><a href='";
print_r($response[statuses][$rand_no][entities][urls][0][expanded_url]);
echo "'>";
print_r($response[statuses][$rand_no][entities][urls][0][expanded_url]);
echo "</a></h2>";
echo "<p>";
print_r($response[statuses][$rand_no][created_at]);
echo "</p>";
echo "</div>";
?>

</div>
</div>
</body>
</html>