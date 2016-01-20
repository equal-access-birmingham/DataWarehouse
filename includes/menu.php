    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/css/titlespacing.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">EAB Database</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
<?php
if ($login->isUserLoggedIn() == true) {
    echo "
            <li><a href=\"newpatientform.php\">New Patient</a></li>
            <li><a href=\"select_patient.php\">Returning Patient</a></li>";
}
if ($permissions->isUserAdmin() == true)  {
	echo"
            <li><a href=\"viewdata.php\">View Patients</a></li>
            <li><a href=\"admin.php\">Administration</a></li>";
} ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if ($login->isUserLoggedIn() == true) echo "<li><a href=\"index.php?logout\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> Logout</a>"; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <div class="container">