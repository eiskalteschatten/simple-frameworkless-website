<?php
  // Get the full URI and break it apart
  $full_path = rtrim($_SERVER["REQUEST_URI"], "/");
  $path_parts = explode("/", $full_path);

  // Remove the unneeded parts: "/" and "index.php"
  array_splice($path_parts, 0, 2);

  $pages_config = array(
    "home" => array(),
    "test" => array(
      "title" => "Test Page 1"
    ),
    "deeper/test" => array(
      "title" => "Test Page 2"
    ),
    "404" => array(
      "title" => "Page Not Found"
    )
  );

  $page_key = count($path_parts) === 0 || $path_parts[0] === "" ? "home" : implode("/", $path_parts);
  $page_path = "pages/" . $page_key . ".php";
  
  if (!file_exists($page_path)) {
    $page_key = "404";
    $page_path = "pages/404.php";
  }
  
  $page_config = $pages_config[$page_key];
?>

<html>
  <head>
    <title><?php if (isset($page_config["title"])) echo $page_config["title"] . " | "; ?> Simple Frameworkless Website</title>

    <link rel="stylesheet" href="/styles.css">
  </head>
  <body>
    <header>
      <h1>Simple Frameworkless Website</h1>
    </header>

    <?php include_once($page_path); ?>

    <footer>
      &copy; No One 2023
    </footer>
  </body>
</html>