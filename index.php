<?php session_start();

$con = mysqli_connect("localhost", "root", "", "todoapp");
if (!$con) {
    echo "Connection Failed" . mysqli_connect_error();
}
$sql = "SELECT * FROM `tasks`";
$data = mysqli_query($con, $sql);

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
    /* Neon Dark Theme with Reduced Button Glow (Neon Blue) */

    /* Body styling */
    body {
        background-color: #0d0d0d;
        color: #d0d0d0;
        font-family: 'Roboto', sans-serif;
    }

    /* Neon glow around the form container */
    .container {
        background-color: #1a1a1a;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 50px rgba(0, 150, 255, 0.3), 0 0 15px rgba(0, 150, 255, 0.2);
    }

    /* Form styling */
    form {
        background-color: #151515;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 150, 255, 0.3);
    }

    form input[type="text"] {
        background-color: #212121;
        color: #00aaff;
        /* Neon blue text */
        border: 1px solid #00aaff;
        padding: 10px;
        outline: none;
        transition: box-shadow 0.3s ease;
    }

    /* Remove the white hover effect on input text field, change it to a soft glow */
    form input[type="text"]:hover,
    form input[type="text"]:focus {
        box-shadow: 0 0 5px rgba(0, 150, 255, 0.5);
        /* Reduced neon blue glow when typing */
        background-color: #1e1e1e;
        /* Change the background color on hover/focus */
    }

    form input[type="text"]::placeholder {
        color: #00aaff;
        /* Placeholder in neon blue */
    }

    form input[type="submit"] {
        background-color: #0d7377;
        color: #00aaff;
        border: none;
        padding: 10px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        text-shadow: 0 0 5px #00aaff;
    }

    /* Reduce the neon light of the button */
    form input[type="submit"]:hover {
        background-color: #0d9fee;
        box-shadow: 0 0 5px #00aaff, 0 0 10px #0d9fee;
        /* Reduced neon blue glow */
    }

    /* Table styling */
    table {
        background-color: #151515;
        color: #00aaff;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 150, 255, 0.3);
    }

    table thead {
        background-color: #212121;
        color: #0d9fee;
    }

    table th,
    table td {
        border: 1px solid #00aaff;
        padding: 10px;
    }

    table tr:hover {
        color: white;
        background-color: #212121;
        box-shadow: 0 0 15px #0d9fee;
    }

    /* Button styling */
    .btn-primary {
        background-color: #0d7377;
        border: none;
        color: #00aaff;
        text-shadow: 0 0 15px #00aaff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0d9fee;
        box-shadow: 0 0 5px #00aaff, 0 0 10px #0d9fee;
        /* Reduced neon blue glow */
    }

    .header {
        text-align: center;
    }

    .header h1 {
        color: #0d7377;
        text-shadow: #00aaff 0 0 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }
    }
    </style>
</head>

<body>


    <div class="container">
        <div class="header">
            <h1>Welcome To My App</h1>
        </div>

        <div class="row">
            <div class="col-8 mx-auto">
                <form action="handlers/store.php" method="POST" class="form border p-2 my-5">
                    <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success text-center">
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="alert alert-success text-center">
                        <?php
                            echo $_SESSION['errors'];
                            unset($_SESSION['errors']);
                            ?>
                    </div>
                    <?php endif; ?>
                    <input type="text" name="title" class="form-control my-3 border border-success"
                        placeholder="add new todo" style="color: white;">
                    <input type="submit" value="Add" class="form-control btn btn-primary my-3 "
                        placeholder="add new todo">
                </form>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td>
                                <a href="handlers/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i> </a>
                                <a href="show-update.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i
                                        class="fa-solid fa-edit"></i> </a>
                            </td>
                        </tr>

                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src=" https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src="script.js"></script>
</body>

</html>