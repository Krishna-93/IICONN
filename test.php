
<html>
  <head>
    <script src="js/jquery-2.2.1.min.js"></script>
  </head>

  <body>
<input type="checkbox" name="action1" id="action1" title="Action 1" value="1"/>


<script>
$("#action1").click(function () {
  // alert(1)
  var value = $("#action1").val();
  $.ajax({
      type: "POST",
      url: "test1.php",
      async: true,
      data: {
          action1: value // as you are getting in php $_POST['action1']
      },
      success: function (msg) {
        msg = $.trim(msg);
        if(msg=1){
          window.location.reload();
        }
        else{
          
        }

      }
  });
});
</script>
  </body>
</html>
