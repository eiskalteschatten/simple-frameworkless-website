<?php require_once("page_config.php"); ?>

<!DOCTYPE html>
<html lang="en">
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

    <script src="/assets/js/scripts.js" async></script>

    <?php
      if (isset($page_config["scripts"])) {
        foreach ($page_config["scripts"] as $script) {
          echo "<script src=\"/assets/js/" . $script[0] . "\" $script[1]></script>";
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
  </body>
</html>
