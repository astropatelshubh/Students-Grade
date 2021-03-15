<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Student's Grade</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  </head>
  <style>
    body { font-family: times; }
    * { box-sizing: border-box; }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.9;
    }

    button:hover { opacity:1; }

    .cancelbtn {
      float: left;
      width: 50%;
      padding: 14px 20px;
      background-color: #f44336;
    }

    .container { padding: 16px; }

    hr { border: 1px solid #f1f1f1; margin-bottom: 25px; }

    @media screen and (max-width: 300px) { .cancelbtn { width: 100%; } }
  </style>
  <body>
    <form name="student" action="students.html">
      <div class="container">
        <h1>PHP-701 Grades for Fall 2018</h1>
        <hr>
        <?php
          $error_msg = "";

          if (empty($_POST['name'])) {
            $error_msg .= "<p>You must enter your name.</p>\n";
          }
          if (empty($_POST['id'])) {
            $error_msg .= "<p>You must enter your id #.</p>\n";
          }
          else if (!is_numeric($_POST['id'])) {
            $error_msg .= "<p>Your id # must be a whole number.</p>\n";
          }
          else if ($_POST['id'] < 1) {
            $error_msg .= "<p>Your id # must be a whole number.</p>\n";
          }
          if (empty($_POST['grade'])) {
            $error_msg .= "<p>You must enter your grade (enter 0 if you don't have one).</p>\n";
          }
          else if (!is_numeric($_POST['grade'])) {
            $error_msg .= "<p>Your grade must be a whole number.</p>\n";
          }
          else if (($_POST['grade'] < 0) || ($_POST['grade'] > 4)) {
            $error_msg .= "<p>Your grade must be between 0 and 4.0.</p>\n";
          }
          if (strlen($error_msg) > 0) {
            echo $error_msg;
            echo "<p>Click on the button below to return at Student's Grade form and fix these errors.</p>\n";
          }
          else {
            $Name = addslashes($_POST['name']);
            $RegistrationFile = fopen("students.txt", "ab");

            if (is_writeable("students.txt")) {
              if (fwrite($RegistrationFile, $Name . ", " . $_POST['id'] . ", " . $_POST['grade'] . "\n")) {
                echo "<p>Student's Name: " . $_POST['name'] . "</p>\n";
                echo "<p>Student's ID: " . $_POST['id'] . "</p>\n";
                echo "<p>Grade: " . $_POST['grade'] . "</p>\n";
                echo "<p>Thank you for registering!</p>\n\n";
              }
              else {
                echo "<p>Cannot store your information.</p>\n";
              }
            }
            else {
              echo "<p>Cannot write to the file.</p>\n";
            }
            fclose($RegistrationFile);
          }
        ?>
        <hr>
        <div class="clearfix">
          <button onclick="students.html" class="cancelbtn">Another Student</button>
        </div>
      </div>
    </form>
  </body>
</html>
