<?php

if(isset($_POST['doEntry']) && isset($_POST['pos'])) {
    
    if($_POST['doEntry'] == "delete"){
        echo "<script type='text/javascript'> alert('" $_POST['pos'] "'); </script>";
    }
    
    if($_POST['doEntry'] == "moveUp"){
        
    }
    
    if($_POST['doEntry'] == "moveDown"){
        
    }
    
    if($_GET['doEntry'] == "add"){
        echo "<script> alert('" $_POST['pos'] "'); </script>";
    }
    
}

?>