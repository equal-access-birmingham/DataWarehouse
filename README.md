# Free, Student-Run Clinic Intake System
This system was built to allow free, student-run clinics to effectively collect structured data on their patient populations for the purposes of research and qualtiy improvement.  Data collection is performed through a completely electronic form that can either serve as a replacement for or be used in addition to the current check-in form.  This intake system was built by volunteer students at the University of Alabama free, student-run clinic [Equal Access Birmingham](http://www.uab.edu/medicine/eab/) and is currently running on a local network at the clinic.  

## Quicklinks
* [Purpose](#purpose)
* [Features](#features)
  * [Demo](#demo)
* [How It Works](#how-it-works)
  * [Login](#login)
  * [New Patient](#new-patient)
  * [Returning Patient](#returning-patient)
  * [Patient Information Summaries](#patient-information-summaries)
  * [Research Data](#research-data)
* [Installation](#installation)
  * [Server Stack](#server-stack)
  * [Web Application Files](#web-application-files)
  * [Database](#database) <!-- Focus on the installation -->
  * [Website Access](#website-access)
* [Configuration](#configuration)
  * [Intake System Database](#intake-system-database-includesdbphp)
  * [Login System Database](#login-system-database-php-login-adminconfigconfigphp)
  * [Intake System Database Fine Tuning](#intake-system-database-fine-tuning) <!-- Explain what tables need special attention for customization and which tables have preset values -->

# Purpose
The original design of the system focused on three goals listed below in order of importance:

1. Providing a completely electronic form for collecting patient data for research
2. Storing patient data in as structured a manner as possible for easier retrieval
3. Displaying limited views of patient information for clinical workflow

# Features
* **New Patient Form** - adds new patients to the system collecting a large amount of preliminary information
* **Patient Search** - searches for patients by name and dob allowing patient data to be viewed in several forms
* **Returning Patient Form** - allows patient information to be updated
* **Clinical Summary** - specific view of patient data that provides relevant medical information for clinical workflow
* **Social Services Summary** - specific view of patient data that provides relevant information for social service workers
* **Research Data Dumps** - provide whole CSV dumps of database information **to administrators** for easy data retrieval
  * **Patient Demographics Data**
  * **Patient Social History Data**
  * **Patient Visit Information Data**
  * **Date of LastMammogram**
  * **Date of Last Secxually Transmitted Infection**
  * **Date of Last Colonoscopy**
  * **Date of Last Pap Smear**
* **Administrative-focused Login System** - accounts easily created and maintained by master administrator

## Demo
A demo of the system is available at [https://data.eabclinic.tk](https://data.eabclinic.tk).  No data should be stored here permanently as it is just for testing out the system and it's features.

* **Username**:  admin
* **Password**:  password

# How It Works

## Login
![How to login](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/login.gif)

## New Patient
![Registering a new patient](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/new_patient.gif)

## Returning Patient
![Updating a returning patient's info](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/returning_patient.gif)

## Clinical Summary
![Viewing a patient's clinical summary](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/clinical_summary.gif)

## Social Services Summary
![Viewing a patient's social service summary](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/social_services_summary.gif)

## Research Data
![Retrieving data for research](https://github.com/equal-access-birmingham/DataWarehouse/blob/assets/research_data.gif)

# Installation
While there is no pre-packaged install for this system, it is a relatively simple PHP application that can be easily dropped into any server stack running PHP 5 or greater. 

## Server Stack
The stack below is the one that EAB has running in their clinic; however, this application does not take advantage of specialized web server settings or PHP packages.  Therefore, it should run on almost any server stack with PHP installed.

* [Ubuntu 16.04 LTS](https://www.ubuntu.com/server)
* [nginx](https://www.nginx.com/resources/wiki/)
* [PHP 7.0](http://php.net/archive/2015.php)
* [MariaDB](https://mariadb.org/)

There are multiple tutorials online detailing how to set up a server stack such as the one listed above.  This [tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04) from DigitalOcean is one such example.

## Web Application Files
Installation is mader super simple through git/GitHub.  Simply follow these steps:
1. Recommended install location:  `/var/www`
2. `git clone https://github.com/equal-access-birmingham/DataWarehouse.git`

## Database
### Login System
This system is kept separate from the main system for security reasons and the recommended procedure is to install the login system in a **completely separate database** from the main system.  Run the following command on the server:

    `mysql -u <intake_database_user_name> -p <intake_database_name> < php-login-admin/_installation/02-create-user-table.sql`

* `<intake_database_user_name>`:  The name of the user that has access to the database to be used by the login system
* `<intake_database_name>`:  The name of the database for the login system

### Intake System
A mysql workbench file (`database/datawarehousedb.mwb`) is provided for those that know how to use this file.  However, the procedure below uses ye olde command line of the server.

    `mysql -u <intake_database_user_name> -p <intake_database_name> < database/datawarehouse_creation_script.sql`

* `<intake_database_user_name>`:  The name of the user that has access to the database to be used by the intake system
* `<intake_database_name>`:  The name of the database for the intake system


# Configuration
There are two locations for the configuration files due to the separation of the login system.  
* includes/db.php.default
* php-login-admin/config/config.php.default

For each of the files above:
1. Copy the files
2. Remove the `.default` ending to make them active

## Intake System Database (includes/db.php)
To make this file active simply change the values to the appropriate ones for your setup:

* `$host`: the hostname/IP address of the server the intake system's database is located on (probably `localhost`)
* `$db_user`:  the user that has access to the intake system's database (see [Intake System Database Setup](#intake-system))
* `$db_pass`:  the password of the user that has access to the intake system's database
* `$db_db`:  the name of the database housing the intake system

## Login System Database (php-login-admin/config/config.php)
**Caution**:  it is better to leave the settings in the `config.php` file not described below alone...

### Database Access
* `define("DB_HOST", "your_host");`:  change "your_host" to the server's hostname/IP address that is hosting the login system's database (probably `localhost`)
* `define("DB_NAME", "database_name");`:  change "database_name" to the database name housing the login system 
* `define("DB_USER", "database_username");`:  change "database_username" to the user that has access to the database housing the login system
* `define("DB_PASS", "database_password");`:  change "database_password" to the password of the user that has access to the database housing the login system

### Cookies
* `define("COOKIE_DOMAIN", ".192.168.56.101");`: change "192.168.56.101" to the IP address or domain name of the site hosting the intake system
* `define("COOKIE_SECRET_KEY", "cookie_secret_key");`: change "cookie_secret_key" to some [long, random string](https://strongpasswordgenerator.com/)

### Email Setup
Recommend a gmail account with [lowered security settings](https://support.google.com/accounts/answer/6010255?hl=en).  Otherwise, more settings in the config file will need to be changed.

* `define("EMAIL_SMTP_USERNAME", "your_username_email");`: change "your_username_email" to the gmail **username** (not the full address)
* `define("EMAIL_SMTP_PASSWORD", "yourpassword");`:  change "yourpassword" to the gmail account's password

### Password Reset
* `define("EMAIL_PASSWORDRESET_URL", "http://your_server/php-login-admin/password_reset.php");`: change "your_server" to the IP address or domain name hosting the intake system
* `define("EMAIL_PASSWORDRESET_FROM", "your_username_email");`:  change "your_username_email" to the sender's email that should be shown to recipients (can be anything...)
* `define("EMAIL_PASSWORDRESET_FROM_NAME", "yourname");`:  change "yourname" to the sender's name that should be show to recipients (can be anything...)

New Account Email configurations and Reset Account Email configurations follow the same patter as the [password reset configurations](#password-reset).

## Intake System Database Fine Tuning
### Database Model
The database model is provided in a mysql workbench file in `databases/datawarehouse.mwb`.  This file can be viewed with [MySQL Workbench](https://www.mysql.com/products/workbench/) and will show a detailed model of the database.

### Default Table Values
In order to get the system running, there are a few tables that have been filled with default values.  Some of these tables can have their values changed; some can't.  Below two lists highlighting the differences.  Tables marked as "Yes/No Table" only contain those values as binary answers to simple questions on the forms.

#### Tables with changeable values
* Alcohol (Yes/No Table)
* CitizenStatus
* CooperGreen (Yes/No Table)
* CurrentEmployment (Yes/No Table)
* Disability (Yes/No Table)
* EducationLevel
* FoodStamp (Yes/No Table)
* Gender
* HeadofHousehold (Yes/No Table)
* HomeType
* MedicalInsurance (Yes/No Table)
* RelationshipStatus
* Transport
* Veteran (Yes/No Table)

#### Tables with immutable values
* VisitType
