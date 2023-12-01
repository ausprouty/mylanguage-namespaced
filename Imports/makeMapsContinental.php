<?php
<?php
// Load the SVG file
$svgFile = 'world_map.svg';
$svgContent = file_get_contents($svgFile);

// Define the list of South American country IDs to keep
$southAmericanCountries = ["country1", "country2"];

// Parse the SVG content
$doc = new DOMDocument();
$doc->loadXML($svgContent);

// Get the root SVG element
$svg = $doc->getElementsByTagName('svg')->item(0);

// Get all <path> elements within the SVG
$paths = $doc->getElementsByTagName('path');

// Loop through <path> elements and remove non-South American countries
foreach ($paths as $path) {
    $id = $path->getAttribute('id');
    $name = $path->getAttribute('name');
    
    // Check if the ID is not in the list of South American countries
    if (!in_array($id, $southAmericanCountries)) {
        $svg->removeChild($path);
    }
}

// Modify width and height attributes to resize the map
$svg->setAttribute('width', 'new_width');
$svg->setAttribute('height', 'new_height');

// Save the edited SVG to a new file
$editedSvgFile = 'south_american_map.svg';
file_put_contents($editedSvgFile, $doc->saveXML());

echo "SVG map with South American countries saved as '$editedSvgFile'";
?>
Replace "country1", "country2", 'new_width', and 'new_height' with the actual values and criteria relevant to your SVG file. Make sure you have the PHP DOM extension enabled on your server to run this script.

This PHP script loads the SVG file, iterates through the <path> elements, removes those whose IDs are not in the list of South American countries, and resizes the SVG. It then saves the edited SVG as a new file.





