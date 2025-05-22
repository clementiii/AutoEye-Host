<?php
// URL Routing Test Script

echo "<!DOCTYPE html>
<html>
<head>
    <title>URL Routing Test</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #121212;
            color: white;
        }
        h1, h2 { color: #FFD700; }
        pre { 
            background-color: #1E1E1E; 
            padding: 15px;
            border: 1px solid #FFD700;
            overflow: auto;
        }
        .success { color: lightgreen; }
        .error { color: #ff6b6b; }
        table { 
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #FFD700;
            padding: 8px;
            text-align: left;
        }
        th { background-color: #262626; }
        .test-link {
            display: inline-block;
            margin: 5px;
            padding: 5px 10px;
            background: linear-gradient(135deg, #FFD700, #B8860B);
            border: none;
            color: #121212;
            font-weight: bold;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>URL Routing Test</h1>";

// Server information
echo "<h2>Server Environment</h2>";
echo "<pre>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "</pre>";

// .htaccess check
echo "<h2>.htaccess Status</h2>";
if (file_exists('.htaccess')) {
    echo "<p class='success'>.htaccess file exists</p>";
    echo "<pre>" . htmlspecialchars(file_get_contents('.htaccess')) . "</pre>";
} else {
    echo "<p class='error'>.htaccess file not found!</p>";
}

// File existence check
echo "<h2>PHP Files Check</h2>";
echo "<table>";
echo "<tr><th>File</th><th>Status</th></tr>";

$files = ['index.php', 'collatz.php', 'fibonacci.php', 'euclidean.php', 'tribonacci.php', 'lucas.php', 'pascal.php'];
foreach ($files as $file) {
    echo "<tr>";
    echo "<td>$file</td>";
    echo "<td>" . (file_exists($file) ? "<span class='success'>Exists</span>" : "<span class='error'>Missing</span>") . "</td>";
    echo "</tr>";
}
echo "</table>";

// Link Test
echo "<h2>Navigation Link Test</h2>";
echo "<p>Click these links to test if the pages load correctly:</p>";

foreach ($files as $file) {
    if ($file !== 'index.php') {
        echo "<a href='$file' class='test-link' target='_blank'>$file</a> ";
    }
}

// Bootstrap JS check
echo "<h2>Javascript Files Check</h2>";
echo "<table>";
echo "<tr><th>File</th><th>Status</th></tr>";

$jsFiles = ['js/bootstrap.min.js', 'js/bootstrap.bundle.min.js'];
foreach ($jsFiles as $file) {
    echo "<tr>";
    echo "<td>$file</td>";
    echo "<td>" . (file_exists($file) ? "<span class='success'>Exists</span>" : "<span class='error'>Missing</span>") . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "</body></html>";
?>
