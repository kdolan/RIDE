<?php   

function notify($username, $notification)
{
  
    ////////////////////
    //-----CONFIG-----//
    $apiKey = 'uRt0Tj8ZqX3KuUVb';
    ////////////////////
    $notification = str_replace(' ','+',$notification);
    $url = "http://csh.rit.edu/~kdolan/notify/apiBridge.php?username=".$username."&notification=".$notification."&apiKey=".$apiKey;
   // echo $url;
    $ch = curl_init($url);
    curl_exec($ch);
    curl_close($ch);
}

?>