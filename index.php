
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foreign Student Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">







 
    <style>
        /* Add the following styles for animation */
        body {
            background-color: #f1f1f1; /* Change the background color of the body */
        }

        .container-with-margin {
            overflow: hidden; /* Hide overflow to prevent vertical scrollbars */
            overflow-x: hidden; /* Hide horizontal overflow */
        }

        .moving-section {
            animation: moveRightToLeft 22s linear infinite; /* Adjust the duration as needed */
            white-space: nowrap;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .text-content {
            display: inline-block;
        }

        @keyframes moveRightToLeft {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .section {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f8f8;
            text-align: center;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 10px 20px;
            color: white;
        }

        .container {
            transition: box-shadow 0.1s ease, transform 0.3s ease-in;
        }

       

        .navbar {
            z-index: 1;
        }

        .section:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand" href="#">Foreign Student Registration</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="new_user_registration.php">New Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 container-with-margin">
        <div class="jumbotron moving-section" style="padding: 20px;">
            <h1 class="display-4">Welcome to Foreign Student Registration</h1>
            <p class="lead">This website allows foreign students to be able to apply for visa extension in online mode</p>
        </div>

        <section class="section">
            <h2>What is e-FRRO?</h2>
            <p>
                Online FRRO Service delivery mechanism without requirement of visiting FRRO/FRO office. No requirement
                of taking
                appointment and visiting FRRO/FRO office unless specifically called upon by the FRRO/FRO. Web based
                application
                aimed to build centralized online platform for foreigners for visa related services. Its key objective
                is to provide
                Faceless, Cashless and Paperless services to the foreigners with user friendly experience. Using this
                application,
                foriegners are required to create their own USER-ID by registering themselves. Afterwards, they would
                apply online
                through registered user-id for various Visa and Immigration related services in India viz.
                Registration, Visa Extension,
               
                 Foreigners would not be required to mandatorily visit FRRO/FRO office for grant of service.
                However, in
                certain exceptional cases, the foreigner will be intimated to visit the FRRO/FRO on scheduled date and
                time for
                interview. In case of exigency, the foreigner can visit the FRRO/FRO office directly for grant of
                service.
            </p>
        </section>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">
                Version 1.1 © Content Owned by Ministry of Home Affairs, Government of India.
                e-FRRO is designed, developed and hosted by National Informatics Centre    </p>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>