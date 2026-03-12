<img width="1751" height="722" alt="ER StudentManagement drawio" src="https://github.com/user-attachments/assets/1f26f070-a52c-46ed-a32a-f9d30581ddf7" /><img width="1853" height="814" alt="A" src="https://github.com/user-attachments/assets/91f3701c-61fb-4a31-9395-f3380eadf763" />
<img width="836" height="850" alt="B" src="https://github.com/user-attachments/assets/8310c4bf-31db-4a92-992c-60a20d1a25be" />
<img width="1806" height="854" alt="C" src="https://github.com/user-attachments/assets/e9c8e073-4b1b-47d0-aed1-09091ab06889" />
<img width="835" height="756" alt="D" src="https://github.com/user-attachments/assets/685740fe-2367-4c20-b981-77583d3d699f" />
<img width="563" height="766" alt="MB E" src="https://github.com/user-attachments/assets/1f201338-8711-452b-b30e-e229649a2bd7" />
<img width="590" height="845" alt="MB D" src="https://github.com/user-attachments/assets/13cba572-7f61-46b5-bbf9-a587fffaee01" />
<img width="529" height="853" alt="MB C" src="https://github.com/user-attachments/assets/2d0633f0-ba6d-4471-8e17-b3ca85f624ae" />
<img width="560" height="863" alt="MB B" src="https://github.com/user-attachments/assets/e4be7a08-42dc-4095-90ab-0e6633cdfa90" />
<img width="521" height="843" alt="MB A" src="https://github.com/user-attachments/assets/6328fc17-017a-4d97-83f2-f6b4d2fcac78" />
<img width="557" height="674" alt="K" src="https://github.com/user-attachments/assets/5d95acc0-8884-4bb0-a110-392e48e77625" />
<img width="865" height="922" alt="J" src="https://github.com/user-attachments/assets/dd56181e-6a32-4b21-8e3e-65fc78a89cc1" />
<img width="915" height="916" alt="I" src="https://github.com/user-attachments/assets/3afb8f83-e771-40c4-9d63-4da700b4a817" />
<img width="1800" height="656" alt="H" src="https://github.com/user-attachments/assets/93050fc2-3cb4-49af-add8-1db907f7d632" />
<img width="1761" height="905" alt="G" src="https://github.com/user-attachments/assets/9de20996-a5a8-4d67-a9d4-2bf3b1542142" />
<img width="1850" height="894" alt="F" src="https://github.com/user-attachments/assets/4aa38984-cf03-4706-9a31-162700b563cd" />
<img width="868" height="840" alt="E" src="https://github.com/user-attachments/assets/2bab5020-6a20-44a2-8437-15456f8d8d18" />


Setup Instructions

Prerequisites
* Local Server Environment: Download and install [XAMPP](https://www.apachefriends.org/index.html) or WAMP server.
* Web Browser:Google Chrome, Firefox, or Edge.
* Code Editor: VS Code (optional, for viewing the code).

Installation Steps

Step 1: Download the Project
Clone this repository using Git or download it as a ZIP file and extract it.
bash
git clone (https://github.com/Timali-Navodhya/student-management-system.git)

Step 2: Move to Local Server
Copy the extracted project folder (student-management-system) and paste it inside the htdocs folder of your XAMPP installation (usually located at C:\xampp\htdocs\)

Step 3: Database Configuration

Open the XAMPP Control Panel and start Apache and MySQL.
Open your web browser and go to http://localhost/phpmyadmin/.
Click on "New" to create a new database and name it student_db.
Click on the newly created student_db database, go to the "Import" tab.
Choose the student_db.sql file provided in the project folder and click "Import" (or "Go") at the bottom to create all tables and insert sample data.

Step 4: Database Connection (If needed)
By default, the system connects using the standard XAMPP credentials:
Host: localhost
Username: root
Password: (leave blank)(If your MySQL setup has a different password, update it in the db.php file).

Step 5: Run the Application
Open your web browser and navigate to the following URL: http://localhost/student-management-system/

API Endpoints List

The backend is built using PHP (OOP) following an API-driven architecture. The frontend communicates with these endpoints using JavaScript `fetch()`.

# User Authentication & Profile
* **POST** `/register_user.php` - Register a new user (Requires: name, email, password)
* **POST** `/login_user.php` - Authenticate user and return user details (Requires: email, password)
* **GET** `/get_profile.php?id={id}` - Fetch details of the logged-in user
* **POST** `/update_profile.php` - Update user profile information (name, email, password)

# Student Management (CRUD)
* **GET** `/read_students.php?page={page}&search={query}` - Fetch all students (Supports pagination and search)
* **GET** `/get_student.php?id={id}` - Fetch a single student's details along with associated images
* **POST** `/create_student.php` - Add a new student to the system (Supports multiple image file uploads)
* **POST** `/update_student.php` - Update existing student details
* **POST** `/delete_student.php` - Delete a student record and associated data from the database

# ER Diagram 
<img width="1751" height="722" alt="ER StudentManagement drawio" src="https://github.com/user-attachments/assets/e4cfed22-ffcc-45e2-8823-5bb63204815f" />
