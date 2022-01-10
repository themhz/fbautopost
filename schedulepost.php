<?php
    require_once 'db.php';  
    $stmt = $pdo->prepare("SELECT * FROM Ld6irglhf_autoposts order by id desc");
    $stmt->execute();
    $posts = $stmt->fetchAll();
?>
<div class="wraper">    
    <div class="form">
        <form action="controllers/createpostindb.php" method="post">
            <input type="text" value="" id="txturl" name="txturl"/>
            <input type="date" id="txtdate" name="txtdate"/>
            <input type="time" id="txttime" name="txttime"/>
            <input type="submit" value="Καταχώρηση"/>
        </form>
    </div>
    <hr>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Url</th>
            <th scope="col">Post date</th>
            <th scope="col">Posted</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
                foreach($posts as $post){                     
                    ?>                    
                    <tr>
                        <th scope="row"><?php echo $post["id"];?></th>
                        <td><?php echo $post["url"]; ?></td>
                        <td><?php echo $post["post_date"]; ?></td>
                        <td><?php echo $post["posted"]; ?></td>
                    </tr>
                <?php 
                $i++;
            } ?>            
        </tbody>
    </table>
</div>
