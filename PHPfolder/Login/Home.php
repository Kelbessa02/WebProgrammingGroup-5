<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css\homeStyle.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="headerWrapper">
        <div class="logo">
           <p>Group5</p>
         </div>
        <header>
         <ul>
           <li><a href="DisplayOnbrowser.php">Your Data</a></li>
           <li><a href="LoginForm.php">Logout</a></li>
           <li><a href="SignupForm.php">Signup</a></li>
          <li><a href="../../Web Folder/index.html">Home</a></li>
          <li><a href="Update.php">Update</a></li>
        </ul>
      </header>
    </div>

    <div class="home">
        <p class="p1">
         You Are Registered Successfully Now.
        </p>
            
        <p class="p2">
         Welcome To Our Website. You Can Access Your Data.
        </p>

        <!-- Placeholder for AJAX content -->
        <div id="ajax-content">
            <!-- Content loaded via AJAX will be inserted here -->
        </div>

        <!-- Button to trigger AJAX request -->
        <button id="load-data">Load Data</button>
    </div>

    <footer>
        <p>
        All rights reserved © 2025 Group5 Student
        </p>
    </footer>

    <script>
        $(document).ready(function() {
            // AJAX request when the button is clicked
            $('#load-data').click(function() {
                $.ajax({
                    url: 'fetchData.php', // URL to the server-side script
                    type: 'GET', // HTTP method
                    dataType: 'html', // Expected data type
                    success: function(response) {
                        // Insert the fetched data into the div
                        $('#ajax-content').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        $('#ajax-content').html('<p>Error loading data.</p>');
                        console.error(Loading);
                    }
                });
            });
        });
    </script>
</body>
</html>