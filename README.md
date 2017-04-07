# user-manager
A person management portal. People can be viewed, edited, created and deleted.

## Technologies Used

The portal is built using the Codigniter framework and the main CRUD functionality is built around a RESTful architecture - it can be ported to BootstrapJS or Angular fairly easily.
The frontend uses Twitter Bootstrap 3, jQuery and jQuery Validate

The portal uses the Tank Auth library by Ilya Konyukhov (https://konyukhov.com/soft/tank_auth/) to handle all user auth. The library templates have been customised to work with Bootstrap.

## Set up instructions

*Unzip the folder to a directory 
*Create a virtual host for usermanager.local pointing to the root directory
*Create a database and run user_manager.sql to create the database
*Configure the database connection in /application/config/database.php
*Navigate to the root directory in your browser
*Log in with the username "admin" and password "admin12"


