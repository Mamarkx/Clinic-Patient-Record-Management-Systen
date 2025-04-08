<?php 
session_start();
include("database/connection.php");

$usernameErr = $passwordErr = ''; 
$username = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErr = "*Username is required";
    } else {
        $username = trim(htmlspecialchars($_POST["username"]));
    }
    
    if (empty($_POST["password"])) {
        $passwordErr = "*Password is required";
    } else {
        $password = $_POST["password"];
    }
    
    if (empty($usernameErr) && empty($passwordErr)) {
        $stmt = $conn->prepare("SELECT id, username, password, Roles, Name  FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["Username"];
                $_SESSION["user_role"] = $row["Roles"];    
                $_SESSION["user_fullname"] = $row["Name"];
                $_SESSION["login_success"] = true;
                
                // Redirect to welcome page
                header("Location: Popup/welcome.php");
                exit();
                
            } else {
                $passwordErr = '*Incorrect Password';
            }
        } else {
            $usernameErr = '*No user found with that username.';
        }
        
        $stmt->close();
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Now</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="Admin/Assets/css/fontawesome/css/all.min.css">
</head>
<body>
    <div class="container main">
        <form method="POST" class="form" novalidate>
            <div class="mb-3 bg p-5 rounded">
                <h2 class="text-center mb-5 bold">LOGIN ACCOUNT</h2>
                
                <!-- Username Field -->
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control <?php echo !empty($usernameErr) ? 'is-invalid' : ''; ?>" 
                        placeholder="Username" 
                        id="name" 
                        name="username" 
                        value="<?php echo htmlspecialchars($username); ?>" 
                        required 
                    />
                    <?php if (!empty($usernameErr)): ?>
                        <div class="invalid-feedback">
                            <?php echo $usernameErr; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Password Field -->
                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input 
                        type="password" 
                        class="form-control <?php echo !empty($passwordErr) ? 'is-invalid' : ''; ?>" 
                        placeholder="Password" 
                        id="pass" 
                        name="password" 
                        required 
                    />
                    <?php if (!empty($passwordErr)): ?>
                        <div class="invalid-feedback">
                            <?php echo $passwordErr; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <input type="submit" name="submit" class="submit w-100" value="Login">
                
                <hr>
            </div>
        </form>
    </div>


</body>
</html>
