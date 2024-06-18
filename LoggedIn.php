<?php
if (isset($_COOKIE['username'])) {
    include 'config.php';

    $stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE username = ?");
    $username = $_COOKIE['username'];
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    $stmt->close();

    $date = date('Y-m-d');
    $checkStmt = $conn->prepare("SELECT id FROM user_submissions WHERE username = ? AND submission_date = ?");
    $checkStmt->bind_param("ss", $username, $date);
    $checkStmt->execute();
    $checkStmt->store_result();
    $submissionExists = $checkStmt->num_rows > 0;
    $checkStmt->close();

    $userStmt = $conn->prepare("SELECT SUM(rating) AS total_rating, COUNT(*) AS total_submissions, SUM(recycling_points) FROM user_submissions WHERE username = ?");
    $userStmt->bind_param("s", $username);
    $userStmt->execute();
    $userStmt->store_result();


    if ($userStmt->num_rows > 0) {
        $userStmt->bind_result($total_rating, $total_submissions, $total_recycling_points);
        $userStmt->fetch();
        $totalRecyclingPoints = $total_recycling_points;
        $totalSubmissions = $total_submissions;
        $totalRating = $total_rating;
    } else {
        $totalSubmissions = 0;
    }
    $userStmt->close();

    $queryResult1 = $conn->prepare("SELECT COUNT(*) FROM users_stories WHERE username = ?");
    $queryResult1->bind_param("s", $username);
    $queryResult1->execute();
    $queryResult1->bind_result($total_stories);
    $queryResult1->fetch();
    $queryResult1->close();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rating = $_POST['rating'];
        $feedback = $_POST['feedback'];
        $recycling_points = $_POST['recycling_points'];

        if ($submissionExists) {
            $updateStmt = $conn->prepare("UPDATE user_submissions SET rating = ?, feedback = ?, recycling_points = ? WHERE username = ? AND submission_date = ?");
            $updateStmt->bind_param("isiss", $rating, $feedback, $recycling_points, $username, $date);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            $insertStmt = $conn->prepare("INSERT INTO user_submissions (username, rating, feedback, recycling_points, submission_date) VALUES (?, ?, ?, ?, ?)");
            $insertStmt->bind_param("sisss", $username, $rating, $feedback, $recycling_points, $date);
            $insertStmt->execute();
            $insertStmt->close();
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sustainable Living Dashboard</title>
        <link rel="icon" href="logo.png" type="image/png">
        <link rel="stylesheet" href="Main.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>

    <body>
        <nav id="navbar" class="navbar navbar-dark navbar-expand-md navbar-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-danger font-weight-bold" href="Journal.php">Journal<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="logout.php" method="POST">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Log Out</button>
                </form>
            </div>
        </nav>

        <section class="hero">
            <img src="mainBackground.jpg" alt="Hero Image">
            <div id="row1" class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 style="margin-top: 150px; top:5%;" id="col1"><i>Welcome, <?php echo htmlspecialchars($firstName) . " " . htmlspecialchars($lastName); ?></i></h1>
                    </div>
                    <div class="col-12">
                        <h2 style="top: 40%; color: black;" id="col2">Rate Your Eco-Friendly Actions Today</h2>
                    </div>
                    <div class="col-12 rating-container">
                        <p class="rating-value">0</p><br><br>
                        <div class="rating-stars">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <span class="star" data-value="6">&#9733;</span>
                            <span class="star" data-value="7">&#9733;</span>
                            <span class="star" data-value="8">&#9733;</span>
                            <span class="star" data-value="9">&#9733;</span>
                            <span class="star" data-value="10">&#9733;</span>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.querySelectorAll('.star').forEach(function(star) {
                    star.addEventListener('click', function() {
                        const ratingValue = document.querySelector('.rating-value');
                        const stars = document.querySelectorAll('.star');
                        const ratingInput = document.getElementById('rating-input');

                        const value = parseInt(star.getAttribute('data-value'));
                        ratingValue.textContent = value;
                        ratingInput.value = value;

                        stars.forEach(s => {
                            const sValue = parseInt(s.getAttribute('data-value'));
                            if (sValue <= value) {
                                if (value <= 4) {
                                    s.style.color = 'red';
                                    showFeedback('Not quite there yet, you need to put in more effort to make the world a better place!', 'red');
                                } else if (value <= 7) {
                                    s.style.color = '#FFCC00';
                                    showFeedback('Not bad! Keep going.', '#FFCC00');
                                } else {
                                    s.style.color = 'green';
                                    showFeedback('Great job! Together, we will make the world a more sustainable place.', 'green');
                                }
                            } else {
                                s.style.color = 'black';
                            }
                        });

                        const feedbackSection = document.querySelector('.feedback-section');
                        feedbackSection.style.display = 'block';

                        const elementHeight = 750;
                        const scrollToPosition = elementHeight;

                        window.scrollTo({
                            top: scrollToPosition,
                            behavior: 'smooth'
                        });

                        const submitButton = document.getElementById('submitButton');
                        submitButton.textContent = '<?php echo $submissionExists ? "Update" : "Submit"; ?>';
                        submitButton.style.display = 'block';
                    });
                });

                function showFeedback(message, color) {
                    const feedbackMessage = document.querySelector('.feedback-message');
                    feedbackMessage.textContent = message;
                    feedbackMessage.style.color = color;
                }
            </script>
        </section>
        <main>
            <div class="mt-5 container">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
                            <input type="hidden" name="rating" id="rating-input" value="0">
                            <div class="feedback-section text-center mb-5" style="display:none;">
                                <p style="font-size: 27px; border: solid 2px;" id="feedBack" class="feedback-message mb-5"></p>
                                <p id="feedBack3" class="sustainability-experience">
                                    You can write down your sustainability experiences of the day in the area below and add them to your journal.</p>
                                <textarea style="height: 175px;" name="feedback" class="form-control mb-1 reason-input"></textarea>
                                <label id="feedBack2" for="recycle-input">How many recycling points did you visit today?</label>
                                <input style="margin:auto;" type="number" id="recycle-input" name="recycling_points" class="col-3 form-control recycle-input" oninput="validateInput(event)">
                            </div>

                            <button class="btn btn-primary btn-lg" id="submitButton" style="display:none; margin:auto;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            include 'OverviewFunction.php';
            generateUserOverview($totalSubmissions, $totalRating, $totalRecyclingPoints, $total_stories);
            ?>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">My Stories</h2>
                            <?php
                            $queryResult = $conn->prepare("SELECT id, story_title, story_content FROM users_stories WHERE username = ?");
                            $queryResult->bind_param("s", $username);
                            $queryResult->execute();
                            $queryResult->bind_result($id, $story_title, $story_content);
                            $count = 0;
                            while ($queryResult->fetch()) {
                                $story_preview = substr($story_content, 0, 100);
                                if (strlen($story_content) > 100) {
                                    $story_preview .= '...';
                                }
                                if ($count % 2 == 0) {
                                    echo '<div class="row">';
                                }
                                echo '<div class="col-md-6">';
                                echo '<div class="card mb-3">';
                                echo '<div class="card-body">';
                                echo '<h3 class="card-title">' . htmlspecialchars($story_title) . '</h3>';
                                echo '<p class="card-text">' . htmlspecialchars($story_preview) . '</p>';
                                echo '<a href="StoryDetail.php?story_id=' . htmlspecialchars($id) . '" class="btn btn-primary">Read Story</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';

                                $count++;

                                if ($count % 2 == 0) {
                                    echo '</div>';
                                }
                            }

                            if ($count % 2 != 0) {
                                echo '</div>';
                            }

                            $queryResult->close();
                            ?>
                            <a href="https://web.itu.edu.tr/atakuln21/FinalProject/AddStory.php" class="btn btn-success">Add Story</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Other Stories</h2>
                                <?php
                                include 'config.php';
                                $queryResult = $conn->query("SELECT id, username, story_title, story_content FROM users_stories");
                                $count = 0;
                                while ($row = $queryResult->fetch_assoc()) {
                                    if ($count % 2 == 0) {
                                        echo '<div class="row">';
                                    }
                                    $story_preview = substr($row['story_content'], 0, 100);
                                    if (strlen($row['story_content']) > 100) {
                                        $story_preview .= '...';
                                    }
                                    if ($_COOKIE['username'] == $row['username']) {
                                        continue;
                                    }
                                    echo '<div class="col-md-6">';
                                    echo '<div class="card mb-3">';
                                    echo '<div class="card-body">';
                                    echo '<h4 class="card-subtitle mb-2 text-muted">Author: ' . htmlspecialchars($row['username']) . '</h4>';
                                    echo '<h3 class="card-title">' . htmlspecialchars($row['story_title']) . '</h3>';
                                    echo '<p class="card-text">' . htmlspecialchars($story_preview) . '</p>';
                                    echo '<a href="StoryDetail.php?story_id=' . htmlspecialchars($row['id']) . '" class="btn btn-primary">Read Story</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    if ($count % 2 == 1) {
                                        echo '</div>';
                                    }

                                    $count++;
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container mt-4">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Recycling Points</h2>
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5V0KPPXUG12jOTXkfq0s1GE4FQkkaSjL2twDPr" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-4Af6pBuHkL5rSn5T+IszELTm+JFu2Z3nZxva/nUtoaLwAu6kSpPe6SiFx2tx0rx3" crossorigin="anonymous"></script>
        <script>
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                var navbar = document.getElementById("navbar");
                var navbarHeight = navbar.offsetHeight;
                if (document.body.scrollTop > navbarHeight || document.documentElement.scrollTop > navbarHeight) {
                    navbar.classList.add("fixed");
                    navbar.classList.remove("navbar");
                    navbar.style.backgroundColor = "#000";
                    document.body.style.paddingTop = navbarHeight + "px";
                } else {
                    navbar.classList.remove("fixed");
                    navbar.classList.add("navbar");
                    navbar.style.backgroundColor = "black";
                    document.body.style.paddingTop = 0;
                }
            }
        </script>
        <?php
        $sql = "SELECT * FROM recycling_points";
        $result = $conn->query($sql);
        $points = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $point = array(
                    'name' => $row['name'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude']
                );
                array_push($points, $point);
            }
        }
        $conn->close();
        header('Content-Type: application/json');
        ?>
    <script 
    import { configApi } from './api.js';
    const apiKey = configApi.apiKey;
    const apiKey = process.env.API_KEY;
    src="https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap" async defer></script>
            <script>
            var markersData = <?php echo json_encode($points); ?>;

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 41.0082,
                        lng: 28.9784
                    },
                    zoom: 10
                });

                for (var i = 0; i < markersData.length; i++) {
                    var position = new google.maps.LatLng(markersData[i].latitude, markersData[i].longitude);
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markersData[i].name
                    });
                    var infowindow = new google.maps.InfoWindow({
                        content: markersData[i].name
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(markersData[i].name);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }
        </script>
        <script>
            function validateInput(event) {
                const input = event.target;
                const value = parseInt(input.value, 10);
                if (isNaN(value) || value <= 0) {
                    input.value = '';
                }
            }
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: login.php');
    exit();
}
?>