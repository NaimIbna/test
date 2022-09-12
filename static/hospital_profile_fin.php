<?php

include_once("../classes/entities/Hospital.class.php");
include "./helpers/Hospital/hospital_populator.inc.php";
//include "./helpers/Hospital/hospital_employee_counter.inc.php";

$hospital = json_decode($_SESSION["Hospital"]);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Hospital Profile Update - result</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <?php
    include_once("./helpers/Common/navbar.inc.php");
    ?>
    <div class="container" style="padding: 30px;">
        <div class="col">
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col">
                    <div class="card border-dark shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2"><img class="rounded-circle border border-dark" src="assets/img/blank-profile-picture-973460_1280.jpg" style="width: 150px;"></div>
                                <div class="col-auto col-xl-7" style="font-size: 5px;padding-top: 40px;">
                                    <?php echo '
                                    <h4>Welcome, admin of ' . $hospital->hospital_name . '</h4>
                                    <h4 style="font-weight: normal;font-size: 18px;">' . $hospital->address . '</h4>
                                    <h4 style="font-weight: normal;font-size: 18px;">' . $hospital->phone . '</h4>'
                                    ?>
                                </div>
                                <div class="col-xl-3 offset-xl-3 text-center d-xl-flex align-self-center justify-content-xl-center align-items-xl-center" style="margin-left: 0px;height: auto;">
                                    <div>
                                        <p><button class="btn btn-primary border rounded" type="button" style="width: 188px;height: 57px;font-size: 18px;" href="./hospital_dashboard.php/#admit-or-release">+Admit A Patient</button></p>
                                        <p><button class="btn btn-primary border rounded" type="button" style="width: 188px;height: 57px;font-size: 18px;" href="./hospital_dashboard.php/#admit-or-release">-Release A Patient</button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row" style="margin: 10px -15px;">
                    <div class="col-xl-12">
                        <div class="card shadow-sm">
                            <div class="card-body bg-light shadow-sm">
                                <h4 class="text-dark card-title" style="padding: 20px;color: #ffffff;font-size: 30px;">Admit or Release a Patient</h4>
                                <?php
                                $subheading_text = "Error encountered";
                                $summary_text = "Invalid request has been detected. Please be sure to provide correct information.";

                                if (isset($_POST["update_hospital_profile"])) {
                                    $stmt = $db->prepare("UPDATE Hospital SET " .
                                        "Hospital_name = '" . $_POST['hospital_name'] .
                                        "', Map_url = '" . $_POST['map_url'] .
                                        "', Address = '" . $_POST["address"] .
                                        "', Phone = " . $_POST["phone"] .
                                        ', General_ambulance = ' . $_POST["general_ambulance"] .
                                        ', Intensive_care_ambulance = ' . $_POST["intensive_care_ambulance"] .
                                        ' WHERE Hospital_id = ' . $hospital->hospital_id);
                                    $stmt->execute();

                                    $subheading_text = "Updating profile";
                                    $summary_text = "Details of " . $_POST["hospital_name"] . "has been successfully updated.";
                                }

                                echo '
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card" style="margin: 15px;">
                                                <div class="card-body shadow">
                                                    <h4 class="card-title" style="font-weight: 500;font-size: 20px;">' . $subheading_text . '</h4>
                                                    <h6 class="text-muted card-subtitle mb-2"></h6>
                                                    <div style="padding-top: 15px;">
                                                    <p> ' . $summary_text . ' </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>