<?php
// Start a PHP session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set session variables based on the form inputs
    $_SESSION['present_nationality'] = $_POST['present_nationality'];
    $_SESSION['frro_state'] = $_POST['frro_state'];
    $_SESSION['city_district'] = $_POST['city_district'];
    $_SESSION['services'] = $_POST['services'];
    $_SESSION['q1'] = $_POST['q1'];
    $_SESSION['q3'] = $_POST['q3'];
    $_SESSION['visa_type'] = $_POST['visa_type'];
    $_SESSION['visa_subtype'] = $_POST['visa_subtype'];
	
   
    
	header('Location: DocsRequiredInfo.php');

    exit; // Ensure that the script stops here and doesn't continue processing the rest of the page.
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Fresh Application</title>
	<!-- Add Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		/* Set Background Color */
		body {
			background-color: #f6f6f6;
			font-family: Arial, sans-serif;
		}

		/* Centered Title */
		.title {
			text-align: center;
			color: #117a8b;
		}

		/* Form Styling */
		form {
			padding: 40px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
		}

		.form-group label {
			font-weight: bold;
			color: #117a8b;
			font-size: 18px;
		}

		.form-group select {
			border: 1px solid #117a8b !important;
			border-radius: 5px !important;
			color: #4e616c !important;
			font-weight: bold !important;
			font-size: 16px;
		}

		.form-group input[type="radio"] {
			margin-right: 10px;
			font-size: 16px;
		}

		.table thead th {
			background-color: #117a8b;
			color: #fff;
			border: none;
			text-align: center;
			font-size: 18px;
		}

		.table td {
			font-weight: bold;
			border: none;
			font-size: 16px;
		}

		.table td:first-child {
			width: 50%;
		}

		.table td input[type="radio"] {
			margin-right: 5px;
			font-size: 16px;
		}

		.btn-primary {
			background-color: #117a8b;
			border: none;
			border-radius: 5px;
			font-size: 16px;
		}

		.btn-primary:hover {
			background-color: #0e6373;
		}

		.mt-4 {
			margin-top: 20px;
		}

        .custom-container {
            max-width: 100%;
            width: 100vw; 
            margin: 0 auto;
            overflow-x: hidden; /* hide horizontal overflow */
        }
	</style>
</head>

<body>
	
	<div class="custom-container">
		
		<div class="row justify-content-center align-items-center" style="min-height: 100vh;">
			<div class="col-md-6">
				<h2 class="title mb-4">Fresh Application</h2>
				<form method="post">

					<!-- Present Nationality dropdown -->
					<div class="form-group">
						<label for="present_nationality">Present Nationality *</label>
						<select class="form-control" id="present_nationality" name="present_nationality">
							<option value="">Select Present Nationality</option>
						</select>
					</div>

					<!-- FRRO/FRO State in India dropdown -->
					<div class="form-group">
						<label for="frro_state">FRRO/FRO State in India *</label>
						<select class="form-control" id="frro_state" name="frro_state">
							<option value="">Select FRRO/FRO State</option>
						</select>
					</div>

					<!-- City / District dropdown -->
					<div class="form-group">
						<label for="city_district">City / District *</label>
						<select class="form-control" id="city_district" name="city_district">
							<option value="">Select City / District</option>
						</select>
					</div>

					<!-- Services selection as radio buttons -->
					<div class="form-group">
						<label>Please Choose the Services you Desire:</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="services" id="registration" value="Registration">
							<label class="form-check-label" for="registration" style="font-size: 16px;">Registration</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="services" id="registration_extension" value="Registration_Extension">
							<label class="form-check-label" for="registration_extension" style="font-size: 16px;">Registration Extension</label>
						</div>
						
					</div>

					<!-- Category Table -->
					<div class="table-responsive mt-4">
						<table class="table table-bordered table-striped">
							<thead class="thead-dark">
								<tr>
									<th colspan="4" class="text-center">Category</th>
								</tr>
								<tr>
									<th style="font-size: 18px;">Questions</th>
									<th style="font-size: 18px;">Yes</th>
									<th style="font-size: 18px;">No</th>
									<th style="font-size: 18px;">Not Applicable</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="font-size: 16px;">Whether newly born child (born in India only)*</td>
									<td class="text-center"><input type="radio" name="q1" value="Yes"></td>
									<td class="text-center"><input type="radio" name="q1" value="No"></td>
									<td class="text-center"></td>
								</tr>
								<tr>
									<td style="font-size: 16px;">Refugee*</td>
									<td class="text-center"><input type="radio" name="q3" value="Yes"></td>
									<td class="text-center"><input type="radio" name="q3" value="No"></td>
									<td class="text-center"></td>
								</tr>
							</tbody>
						</table>
					</div>

					<!-- Additional Lines of Sentences -->
					<p class="mt-4" style="color: red; font-size: 16px;">1) For Medical Attendant Visa, select Medical as Visa Type and MED-2 as Visa Subtype.</p>
					<p style="color: red; font-size: 16px;">2) For Research Visa, select Student as Visa type and S-5 as Visa Subtype.</p>

					<!-- Visa Type dropdown -->
