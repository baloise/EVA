<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5"><?php echo $translate[250];?></h1>

    <p>
        <?php echo $translate[252]; ?>
    </p>

    <div class="form-group">
        <i class="fa fa-search" style="position: absolute; padding: 10px; right: 15px;" aria-hidden="true"></i>
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="">
    </div>

    <table class="table table-condensed" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo $translate[251]; ?></th>
            </tr>
        </thead>
        <tbody id="searchList">
            <div >

            <?php

                $list = "";

                $sql = "SELECT * FROM `tb_translation` ORDER BY `ID` DESC";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        $trClass = 'class="accordion-toggle searchRow"';

                        if($row['it'] == "" || $row['fr'] == ""){
                            if($row['it'] == "" && $row['fr'] == ""){
                                $trClass = 'class="alert-danger accordion-toggle searchRow"';
                            } else {
                                $trClass = 'class="alert-warning accordion-toggle searchRow"';
                            }
                        }

                        echo '
                        <div class="">
                            <tr data-toggle="collapse" data-target="#'.$row['ID'].'" '.$trClass.'>
                                <td>'.$row['ID'].'</td>
                                <td class="searchFor">'.$translate[$row['ID']].'</td>
                            </tr>
                            <tr >
                                <td colspan="2" class="hiddenRow">
                                    <div id="'.$row['ID'].'" class="accordian-body collapse">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="gerForm">'.$translate[140].'</label>
                                                <textarea id="gerForm" class="form-control inGerman" traEntry="'.$row['ID'].'">'.$row['de'].'</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="itaForm">'.$translate[141].'</label>
                                                <textarea id="itaForm" class="form-control inItalian" traEntry="'.$row['ID'].'">'.$row['it'].'</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="freForm">'.$translate[142].'</label>
                                                <textarea id="freForm" class="form-control inFrench" traEntry="'.$row['ID'].'">'.$row['fr'].'</textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-12" style="margin-bottom:5px;">
                                                <button class="btn btn-block changeTra" traEntry="'.$row['ID'].'">Speichern</button>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </div>
                        ';

                    }

                } else {

                }

            ?>
            </div>
        </tbody>
    </table>


    <script type="text/javascript" src="modul/uebersetzung/uebersetzung.min.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
