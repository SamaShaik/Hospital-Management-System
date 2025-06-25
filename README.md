# Hospital-Management-System
This is a PHP + MySQL based Doctor Appointment and Prescription Management System developed for hospitals and clinics. The system allows doctors to manage appointments, review patient details, cancel appointments, and prescribe treatments. Patients can book appointments and later review their prescriptions.

#### **Overview**
The Doctor Panel is a part of the Hospital Management System developed using PHP, MySQL, HTML, and CSS. It allows doctors to:
- View appointments
- Cancel appointments
- Add prescriptions
- View patient prescription history
- Manage appointments and patient data

#### **Features**
- Doctor Login and Session Management
- Dashboard with quick access to appointments and prescriptions
- View, cancel, and manage appointments
- Add prescriptions for patients
- View patient prescription history
- Simple, clean, and responsive user interface built with HTML and CSS
- Integrated with PHP and MySQL backend

#### **Technologies Used**
- PHP (Backend logic & Session handling)
- MySQL (Database for patient, doctor, appointments, prescriptions data)
- HTML (User interface)
- CSS (Layout and Styling)

#### **Getting Started**

#### **Prerequisites**
Make sure you have the following installed:
- XAMPP or any other PHP + MySQL environment
- A Web Browser (Google Chrome, Firefox, etc.)
- `myhmsdb` database configured with `appointmenttb` and `prestb` tables.

#### **Setup**
- **Clone the Repository**:
    ```
    git clone https://github.com/SamaShaik/hospital-management-system.git
    ```
- **Import the Database**:
    - Open phpMyAdmin.
    - Create a database named `myhmsdb`.
    - Import the `.sql` files for `appointmenttb` and `prestb`.
- **Edit Database Credentials**:
    - Open `func1.php`, `doctor-panel.php`, and other files.
    - Ensure your database credentials match your XAMPP setup.
- **Run the Project**:
    - Place files in the `htdocs` directory (for XAMPP).
    - Access via: `http://localhost/hospital-management/doctor-panel.php`
