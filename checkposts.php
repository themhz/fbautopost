<?php
$date = new DateTime();
require_once 'db2.php';  
$stmt = $pdo->prepare("SELECT * FROM Ld6irglhf_autoposts_scheduleintervalpost     ");
$stmt->execute();
$posts = $stmt->fetchAll();

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
                