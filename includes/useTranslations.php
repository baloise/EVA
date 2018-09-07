<script type="text/javascript">
    var translate = {};
    <?php
        foreach ($translate as $key => $value) {
            echo ("translate['".$key."'] = '".$value."';");
        };
    ?>;
</script>
