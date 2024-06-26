# Dairy Serve Management System

## Description

The Dairy Serve Management System is a comprehensive solution designed to manage various aspects of a dairy business. The system is built using HTML, CSS, Bootstrap, JavaScript for the front end, and PHP, MySQL (WAMP) for the backend. It includes multiple modules and functionalities tailored to streamline operations, manage data efficiently, and provide an intuitive interface for different user roles.
## Dashboard
- ![Dashboard](images/dashboard.png)
- ![](images/dash2.png)
  <hr>
  
## Modules

1.  Login/Register Module 
   - This module provides a secure login system for users. It includes features for user authentication and access control based on user roles (Admin, Staff, Farmer, Buyer).
   - ![Login Module](images/login.png)
   - ![Register](images/register.png)
<hr>
2.  Farmer Details Module 

   - This module manages the details of farmers associated with the dairy. It allows adding, updating, and viewing farmer profiles, including personal information, farm details, and contact information.
   -    ![Farmer Details Module](images/farmer.png)
<hr>
3.  Staff Details Module 
   
   - This module handles the details of staff members. It allows for the management of staff profiles, including adding new staff, updating existing profiles, and viewing staff information.
   - ![Staff Details Module](images/staff.png)
<hr>
4.  Dairy Animal Details Module 
   
   - This module maintains records of dairy animals. It includes features for adding new animals, tracking health and productivity data, and managing overall animal details.
   - ![Dairy Animal Details Module](images/animalinfo.png)
<hr>
5.  Daily Data Entry Module 
   ![Daily Data Entry Module](images/dailydata.png)
   - This module facilitates daily data entry related to dairy operations. It includes forms for recording milk production, feed usage, health checks, and other routine activities.
   -  ![Daily Data Entry Module](images/dailydata.png)
<hr>
6.  Bill Module 
   
   - This module generates and manages bills for various transactions. It includes features for creating invoices, tracking payments, and maintaining billing records for customers and suppliers.
   - ![Bill Module](images/bill.png)
<hr>
7.  Dairy Products Module 
   
   - This module manages the inventory of dairy products. It allows adding new products, updating product details, managing stock levels, and tracking product sales.
   - ![Dairy Products Module](images/prod1.png)
   ![](images/prod2.png)
<hr>
8.  Admin Order Management Module 
   
   - This module provides tools for admins to manage orders. It includes features for viewing, updating, and processing customer orders, handling order status, and generating order reports.
   - ![Admin Order Management Module](images/adminapp.png)
<hr>

## User Privileges

### Admin
- Full access to all modules and functionalities.
- Ability to manage users, products, and orders.
<hr>
 
### Staff
![DASHBOARD](images/sdash.png)
![](images/sdash2.png)
 ### Staff
 
- View and edit personal details.
- Access dashboard.
- Manage products cart.
- View order history.
- View payment history.
<hr>
 
### Farmer
![DASHBOARD](images/fdash.png)
 ### Farmer
 
- View and edit personal details.
- Access dashboard.
- Manage products cart.
- View order history.
- View payment history.
<hr>
 
### Buyer
![DASHBOARD](images/bdash.png)
 ### Buyer
 
- Manage products cart.
- View order history.
- View payment history.
<hr>
 
## Technologies Used
<hr>

 ## Technologies Used
<hr>
 
### Frontend
- HTML
- CSS
- Bootstrap
- JavaScript
<hr>
 
  
### Backend
- PHP
- MySQL (WAMP)
<hr>
 
  
## Installation Steps

### WAMP Installation
1. Download WAMP server from the [official website](http://www.wampserver.com/).
2. Run the installer and follow the on-screen instructions to install WAMP on your system.
3. After installation, start the WAMP server.
<hr>
 
  
### Project Setup
1. Clone the project repository or download the project files.
2. Copy the project files to the `www` directory in your WAMP installation (usually located at `C:\wamp\www`).
3. Open PHPMyAdmin by navigating to `http://localhost/phpmyadmin`.
4. Create a new database for the project.
5. Import the database schema from the provided SQL file into the newly created database.
6. Update the database configuration in the project files (usually in a `config.php` file) with your database name, username, and password.
7. Start the WAMP server and navigate to `http://localhost/your_project_directory` to access the application.
<hr>
 
  
## How to Run
1. Ensure WAMP server is running.
2. Open a web browser and navigate to `http://localhost/your_project_directory`.
3. You should see the login page of the Dairy Serve Management System.
4. Log in using the credentials provided during setup or create a new account.
5. Access the various modules and functionalities based on your user privileges.

Enjoy managing your dairy operations efficiently with the Dairy Serve Management System!
<hr>
 
## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

 ## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
 
<hr>
