<?php
include('config.php');

$selectedState = '';
$selectedCity = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedState = $_POST["state"];
    $selectedCity = $_POST["city"];
}

$query = "SELECT * FROM colleges";

if (!empty($selectedCity) && $selectedCity !== 'Select City') {
    $query .= " WHERE city = '$selectedCity'";
} elseif (!empty($selectedState) && $selectedState !== 'Select State') {
    $query .= " WHERE state = '$selectedState'";
}

$result = mysqli_query($con, $query);

if ($result) {
    $collegesData = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
    echo '<script>var selectedState = "' . $selectedState . '";</script>';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Engineering Colleges</title>
    <link rel="stylesheet" href="index2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="display">
        <div class="b_container">
            <form method="post" action="">
                <div class="selection">
                <div class="s">
                    <label for="state">Choose a State : </label>
                    <select name="state" id="state" onchange="loadCity()" >
                    <option <?php echo ($selectedCity === 'Select City') ? 'selected' : ''; ?> id="option"> 
                    <?php echo ($selectedCity === 'Select State') ? 'Select State' : $selectedState; ?>
                    </option>
                <?php foreach ($states as $state) : ?>
                    <option <?php echo ($selectedState === $state) ? 'selected' : ''; ?>><?php echo $state; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="s">
    <label for="city">Choose a City : </label>
    <select name="city" id="city">
        <option <?php echo ($selectedCity === 'Select City') ? 'selected' : ''; ?>>
            <?php echo ($selectedCity === 'Select City') ? 'Select City' : $selectedCity; ?>
        </option>
    </select>
</div>


                <input type="submit" value="Submit">
                </div>
            </form>
        </div>

        <hr>

        <form class="for-search">
            <div class="search-container">
               
                    <input type="search" id="searchInput" name="Colleges" placeholder="Search" onkeyup="search()">
                    <div id="search_box">
                        <button ><img src="images/icons/search.png" class=""></button>
                    </div>
                
                
            </div>
        </form>

        <div class="container">
            <?php foreach ($collegesData as $collegeData) : ?>
                <div class="colleges">
                    <div class="img">
                        <img src="<?php echo $collegeData['image_url']; ?>">
                    </div>
                    <div class="discription">
                        <div class="main">
                            <h1 class="head">
                                <?php echo $collegeData['college_name']; ?>,
                                <?php echo $collegeData['city']; ?>
                            </h1>
                            <div class="ratting">
                                <p class="rate"><?php echo $collegeData['rating']; ?></p>
                                <i class="bx bx-star"></i>
                            </div>
                        </div>
                        <div class="para">
                            <p><?php echo $collegeData['description']; ?></p>
                        </div>
                        <button> More Details... </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="index.js"></script>
</body>

</html>

