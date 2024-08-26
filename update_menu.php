<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuFile = 'menu.json';
    $menuData = json_decode(file_get_contents($menuFile), true);

    if (isset($_POST['delete'])) {
        $country = $_POST['country'];
        $name = $_POST['name'];
        
        $menuData[$country] = array_filter($menuData[$country], function($dish) use ($name) {
            return $dish['name'] !== $name;
        });

        if (file_put_contents($menuFile, json_encode($menuData, JSON_PRETTY_PRINT))) {
            echo "Dish deleted successfully!";
        } else {
            echo "Error deleting dish.";
        }
    } else {
        $country = $_POST['country'];
        $category = $_POST['category'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $image = $_FILES['image'];
        $targetDir = 'assets/';
        $targetFile = $targetDir . basename($image['name']);
        
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $imgsrc = $targetFile;
        } else {
            echo "Error uploading file.";
            exit;
        }

        $newDish = [
            'name' => $name,
            'imgsrc' => $imgsrc,
            'price' => $price,
            'category' => $category,
            'description' => $description
        ];

        $menuData[$country][] = $newDish;

        if (file_put_contents($menuFile, json_encode($menuData, JSON_PRETTY_PRINT))) {
            echo "Dish added/updated successfully!";
        } else {
            echo "Error saving menu data.";
        }
    }
}
