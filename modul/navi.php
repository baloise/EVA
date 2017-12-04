<?php include("session/session.php"); ?>
<nav class="navbar navbar-expand-lg navbar-inverse bg-color fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="img/logo.svg" width="150" alt="Logo">
		</a>
		<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                
                <?php
                    
                    $userID = ($mysqli->query("SELECT ID FROM tb_user WHERE bKey = '$username'")->fetch_assoc());
                    
                    $sql1 = "SELECT * FROM tb_ind_nav AS mg INNER JOIN tb_modul AS mm ON mm.ID = mg.tb_modul_ID WHERE mg.tb_user_ID = " . $userID['ID'] . " ORDER BY mg.position";
                    
                    $result = $mysqli->query($sql1);
                    
                    if (isset($result) && $result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $link = '
                            <li class="nav-item">
                                <a class="nav-link" href="'. $row["file_path"].'">'. $row["title"].'</a>
                            </li>
                            ';
                            echo $link;
                            
                        }
                    } else {
                        $sql2 = "SELECT * FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $usergroup";
                    
                        $result = $mysqli->query($sql2);
                        
                        if (isset($result) && $result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $link = '
                                <li class="nav-item">
                                    <a class="nav-link" href="'. $row["file_path"].'">'. $row["title"].'</a>
                                </li>
                                ';
                                echo $link;
                                
                            }
                        } else {
                            echo "0 results";
                        }
                    }
                    
                    
                
                ?>
                
			</ul>
		</div>
	</div>
</nav>  