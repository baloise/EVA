<h1 class="mt-5">Eva-Grades</h1>
<div class="row">
    <div class="col-12 text-center">
        <p>
            Welcome! Here you can import your generated evaGrades.json to see them in a better layout.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
        <?php 
            if(isset($_POST["deliverFile"])){
                echo "<input type='hidden' id='delivery' value='".$_POST["deliverFile"]."' />";                
            }
        ?>
        <br/><br/>
        <input type="file" id="uploadedFile" />
    </div>
    <div class="col-12">
        <div id="gradesContent">

        </div>
    </div>
</div>
