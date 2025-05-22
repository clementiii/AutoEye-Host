<?php
// This file helps diagnose CSS loading issues

// Check if style.css exists and is readable
$styleCSS = __DIR__ . '/css/style.css';
$bootstrapCSS = __DIR__ . '/css/bootstrap.min.css';

echo "<!DOCTYPE html>
<html>
<head>
    <title>CSS Test</title>
</head>
<body>
    <h1>CSS File Test</h1>
    <ul>";

echo "<li>style.css: " . (file_exists($styleCSS) ? "EXISTS" : "NOT FOUND") . "</li>";
echo "<li>bootstrap.min.css: " . (file_exists($bootstrapCSS) ? "EXISTS" : "NOT FOUND") . "</li>";

echo "</ul>
    <h2>Directory Structure</h2>
    <pre>";
    
// Print directory structure
function listDir($dir, $indent = 0) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        echo str_repeat(' ', $indent * 4) . $file . PHP_EOL;
        if (is_dir($dir . '/' . $file)) {
            listDir($dir . '/' . $file, $indent + 1);
        }
    }
}

listDir(__DIR__);

echo "</pre>

<h2>CSS Link Tests</h2>
<p>The following links should show CSS files if they're accessible:</p>
<ul>
    <li><a href='css/style.css' target='_blank'>css/style.css (relative)</a></li>
    <li><a href='/css/style.css' target='_blank'>/css/style.css (root)</a></li>
    <li><a href='/autoeye/css/style.css' target='_blank'>/autoeye/css/style.css (autoeye subdirectory)</a></li>
</ul>

</body>
</html>";
?>
