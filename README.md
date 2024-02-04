# Clinic Managment System

# Setup Instructions :

To run the System :

1. Install dependencies: composer install
2. Create symbolic links for storage: php artisan storage:link

# Database Configuration :

You have two options for setting up the database:

-   Download the pre-configured database from here : https://drive.google.com/file/d/1oMHtWMdBRBu7YT-MPOHIXWLdyAhPUBgl/view?usp=sharing

-   Or, create your own database in phpMyAdmin and then proceed with the following steps:

    1.  Run migrations: php artisan migrate For the Database :
    2.  Seed the database: php artisan db:seed

Note: Remember to update the database username and password in your .env file. Also, ensure the APP_URL in your .env file is set to http://localhost:8000.

# Postman Collection :

-   For API testing, download the Postman collection from here : https://drive.google.com/file/d/1J9lkVWutmcJEzCQ1ZDZC0uw_cZ7NeQHI/view?usp=sharing

# Important Points :

-   To change the response language, adjust the lang variable's value in the request headers.

-   The role and permissions system is implemented with current project limitations in mind. It could be made more dynamic and expansive.

-   The doctor's schedule feature is implemented as per the current deadline constraints. Future versions could offer more flexibility.

-   Creating an appointment is subject to several conditions. While some are enforced in the backend, additional validations and input requirements can be implemented on the frontend.

-   Appointment statuses automatically transition to "expired" if the current time and date surpass the scheduled booking date, provided the status was 'Pending'.

-   The 'get appointment' API returns data appropriate for each user's role, which can be utilized for filtering purposes.
