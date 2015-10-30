@extends('layouts.admin')

@section('content')
    <?php
       date_default_timezone_set('GMT');
	   ini_set('display_errors', 1);
	   error_reporting(~0);
        $user = Auth::user(); 
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-lg-2">
                    <img src="{{$user->avatar}}" alt="Avatar {{$user->name}}" class="img-thumbnail img-responsive">
                </div>
                <div class="col-lg-10">
                    <ul>
                    <li>Usuario: {{$user->name}}</li>
                    <li>Token:</li>
                    </ul>
                    
                </div>
                
                </div>
                </div>
        </div>
    
@stop


<?php
                $appID = '418570198235010';
                $appSecret = '7ab2a76b4f35cb3bdc114f456b7370de';
                $mensaje = 'Sporst & Marketing te invita a participar en la próxima "Carrera San Silvestre 2015" , éste 31 de diciembre más información en www.sportsandmarketing.com , ¡¡Te esperamos!!';
            
                /*'client_id' => '1717236581833733',
                'client_secret' => '4877a8fb27f065dbf3a8315821fe6195',*/
                    
                
            
                //GET FACEBOOK TOKEN
                    /*$app_token_url = "https://graph.facebook.com/oauth/access_token?"
                                        . "client_id=" . $appID //*** $gral->appID
                                        . "&client_secret=" . $appSecret //*** $gral->appSecret 
                                        . "&grant_type=client_credentials";*/

                    //$response = file_get_contents($app_token_url);
                    
                    $params = $user->social_token;
                    //parse_str($response, $params);	
                    $fb_token_app = $params;
                    
                    // POST ON USER WALL 
                    $status = $mensaje;
                    $facebook_id = trim($user->id_social);
                    $acces_token = $fb_token_app;
                    $params = http_build_query(array('message'=>$status, 'access_token'=>$fb_token_app));
                    $url = "https://graph.facebook.com/$facebook_id/feed?$params";
                    $curlResult = httpGetCURL($url);
                    //dd($curlResult);
                
                
                 
                
                
                
                    function httpGetCURL($url)
                    {
                        $curl = curl_init($url);

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_VERBOSE, true);
                        curl_setopt($curl, CURLOPT_POST, true);

                        $result = curl_exec($curl);
                        curl_close($curl); 

                        return trim($result);
                    }	
                
                ?>