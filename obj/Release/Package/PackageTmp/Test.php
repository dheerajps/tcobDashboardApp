<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="description" content="CONTENT">
  <meta name="author" content="AUTHOR">
  <!--<link rel="stylesheet" href="css/styles.css?v=1.0">-->
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script>
      $(document).ready(function () {
          $.ajax({
              type: "GET",
              url: "Services/GetDashboard.php?id=<?php echo $_GET['id'] ?>&mode=<?php echo $_GET['mode'] ?>",
              dataType: 'html',
              success: function (msg) {
                  $("#results").html(msg);
              }
          });
      });
  </script>
</head>
<body>
  <div id="results">Loading...</div>
</body>
</html>



