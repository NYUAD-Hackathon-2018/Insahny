<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<div id="results"></div>

</body>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script>
  	$( document ).ready(function() {
    alert( "ready!" );
    $('#results').load("getQr.php");
});
  </script>
</html>