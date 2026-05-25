<?php
$files = [
    'resources/views/welcome.blade.php',
    'resources/views/comofunciona.blade.php',
    'resources/views/explora.blade.php',
    'resources/views/sobrenosotros.blade.php',
    'resources/views/contacto.blade.php',
    'resources/views/privacidad.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Replace header 
    $content = preg_replace('/<header(.*?)<\/header>/s', '@include(\'components.navbar\')', $content);
    // Remove duplicate navbar includes if we did it manually
    
    // Replace footer
    if (preg_match('/<footer(.*?)<\/footer>/s', $content)) {
        $content = preg_replace('/<footer(.*?)<\/footer>/s', '@include(\'components.footer\')', $content);
    } else {
        // If no footer exists, place it before <script> or </body>
        if (strpos($content, '@include(\'components.footer\')') === false) {
             $content = preg_replace('/<script>/', "@include('components.footer')\n    <script>", $content);
        }
    }
    
    file_put_contents($file, $content);
}
echo "DONE";
