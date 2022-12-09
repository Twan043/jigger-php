<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jigger Twan</title>
</head>
<body>

<div class="wrapper">
    <form action="" method="POST" class="form">
        <div class="row">
            <div class="input-group">
                <label for="name">adress</label>
                <input type="text" name="address" id="address" placeholder="Adress" required>
            </div>
            <div class="input-group">
                <label>JIG</label>
                <input name="JIG" id="JIG" placeholder="How much times do you want to jig" required>
            </div>
            <div class="input-group">
                <label>Catchall</label>
                <input name="catchall" id="catchall" placeholder="What is your catchall?" required>
            </div>
            <div class="filename">
                <label>filename</label>
                <input name="filename" id="filename" placeholder="What do you want as file name" required>
            </div>
        <div class="input-group">
            <button name='submit' class='btn'>Generate output</button>
        </div>
    </form>

</body>
</html>

<?php
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
if (isset($_POST['submit'])) {
    $loop = $_POST['JIG'];
    $catchall = $_POST['catchall'];
    $address_post = $_POST['address'];
    $filename = $_POST['filename'];

    echo "<h2>CSV FILE, copy output to a text file and save it as .csv</h2>";
    for ($i = 0; $i <= $loop; $i++) {
        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        $digits = 3;
        $random = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $email = $firstname . $lastname . $random . $catchall;
        $s = substr(str_shuffle(str_repeat("ABCDEFGHHIJKLMNOPQRSTUVWXYZ", 1)), 0, 3);
        $address = $s . " " . $address_post;

        $data = $firstname . "," . $lastname . "," . $email . "," . $address ;
        $test = "\n";
        $myfile = fopen("$filename.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $data);
        fwrite($myfile, $test);
        fclose($myfile);
    }
    echo "<a href='$filename.txt' download>click here to download</a>";
}

?>
