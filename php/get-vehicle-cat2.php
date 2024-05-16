<?php

  // Connect to the database
  mysql_connect("localhost", "user", "password") or die(mysql_error());
  mysql_select_db("name") or die(mysql_error());

  // Has the form been submitted?
  if (isset($_POST['item'])) {

    // The form has been submitted, query results
    $queryitem = "SELECT * FROM table WHERE item = '".$_POST['item']."';";

    // Successful query?
    if($result = mysql_query($queryitem))  {

      // More than 0 results returned?
      if($success = mysql_num_rows($result) > 0) {

        // For each result returned, display it
        while ($row = mysql_fetch_array($result)) echo $row[serial];
      }
      // Otherwise, no results, tell user
      else { echo "No results found."; }
    }
    // Error connecting? Tell user
    else { echo "Failed to connect to database."; }
  }
  // The form has NOT been submitted, so show the form instead of results
  else {

    // Create the form, post to the same file
    echo "<form method='post' action='example.php'>";

    // Form a query to populate the combo-box
    $queryitem = "SELECT DISTINCT item FROM table;";

    // Successful query?
    if($result = mysql_query($queryitem))  {

      // If there are results returned, prepare combo-box
      if($success = mysql_num_rows($result) > 0) {
        // Start combo-box
        echo "<select name='item'>n";
        echo "<option>-- Select Item --</option>n";

        // For each item in the results...
        while ($row = mysql_fetch_array($result))
          // Add a new option to the combo-box
          echo "<option value='$row[item]'>$row[item]</option>n";

        // End the combo-box
        echo "</select>n";
      }
      // No results found in the database
      else { echo "No results found."; }
    }
    // Error in the database
    else { echo "Failed to connect to database."; }

    // Add a submit button to the form
    echo "<input type='submit' value='Submit' /></form>";
  }
?>