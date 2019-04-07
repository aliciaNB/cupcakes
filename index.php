<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupcake Fundraiser | Order Form</title>

    <!--Bootstrap css styles-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!-- Start of order form -->
    <div class="ml-3 mt-3">
        <h2>Cupcake Fundraiser</h2>
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="name">Your name:</label>
                <input class="form-control col-sm-4" type="text" id="name" placeholder="Please input your name."
                       name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
            </div>
            <div class="mb-3">
                <label>Cupcake flavors:</label>
                    <?php
                    //declare an associative array to define values and labels for the cupcake flavors checkboxes
                    $flavors = array(
                        "grasshopper" => "The Grasshopper",
                        "maple" => "Whiskey Maple Bacon",
                        "carrot" => "Carrot Walnut",
                        "caramel" => "Salted Caramel Cupcake",
                        "velvet" => "Red Velvet",
                        "lemon" => "Lemon Drop",
                        "tiramisu" => "Tiramisu");

                    //output the form checkboxes
                    foreach($flavors as $key => $value) {
                        echo '<div class="form-check">';
                        echo '<input type="checkbox" class="form-check-input" name="flavor[]" id="' . $key . '" value="'
                            . $key . '"';
                            if(isset($_POST['flavor']) && in_array($key, $_POST['flavor'])){
                                echo 'checked';
                            }
                            echo '>';
                        echo '<label class="form-check-label" for="' . $key . '">' . $value . '</label></div>';
                    }
                    ?>
            </div>
            <div>
                <button type="submit" value="Submit" class="btn btn-primary">Order</button>
            </div>
        </form>
    </div>

    <?php //start of form validation and order confirmation
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = []; //error array

            //check for name input
            if (empty($_POST['name'])) {
                $errors[] = 'Please include a name for your cupcake order.';
            }

            //check that at least one cupcake flavor has been selected
            if (empty($_POST['flavor'])) {
                $errors[] = 'Please select at least one cupcake flavor for your order.';
            }

            //check the flavors selected
            if (!empty($_POST['flavor'])) {
                foreach ($_POST['flavor'] as $value) {
                    if (!array_key_exists($value, $flavors)) {
                        $errors[] = "$value is not a valid cupcake flavor!";
                    }
                }
            }

            if (empty($errors)) {
                //TODO: process order form confirmation
            } else {
                //print the errors
                echo '<div class="ml-3 mt-3"><p>The following error(s) occurred:<br>';
                foreach ($errors as $msg) { // Print each error.
                    echo "- $msg<br>\n";
                }
                echo '</p><p>Please try again.</p></div>';
            }
        }
    ?>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>
</html>
