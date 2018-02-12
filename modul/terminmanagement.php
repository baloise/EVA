<?php include("session/session.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">Terminmanagement</h1>
    <p></p>
    
    <hr/>
    
    <p>Zeitraum: 01.01.2017 - 31.12.2017</p>
    
    <div class="scrollable-table">
        <table class="table table-sm table-striped table-header-rotated">
          <thead>
            <tr>
              <!-- First column header is not rotated -->
              <th></th>
              <!-- Following headers are rotated -->
              <th class="rotate-45"><div><span>Verhaltensziele Vereinbarung 31.12.2017</span></div></th>
              <th class="rotate-45"><div><span>Verhaltensziele Bewertung 31.12.2017</span></div></th>
              <th class="rotate-45"><div><span>Column header 3</span></div></th>
              <th class="rotate-45"><div><span>Column header 4</span></div></th>
              <th class="rotate-45"><div><span>Column header 5</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
              <th class="rotate-45"><div><span>Column header 6</span></div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="row-header">Elia Reutlinger</th>
              <td><input checked="checked" name="column1[]" type="checkbox" value="row1-column1"></td>
              <td><input checked="checked" name="column2[]" type="checkbox" value="row1-column2"></td>
              <td><input name="column3[]" type="checkbox" value="row1-column3"></td>
              <td><input name="column4[]" type="checkbox" value="row1-column4"></td>
              <td><input name="column5[]" type="checkbox" value="row1-column5"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
            </tr>
            <tr>
              <th class="row-header">Jakob Abraham</th>
              <td><input checked="checked" name="column1[]" type="checkbox" value="row1-column1"></td>
              <td><input checked="checked" name="column2[]" type="checkbox" value="row1-column2"></td>
              <td><input name="column3[]" type="checkbox" value="row1-column3"></td>
              <td><input name="column4[]" type="checkbox" value="row1-column4"></td>
              <td><input name="column5[]" type="checkbox" value="row1-column5"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
            </tr>
            <tr>
              <th class="row-header">Tim Labbl</th>
              <td><input checked="checked" name="column1[]" type="checkbox" value="row1-column1"></td>
              <td><input checked="checked" name="column2[]" type="checkbox" value="row1-column2"></td>
              <td><input name="column3[]" type="checkbox" value="row1-column3"></td>
              <td><input name="column4[]" type="checkbox" value="row1-column4"></td>
              <td><input name="column5[]" type="checkbox" value="row1-column5"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
              <td><input name="column6[]" type="checkbox" value="row1-column6"></td>
            </tr>
          </tbody>
        </table>
    </div>
    
      
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <h1 class="mt-5">Alle IT-Module</h1>
    <p>Sie sind Informatik-Lehrling</p>

<?php elseif($session_usergroup == 4) : ?>

    <h1 class="mt-5">Alle KV-Module</h1>
    <p>Sie sind KV-Lehrling</p>

<?php elseif($session_usergroup == 5) : ?>

    <h1 class="mt-5">Alle Module</h1>
    <p>Sie sind Superuser</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>