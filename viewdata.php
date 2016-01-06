
<?php require_once("includes/header_require_admin.php"); ?>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>View and Download EAB Patient Data</title>

<?php require_once("includes/menu.php"); ?> 
    
    <h1>Please select the data sets you would like to view and download for further analysis</h1>
    <p><a href="view_patientdemographics.php" class="btn btn-info btn-sm" target="_blank">Patient Demographics Data</a></p>
    <p><a href="view_patientsocialhistory.php" class="btn btn-info btn-sm" target="_blank">Patient Social History Data</a></p>
    <p><a href="view_patientvisitinfo.php" class="btn btn-info btn-sm" target="_blank">Patient Visit Information Data</a></p>
    <p><a href="view_mammogram.php" class="btn btn-info btn-sm" target="_blank">Date of Last Mammogram</a></p>
    <p><a href="view_sti.php" class="btn btn-info btn-sm" target="_blank">Date of Last Sexually Transmitted Infection</a></p>
    <p><a href="view_colonoscopy.php" class="btn btn-info btn-sm" target="_blank">Date of Last Colonoscopy</a></p>
    <p><a href="view_papsmear.php" class="btn btn-info btn-sm" target="_blank">Date of Last Pap Smear</a></p>

<?php require_once("includes/footer.php"); ?>