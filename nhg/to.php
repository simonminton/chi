<?php
error_reporting(0);
?>
<html>
    <head>
        <title>Trains To Richmond</title>
        <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="15">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/css/style.css">
    </head>
    <body class="bg-black">
        <div class="text-gray-200 pt-2 pb-1 font-bold text-center">SOUTH KENSINGTON</div>
        <div class="text-gray-200 pb-2 text-sm font-bold text-center">Circle to NHG</div>
<ul class="bg-gray-900 rounded-md px-4 md:px-8 py-6 max-w-md w-full mx-auto dotmatrix">
    <?php
$file = file_get_contents('https://api.tfl.gov.uk/Line/circle/Arrivals/940GZZLUSKS?direction=inbound&destinationStationId=940GZZLUERC');
// Decode the JSON into an associative array
$data = json_decode($file, true);
// Reorder by time to station
usort($data, function($a, $b) {
    return $a['timeToStation'] <=> $b['timeToStation'];
});
// Print the date from the associative array
foreach($data as $train) {
    echo "<li class='rounded-sm bg-gray-800 p-2 text-amber-500 uppercase m-2 flex flex-row flex-wrap'>";
    // Convert the seconds into a human readable format
    $init =  $train['timeToStation'];
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;
if($seconds < 10) {
    $seconds = '0' . $seconds;
}
// remove "underground Station"
$destination = str_replace(" Underground Station", "", $train['destinationName']);
$destination = str_replace(" (Circle Line)", "", $destination);

    $time = "$minutes:$seconds";
    echo '<div class="flex-1 ">'.  $destination.'</div>';
    echo '<div class="flex-0 "><span class="text-xs">in</span> '.$time . '</div>';
    echo '<div class="w-full text-amber-400 text-xs">'.$train['currentLocation']."</div></li>";
}
?>

    </body>
</html>