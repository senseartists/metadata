# sense-metadata

Description
This project is a website created using WampServer for Windows or MAMP for Mac. The site contains form pages for submitting information to a database (DB).

Project Structure:

sense-metadata/

|-- css/
|   |-- index.css
|   |-- style.css
|   |-- style_edit.css

|

|-- js/
|   |-- artist.js
|   |-- copyright.js
|   |-- file.js
|   |-- index.js
|   |-- label.js
|   |-- registration.js
|   |-- release.js
|   |-- script.js
|   |-- track.js

|

|-- images/
|   |-- grad.jpg
|   |-- logo.png

|

|-- BDD/
|   |-- sense_metadonnees.sql
|   |-- MCD.png

|

|-- connexion.html
|-- registration.html
|-- index.php
|-- artist.php
|-- copyright.php
|-- custom_identifiers.php
|-- file.php
|-- label.php
|-- link.php
|-- marketing.php
|-- release.php
|-- track.php
|-- view_artist.php
|-- README.md


Contents of Folders and Files
css/: This folder contains CSS files used for the site's formatting.

index.css: The CSS file specific to the homepage (index.php).
style.css: The main CSS file for the site.
style_edit.css: The CSS file specific for the formatting of edit pages.
js/: This folder contains JavaScript files used to add interactive features to the site.

images/: This folder contains images used on the site.

grad.jpg: Background image.
logo.png: Site logo.
BDD/: This folder contains files related to the database.

sense_metadonnees.sql: SQL file containing the structure of the "sense_metadonnees" database.
MCD.png: Conceptual schema of the database in image format.

connexion.html: Connection page allowing users to log in to the site.

registration.html: Registration page for new users.

index.php: Homepage of the site containing various tabs to access functionalities.

artist.php: Page dedicated to managing artist information.

copyright.php: Page dedicated to managing copyright.

custom_identifiers.php: Page dedicated to managing custom identifiers.

file.php: Page dedicated to managing files.

label.php: Page dedicated to managing music labels.

link.php: Page dedicated to managing links.

marketing.php: Page dedicated to managing marketing.

release.php: Page dedicated to managing music releases.

track.php: Page dedicated to managing music tracks.

view_artist.php: Page to view information of a specific artist.

Installation
To run the site locally, you must have WampServer installed on Windows or MAMP on Mac.
Make sure that the Apache server and MySQL database are active and running on their respective ports (80 and 3306).

Download the project files and place them in the root folder of your local server (the "www" folder for WampServer and the "htdocs" folder for MAMP).
Import the "sense_metadonnees.sql" database into your database management system (MySQL).

Ensure that you correctly configure the database connection information in the "config.php" file.

README.md: This current file contains information about the project and its structure.
