<?php
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        var_dump($_POST['id']);
        var_dump($_POST['value']);
    } else {
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<input type="checkbox" name="1" id="1" data-toggle="toggle" data-onstyle="default"  data-width="500%" >
<input type="checkbox" name="2" id="2" data-toggle="toggle" data-onstyle="default"  data-width="500%" >
<input type="checkbox" name="3" id="3" data-toggle="toggle" data-onstyle="default"  data-width="500%" >
<input type="checkbox" name="4" id="4" data-toggle="toggle" data-onstyle="default"  data-width="500%" >

<script>
    $('input[type="checkbox"]').on('click', function(){
        console.log("CLCIK");
        
        var data = {};
        data.id = $(this).attr('id');
        data.value = $(this).is(':checked') ? 1 : 0;

        console.log(data);

        $.ajax({
            type: "POST",
            url: "test.php",
            data: data,
        }).done(function(data) {
                console.log(data);
        });
    });

</script>

<?php } ?>
