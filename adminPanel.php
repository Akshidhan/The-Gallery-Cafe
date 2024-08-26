<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="adminStyles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <?php
        include 'connect.php';

        session_start();

        if (!isset($_SESSION['username']) || !isset($_SESSION['userType'])) {
            header("Location: signin.html");
            exit();
        }
    ?>

    <h1>Admin Panel</h1>
    <button id="logout" onclick="window.location.href='logout.php'">Logout</button>
    <button id="home" onclick="window.location.href='index.php'">Home</button>

    <!-- User Management Section -->
    <h2>Manage Users</h2>
    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connect.php';

            // Fetch users
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($user = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$user['userID']}</td>
                            <td>{$user['username']}</td>
                            <td>{$user['password']}</td>
                            <td>{$user['userType']}</td>
                            <td>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='delete_user_id' value='{$user['userID']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <h3>Add User</h3>
    <form id="addUserForm" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <label for="usertype">User Type: </label>
        <select id="usertype" name="usertype" required>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
            <option value="staff">Staff</option>
        </select><br>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <!-- Menu Management Section -->
    <h2>Manage Menu</h2>
    <table id="menuTable">
        <thead>
            <tr>
                <th>Cuisine</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'connect.php';

            // Fetch menu items
            $sql = "SELECT * FROM menu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($item = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$item['cuisine']}</td>
                            <td>{$item['name']}</td>
                            <td>{$item['category']}</td>
                            <td>{$item['description']}</td>
                            <td>Rs. {$item['price']}</td>
                            <td>{$item['imgsrc']}</td>
                            <td>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='delete_item_id' value='{$item['dishID']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No menu items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <h3>Add Dish</h3>
    <form id="addDishForm" method="post" enctype="multipart/form-data">
        <label for="country">Country: </label>
        <select id="country" name="cuisine" required>
            <option value="Sri Lankan">Sri Lanka</option>
            <option value="China">China</option>
            <option value="Italy">Italy</option>
        </select><br>
        
        <label for="category">Category: </label>
        <select id="category" name="category" required>
            <option value="Breakfast">Breakfast</option>
            <option value="Main Course">Main Course</option>
            <option value="Lunch">Lunch</option>
            <option value="Desserts">Desserts</option>
            <option value="Beverages">Beverages</option>
            <option value="Appetizers">Appetizers</option>
        </select><br>

        <label for="name">Dish Name: </label>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Description: </label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="price">Price: </label>
        <input type="text" id="price" name="price" required><br>

        <label for="image">Image: </label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <input type="submit" name="add_item" value="Add Dish">
    </form>    

    <?php
        // Logic for adding users
        if (isset($_POST['add_user'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $usertype = $_POST['usertype'];

            $stmt = $conn->prepare("INSERT INTO users (username, password, userType) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $password, $usertype])) {
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                        }, 2000); // 2-second delay
                    </script>";
                exit();
            } else {
                echo "<p>Failed to add user.</p>";
            }
        }

        // Logic for deleting users
        if (isset($_POST['delete_user_id'])) {
            $userId = $_POST['delete_user_id'];

            $stmt = $conn->prepare("DELETE FROM users WHERE ID = ?");
            if ($stmt->execute([$userId])) {
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                        }, 2000); // 2-second delay
                    </script>";
                exit();
            } else {
                echo "<p>Failed to delete user.</p>";
            }
        }

        // Logic for adding a dish
        if (isset($_POST['add_item'])) {
            $cuisine = $_POST['cuisine'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            // Handling file upload
            $target_dir = "assets/menu/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Check if image file is an actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Insert dish details into the database
                    $stmt = $conn->prepare("INSERT INTO menu (cuisine, name, category, description, price, imgsrc) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $cuisine, $name, $category, $description, $price, $target_file);

                    if ($stmt->execute()) {
                        echo "<script>
                            setTimeout(function() {
                                window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                            }, 2000); // 2-second delay
                        </script>";
                exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        if (isset($_POST['delete_item_id'])) {
            $dishId = $_POST['delete_item_id'];

            $stmt = $conn->prepare("DELETE FROM menu WHERE dishID = ?");
            $stmt->bind_param("i", $dishId);

            if ($stmt->execute()) {
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                        }, 2000); // 2-second delay
                    </script>";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    ?>
</body>
</html>
