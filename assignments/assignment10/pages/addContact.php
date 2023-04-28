<?php
// Include required classes
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";
require_once "classes/StickyForms.php";

// Create instances of required classes
$pdo = new PdoMethods();
$validate = new Validation();
$sticky = new StickyForm();

$elementsArr = [
    'name' => [
        'type' => 'text',
        'regex' => 'name',
        'errorMessage' => 'Please enter a valid name.'
    ],
    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'errorMessage' => 'Please enter a valid address.'
    ],
    'city' => [
        'type' => 'text',
        'regex' => 'city',
        'errorMessage' => 'Please enter a valid city.'
    ],
    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'errorMessage' => 'Please enter a valid phone number.'
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'errorMessage' => 'Please enter a valid email address.'
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'errorMessage' => 'Please enter a valid password.'
    ],
    'dob' => [
        'type' => 'text',
        'regex' => 'dob',
        'errorMessage' => 'Please enter a valid date of birth.'
    ]
];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation
    $nameError = $validate->checkFormat($_POST["name"], "name");
    $addressError = $validate->checkFormat($_POST["address"], "address");
    $cityError = $validate->checkFormat($_POST["city"], "city");
    $stateError = $validate->checkFormat($_POST["state"], "state");
    $phoneError = $validate->checkFormat($_POST["phone"], "phone");
    $emailError = $validate->checkFormat($_POST["email"], "email");
    $dobError = $validate->checkFormat($_POST["dob"], "dob");
  
    
    // Check if there are no validation errors
    if (!$nameError && !$emailError && !$phoneError && !$addressError && !$cityError && !$dobError) {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $dob = DateTime::createFromFormat('m/d/Y', $_POST["dob"])->format('Y-m-d'); //$dob = $_POST["dob"];

        if (isset($_POST["contacts"])) {
            $contacts = implode(', ', $_POST["contacts"]);
        } else {
            $contacts = "";
        }
        
        $age = $_POST["age"];

        // Insert the contact into the database
        $sql = "INSERT INTO contacts (name, address, city, state, phone, email, dob, contacts, age) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";
        
        $bindings = [
            [":name", $name, "str"],
            [":address", $address, "str"],
            [":city", $city, "str"],
            [":state", $state, "str"],
            [":phone", $phone, "str"],
            [":email", $email, "str"],
            [":dob", $dob, "str"],
            [":contacts", $contacts, "str"],
            [":age", $age, "str"],
        ];
        
        $result = $pdo->otherBinded($sql, $bindings);

        // Check if the insertion was successful
        if ($result === "noerror") {
            $successMessage = "Contact successfully added!";
        } else {
            $errorMessage = "There was an error adding the contact. Please try again.";
        }
    } else {
        // Display validation errors
        $errorMessage = "Please correct the following errors:<br>";
        if ($nameError) {
            $errorMessage .= "- Invalid name.<br>";
        }
        if ($emailError) {
            $errorMessage .= "- Invalid email.<br>";
        }
        if ($phoneError) {
            $errorMessage .= "- Invalid phone number.<br>";
        }
    }
}

// <?php echo htmlspecialchars($_SERVER['PHP_SELF']); // in form action? 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <?php echo get_nav(); ?>
    <h1>Add Contact</h1>

    <?php if (isset($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <?php if (isset($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php if ($nameError): ?>
            <p style="color: red;"><?php echo $nameError; ?></p>
        <?php endif; ?>
        <?php if ($addressError): ?>
            <p style="color: red;"><?php echo $addressError; ?></p>
        <?php endif; ?>
        <?php if ($cityError): ?>
            <p style="color: red;"><?php echo $cityError; ?></p>
        <?php endif; ?>
        <?php if ($stateError): ?>
            <p style="color: red;"><?php echo $stateError; ?></p>
        <?php endif; ?>
        <?php if ($phoneError): ?>
            <p style="color: red;"><?php echo $phoneError; ?></p>
        <?php endif; ?>
        <?php if ($emailError): ?>
            <p style="color: red;"><?php echo $emailError; ?></p>
        <?php endif; ?>
        <?php if ($dobError): ?>
            <p style="color: red;"><?php echo $dobError; ?></p>
        <?php endif; ?>
    <?php endif; ?>  

    <form action="index.php?page=addContact" method="POST">
        <label for="name">Name (letters only)</label>
        <input type="text" id="name" name="name" class="form-control" required>
        <br>
        <label for="address">Address (just number and street)</label>
        <input type="text" id="address" name="address" class="form-control" required>
        <br>
        <label for="city">City</label>
        <input type="text" id="city" name="city" class="form-control" required>
        <br>
        <label for="state">State</label>
        <select id="state" name="state" class="form-control" required>
            <option value="Michigan" selected>Michigan</option>
            <option value="Ohio">Ohio</option>
            <option value="California">California</option>
            <option value="West Virgina">West Virginia</option>
            <option value="Florida">Florida</option>
        </select>
        <br>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
        <br>
        <label for="email">Email address</label>
        <input type="email" id="email" name="email" class="form-control" required>
        <br>
        <label for="dob">Date of birth</label>
        <input type="text" id="dob" name="dob" class="form-control" required>
        <br>

        <div class="form-group">

        <label for="contacts">Please check all contact types you would like (optional):</label><br>

        <input type="checkbox" id="newsletter" name="contacts[]" value="Newsletter">
        <label for="newsletter">Newsletter</label>

        <input type="checkbox" id="email_updates" name="contacts[]" value="Email Updates">
        <label for="email_updates">Email Updates</label>

        <input type="checkbox" id="text_updates" name="contacts[]" value="Text Updates">
        <label for="text_updates">Text Updates</label>
        <br><br>
        </div>
       
        <div class="form-group">
        <label for="age">Please select an age range (you must select one):</label><br>
        <input type="radio" id="age_10_18" name="age" value="10-18" required>
        <label for="age_10_18">10-18</label>
        <input type="radio" id="age_19_30" name="age" value="19-30" required>
        <label for="age_19_30">19-30</label>
        <input type="radio" id="age_30_50" name="age" value="30-50" required>
        <label for="age_30_50">30-50</label>
        <input type="radio" id="age50+" name="age" value="50+">
        <label for="age50+">50+</label><br><br>
        </div>

        <input type="submit" class="btn btn-primary" value="Add Contact">
    </form>
    </div>
</body>
</html>