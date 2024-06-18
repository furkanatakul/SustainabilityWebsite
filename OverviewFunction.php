<?php
function generateUserOverview($totalSubmissions, $totalRating, $totalRecyclingPoints, $total_stories) {
    echo '
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Your Sustainable Living Overview</h2>
                        <p class="card-text">Track your progress and explore new ways to live sustainably.</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title">Eco-Friendly Actions</h3>
                                        <p class="card-text">Since you joined, you have provided feedback for ' . $totalSubmissions . ' eco-friendly actions, and the average rating of these is ';
                                        if ($totalSubmissions > 0) {
                                            $averageRating = $totalRating / $totalSubmissions;
                                            if ($averageRating >= 0 && $averageRating < 5) {
                                                echo '<span style="color: red;">' . $averageRating . '/10</span>';
                                            } elseif ($averageRating >= 5 && $averageRating < 8) {
                                                echo '<span style="color: #FFCC00;">' . $averageRating . '/10</span>';
                                            } else {
                                                echo '<span style="color: green;">' . $averageRating . '/10</span>';
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                        echo '</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title">Recycling Points</h3>
                                        <p class="card-text">Since you joined, you have visited a total of ' . $totalRecyclingPoints . ' recycling points.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">Community Stories</h2>
                                        <p class="card-text">Since you joined, you have published a total of ' . $total_stories . ' community stories.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}
?>