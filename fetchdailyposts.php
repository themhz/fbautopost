<?php
$date = new DateTime();
require_once 'db2.php';  
$stmt = $pdo->prepare("SELECT * FROM Ld6irglhf_posts     
    where post_status = 'publish'	
order by id desc
limit 10;
");
$stmt->execute();
$posts = $stmt->fetchAll();

?>
<form action="controllers/scheduleintervalpost.php" method="post">
<table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">Url</th>
			<th scope="col">regdate</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
                $i = 1;
                foreach($posts as $post){                     
                    ?>                    
                    <tr>
                        <th scope="row">
                            <?php echo $post["ID"];?>
                            <input type="hidden" name="fields[ <?php echo $post["ID"];?>][id]" value="<?php echo $post["ID"];?>"/>
                        </th>
                        <td><?php echo $post["post_title"]; ?></td>
                        <td>
                            <a target="__blank" href="https://epenthitis.gr/<?php echo $post["post_name"]; ?>">https://epenthitis.gr/<?php echo $post["post_name"]; ?></a>
                            <input type="hidden" name="fields[ <?php echo $post["ID"];?>][url]" value="https://epenthitis.gr/<?php echo $post["post_name"]; ?>"/>
                        </td>                                          
						<td><?php echo $post["post_date"]; ?></td>
                    </tr>
                <?php 
                $i++;
            } ?>            
        </tbody>
    </table>

            <input type="submit" value="schedule" />
    </form>