<div class="form-group">
    <label for="visa_type" style="font-size: 18px;">Visa Type *</label>
    <select class="form-control" id="visa_type" name="visa_type" style="font-size: 16px;">
        <option value="" disabled>Select Visa Type</option>
        <option value="Student Visa">Student Visa</option>
        <option value="Business Visa" disabled>Business Visa</option>
        <option value="Films Visa" disabled>Films Visa</option>
        <option value="United Nations" disabled>United Nations</option>
    </select>
</div>


					<!-- Visa Subtype dropdown -->
					<div class="form-group">
						<label for="visa_subtype" style="font-size: 18px;">Visa Subtype *</label>
						<select class="form-control" id="visa_subtype" name="visa_subtype" style="font-size: 16px;">
							<option value="">Select Visa Subtype</option>
							<option value="S-1">S-1 (For Higher Studies)</option>
							<option value="S-2">S-2 (School Education in India)</option>
							<option value="S-3">S-3 (Studying Yoga, Vedic Culture)</option>
							<option value="S-4">S-4 (For Theological Studies)</option>
						</select>
					<!-- Back and Submit buttons -->
					<br>
<div class="form-group">
    <a href="registeredHome.php" class="btn btn-secondary">Back</a>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap JS (for optional JavaScript components) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- JavaScript code to populate the dropdowns with options -->
	<script>
		// Function to populate dropdown with options
		function populateDropdown(options, dropdownId) {
			const dropdown = document.getElementById(dropdownId);
			options.sort();

			options.forEach(option => {
				const element = document.createElement('option');
				element.value = option;
				element.textContent = option;
				dropdown.appendChild(element);
			});
		}

		// List of countries
		const countries = [
			"Afghanistan", "Australia", "Brazil", "Canada", "China", "Egypt",
			"France", "Germany", "India", "Italy", "Japan", "Mexico",
			"Russia", "South Korea", "Spain", "Switzerland", "Thailand",
			"United Arab Emirates", "United Kingdom", "USA"
		];

		// List of Indian states
		const indianStates = [
			"Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh",
			"Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka",
			"Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram",
			"Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu",
			"Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
		];

		// List of cities in India
		const indianCities = [
			"Mumbai", "Delhi", "Bangalore", "Hyderabad", "Chennai",
			"Kolkata", "Ahmedabad", "Pune", "Surat", "Jaipur",
			"Lucknow", "Kanpur", "Nagpur", "Indore", "Thane",
			"Bhopal", "Visakhapatnam", "Pimpri-Chinchwad", "Patna", "Vadodara"
		];

		// Populate nationality dropdown
		populateDropdown(countries, 'present_nationality');

		// Populate FRRO/FRO States dropdown with Indian states
		populateDropdown(indianStates, 'frro_state');

		// Populate City / District dropdown with Indian city names
		populateDropdown(indianCities, 'city_district');
	</script>

</body>

</html>
