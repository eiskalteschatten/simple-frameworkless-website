<?php
  $pages_config = array(
    "home" => array(
      "inMainNav" => true,
      "mainNavTitle" => "Home"
    ),
    "test" => array(
      "title" => "Test Page 1",
      "scripts" => ["testscripts.js"],
      "styles" => ["teststyles.css"],
      "inMainNav" => true,
      "mainNavTitle" => "Test Page 1"
    ),
    "deeper/test" => array(
      "title" => "Test Page 2",
      "scripts" => ["testscripts.js"],
      "styles" => ["teststyles.css"],
      "inMainNav" => true,
      "mainNavTitle" => "Test Page 2"
    ),
    "404" => array(
      "title" => "Page Not Found"
    )
  );

  function parse_uri() {
    // Get the full URI and break it apart
    $full_path = rtrim($_SERVER["REQUEST_URI"], "/");
    $path_parts = explode("/", $full_path);

    // Remove the unneeded parts: "/" and "index.php"
    $amount_to_remove = isset($path_parts[1]) && $path_parts[1] === "index.php" ? 2 : 1;
    array_splice($path_parts, 0, $amount_to_remove);

    return $path_parts;
  }

  function parse_uri_string(): string {
    $path_parts = parse_uri();
    return implode("/", $path_parts);
  }

  $path_parts = parse_uri();
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

    <link rel="stylesheet" href="/assets/css/styles.css">
    
    <?php 
      if (isset($page_config["styles"])) {
        foreach ($page_config["styles"] as $styles) {
          echo "<link rel=\"stylesheet\" href=\"/assets/css/" . $styles . "\">";
        }
      }
    ?>
  </head>
  <body>
    <header>
      <h1>Simple Frameworkless Website</h1>

      <nav class="main-nav">
        <?php
          foreach ($pages_config as $key => $_page_config) {
            if (isset($_page_config["inMainNav"]) && $_page_config["inMainNav"] === true) {
              if (parse_uri_string() === $key) {
                echo "<a href=\"/" . $key . "\" class=\"selected-link\">" . $_page_config["mainNavTitle"] . "</a>";
              }
              else {
                echo "<a href=\"/" . $key . "\">" . $_page_config["mainNavTitle"] . "</a>";
              }
            }
          }
        ?>
      </nav>
    </header>

    <?php include_once($page_path); ?>

    <footer>
      &copy; No One 2023
    </footer>

    <script src="/assets/js/scripts.js"></script>
    
    <?php 
      if (isset($page_config["scripts"])) {
        foreach ($page_config["scripts"] as $script) {
          echo "<script src=\"/assets/js/" . $script . "\"></script>";
        }
      }
    ?>
  </body>
</html>