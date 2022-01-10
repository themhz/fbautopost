<?php

if(date("G") >= 11)      // or >10
{
  // current time is greater than 11:00 AM
  exit();
}




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';  
require_once "../db.php";
$stmt = $pdo->prepare("SELECT * FROM Ld6irglhf_autoposts_scheduleintervalpost
where posted > 0
order by posted desc
limit 1;
");
$stmt->execute();
$posts = $stmt->fetchAll();
if ($stmt->rowCount() > 0) {
  $stmt = $pdo->prepare("update Ld6irglhf_autoposts_scheduleintervalpost set posted = posted-1
where id = ".$posts[0]["id"]);
$stmt->execute();

$stmt = null;
?>

<table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>            
            <th scope="col">Url</th>
			<th scope="col">posted</th>
            </tr>
        </thead>
        <tbody>
            
            <?php  
                $i = 1;
				
				echo "submiting...started";

				  $link = $posts[0]["url"];//'https://epenthitis.gr/cnn-%ce%b1%cf%85%cf%84%ce%ac-%ce%b5%ce%af%ce%bd%ce%b1%ce%b9-%cf%84%ce%b1-22-%ce%ba%ce%b1%ce%bb%cf%8d%cf%84%ce%b5%cf%81%ce%b1-%ce%bd%ce%ad%ce%b1-%ce%be%ce%b5%ce%bd%ce%bf%ce%b4%ce%bf%cf%87%ce%b5%ce%af/';
				  $app_id = '3085639764993420';//'3085639764993420';  
				  $app_secret = '94eb93aacdfab8a0347ce4e631fdc327'; //'94eb93aacdfab8a0347ce4e631fdc327';
				  $default_access_token = 'EAAr2X34Y5YwBAAhfxgiG4kILJ8ZBKldkgJOZCVIDRWvdFmFa9LEFtj9bN48kRJbyyeVaNIiIimRler4WXtZBlQxDfsMrbYXVT3tBCNG93tcS0oOK8QSL21T2ZCQP9Ixizn2uRYXZBo4hPFCHwec6OG54vS8dJZAFh3XzCh5mZChfZAPA7eys1bjZB'; //'EAAr2X34Y5YwBAAhfxgiG4kILJ8ZBKldkgJOZCVIDRWvdFmFa9LEFtj9bN48kRJbyyeVaNIiIimRler4WXtZBlQxDfsMrbYXVT3tBCNG93tcS0oOK8QSL21T2ZCQP9Ixizn2uRYXZBo4hPFCHwec6OG54vS8dJZAFh3XzCh5mZChfZAPA7eys1bjZB';

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
				
                foreach($posts as $post){                     
                    ?>                    
                    <tr>
                        <th scope="row">
                            <?php echo $post["id"];?>                            
                        </th>                        
                        <td>
                            <a target="__blank" href="<?php echo $post["url"]; ?>"><?php echo $post["url"]; ?></a>                            
                        </td>                                          
						<td><?php echo $post["posted"]; ?></td>
                    </tr>
                <?php 
                $i++;
            } ?>            
        </tbody>
    </table>
	<?php
} else {
   echo 'nothing to post';
}



	
	
	