<?php
session_start();



if (isset($_GET['id'])) {
    $conn = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$conn) {
        $_SESSION['errors'] =  "connect error " . mysqli_connect_error($conn);
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM `tasks`  WHERE `id` = '$id' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        $_SESSION['errors'] = "data not exists !";
        header("location:index.php");
        die;
    }
}

// echo "<pre>";
// print_r();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
    <style>
    /* General body styling */
    body {
        background-color: #0d0d0d;
        /* Dark background */
        color: #ecf0f1;
        /* Light text color */
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Neon glow for the container */
    .container {
        background-color: #1a1a1a;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.3), 0 0 25px rgba(0, 255, 255, 0.2);
        /* Neon cyan glow */
        padding: 30px;
        max-width: 600px;
        width: 100%;
    }

    /* Row and column styling */
    .row {
        margin: 0;
        padding: 0;
    }

    .col-8 {
        width: 100%;
    }

    /* Form styling */
    form {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.3), 0 0 20px rgba(0, 255, 255, 0.5);
        /* Neon cyan glow */
    }

    /* Input fields styling */
    input[type="text"] {
        background-color: #2c3e50;
        color: #00ffcc;
        /* Neon cyan text */
        border: 1px solid #00ffcc;
        /* Neon border */
        padding: 12px;
        border-radius: 5px;
        transition: box-shadow 0.3s ease, background-color 0.3s ease;
    }

    input[type="text"]::placeholder {
        color: #bdc3c7;
    }

    /* Input hover and focus effect with neon glow */
    input[type="text"]:hover,
    input[type="text"]:focus {
        box-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
        /* Neon glow on hover/focus */
        background-color: #34495e;
        /* Slightly lighter background on focus */
    }

    /* Submit button styling with neon glow */
    input[type="submit"] {
        background-color: #00ffcc;
        color: #1a1a1a;
        border: none;
        padding: 12px;
        font-size: 16px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        text-shadow: 0 0 10px #00ffcc;
        /* Neon text shadow */
    }

    input[type="submit"]:hover {
        background-color: #00bfa5;
        /* Darker neon cyan on hover */
        box-shadow: 0 0 15px #00ffcc, 0 0 25px #00ffcc;
        /* Stronger neon glow on hover */
    }

    /* Alert styling */
    .alert {
        background-color: #e74c3c;
        /* Red for errors */
        color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
        /* Neon red glow */
        text-align: center;
    }

    /* Table styling with neon effect (if applicable) */
    table {
        background-color: #1a1a1a;
        color: #00ffcc;
        border-collapse: collapse;
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        /* Neon table glow */
    }

    table th,
    table td {
        border: 1px solid #00ffcc;
        padding: 10px;
    }

    /* Table row hover effect */
    table tr:hover {
        background-color: #2c3e50;
        box-shadow: 0 0 10px #00ffcc;
        /* Neon hover effect */
    }

    /* Media queries for responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        input[type="submit"] {
            font-size: 14px;
        }
    }
    </style>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="handlers/update.php?id=<?php echo $_GET['id']; ?>" method="POST"
                    class="form border p-2 my-5">

                    <?php if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            echo $_SESSION['errors'];
                            unset($_SESSION['errors']);
                            ?>

                    </div>
                    <?php endif; ?>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>"
                        class="form-control my-3 border border-success" placeholder="add new todo"
                        style="color: white;">
                    <input type="submit" value="Save" class="form-control btn btn-primary my-3 "
                        placeholder="add new todo">
                </form>
            </div>

        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>