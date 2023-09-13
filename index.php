<?php
  // Get the full URI
  $full_path = $_SERVER["REQUEST_URI"];
  $path_parts = explode("/", $full_path);

  // Remove the unneeded parts: "/" and "index.php"
  array_splice($path_parts, 0, 2);

  // TODO: page config:
  // - path
  // - title
  // - etc
?>

<html>
  <head>
    <title>Simple Frameworkless Website</title>

    <link rel="stylesheet" href="/styles.css">
  </head>
  <body>
    <header>
      <h1>Simple Frameworkless Website</h1>
    </header>

    <?php 
      if (count($path_parts) === 0 || $path_parts[0] === "") {
        include_once("pages/home.php");
      }
      else {
        $page_path = "pages/" . implode("/", $path_parts) . ".php";
        $page_path = file_exists($page_path) ? $path_path : "pages/404.php";
        include_once($page_path);
      }
    ?>

    <footer>
      &copy; No One 2023
    </footer>
  </body>
</html>