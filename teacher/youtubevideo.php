<?php
$video_url = "https://www.youtube.com/watch?v=DRCZdWhnyjg";

// Use the cURL library to download the video
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $video_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data = curl_exec($ch);
curl_close($ch);

// Save the video to a file
$file = fopen("video.mp4", "w+");
fputs($file, $data);
fclose($file);

echo "Video downloaded successfully!";

?>