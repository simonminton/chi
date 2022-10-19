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
    </head>
    <body class="bg-black">
        <div class="text-white py-2 font-bold text-center">SOUTH KENSINGTON</div>
<ul class="bg-gray-900 px-4 md:px-8 py-6 max-w-md w-full mx-auto font-mono">
    <?php
$file = file_get_contents('https://api.tfl.gov.uk/Line/district/Arrivals/940GZZLUSKS?direction=inbound&destinationStationId=940GZZLURMD');
// Decode the JSON into an associative array
$data = json_decode($file, true);
// Print the date from the associative array
foreach($data as $train) {
    echo "<li class='bg-gray-800 p-2 text-amber-500 uppercase m-2 flex flex-row flex-wrap'>";
    // Convert the seconds into a human readable format
    $init =  $train['timeToStation'];
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;
if($seconds < 10) {
    $seconds = '0' . $seconds;
}

    $time = "$minutes:$seconds";
    echo '<div class="flex-1 ">KEW GARDENS</div>';
    echo '<div class="flex-0 "><span class="text-xs">in</span> '.$time . '</div>';
    echo '<div class="w-full text-amber-400 text-xs">'.$train['currentLocation']."</div></li>";
}
?>

    </body>
</html>