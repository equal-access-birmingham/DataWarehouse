
<?php require_once("includes/header_require_admin.php"); ?>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>View and Download EAB Patient Data</title>

<?php require_once("includes/menu.php"); ?> 
    
    <h1 style="margin-bottom: 20px">Research Data Sets for Download</h1>
    <div class="row text-center data-btn-row">
      <div class="col-sm-3">
        <a href="view_patientdemographics.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Patient Demographics Data
          </div>
        </a>
      </div>
      <div class="col-sm-3">
        <a href="view_patientsocialhistory.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Patient Social History Data
          </div>
        </a>
      </div>
      <div class="col-sm-3">
      <a href="view_patientvisitinfo.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Patient Visit Information Data
          </div>
        </a>        
      </div>
      <div class="col-sm-3">
        <a href="view_mammogram.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Date of Last Mammogram
          </div>
        </a>
      </div>
    </div>

    <div class="row text-center data-btn-row">
      <div class="col-sm-3">
        <a href="view_sti.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Date of Last Sexually Transmitted Infection
          </div>
        </a>
      </div>
      <div class="col-sm-3">
        <a href="view_colonoscopy.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Date of Last Colonoscopy
          </div>
        </a>
      </div>
      <div class="col-sm-3">
        <a href="view_papsmear.php" class="data-btn-anchor" target="_blank">
          <div class="data-btn-container">
            Date of Last Pap Smear
          </div>
        </a>
      </div>
    </div>

    <p class="lead">These data sets provide some basic information dumps from the database for use in research.  However, if you are interested in getting a different data format or an answer to a more complicated research question, please contact <a href="mailto:eabitteam@gmail.com">eabitteam@gmail.com</a></p>

<?php require_once("includes/footer.php"); ?>