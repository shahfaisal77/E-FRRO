<?php
session_start();
require 'db_connect.php';
/*echo $_SESSION['present_nationality'];
echo $_SESSION['frro_state'];
echo $_SESSION['city_district'];
echo $_SESSION['services'];
echo $_SESSION['q1'];
echo $_SESSION['q3'];
echo $_SESSION['visa_type'];
echo $_SESSION['visa_subtype'];*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Main Registration Form</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--using css to reduce and adjust the size of the page fonts and layouts-->
    <style>
        body {
            font-size: 13px;
        }
        .form-group h2 {
            font-size: 16px;
            margin-bottom: 8px;
        }
        label {
            font-size: 12px;
        }
        select, input[type="text"], input[type="email"], input[type="date"], input[type="tel"] {
            height: 25px;
            font-size: 12px;
        }
        .form-check-label {
            font-size: 12px;
        }
        .btn {
            font-size: 12px;
            padding: 5px 10px;
        }
        .row-cols-4 > * {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .container {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>
<?php
require 'countries_list.php'; // Include the countries list 
require 'states_list.php';
require 'cities_list.php';    // Include the cities list
//require 'db_connect.php'; // to save the details we need the connection details
?>

    <div class="container mt-5">
    <form method="post" action="mainRegistrationFormSubmit.php" >

            <!-- Personal Details section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Personal Details</h2>
                <div class="row">
                    <div class="col-md-4">
                        <label>Surname:</label>
                        <input type="text" class="form-control " name="surname">


                    </div>
                    <div class="col-md-4">
                        <label>Given Name*:</label>
            <?php
            // Assuming you have a database connection established
            include 'db_connect.php';

            // Fetch the user's given name from the database
            $userId = $_SESSION['user_id']; // Assuming you have the user's ID in the session
            $givenNameQuery = "SELECT given_name FROM new_user_registration WHERE id = $userId";
            $givenNameResult = $conn->query($givenNameQuery);

            if ($givenNameResult->num_rows > 0) {
                $givenNameRow = $givenNameResult->fetch_assoc();
                $givenName = $givenNameRow['given_name'];
            } else {
                $givenName = ''; // Set a default value if the given name is not found
            }
            ?>
            <input type="text" class="form-control" name="given_name" value="<?php echo $givenName; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Sex*:</label>
                        <select class="form-control" name="sex" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <!-- Add more input fields for Personal Details here -->
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Father's Name:</label>
                        <input type="text" class="form-control" name="fathers_name">
                    </div>
                    <div class="col-md-4">
                        <label>Spouse's Name:</label>
                        <input type="text" class="form-control" name="spouses_name">
                    </div>
                    <div class="col-md-4">
                    <label>Date Of Birth*:</label>
            <?php
            // Fetch the user's date of birth from the database
            $dobQuery = "SELECT date_of_birth FROM new_user_registration WHERE id = $userId";
            $dobResult = $conn->query($dobQuery);

            if ($dobResult->num_rows > 0) {
                $dobRow = $dobResult->fetch_assoc();
                $dateOfBirth = $dobRow['date_of_birth'];
            } else {
                $dateOfBirth = ''; // Set a default value if the date of birth is not found
            }
            ?>
            <input type="date" class="form-control" name="date_of_birth" value="<?php echo $dateOfBirth; ?>" required readonly>
                    </div>
                </div>
                <!-- Add more input fields for Personal Details here -->
                <!-- Add the remaining Personal Details input fields here -->
            </div>

            <!-- Address of Last Residence (Outside India) section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Address of Last Residence (Outside India)</h2>
                <!-- Add input fields for Address of Last Residence (Outside India) here -->
                <div class="row">
                    <div class="col-md-4">
                        <label>Address*:</label>
                        <input type="text" class="form-control" name="address_last_residence" required>
                    </div>
                    <div class="col-md-4">
                        <label>City*:</label>
                        <input type="text" class="form-control" name="city_last_residence" required>
                    </div>
                    <div class="col-md-4">
                        <label>Country*:</label>
                        <select class="form-control" name="country_last_residence" required>
                            <option value="">Select</option>
                            <!-- Add the list of countries here as options -->
                            <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- Add more input fields for Address of Last Residence (Outside India) here -->
                <!-- Add the remaining Address of Last Residence input fields here -->
            </div>

            <!-- Address Intended for Longer Stay in India (Registration) section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Address Intended for Longer Stay in India (Registration)</h2>
                <!-- Add input fields for Address Intended for Longer Stay in India (Registration) here -->
                <div class="row">
                    <div class="col-md-4">
                        <label>Address*:</label>
                        <input type="text" class="form-control" name="address_longer_stay" required>
                    </div>
                    <div class="col-md-4">
                    <label>State*:</label>
    <select class="form-control" name="state_longer_stay" id="stateSelect" required >
        <option value="">Select</option>
        <!-- Add the list of states here as options -->
        <?php foreach ($states as $state) : ?>
            <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
        <?php endforeach; ?>
    </select>
                    </div>
                    <div class="col-md-4">
                        <label>City/District*:</label>
                        <select class="form-control" name="city_district_longer_stay"  id="citySelect" required>
        <option value="">Select</option>
    </select>
                    </div>
                </div>
                <!-- Add more input fields for Address Intended for Longer Stay in India here -->
                <!-- Add the remaining Address Intended for Longer Stay in India input fields here -->
            </div>

            <!-- Email/Professional/Occupation Details section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Email/Professional/Occupation Details</h2>
                <!-- Add input fields for Email/Professional/Occupation Details here -->
                <div class="row">
                    <div class="col-md-4">
                        <!-- Fetch the user's email from the database -->
    <?php
    // Assuming you have a database connection established
    

    // Fetch the user's email from the database
    $userId = $_SESSION['user_id']; // Assuming you have the user's ID in the session
    $emailQuery = "SELECT email FROM new_user_registration WHERE id = $userId";
    $emailResult = $conn->query($emailQuery);

    if ($emailResult->num_rows > 0) {
        $emailRow = $emailResult->fetch_assoc();
        $email = $emailRow['email'];
    } else {
        $email = ''; // Set a default value if the email is not found
    }
    ?>
                        <label>Email ID:</label>
                        <input type="email" class="form-control" name="email_id" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Profession/Occupation*:</label>
                        <select class="form-control" name="profession_occupation" required onchange="checkOccupation(this)">
    <option value="">Select</option>
    <!-- Add the list of professions/occupations here as options -->
    <option value="AIR FORCE">AIR FORCE</option>
    <option value="Artist">Artist</option>
    <option value="BUSINESS">BUSINESS</option>
    <option value="CAMERA PERSON">CAMERA PERSON</option>
    <option value="CEO/COO">CEO/COO</option>
    <option value="DIPLOMAT">DIPLOMAT</option>
    <option value="Director">Director</option>
    <option value="DOCTOR">DOCTOR</option>
    <option value="ENGINEER">ENGINEER</option>
    <option value="LAWYER">LAWYER</option>
    <option value="FILM PRODUCER">FILM PRODUCER</option>
    <option value="STUDENT">STUDENT</option>
</select>
                    </div>
                    <!-- Add more input fields for Email/Professional/Occupation Details here -->
                    <!-- Add the remaining Email/Professional/Occupation Details input fields here -->
                </div>
            </div>

            <!-- Passport Details section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Passport Details</h2>
                <!-- Add input fields for Passport Details here -->
                <div class="row">
                    <div class="col-md-4">
                        <label>Passport no*:</label>
                        <?php
                // Fetch the user's passport number from the database
                $userId = $_SESSION['user_id']; // Assuming you have the user's ID in the session
                $query = "SELECT passport_number FROM new_user_registration WHERE id = $userId";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $passportNumber = $row['passport_number'];
                } else {
                    $passportNumber = ''; // Set a default value if the passport number is not found
                }
            ?>
            <input type="text" class="form-control" name="passport_no" value="<?php echo $passportNumber; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Country of issue*:</label>
                        <select class="form-control" name="country_of_issue_passport" required>
                            <option value="">Select</option>
                            <!-- Add the list of countries here as options -->
                            <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Place of Issue*(City Name):</label>
                        <input type="text" class="form-control"  name="place_of_issue_passport" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Date of Issue*:</label>
                        <input type="date" class="form-control" name="date_of_issue_passport" required>
                    </div>
                    <div class="col-md-4">
                        <label>Expiry Date*:</label>
                        <input type="date" class="form-control" name="expiry_date_passport" required>
                    </div>
                    <!-- Add more input fields for Passport Details here -->
                    <!-- Add the remaining Passport Details input fields here -->
                </div>
            </div>

            <!-- Current Visa Details section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Current Visa Details</h2>
                <!-- Add input fields for Current Visa Details here -->
                <div class="row">
                    <div class="col-md-4">
                        <label>Visa no*:</label>
                        <input type="text" class="form-control" name="visa_no" id="visa_no" required>
            <div id="visa_no_example" style="color: #6c757d; font-size: 14px;">Example: ABC123</div>
                    </div>
                    <div class="col-md-4">
                        <label>Country of issue*:</label>
                        <select class="form-control" name="country_of_issue_visa" required>
                            <option value="">Select</option>
                            <!-- Add the list of countries here as options -->
                            <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Place of Issue*(City name):</label>
                        <input type="text" class="form-control" name="place_of_issue_visa" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Date of Issue*:</label>
                        <input type="date" class="form-control" name="date_of_issue_visa" required>
                    </div>
                    <div class="col-md-4">
                        <label>Expiry Date*:</label>
                        <input type="date" class="form-control" name="expiry_date_visa" required>
                    </div>
                    <div class="col-md-4">
                        <label>Valid for*:</label>
                        <select class="form-control" name="valid_for" required>
                            <option value="">Select</option>
                            <option value="single-entry">Single Entry</option>
                            <option value="double-entry">Double Entry</option>
                            <option value="triple-entry">Triple Entry</option>
                            <option value="four-entry">Four Entry</option>
                            <option value="multiple-entry">Multiple Entry</option>
                        </select>
                    </div>
                    <!-- Add more input fields for Current Visa Details here -->
                    <!-- Add the remaining Current Visa Details input fields here -->
                </div>
            </div>

            <!-- Hospital Details/Organization/Company/Institute Details section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Hospital Details/Organization/Company/Institute Details</h2>
                <!-- Add input fields for Hospital Details/Organization/Company/Institute Details here -->
                <div class="row">
                    <div class="col-md-4">
                        <label>Name*:</label>
                        <input type="text" class="form-control" name="hospital_organization_name" required>
                    </div>
                    <div class="col-md-4">
                        <label>Address*:</label>
                        <input type="text" class="form-control" name="hospital_organization_address" required>
                    </div>
                    <div class="col-md-4">
                    <label>State*:</label>
            <select class="form-control"  id="hospitalStateSelect" name="hospital_organization_state" required>
                <option value="">Select</option>
                <?php foreach ($states as $state) : ?>
                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                <?php endforeach; ?>
            </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label>City/District*:</label>
            <select class="form-control"  id="hospitalCitySelect" name="hospital_organization_city" required>
                <option value="">Select</option>
            </select>
                    </div>
                    <div class="col-md-4">
                        <label>Contact:</label>
                        <input type="tel" class="form-control" name="hospital_organization_contact">
                    </div>
                    <div class="col-md-4">
                        <label>Email-ID:</label>
                        <input type="email" class="form-control" name="hospital_organization_email">
                    </div>
                    <!-- Add more input fields for Hospital Details/Organization/Company/Institute Details here -->
                    <!-- Add the remaining Hospital Details/Organization/Company/Institute Details input fields here -->
                </div>
            </div>

            <!-- Arrival Details section -->
<div class="form-group">
    <h2 class="bg-primary text-white p-2">Arrival Details</h2>
    <!-- Add input fields for Arrival Details here -->
    <div class="row">
        <div class="col-md-4">
            <label>City of Embarking/Boarding for India*:</label>
            <input type="text" class="form-control" name="city_embarking_boarding" required>
        </div>
        <div class="col-md-4">
            <label>Country of Embarking/Boarding for India*:</label>
            <select class="form-control" name="country_embarking_boarding" required>
                <option value="">Select</option>
                <!-- Add the list of countries here as options -->
                <?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Date of Arrival in India*:</label>
            <input type="date" class="form-control" name="date_arrival_in_india" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label>Place of Disembarking/Arrival in India*:</label>
            <select class="form-control" id="stateSelect" name="place_disembarking_arrival" required>
                <option value="">Select</option>
                <!-- Add the list of states here as options -->
                <?php foreach ($states as $state) : ?>
                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Mode of Journey*:</label>
            <select class="form-control" name="mode_of_journey" required>
                <option value="">Select</option>
                <option value="air">Air</option>
                <option value="others">Others</option>
                <option value="rail">Rail</option>
                <option value="road">Road</option>
                <option value="ship">Ship</option>
            </select>
        </div>
        <!-- Add more input fields for Arrival Details here -->
        <!-- Add the remaining Arrival Details input fields here -->
    </div>
</div>


            <!-- Previous Registration in India Details (if any) section -->
            

            <!-- Details of Family Members/Attendant/Dependents section -->
           

            <!-- Person to Be Contacted in Case of Emergency section -->
            <div class="form-group">
    <h2 class="bg-primary text-white p-2">Person to Be Contacted in Case of Emergency</h2>
    <!-- Add input fields for Person to Be Contacted in Case of Emergency here -->
    <div class="row">
        <div class="col-md-4">
            <label>Name:</label>
            <input type="text" class="form-control" name="person_to_contact_name">
        </div>
        <div class="col-md-4">
            <label>Relationship:</label>
            <input type="text" class="form-control" name="person_to_contact_relationship">
        </div>
        <div class="col-md-4">
            <label>Address:</label>
            <input type="text" class="form-control" name="person_to_contact_address">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label>City:</label>
            <input type="text" class="form-control" name="person_to_contact_city">
        </div>
        <div class="col-md-4">
            <label>Country:</label>
            <select class="form-control" name="person_to_contact_country">
                <option value="">Select</option>
                <!-- Add the list of countries here as options -->
                <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Phone Number:</label>
            <input type="tel" class="form-control" name="person_to_contact_phone">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label>Email:</label>
            <input type="email" class="form-control" name="person_to_contact_email">
        </div>
        <!-- Add more input fields for Person to Be Contacted in Case of Emergency here -->
        <!-- Add the remaining Person to Be Contacted in Case of Emergency input fields here -->
    </div>
</div>


            <!-- Have You Served in Military/Navy/Air Force or Reserve of Any Country? section -->
            <div class="form-group">
                <h2 class="bg-primary text-white p-2">Have You Served in Military/Navy/Air Force or Reserve of Any Country?*</h2>
                <!-- Add input fields for Have You Served in Military/Navy/Air Force or Reserve of Any Country? here -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="served_in_military" value="No" required>
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="served_in_military" value="Yes" required >
                            <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                    <!-- Add more input fields for Have You Served in Military/Navy/Air Force or Reserve of Any Country? here -->
                    <!-- Add the remaining Have You Served in Military/Navy/Air Force or Reserve of Any Country? input fields here -->
                </div>
            </div>

            <!-- Save and Continue & Exit to Home Buttons -->
            <div class="form-group">
            <button type="submit" class="btn btn-primary" name="save" id="saveBtn">Save and Continue</button>
                <a href="fresh_application.php" class="btn btn-secondary">Exit to Home</a>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JS (for optional JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    const citiesByState = <?php echo json_encode($citiesByState); ?>;
    const citySelect = document.getElementById('citySelect');
    const stateSelect = document.getElementById('stateSelect');
    
    stateSelect.addEventListener('change', function () {
        const selectedState = stateSelect.value;
        citySelect.innerHTML = ''; // Clear previous options
        
        const cities = citiesByState[selectedState];
        if (cities) {
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Select';
            citySelect.appendChild(option);
        }
    });

    //for hospital section drop down lists as per state selected
    const hospitalCitySelect = document.getElementById('hospitalCitySelect');
    const hospitalStateSelect = document.getElementById('hospitalStateSelect');
    
    hospitalStateSelect.addEventListener('change', function () {
        const selectedState = hospitalStateSelect.value;
        hospitalCitySelect.innerHTML = ''; // Clear previous options
        
        const cities = citiesByState[selectedState];
        if (cities) {
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                hospitalCitySelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Select';
            hospitalCitySelect.appendChild(option);
        }
    });

    // fro arrival details dynamic city selection based on country selected
    const previousRegistrationCitySelect = document.getElementById('previousRegistrationCitySelect');
const previousRegistrationStateSelect = document.getElementById('previousRegistrationStateSelect');

previousRegistrationStateSelect.addEventListener('change', function () {
    const selectedState = previousRegistrationStateSelect.value;
    previousRegistrationCitySelect.innerHTML = ''; // Clear previous options

    const cities = citiesByState[selectedState];
    if (cities) {
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            previousRegistrationCitySelect.appendChild(option);
        });
    } else {
        const option = document.createElement('option');
        option.value = '';
        option.textContent = 'Select';
        previousRegistrationCitySelect.appendChild(option);
    }
});
</script>


<script>
function checkOccupation(selectElement) {
    var selectedValue = selectElement.value;
    
    if (selectedValue !== 'STUDENT') {
        // If the selected value is not 'STUDENT', reset the selection
        selectElement.selectedIndex = 0;
        alert('Only "STUDENT" is allowed as the occupation.');
    }
}
</script>




<script>
document.getElementById('visa_no').addEventListener('input', function () {
    validateVisaNumber(this.value);
});

function validateVisaNumber(visaNumber) {
    // Check if the length is exactly 6 and the format is alphanumeric
    if (/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6}$/.test(visaNumber)) {
        // Valid visa number
        // You can add further actions if needed
        document.getElementById('visa_no_example').innerText = 'Example: ABC123';
    } else {
        // Invalid visa number
        // Provide feedback to the user (e.g., display an error message)
        document.getElementById('visa_no_example').innerText = 'Invalid format. Please enter exactly 6 alphanumeric characters with at least one letter and one number.';
    }
}

// Display example format when the page loads
window.onload = function () {
    document.getElementById('visa_no_example').innerText = 'Example: ABC123';
};

// Add an event listener to your specific submit button
document.getElementById('saveBtn').addEventListener('click', function (event) {
    // Get the value of the visa number input
    var visaNumber = document.getElementById('visa_no').value;

    // Validate the visa number
    if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6}$/.test(visaNumber)) {
        // Invalid format, prevent form submission
        event.preventDefault();
        alert('Invalid format. Please enter exactly 6 alphanumeric characters with at least one letter and one number for the visa number.');
    } else {
        // Add additional checks if needed
        // Continue with form submission
    }
});
</script>

    
</body>
</html>

<!-- I've applied the "row-cols-4" class to each section's "row" element, which should result in a consistent 4-column layout for all sections in the form.-->