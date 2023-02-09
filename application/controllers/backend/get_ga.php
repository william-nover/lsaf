<?php
$this->load->library('google');
 $client_id = '435142122966-cugnm95r5e26mnd3an736blhi1kbl2nu.apps.googleusercontent.com'; //Client ID
                $service_account_name = '435142122966-cugnm95r5e26mnd3an736blhi1kbl2nu@developer.gserviceaccount.com'; //Email Address
                $key_file_location = APPPATH . 'third_party/google-api-php-client/balkat-24225845c22d.p12'; //key.p12    
                $key_file_location='';
                 $client = new Google_Client();
                 $client->setApplicationName("balkat"); 
                 $analytics = new Google_Service_Analytics($client);

                 if (isset($_SESSION['service_token'])) {
                 $client->setAccessToken($_SESSION['service_token']);
                 }
                 //mendapat data dari .p12 
                 $key = file_get_contents($key_file_location);

                $cred = new Google_Auth_AssertionCredentials(
                 $service_account_name,
                 array(
                 'https://www.googleapis.com/auth/analytics',
                 ),
                 $key,
                 'notasecret'
                 );

                 $client->setAssertionCredentials($cred);
                 if($client->getAuth()->isAccessTokenExpired()) {
                 $client->getAuth()->refreshTokenWithAssertion($cred);
                 }
                 $_SESSION['service_token'] = $client->getAccessToken();         
                //untuk page view    
                 $profileId = "ga:107280025";
                 $startDate = '2015-08-08';
                 $metrics = 'ga:visits,ga:pageviews';
                 $optParams = array("dimensions" => "ga:date");    
                 $stats = $analytics->data_ga->get($profileId, $startDate, 'today', $metrics, $optParams);

                 //untuk page traffict   
                 $metrics_trafict = 'ga:sessions';    
                 $optParams_trafict = array("dimensions" => "ga:source");  
                 $stats_trafict = $analytics->data_ga->get($profileId, $startDate, 'today', $metrics_trafict, $optParams_trafict);    

                 //untuk page city  
                 $metrics_city = 'ga:sessions';    
                 $optParams_city = array("dimensions" => "ga:city");  
                 $stats_city = $analytics->data_ga->get($profileId, $startDate, 'today', $metrics_city, $optParams_city);   
