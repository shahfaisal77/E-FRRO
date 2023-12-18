// Add JavaScript code to handle form submission and validation here
document.getElementById("registrationForm").addEventListener("submit", function (event) {
    event.preventDefault();
    // Form submission handling code goes here
  
    // Fetch form values
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const nationality = document.getElementById("nationality").value;
    const dateOfBirth = document.getElementById("dateOfBirth").value;
    const passportNumber = document.getElementById("passportNumber").value;
    const visaExpirationDate = document.getElementById("visaExpirationDate").value;
    const passportExpirationDate = document.getElementById("passportExpirationDate").value;
  
    // Perform form validation (you can add more checks based on your requirements)
    if (!name || !email || !nationality || !dateOfBirth || !passportNumber || !visaExpirationDate || !passportExpirationDate) {
      alert("Please fill in all fields.");
      return;
    }
  
    // Submit the form data to the server using AJAX (you'll need to write this code)
    // Example using jQuery AJAX:
    // $.post("submit_form.php", {
    //   name: name,
    //   email: email,
    //   nationality: nationality,
    //   dateOfBirth: dateOfBirth,
    //   passportNumber: passportNumber,
    //   visaExpirationDate: visaExpirationDate,
    //   passportExpirationDate: passportExpirationDate
    // }, function (response) {
    //   alert(response); // Display server response
    // });
  
    // Clear the form after successful submission
    document.getElementById("registrationForm").reset();
  });
  