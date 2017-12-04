<?php include("session/session.php"); ?>
<?php if($usergroup == 1) : ?>

    <head>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.2.1/b-1.4.2/b-html5-1.4.2/r-2.2.0/datatables.min.css"/>
 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.2.1/b-1.4.2/b-html5-1.4.2/r-2.2.0/datatables.min.js"></script>

	</head>
    
    
    
    <h1 class="mt-5">Benutzerverwaltung</h1>
    
    <table id="users" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>B-Key</th>
                <th>Gruppe</th>
                <th>Vorname</th>
                <th>Nachname</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>B-Key</th>
                <th>Gruppe</th>
                <th>Vorname</th>
                <th>Nachname</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
            </tr>
        </tbody>
    </table>
    
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#users').DataTable();
        } );
    </script>
    
      
<?php elseif($usergroup == 2 || $usergroup == 3 || $usergroup == 4 || $usergroup == 5) : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong>Fehler </strong> Sie haben keine Berechtigungen auf dieses Modul.
        Falls Sie dies für einen Fehler halten, wenden Sie sich bitte an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>