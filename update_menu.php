<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Load existing menu data
    $menuFile = 'menu.json';
    $menuData = json_decode(file_get_contents($menuFile), true);

    // Check if this is a delete request
    if (isset($_POST['delete'])) {
        $country = $_POST['country'];
        $name = $_POST['name'];
        
        // Filter out the dish to be deleted
        $menuData[$country] = array_filter($menuData[$country], function($dish) use ($name) {
            return $dish['name'] !== $name;
        });

        // Save updated menu data back to the JSON file
        if (file_put_contents($menuFile, json_encode($menuData, JSON_PRETTY_PRINT))) {
            echo "Dish deleted successfully!";
        } else {
            echo "Error deleting dish.";
        }
    } else {
        // Handle add/update request
        $country = $_POST['country'];
        $category = $_POST['category'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Handle file upload
        $image = $_FILES['image'];
        $targetDir = 'assets/';
        $targetFile = $targetDir . basename($image['name']);
        
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $imgsrc = $targetFile;
        } else {
            echo "Error uploading file.";
            exit;
        }

        // Create new dish array
        $newDish = [
            'name' => $name,
            'imgsrc' => $imgsrc,
            'price' => $price,
            'category' => $category,
            'description' => $description
        ];

        // Add new dish to the appropriate country array
        $menuData[$country][] = $newDish;

        // Save updated menu data back to the JSON file
        if (file_put_contents($menuFile, json_encode($menuData, JSON_PRETTY_PRINT))) {
            echo "Dish added/updated successfully!";
        } else {
            echo "Error saving menu data.";
        }
    }
}