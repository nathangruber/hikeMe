<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
		<script type="text/javascript"src="https://maps.googleapis.com/maps/pi/js?client=2bd428fa9cf856303ff450f01f4a97de"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
      

   $(document).ready(function(){
      $( "#find" ).keyup(function(){
         fetch();
      });
   });

   function fetch()
   {
   
      var val = document.getElementById( "find" ).value;
      $.ajax({
         type: 'post',
         url: 'fetch.php',
         data: {
            get_val:val
         },
         success: function (response) {
            document.getElementById( "search_items" ).innerHTML = response; 
         }
      });

   }
</script>
</head>