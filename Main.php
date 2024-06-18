<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainable Living Information Platform</title>
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
    <a class="nav-link text-danger font-weight-bold" href="#sustainable-living">Sustainable Living <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
    <a class="nav-link text-danger font-weight-bold" href="#healthy-living-tips">Healthy Living Tips</a>
</li>

                <li class="nav-item">
    <a class="nav-link text-danger font-weight-bold" href="#community-stories">Stories</a>
</li>
<li class="nav-item">
    <a class="nav-link text-danger font-weight-bold" href="#recycling-points">Recycling Points</a>
</li>

            </ul>
            <form method="POST" action="RegisterPage.php">
            <button style="margin-right: 10px;" class="btn btn-primary my-2 my-sm-0" id="create" name="create" type="submit">Register</button>
        </form>     
            <form class="form-inline my-2 my-lg-0" action="LoginPage.php" method="POST">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Log In</button>
            </form>
        </div>
    </nav>
    <section class="hero">
        <img src="mainBackground.jpg" alt="Hero Image">
        <div id="row1" class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 id="col1">Discover the Path to Sustainable Living</h1>
                </div>
                <div class="col-12">
                    <h2 id="col2">Embrace a Greener Tomorrow</h2>
                </div>
                <div class="col-12">
                    <button id="learnMoreButton" class="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('learnMoreButton').addEventListener('click', function() {
                var sustainableLivingSectionHeight = document.querySelector('.hero').offsetHeight;
                window.scrollTo({
                    top: sustainableLivingSectionHeight,
                    behavior: 'smooth'
                });
            });
        </script>
    </section>
    <main>
        <div id="sustainable-living" class="container mt-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">What is Sustainable Living?</h2>
                            <p class="card-text">
                                Sustainable living is a lifestyle that aims to reduce personal and societal environmental impact by making positive changes which counteract climate change and other environmental concerns. It involves adopting practices that promote ecological balance, resource conservation, and social equity to create a more sustainable future for generations to come.
                            </p>
                            <p class="card-text">
                                At its core, sustainable living encompasses various aspects of daily life, including:
                            </p>
                            <ul>
                                <li><strong>Environmental Consciousness:</strong> Being mindful of the environmental consequences of our actions and striving to minimize negative impacts on ecosystems and natural resources.</li>
                                <li><strong>Resource Conservation:</strong> Using resources efficiently and responsibly to reduce waste and promote long-term sustainability.</li>
                                <li><strong>Renewable Energy:</strong> Embracing clean, renewable energy sources such as solar, wind, and hydropower to reduce reliance on fossil fuels and combat climate change.</li>
                                <li><strong>Eco-Friendly Consumption:</strong> Making informed choices about products and services, opting for sustainable, ethically produced goods, and reducing consumption of single-use items.</li>
                                <li><strong>Green Transportation:</strong> Choosing eco-friendly modes of transportation like walking, biking, carpooling, or using public transit to minimize carbon emissions and air pollution.</li>
                                <li><strong>Community Engagement:</strong> Participating in local initiatives, supporting green businesses, and advocating for sustainable policies to create positive change at the community level.</li>
                            </ul>
                            <p class="card-text">
                                Sustainable living is not only about individual actions but also about collective efforts to address global environmental challenges. By embracing sustainable practices and promoting a culture of environmental stewardship, we can create a healthier planet and a more equitable society for all.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="healthy-living-tips" class="container mt-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Healthy Living Tips for an Eco-Friendly Lifestyle</h2>
                            <p class="card-text">
                                Adopting an eco-friendly lifestyle not only benefits the environment but also contributes to your overall well-being. Here are some tips to help you live a healthier and more sustainable life:
                            </p>
                            <ul>
                                <li>
                                    <strong>Choose organic and locally grown foods:</strong><br>
                                    Opting for organic produce reduces your exposure to harmful pesticides and supports sustainable farming practices. Buying locally grown foods reduces transportation emissions and supports local farmers, contributing to a stronger community and economy.
                                </li>
                                <li>
                                    <strong>Reduce meat consumption and incorporate more plant-based meals:</strong><br>
                                    Plant-based diets are associated with lower rates of chronic diseases and have a lower environmental impact compared to meat-heavy diets. By reducing meat consumption, you can improve your health and help mitigate climate change, deforestation, and water pollution caused by animal agriculture.
                                </li>
                                <li>
                                    <strong>Use eco-friendly cleaning products:</strong><br>
                                    Conventional cleaning products often contain harsh chemicals that can be harmful to your health and the environment. Switching to eco-friendly alternatives reduces your exposure to toxins and minimizes pollution of waterways and ecosystems.
                                </li>
                                <li>
                                    <strong>Practice mindful consumption:</strong><br>
                                    Avoid single-use plastics and disposable items by choosing reusable alternatives. By reducing waste, you can minimize landfill contributions and conserve natural resources, leading to a cleaner environment and healthier ecosystems.
                                </li>
                                <li>
                                    <strong>Conserve energy:</strong><br>
                                    Turn off lights and appliances when not in use, and invest in energy-efficient appliances and lighting. By reducing energy consumption, you can lower your utility bills and decrease greenhouse gas emissions, helping combat climate change.
                                </li>
                                <li>
                                    <strong>Embrace sustainable transportation:</strong><br>
                                    Walk, bike, carpool, or use public transportation whenever possible to reduce reliance on fossil fuels and minimize air pollution. Sustainable transportation options promote physical activity, improve air quality, and reduce traffic congestion.
                                </li>
                                <li>
                                    <strong>Connect with nature:</strong><br>
                                    Spend time outdoors, engage in nature-based activities like hiking and gardening, and support conservation efforts in your community. Connecting with nature enhances mental and physical well-being, fosters appreciation for the environment, and inspires eco-friendly actions.
                                </li>
                                <li>
                                    <strong>Support eco-conscious brands and businesses:</strong><br>
                                    Choose products and services from companies that prioritize sustainability, ethical practices, and social responsibility. By supporting eco-conscious brands, you encourage industry-wide shifts towards more environmentally friendly practices and products.
                                </li>
                                <li>
                                    <strong>Reduce waste:</strong><br>
                                    Compost food scraps, recycle materials, and repurpose items to minimize landfill waste and conserve resources. By adopting a zero-waste lifestyle, you can minimize environmental pollution and promote a circular economy based on reuse and recycling.
                                </li>
                                <li>
                                    <strong>Spread awareness:</strong><br>
                                    Educate others about the importance of environmental conservation and inspire them to take action. By raising awareness and advocating for sustainable practices, you can create positive change and empower others to make a difference in their communities and beyond.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div id="community-stories" class="container mt-5"> 
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Community Stories</h2>
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
            </div>
            <div class="container mt-4">
    <div class="row mb-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Community Stories Overview</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Title</th>
                                    <th>Upload Date</th>
                                    <th>Word Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $storyQuery = $conn->prepare("SELECT username, story_title, submission_date, story_content FROM users_stories");
                                $storyQuery->execute();
                                $storyQuery->bind_result($username, $story_title, $submission_date, $story_content);
                                while ($storyQuery->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($username) . '</td>';
                                    echo '<td>' . htmlspecialchars($story_title) . '</td>';
                                    echo '<td>' . htmlspecialchars($submission_date) . '</td>';
                                    $word_count = str_word_count($story_content);
                                    echo '<td>' . $word_count . '</td>';
                                    echo '</tr>';
                                }
                                $storyQuery->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recycling-points" class="container mt-2">
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
    <?php
    include 'config.php';

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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    function scrollToSection(sectionId, offset) {
        var section = document.getElementById(sectionId);
        if (section) {
            var sectionOffset = section.offsetTop - offset;
            window.scrollTo({
                top: sectionOffset,
                behavior: 'smooth'
            });
        }
    }
    var navbarLinks = document.querySelectorAll('.nav-link');
    navbarLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var sectionId = this.getAttribute('href').substring(1);
            if (sectionId === 'community-stories') {
                scrollToSection(sectionId, 70);
            }
            else if (sectionId === 'sustainable-living') {
                scrollToSection(sectionId, 70);
            } else if (sectionId === 'healthy-living-tips') {
                scrollToSection(sectionId, 70);
            } 
             else {
                scrollToSection(sectionId, 0);
            }
        });
    });
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5V0KPPXUG12jOTXkfq0s1GE4FQkkaSjL2twDPr" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-4Af6pBuHkL5rSn5T+IszELTm+JFu2Z3nZxva/nUtoaLwAu6kSpPe6SiFx2tx0rx3" crossorigin="anonymous"></script>

</body>

</html>