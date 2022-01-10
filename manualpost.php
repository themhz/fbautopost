<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST" >
        <table>
            <tr>
              <td>Διεύθυνση άρθρου</td><td><input type="text" value="https://epenthitis.gr/cnn-%ce%b1%cf%85%cf%84%ce%ac-%ce%b5%ce%af%ce%bd%ce%b1%ce%b9-%cf%84%ce%b1-22-%ce%ba%ce%b1%ce%bb%cf%8d%cf%84%ce%b5%cf%81%ce%b1-%ce%bd%ce%ad%ce%b1-%ce%be%ce%b5%ce%bd%ce%bf%ce%b4%ce%bf%cf%87%ce%b5%ce%af/" name="link"></td>
            </tr>
            <tr>
              <td>app_id</td><td><input type="text" value="3085639764993420" name="app_id"></td>
            </tr>
            <tr>
              <td>app_secret</td><td><input type="text" value="94eb93aacdfab8a0347ce4e631fdc327" name="app_secret"></td>
            </tr>
            <tr>
              <td>default_access_token</td><td><input type="text" value="EAAr2X34Y5YwBAAhfxgiG4kILJ8ZBKldkgJOZCVIDRWvdFmFa9LEFtj9bN48kRJbyyeVaNIiIimRler4WXtZBlQxDfsMrbYXVT3tBCNG93tcS0oOK8QSL21T2ZCQP9Ixizn2uRYXZBo4hPFCHwec6OG54vS8dJZAFh3XzCh5mZChfZAPA7eys1bjZB" name="default_access_token"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="post" name="submit"/>
                  </td>
            </tr>
        </table>       
    </form>
</body>
</html>

<?php

require_once __DIR__ . '/vendor/autoload.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "submiting...started";

  $link = $_REQUEST["link"];//'https://epenthitis.gr/cnn-%ce%b1%cf%85%cf%84%ce%ac-%ce%b5%ce%af%ce%bd%ce%b1%ce%b9-%cf%84%ce%b1-22-%ce%ba%ce%b1%ce%bb%cf%8d%cf%84%ce%b5%cf%81%ce%b1-%ce%bd%ce%ad%ce%b1-%ce%be%ce%b5%ce%bd%ce%bf%ce%b4%ce%bf%cf%87%ce%b5%ce%af/';
  $app_id = $_REQUEST["app_id"];//'3085639764993420';  
  $app_secret = $_REQUEST["app_secret"]; //'94eb93aacdfab8a0347ce4e631fdc327';
  $default_access_token = $_REQUEST["default_access_token"]; //'EAAr2X34Y5YwBAAhfxgiG4kILJ8ZBKldkgJOZCVIDRWvdFmFa9LEFtj9bN48kRJbyyeVaNIiIimRler4WXtZBlQxDfsMrbYXVT3tBCNG93tcS0oOK8QSL21T2ZCQP9Ixizn2uRYXZBo4hPFCHwec6OG54vS8dJZAFh3XzCh5mZChfZAPA7eys1bjZB';

  $fb = new \Facebook\Facebook([
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.10',
    'default_access_token' => $default_access_token, // optional
  ]);

  //Post property to Facebook
  $linkData = [
      'link' => $link,
      'message' => ''
    ];    
    
    try {
      $response = $fb->post('/me/feed', $linkData, $default_access_token);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: '.$e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: '.$e->getMessage();
      exit;
    }
    $graphNode = $response->getGraphNode();

    echo "success post";

}






// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

// try {
//   // Get the \Facebook\GraphNodes\GraphUser object for the current user.
//   // If you provided a 'default_access_token', the '{access-token}' is optional.
//   $response = $fb->get('/me', 'EAAr2X34Y5YwBACsbMbSCFAFrJtmvKdorg0LyuTZCnHctUkrfXgidV7x9ZB3UiNv6qXmjyZARvHFwmUbyZAOnq9o5X60SH2UoEEFJ1M7ISLWc6MeonhtkZAZAY1FcKUBnvjTt4hNovZAOcNhX36tQihFBrPVRCNDm04ZCVtKZARIRhxwZDZD');
// } catch(\Facebook\Exceptions\FacebookResponseException $e) {
//   // When Graph returns an error
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch(\Facebook\Exceptions\FacebookSDKException $e) {
//   // When validation fails or other local issues
//   echo 'Facebook SDK returned an error: ' . $e->getMessage();
//   exit;
// }

// $me = $response->getGraphUser();
// echo 'Logged in as ' . $me->getName();


//https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=3085639764993420&client_secret=94eb93aacdfab8a0347ce4e631fdc327&fb_exchange_token=EAAr2X34Y5YwBAGRvy1NzGNW0N7gj1QCPakYrBUaZC8kP6ephSBRHv9jBJRAW5ZAXRufcmjZASiBywgfkHUJZBrZAJZAJ7a4JTsuRM6Lagzozs73ft1bd8l5jiMUWoI1naDOYLhp1nGD1lcLdZCdhCwf8xbXtxx1gD7NhQbZBbN4jpam6dGMezZBglI7msEauZCIenWtrnvjb8fkBMfQ9AiXSDZAVRZCgqgfpWajhBx0YlbCJuwIEAxDSEQxJ