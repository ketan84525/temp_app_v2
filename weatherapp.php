<?php

if (!empty($_POST['location'])) {
	$city=$_POST['location'];
	$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&units=metric&cnt=7&lang=en&appid=c0c4a4b4047b97ebc5948ac9c48c0559";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $response=curl_exec($ch);

    $url_current = "http://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&lang=en&appid=c0c4a4b4047b97ebc5948ac9c48c0559";
    $ch_current=curl_init();
    curl_setopt($ch_current,CURLOPT_URL,$url_current);
    curl_setopt($ch_current,CURLOPT_RETURNTRANSFER,true);
    $response_current=curl_exec($ch_current);
    
    $err_current = curl_error($ch_current);
    curl_close($ch_current);

    $err = curl_error($ch);
    curl_close($ch);

    if ($err && $err_current) {
		echo "cURL Error #:" . $err;
	} else {
        $response_val_curr = json_decode($response_current,true);
		$response_val = json_decode($response,true);
        $html ="";

        //echo "<pre>";print_r($response_val_curr);

        $html .= "<div class='row'>
        <h3 class='title text-center bordered'>Weather Report for ".$response_val_curr['name']."</h3>
        <div class='col-md-12' style='padding-left:0px;padding-right:0px;'>
            <div class='single bordered'>
                <div class='row'>
                    <div class='col-sm-9' style='font-size:20px;text-align:left;padding-left:70px;'>
                        <p class='aqi-value'> ".$response_val_curr['main']['temp_max']." °C - ".$response_val_curr['main']['temp_min']." °C</p>
                        <div class='weather-icon'>
              <p><strong>Wind Speed : </strong> ".$response_val_curr['wind']['speed']."</p>
              <p><strong>Pressue : </strong>".$response_val_curr['main']['pressure']."</p>
              <p><strong>Visibility : </strong>".$response_val_curr['visibility']."</p>
            </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>";

        try{
            if (!empty($response_val)) {
                $html .= "<br><br>
                    <div class='row'>
                        <h3 class='title text-center bordered'>7 Days Weather Forecast for ".$city."</h3>";
                        $loop=0; foreach ($response_val['list'] as $key=>$value) { $loop++;
                    $html .= "<div class='single forecast-block bordered'>
                    <h3>".date('l',$value['dt']).': '.date('Y-m-d',$value['dt'])."</h3>
                    <p style='font-size:1em;' class='aqi-value'>".$value['temp']['min']." °C - ".$value['temp']['max']." °C</p>
                    <hr style='border-bottom:1px solid #fff;'>
                    <p>".$value['weather'][0]['main']."</p>
                    </div>";
                }
                $html .= "</div>";
            }
            echo $html;
        }catch (Exception $e) {
			echo $e;
		}
    }
}
else  {
    echo "Please Enter Field";
}

?>