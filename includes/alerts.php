<div class="floatAlerts">
    <div class="alert alert-danger alert-dismissible" id="errorAlert">
        <a href="#" class="close" data-dismiss="" aria-label="close">&times;</a>
        <span id="errorText"></span>
    </div>
    <div class="alert alert-success alert-dismissible" id="successAlert">
        <a href="#" class="close" data-dismiss="" aria-label="close">&times;</a>
        <span id="successText"></span>
    </div>
    <div class="alert alert-warning alert-dismissible" id="warningAlert">
        <a href="#" class="close" data-dismiss="" aria-label="close">&times;</a>
        <span id="warningText"></span>
        <button type="button" id="warningButton" style="background-color: inherit; color: #856404; border-color: #856404; margin-left: 20px; display:none;" class="btn btn-warning"><?php echo $translate[99];?></button>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.close').each(function(){
            $(this).click(function(event){
                event.preventDefault();
                $(this).parent().slideUp('fast');
            });
        })
    });
</script>
