<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("autoload.php");
spl_autoload_register(function ($class) {
  include "Model\\$class.php";
});

include "Model/Weather_Interface.php";
include "Model/Weather.php";
ini_set('memory_limit', '-1');
$weather = new Weather();
$egyption_cities = $weather->get_cities();



 var_dump($_POST);
if (isset($_POST["city"])) {
  $city_id = $_POST["city"];
  $detailed_weather = $weather ->get_weather($city_id);
  $detailed_weather = json_decode($detailed_weather);
  echo "<h3>".$weather->get_current_time()."</h3>";
  echo "<h3>".$detailed_weather->weather[0]->description."</h3><br>";
  echo "<h3>".$detailed_weather->main->temp_min."C".
  $detailed_weather->main->temp_min."C</h3><br>";
  echo "<h3> Humidity ".$detailed_weather->main->humidity."</h3><br>";
  

    // var_dump($detailed_weather.weather[0].main);
  
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab1</title>
    </head>
    <body>
 
  <form action="" method="post">
  <h1>Weather forcast</h1>
  <select name="city" id="">
    <?php 
      foreach ($egyption_cities as $city)
      {
        echo "<option  value= ".$city['id'].">".$city["name"]."</option>";
      }
    ?>
  </select> 
  <button type = "submit">Show Weather</button>

  </form>
      <script>
      </script>
    </body>
</html>
