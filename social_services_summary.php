<?php
// error_reporting(E_ALL);
// ini_set("display_errors",1);

require("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->connect_error);
?>

<?php include("includes/header_require_login.php"); ?>

    <title>Equal Access Birmingham</title>

<?php require_once("includes/menu.php"); ?>

      <h1>Social Services Summary</h1>
      <div class="row">
        <div class="col-xs-6">
          <h2>Bob Smiley</h2>
        </div>
        
        <div class="col-xs-6">
          <h2><strong>DOB</strong>: December 12, 1992</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-print-6">
          <h3>Patient Demographics</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Gender</strong></td>
                <td>Male</td>
              </tr>
              <tr>
                <td><strong>Race</strong></td>
                <td>All American</td>
              </tr>
              <tr>
                <td><strong>Ethnicity</strong></td>
                <td>Non-hispanic</td>
              </tr>
              <tr>
                <td><strong>Language</strong></td>
                <td>American</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Education</h3>
          <table class="table table-striped table-condensed">
            <tr>
              <td><strong>Highest Degree</strong></td>
              <td>PhD</td>
            </tr>
            <tr>
              <td><strong>Veteran</strong></td>
              <td>Yes</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-print-6">
          <h3>Household</h3>
          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Relationship Status</strong></td>
                <td>Married</td>
              </tr>
              <tr>
                <td><strong>Household Head</strong></td>
                <td>Yes</td>
              </tr>
              <tr>
                <td><strong>Number in Household</strong></td>
                <td>50</td>
              </tr>
              <tr>
                <td><strong>Number of Children in Household</strong></td>
                <td>Too many</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Financial Status</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Income</strong></td>
                <td>$123,123</td>
              </tr>
              <tr>
                <td><strong>Employment Status</strong></td>
                <td>Employed</td>
              </tr>
              <tr>
                <td><strong>Disability</strong></td>
                <td>No</td>
              </tr>
              <tr>
                <td><strong>SNAP (Foodstamps)</strong></td>
                <td>No</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-print-6">
          <h3>Smoking, Alcohol, and Recreational Drugs</h3>
          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Smoking Status</strong></td>
                <td>Smoker</td>
              </tr>
              <tr>
                <td><strong>Years Smoking</strong></td>
                <td>32.41</td>
              </tr>
              <tr>
                <td><strong>Packs per Day</strong></td>
                <td>2.3</td>
              </tr>
              <tr>
                <td><strong>Years since Quitting</strong></td>
                <td>0</td>
              </tr>
              <tr>
                <td><strong>Amount of Alcohol Consumption</strong></td>
                <td>6</td>
              </tr>
              <tr>
                <td><strong>Recreational Drug Use</strong></td>
                <td>None</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Healthcare Access</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Health Insurance</strong></td>
                <td>Of course not</td>
              </tr>
              <tr>
                <td><strong>Health First Card</strong></td>
                <td>my health is always first</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <h3 style="margin-bottom: 50px">Social Services Note (<?php echo (new DateTime("now"))->format("m/d/Y"); ?>)</h3>

<?php require_once("includes/footer.php"); ?>