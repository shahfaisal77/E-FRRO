<?php
// Define an associative array with states as keys and arrays of cities as values
$citiesByState = array(
    'Andhra Pradesh' => array(
        'Anantapur', 'Chittoor', 'East Godavari', 'Alluri Sitarama Raju', 'Anakapalli',
        'Annamaya', 'Bapatla', 'Eluru', 'Guntur', 'Kadapa', 'Kakinada', 'Konaseema',
        'Krishna', 'Kurnool', 'Manyam', 'N T Rama Rao', 'Nandyal', 'Nellore', 'Palnadu',
        'Prakasam', 'Sri Balaji', 'Sri Satya Sai', 'Srikakulam', 'Visakhapatnam',
        'Vizianagaram', 'West Godavari'
    ),
    'Arunachal Pradesh' => array(
        'Anjaw', 'Siang', 'Changlang', 'Dibang Valley', 'East Kameng', 'East Siang',
        'Kamle', 'Kra Daadi', 'Kurung Kumey', 'Lepa Rada', 'Lohit', 'Longding',
        'Lower Dibang Valley', 'Lower Siang', 'Lower Subansiri', 'Namsai', 'Pakke Kessang',
        'Papum Pare', 'Shi Yomi', 'Tawang', 'Tirap', 'Upper Siang', 'Upper Subansiri',
        'West Kameng', 'West Siang'
    ),
    'Assam' => array(
        'Baksa', 'Barpeta', 'Bongaigaon', 'Cachar', 'Charaideo', 'Chirang', 'Darrang',
        'Dhemaji', 'Dhubri', 'Dibrugarh', 'Dima Hasao', 'Goalpara', 'Golaghat', 'Hailakandi',
        'Hojai', 'Jorhat', 'Kamrup', 'Kamrup Metropolitan', 'Karbi Anglong', 'Karimganj',
        'Kokrajhar', 'Lakhimpur', 'Majuli', 'Morigaon', 'Nagaon', 'Nalbari', 'Sivasagar',
        'Sonitpur', 'South Salmara-Mankachar', 'Tinsukia', 'Udalguri', 'West Karbi Anglong'
    ),
    // Continue adding the remaining states and districts in a similar manner
    'Maharashtra' => array(
        'Ahmednagar', 'Akola', 'Amravati', 'Aurangabad', 'Beed', 'Bhandara', 'Buldhana',
        'Chandrapur', 'Dhule', 'Gadchiroli', 'Gondia', 'Hingoli', 'Jalgaon', 'Jalna',
        'Kolhapur', 'Latur', 'Mumbai', 'Nagpur', 'Nanded', 'Nandurbar', 'Nashik', 'Osmanabad',
        'Palghar', 'Parbhani', 'Pune', 'Raigad', 'Ratnagiri', 'Sangli', 'Satara', 'Sindhudurg',
        'Solapur', 'Thane', 'Wardha', 'Washim', 'Yavatmal'
    ),
    'Manipur' => array(
        'Bishnupur', 'Chandel', 'Churachandpur', 'Imphal East', 'Imphal West', 'Jiribam',
        'Kakching', 'Kamjong', 'Kangpokpi', 'Noney', 'Pherzawl', 'Senapati', 'Tamenglong',
        'Tengnoupal', 'Thoubal', 'Ukhrul'
    ),
    'Meghalaya' => array(
        'East Garo Hills', 'East Jaintia Hills', 'East Khasi Hills', 'North Garo Hills',
        'Ri-Bhoi', 'South Garo Hills', 'South West Garo Hills', 'South West Khasi Hills',
        'West Garo Hills', 'West Jaintia Hills', 'West Khasi Hills'
    ),
    'Mizoram' => array(
        'Aizawl East', 'Aizawl West', 'Champhai', 'Kolasib', 'Lawngtlai', 'Lunglei',
        'Mamit', 'Saiha', 'Serchhip'
    ),
    'Nagaland' => array(
        'Dimapur', 'Kiphire', 'Kohima', 'Longleng', 'Mokokchung', 'Mon', 'Peren', 'Phek',
        'Tuensang', 'Wokha', 'Zunheboto'
    ),
    'Odisha' => array(
        'Angul', 'Balangir', 'Balasore', 'Bargarh', 'Bhadrak', 'Boudh', 'Cuttack',
        'Deogarh', 'Dhenkanal', 'Gajapati', 'Ganjam', 'Jagatsinghpur', 'Jajpur', 'Jharsuguda',
        'Kalahandi', 'Kandhamal', 'Kendrapara', 'Kendujhar', 'Khordha', 'Koraput', 'Malkangiri',
        'Mayurbhanj', 'Nabarangpur', 'Nayagarh', 'Nuapada', 'Puri', 'Rayagada', 'Sambalpur',
        'Subarnapur', 'Sundargarh'
    ),

    'Punjab' => array(
        'Amritsar', 'Barnala', 'Bathinda', 'Faridkot', 'Fatehgarh Sahib', 'Fazilka',
        'Ferozepur', 'Gurdaspur', 'Hoshiarpur', 'Jalandhar', 'Kapurthala', 'Ludhiana',
        'Mansa', 'Moga', 'Muktsar', 'Nawanshahr', 'Pathankot', 'Patiala', 'Rupnagar',
        'Sangrur', 'SAS Nagar', 'SBS Nagar', 'Sri Muktsar Sahib', 'Tarn Taran'
    ),
    'Rajasthan' => array(
        'Ajmer', 'Alwar', 'Banswara', 'Baran', 'Barmer', 'Bharatpur', 'Bhilwara',
        'Bikaner', 'Bundi', 'Chittorgarh', 'Churu', 'Dausa', 'Dholpur', 'Dungarpur',
        'Hanumangarh', 'Jaipur', 'Jaisalmer', 'Jalore', 'Jhalawar', 'Jhunjhunu', 'Jodhpur',
        'Karauli', 'Kota', 'Nagaur', 'Pali', 'Pratapgarh', 'Rajsamand', 'Sawai Madhopur',
        'Sikar', 'Sirohi', 'Sri Ganganagar', 'Tonk', 'Udaipur'
    ),
    'Sikkim' => array(
        'East Sikkim', 'North Sikkim', 'South Sikkim', 'West Sikkim'
    ),
    'Tamil Nadu' => array(
        'Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri',
        'Dindigul', 'Erode', 'Kallakurichi', 'Kancheepuram', 'Kanyakumari', 'Karur', 'Krishnagiri',
        'Madurai', 'Nagapattinam', 'Namakkal', 'Nilgiris', 'Perambalur', 'Pudukkottai', 'Ramanathapuram',
        'Ranipet', 'Salem', 'Sivaganga', 'Tenkasi', 'Thanjavur', 'Theni', 'Thoothukudi', 'Tiruchirappalli',
        'Tirunelveli', 'Tirupathur', 'Tiruppur', 'Tiruvallur', 'Tiruvannamalai', 'Tiruvarur', 'Vellore',
        'Viluppuram', 'Virudhunagar'
    ),

    'Telangana' => array(
        'Adilabad', 'Bhadradri Kothagudem', 'Hyderabad', 'Jagtial', 'Jangaon', 'Jayashankar Bhoopalpally',
        'Jogulamba Gadwal', 'Kamareddy', 'Karimnagar', 'Khammam', 'Kumuram Bheem', 'Mahabubabad',
        'Mahabubnagar', 'Mancherial', 'Medak', 'Medchal–Malkajgiri', 'Mulugu', 'Nagarkurnool',
        'Nalgonda', 'Narayanpet', 'Nirmal', 'Nizamabad', 'Peddapalli', 'Rajanna Sircilla', 'Rangareddy',
        'Sangareddy', 'Siddipet', 'Suryapet', 'Vikarabad', 'Wanaparthy', 'Warangal', 'Yadadri Bhuvanagiri'
    ),
    'Tripura' => array(
        'Dhalai', 'Gomati', 'Khowai', 'North Tripura', 'Sepahijala', 'South Tripura', 'Unakoti', 'West Tripura'
    ),
    'Uttar Pradesh' => array(
        'Agra', 'Aligarh', 'Ambedkar Nagar', 'Amethi', 'Amroha', 'Auraiya', 'Ayodhya', 'Azamgarh', 'Baghpat',
        'Bahraich', 'Ballia', 'Balrampur', 'Banda', 'Barabanki', 'Bareilly', 'Basti', 'Bhadohi', 'Bijnor', 'Budaun',
        'Bulandshahr', 'Chandauli', 'Chitrakoot', 'Deoria', 'Etah', 'Etawah', 'Farrukhabad', 'Fatehpur', 'Firozabad',
        'Gautam Buddha Nagar', 'Ghaziabad', 'Ghazipur', 'Gonda', 'Gorakhpur', 'Hamirpur', 'Hapur', 'Hardoi', 'Hathras',
        'Jalaun', 'Jaunpur', 'Jhansi', 'Kannauj', 'Kanpur Dehat', 'Kanpur Nagar', 'Kasganj', 'Kaushambi', 'Kheri', 'Kushinagar',
        'Lalitpur', 'Lucknow', 'Maharajganj', 'Mahoba', 'Mainpuri', 'Mathura', 'Mau', 'Meerut', 'Mirzapur', 'Moradabad',
        'Muzaffarnagar', 'Pilibhit', 'Pratapgarh', 'Prayagraj', 'Raebareli', 'Rampur', 'Saharanpur', 'Sambhal', 'Sant Kabir Nagar',
        'Shahjahanpur', 'Shamli', 'Shravasti', 'Siddharthnagar', 'Sitapur', 'Sonbhadra', 'Sultanpur', 'Unnao', 'Varanasi'
    ),
    'Uttarakhand' => array(
        'Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh',
        'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'
    ),
    'West Bengal' => array(
        'Alipurduar', 'Bankura', 'Birbhum', 'Cooch Behar', 'Dakshin Dinajpur', 'Darjeeling', 'Hooghly', 'Howrah', 'Jalpaiguri',
        'Jhargram', 'Kalimpong', 'Kolkata', 'Malda', 'Murshidabad', 'Nadia', 'North 24 Parganas', 'Paschim Bardhaman',
        'Paschim Medinipur', 'Purba Bardhaman', 'Purba Medinipur', 'Purulia', 'South 24 Parganas', 'Uttar Dinajpur'
    ),
    'Andaman and Nicobar Islands' => array(
        'Nicobar', 'North and Middle Andaman', 'South Andaman'
    ),
    'Chandigarh' => array(
        'Chandigarh'
    ),
    'Dadra and Nagar Haveli and Daman and Diu' => array(
        'Dadra and Nagar Haveli', 'Daman', 'Diu'
    ),
    'Lakshadweep' => array(
        'Lakshadweep'
    ),
    'Delhi' => array(
        'Central Delhi', 'East Delhi', 'New Delhi', 'North Delhi', 'North East Delhi',
        'North West Delhi', 'Shahdara', 'South Delhi', 'South East Delhi', 'South West Delhi',
        'West Delhi'
    ),
    'Puducherry' => array(
        'Karaikal', 'Mahe', 'Puducherry', 'Yanam'
    ),

    'Haryana' => array(
        'Ambala', 'Bhiwani', 'Charkhi Dadri', 'Faridabad', 'Fatehabad', 'Gurugram',
        'Hisar', 'Jhajjar', 'Jind', 'Kaithal', 'Karnal', 'Kurukshetra', 'Mahendragarh',
        'Nuh', 'Palwal', 'Panchkula', 'Panipat', 'Rewari', 'Rohtak', 'Sirsa', 'Sonipat',
        'Yamunanagar'
    ),
    'Himachal Pradesh' => array(
        'Bilaspur', 'Chamba', 'Hamirpur', 'Kangra', 'Kinnaur', 'Kullu', 'Lahaul and Spiti',
        'Mandi', 'Shimla', 'Sirmaur', 'Solan', 'Una'
    ),
    'Jammu and Kashmir' => array(
        'Anantnag', 'Bandipora', 'Baramulla', 'Budgam', 'Doda', 'Ganderbal', 'Jammu',
        'Kathua', 'Kishtwar', 'Kulgam', 'Kupwara', 'Poonch', 'Pulwama', 'Rajouri',
        'Ramban', 'Reasi', 'Samba', 'Shopian', 'Srinagar', 'Udhampur'
    ),
    
    'Jharkhand' => array(
        'Bokaro', 'Chatra', 'Deoghar', 'Dhanbad', 'Dumka', 'East Singhbhum', 'Garhwa',
        'Giridih', 'Godda', 'Gumla', 'Hazaribagh', 'Jamtara', 'Khunti', 'Koderma',
        'Latehar', 'Lohardaga', 'Pakur', 'Palamu', 'Ramgarh', 'Ranchi', 'Sahibganj',
        'Saraikela-Kharsawan', 'Simdega', 'West Singhbhum'
    ),
    'Karnataka' => array(
        'Bagalkot', 'Ballari', 'Belagavi', 'Bengaluru Rural', 'Bengaluru Urban',
        'Bidar', 'Chamarajanagar', 'Chikkaballapur', 'Chikkamagaluru', 'Chitradurga',
        'Dakshina Kannada', 'Davanagere', 'Dharwad', 'Gadag', 'Hassan', 'Haveri',
        'Kalaburagi', 'Kodagu', 'Kolar', 'Koppal', 'Mandya', 'Mysuru', 'Raichur',
        'Ramanagara', 'Shivamogga', 'Tumakuru', 'Udupi', 'Uttara Kannada', 'Vijayapura',
        'Yadgir'
    ),
    'Kerala' => array(
        'Alappuzha', 'Ernakulam', 'Idukki', 'Kannur', 'Kasaragod', 'Kollam', 'Kottayam',
        'Kozhikode', 'Malappuram', 'Palakkad', 'Pathanamthitta', 'Thiruvananthapuram',
        'Thrissur', 'Wayanad'
    ),
);
?>
