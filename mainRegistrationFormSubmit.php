
<?php

session_start(); // Start the session to access session variables

require('db_connect.php'); // Include the database connection script

// Check if the form on the previous page was submitted and "save" button was clicked
if (isset($_POST['save'])) {
    // Check if the session variables are set
    if (isset($_SESSION['present_nationality']) && isset($_SESSION['frro_state']) && isset($_SESSION['city_district']) &&
        isset($_SESSION['services']) && isset($_SESSION['q1']) && isset($_SESSION['q3']) &&
        isset($_SESSION['visa_type']) && isset($_SESSION['visa_subtype'])) {

        // Store session variables in local variables for easier use
        $applicant_country = $_SESSION['present_nationality'];
        $applicant_state = $_SESSION['frro_state'];
        $applicant_city = $_SESSION['city_district'];
        $services = $_SESSION['services'];
        $new_born_child = $_SESSION['q1']; // Store in new_born_child
        $refuge = $_SESSION['q3']; // Store in refuge
        $visa_type = $_SESSION['visa_type']; // Store in visa_type
        $visa_sub_type = $_SESSION['visa_subtype']; // Store in visa_sub_type
        $user_id = $_SESSION['user_id']; // Store in user_id

        /* 
          Step 1: Insert data into the applicant table
         */
        // Prepare and execute your SQL INSERT query for the applicant table
        $applicant_sql = "INSERT INTO applicant (
            user_registration_id,
            surname,
            given_name,
            sex,
            father_name,
            spouse_name,
            dob,
            email,
            profession,
            new_born_child,
            military_service,
            refuge,
            service_selected,
            reg_number
        ) VALUES (
            '$user_id',
            '{$_POST['surname']}',
            '{$_POST['given_name']}',
            '{$_POST['sex']}',
            '{$_POST['fathers_name']}',
            '{$_POST['spouses_name']}',
            '{$_POST['date_of_birth']}',
            '{$_POST['email_id']}',
            '{$_POST['profession_occupation']}',
            '{$new_born_child}',     -- Insert from session variable
            '{$_POST['served_in_military']}',
            '{$refuge}',              -- Insert from session variable
            '{$services}',             -- Insert from session variable
            '{$_POST['reg_number']}' 
        )";

        // Execute the query
        if ($conn->query($applicant_sql) === TRUE) {
            // Get the last inserted applicant_id
            $applicant_id = $conn->insert_id;

            /* 
              Step 2: Insert data into the arrival_detail table
             */
            $city_embarking_boarding = isset($_POST['city_embarking_boarding']) ? $_POST['city_embarking_boarding'] : '';
            $country_embarking_boarding = isset($_POST['country_embarking_boarding']) ? $_POST['country_embarking_boarding'] : '';
            $date_arrival_in_india = isset($_POST['date_arrival_in_india']) ? $_POST['date_arrival_in_india'] : '';
            $place_disembarking_arrival = isset($_POST['place_disembarking_arrival']) ? $_POST['place_disembarking_arrival'] : '';
            $mode_of_journey = isset($_POST['mode_of_journey']) ? $_POST['mode_of_journey'] : '';

            $arrival_detail_sql = "INSERT INTO arrival_detail (applicant_id, city_of_boarding, country_of_boarding, date_of_arrival, place_of_arrival, mode_of_journey) VALUES ($applicant_id,'$city_embarking_boarding', '$country_embarking_boarding', '$date_arrival_in_india', '$place_disembarking_arrival', '$mode_of_journey')";

            // Execute the query and check for errors
            if ($conn->query($arrival_detail_sql) === FALSE) {
                echo "Error inserting data into the arrival_detail table. Please try again.";
            }

            /* 
              Step 3: Insert data into the organization table
             */
            $hospital_organization_name = isset($_POST['hospital_organization_name']) ? $_POST['hospital_organization_name'] : '';
            $hospital_organization_contact = isset($_POST['hospital_organization_contact']) ? $_POST['hospital_organization_contact'] : '';
            $hospital_organization_email = isset($_POST['hospital_organization_email']) ? $_POST['hospital_organization_email'] : '';

            $organization_sql = "INSERT INTO organization (name, contact, email, applicant_id) VALUES ('$hospital_organization_name', '$hospital_organization_contact', '$hospital_organization_email', $applicant_id)";

            // Execute the query and check for errors
            if ($conn->query($organization_sql) === FALSE) {
                echo "Error inserting Organization data. Please try again.";
            }

            /* 
              Step 4: Insert data into the address table for "Applicant" type
             */
            $applicant_address_sql = "INSERT INTO address (country, state, city, type, applicant_id) VALUES ('$applicant_country', '$applicant_state', '$applicant_city', 'Applicant', $applicant_id)";

            // Execute the address query for the applicant
            if ($conn->query($applicant_address_sql) === FALSE) {
                echo "Error inserting data into the address table (Applicant). Please try again.";
            }

            /* 
              Step 5: Insert data into the remaining address tables
             */
            // Insert "Last Address" into the address table
            $address_last_residence = isset($_POST['address_last_residence']) ? $_POST['address_last_residence'] : '';
            $city_last_residence = isset($_POST['city_last_residence']) ? $_POST['city_last_residence'] : '';
            $country_last_residence = isset($_POST['country_last_residence']) ? $_POST['country_last_residence'] : '';

            $last_address_sql = "INSERT INTO address (address, country, city, type, applicant_id) VALUES ('$address_last_residence', '$country_last_residence', '$city_last_residence', 'Last Address', $applicant_id)";
            if ($conn->query($last_address_sql) === FALSE) {
                echo "Error inserting Last Address. Please try again.";
            }

            // Insert "Longer Stay Address" into the address table
            $address_longer_stay = isset($_POST['address_longer_stay']) ? $_POST['address_longer_stay'] : '';
            $state_longer_stay = isset($_POST['state_longer_stay']) ? $_POST['state_longer_stay'] : '';
            $city_district_longer_stay = isset($_POST['city_district_longer_stay']) ? $_POST['city_district_longer_stay'] : '';

            $longer_stay_address_sql = "INSERT INTO address (address, state, city, type, applicant_id) VALUES ('$address_longer_stay', '$state_longer_stay', '$city_district_longer_stay', 'Longer Stay Address', $applicant_id)";
            if ($conn->query($longer_stay_address_sql) === FALSE) {
                echo "Error inserting Longer Stay Address. Please try again.";
            }

            // Insert "Passport" data into the address table
            $country_of_issue_passport = isset($_POST['country_of_issue_passport']) ? $_POST['country_of_issue_passport'] : '';
            $place_of_issue_passport = isset($_POST['place_of_issue_passport']) ? $_POST['place_of_issue_passport'] : '';

            $passport_address_sql = "INSERT INTO address (country, city, type, applicant_id) VALUES ('$country_of_issue_passport', '$place_of_issue_passport', 'Passport', $applicant_id)";
            if ($conn->query($passport_address_sql) === FALSE) {
                echo "Error inserting Passport data. Please try again.";
            }

            // Insert "Visa" data into the address table
            $country_of_issue_visa = isset($_POST['country_of_issue_visa']) ? $_POST['country_of_issue_visa'] : '';
            $place_of_issue_visa = isset($_POST['place_of_issue_visa']) ? $_POST['place_of_issue_visa'] : '';

            $visa_address_sql = "INSERT INTO address (country, city, type, applicant_id) VALUES ('$country_of_issue_visa', '$place_of_issue_visa', 'Visa', $applicant_id)";
            if ($conn->query($visa_address_sql) === FALSE) {
                echo "Error inserting Visa data. Please try again.";
            }

            // Insert "Organization" data into the address table
            $hospital_organization_address = isset($_POST['hospital_organization_address']) ? $_POST['hospital_organization_address'] : '';
            $hospital_organization_state = isset($_POST['hospital_organization_state']) ? $_POST['hospital_organization_state'] : '';
            $hospital_organization_city = isset($_POST['hospital_organization_city']) ? $_POST['hospital_organization_city'] : '';

            $organization_address_sql = "INSERT INTO address (address, state, city, type, applicant_id) VALUES ('$hospital_organization_address', '$hospital_organization_state', '$hospital_organization_city', 'Organization', $applicant_id)";
            if ($conn->query($organization_address_sql) === FALSE) {
                echo "Error inserting Organization data. Please try again.";
            }

            // Insert "Person to Contact" data into the address table
            $person_to_contact_address = isset($_POST['person_to_contact_address']) ? $_POST['person_to_contact_address'] : '';
            $person_to_contact_city = isset($_POST['person_to_contact_city']) ? $_POST['person_to_contact_city'] : '';
            $person_to_contact_country = isset($_POST['person_to_contact_country']) ? $_POST['person_to_contact_country'] : '';

            $person_to_contact_sql = "INSERT INTO address (address, city, country, type, applicant_id) VALUES ('$person_to_contact_address', '$person_to_contact_city', '$person_to_contact_country', 'Emergency', $applicant_id)";
            if ($conn->query($person_to_contact_sql) === FALSE) {
                echo "Error inserting Person to Contact data. Please try again.";
            }

            /* 
              Step 6: Insert data into the passport table
             */
            $passport_no = isset($_POST['passport_no']) ? $_POST['passport_no'] : '';
            $date_of_issue_passport = isset($_POST['date_of_issue_passport']) ? $_POST['date_of_issue_passport'] : '';
            $expiry_date_passport = isset($_POST['expiry_date_passport']) ? $_POST['expiry_date_passport'] : '';

            $passport_sql = "INSERT INTO passport (pno, date_of_issue, expiry_date, applicant_id) VALUES ('$passport_no', '$date_of_issue_passport', '$expiry_date_passport', $applicant_id)";
            if ($conn->query($passport_sql) === FALSE) {
                echo "Error inserting Passport data. Please try again.";
            }

            /* 
              Step 7: Insert data into the visa table
             */
            $visa_no = isset($_POST['visa_no']) ? $_POST['visa_no'] : '';
            $expiry_date_visa = isset($_POST['expiry_date_visa']) ? $_POST['expiry_date_visa'] : '';
            $date_of_issue_visa = isset($_POST['date_of_issue_visa']) ? $_POST['date_of_issue_visa'] : '';
            $valid_for = isset($_SESSION['valid_for']) ? $_SESSION['valid_for'] : '';
            $visa_type = $_SESSION['visa_type']; // Use session variable
            $visa_sub_type = $_SESSION['visa_subtype']; // Use session variable

            $visa_sql = "INSERT INTO visa (vno, expiry_date, date_of_issue, valid_for, visa_type, visa_sub_type, applicant_id) VALUES ('$visa_no', '$expiry_date_visa', '$date_of_issue_visa', '$valid_for', '$visa_type', '$visa_sub_type', $applicant_id)";
            if ($conn->query($visa_sql) === FALSE) {
                echo "Error inserting Visa data. Please try again.";
            }

            /* 
              Step 8: Insert data into the emergency_contact table
             */
            $person_to_contact_name = isset($_POST['person_to_contact_name']) ? $_POST['person_to_contact_name'] : '';
            $person_to_contact_relationship = isset($_POST['person_to_contact_relationship']) ? $_POST['person_to_contact_relationship'] : '';
            $person_to_contact_phone = isset($_POST['person_to_contact_phone']) ? $_POST['person_to_contact_phone'] : '';
            $person_to_contact_email = isset($_POST['person_to_contact_email']) ? $_POST['person_to_contact_email'] : '';

            $emergency_contact_sql = "INSERT INTO emergency_contact (name, relationship, contact, email, applicant_id) VALUES ('$person_to_contact_name', '$person_to_contact_relationship', '$person_to_contact_phone', '$person_to_contact_email', $applicant_id)";
            if ($conn->query($emergency_contact_sql) === FALSE) {
                echo "Error inserting Person to Contact data. Please try again.";
            }

            // Data insertion was successful
            header("Location: newRegisterDocUpload.php");
            exit();

        } else {
            // Data insertion failed for the applicant table
            echo '<script>alert("Error inserting data into the applicant table. Please try again.");</script>';
        }
    } else {
        // Handle the case where session variables are not set (e.g., if the form was not submitted from the correct page)
        echo "Session variables are not set. Form submission might not have occurred.";
    }
}

// If the form was not submitted, display an error
echo '<script>alert("Error: Form not submitted. Please try again.");</script>';

?>
