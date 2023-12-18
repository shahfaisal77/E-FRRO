


CREATE TABLE IF NOT EXISTS new_user_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    nationality VARCHAR(50) NOT NULL,
    mobile VARCHAR(15),
    given_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    passport_number VARCHAR(50) NOT NULL,
    type ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO new_user_registration (email, password, gender, nationality, given_name, date_of_birth, passport_number, type)
VALUES ('admin@gmail.com', 'shah', 'male', 'afg', 'admin', '2000-03-04', '77777', 'admin');








CREATE TABLE IF NOT EXISTS applicant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_registration_id INT UNIQUE,
    FOREIGN KEY (user_registration_id) REFERENCES new_user_registration(id),
    surname VARCHAR(255),
    given_name VARCHAR(255) NOT NULL,
    sex ENUM('Male', 'Female', 'Other') NOT NULL,
    father_name VARCHAR(255),
    spouse_name VARCHAR(255),
    dob DATE NOT NULL,
    email VARCHAR(255),
    profession VARCHAR(255),
    new_born_child VARCHAR(20),
    military_service VARCHAR(20),
    refuge VARCHAR(20),
    service_selected VARCHAR(50)
);

CREATE TABLE organization (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact VARCHAR(255),
    email VARCHAR(255),
    applicant_id INT,
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE
);

CREATE TABLE arrival_detail (
    arrival_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id INT,
    city_of_boarding VARCHAR(255),
    country_of_boarding VARCHAR(255),
    date_of_arrival DATE,
    place_of_arrival VARCHAR(255),
    mode_of_journey VARCHAR(255),
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE
);


CREATE TABLE address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    country VARCHAR(255),
    type ENUM(
        'Organization',
        'Applicant',
        'Passport',
        'Visa',
        'Emergency',
        'Last Address',
        'Longer Stay Address',
        'Arrival Date'
    ) NOT NULL,
    applicant_id INT, -- New column for linking to applicant
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE-- One-to-many relationship with applicant
);


CREATE TABLE passport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pno VARCHAR(255) NOT NULL,
    date_of_issue DATE,
    expiry_date DATE,
    applicant_id INT,
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE
);

CREATE TABLE visa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vno VARCHAR(255) NOT NULL,
    expiry_date DATE,
    date_of_issue DATE,
    valid_for VARCHAR(255),
    visa_type VARCHAR(255),
    visa_sub_type VARCHAR(255),
    applicant_id INT,
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE
);


CREATE TABLE emergency_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    relationship VARCHAR(255),
    contact VARCHAR(255),
    email VARCHAR(255),
    applicant_id INT,
    FOREIGN KEY (applicant_id) REFERENCES applicant(id) ON DELETE CASCADE
);

ALTER TABLE applicant
ADD COLUMN status_inquiry VARCHAR(255);



ALTER TABLE applicant
ADD COLUMN reg_number VARCHAR(255);

ALTER TABLE applicant
ADD COLUMN missing_docs_status VARCHAR(50);


-- Insert into 'applicant' table
INSERT INTO applicant (
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
    status_inquiry,
    reg_number,
    missing_docs_status
) VALUES (
    'malakzay',
    'shah',
    'Male',
    'John Doe Sr.',
    'Jane Doe',
    '1990-01-01',
    'nnn128422@gmail.com',
    'Engineer',
    'No',
    'No',
    'No',
    'Registration',
    'underprocess',
    'ABC123',
    'visa'
);

-- Get the ID of the inserted record in 'applicant' table
SET @applicant_id = LAST_INSERT_ID();

-- Insert into 'organization' table
INSERT INTO organization (
    name,
    contact,
    email,
    applicant_id
) VALUES (
    'Fergusson college',
    '123-456-7890',
    'info@fergusson.com',
    @applicant_id
);

-- Insert into 'arrival_detail' table
INSERT INTO arrival_detail (
    applicant_id,
    city_of_boarding,
    country_of_boarding,
    date_of_arrival,
    place_of_arrival,
    mode_of_journey
) VALUES (
    @applicant_id,
    'Kabul',
    'AFG',
    '2023-01-15',
    'Airport1',
    'Air'
);

-- Insert into 'address' table
INSERT INTO address (
    address,
    city,
    state,
    country,
    type,
    applicant_id
) VALUES (
    'gokhly nagar daffads',
    'pune adfa',
    'mah av asdfva',
    'Country2',
    'Applicant',
    @applicant_id
);

-- Insert into 'passport' table
INSERT INTO passport (
    pno,
    date_of_issue,
    expiry_date,
    applicant_id
) VALUES (
    'P123456',
    '2022-01-01',
    '2025-01-01',
    @applicant_id
);

-- Insert into 'visa' table
INSERT INTO visa (
    vno,
    expiry_date,
    date_of_issue,
    valid_for,
    visa_type,
    visa_sub_type,
    applicant_id
) VALUES (
    'V789012',
    '2023-01-01',
    '2023-01-15',
    '90 days',
    'Tourist',
    'Single Entry',
    @applicant_id
);

-- Insert into 'emergency_contact' table
INSERT INTO emergency_contact (
    name,
    relationship,
    contact,
    email,
    applicant_id
) VALUES (
    'ahmad',
    'Friend',
    '987-654-3210',
    'emergency@example.com',
    @applicant_id
);
