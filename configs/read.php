<?php
    // $filePath= "/haneri.json";
    function loadData($filePath) {
        // Check if file exists
        if (file_exists($filePath)) {
            // Read the file contents
            $jsonData = file_get_contents($filePath);
            
            // Decode the JSON data into an associative array
            $data = json_decode($jsonData, true);
            
            return $data;
        } else {
            return null; // Return null if the file doesn't exist
        }
    }
?>