<?php

$pages_config = array(
  "home" => array(
    "inMainNav" => true,
    "mainNavTitle" => "Home"
  ),
  "test" => array(
    "title" => "Test Page 1",
    "scripts" => [
      ["testscripts.js", "async"]
    ],
    "styles" => ["teststyles.css"],
    "inMainNav" => true,
    "mainNavTitle" => "Test Page 1"
  ),
  "deeper/test" => array(
    "title" => "Test Page 2",
    "scripts" => [
      ["testscripts.js", "defer"]
    ],
    "styles" => ["teststyles.css"],
    "inMainNav" => true,
    "mainNavTitle" => "Test Page 2"
  ),
  "deeper" => array(
    "title" => "Test Page 3",
    "scripts" => [
      ["testscripts.js", "defer"]
    ],
    "styles" => ["teststyles.css"],
    "inMainNav" => true,
    "mainNavTitle" => "Test Page 3"
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
  $page_path = "pages/" . $page_key . "/index.php";
}

if (!file_exists($page_path)) {
  $page_key = "404";
  $page_path = "pages/404.php";
}

$page_config = $pages_config[$page_key];
