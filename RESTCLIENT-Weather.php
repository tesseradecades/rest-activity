<html>
 <body>

<?php
// Description: Create a RESTful client to read the API from another site
// Use GETs to read weather info
$apiUrl = 'https://weatherapiactivity.herokuapp.com/RESTAPI-Weather.php';
$clientUrl = 'https://www.se.rit.edu/~nwe8978/swen-344/rest-activity/RESTCLIENT-Weather.php';
//var_dump($apiUrl);
if (isset($_GET["action"]) && isset($_GET["zip"]) && $_GET["action"] == "get_weather") 
{
  $weather_info = file_get_contents($apiUrl . '?action=get_weather&zip=' . $_GET["zip"]);
  $weather_info = json_decode($weather_info, true);
  ?>


    <!-- Buld the table to display the data in
          Notice how the person_info variables are being passed in.      
    -->
    <table border ="1">
      <tr>
        <td>Zip Code: </td><td> <?php echo $weather_info["zip"] ?></td>
      </tr>
      <tr>
        <td>Name: </td><td> <?php echo $weather_info["name"] ?></td>
      </tr>
      <tr>
        <td>Forecast: </td><td> <?php echo $weather_info["forecast"] ?></td>
      </tr>
	<tr>
		<td>Image: </td><td><img src=<?php echo $weather_info["image"] ?>></td>
	</tr>
    </table>
    <br />

    <!-- Create a basic link to return to the previous page -->
    <a href=<?php echo $clientUrl.'?action=get_weather_list' ?> alt="weather list">Return to the weather list</a>
  <?php
}
else // else take the weather list
{
  // Create the weather list
  $weather_list = file_get_contents($apiUrl . '?action=get_weather_list');
  // Retrieve & decode the necessary JSON information
  $weather_list = json_decode($weather_list, true);
  ?>
    <ul>
    <?php foreach ($weather_list as $weather): ?>
      <li>
        <!-- Loop through the list and create the links-->
        <a href=<?php echo $clientUrl."?action=get_weather&zip=" . $weather["zip"]  ?> alt=<?php echo "weather_" . $weather["zip"] ?>><?php echo $weather["name"] ?></a>
    </li>
    <?php endforeach; ?>
    </ul>
  <?php
} ?>
 </body>
</html>
