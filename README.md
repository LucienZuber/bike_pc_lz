# bike_pc_lz
This is a PHP project done during the module 645-1 of the HEG of Sierre
##General
This project has been made for the entreprise ResaBike, it is used to book a place
for your bike on a postal car.
<br>
students: Lucien Zuber and Patrick Clivaz
<br>
teachers: Alexandre Cotting, Pierre-Yves Guex and Jean-Pierre Rey

## Technical details
The project has been developped using:
- HTML 5
- CSS 3
- Materialize
- PHP 7.0
- MySql
- PHPMailer

The encoding of the project is made in UTF-8 and the DB is encoded in latin1

## Running requirements
To run our website, you first need to deploy it in a xamp/wamp/mamp/lamp environnment, you need to set it in PHP 7.0.
the basics credentiel for accessing the DB are located into
BLL/mySqlConnection.php. By default they are kept with username = root and no password
You can run bike_pc_lz.sql on your sql server to create the db on your local machine.

## Project Structure
Our project has been constructed using the N-Tier architecture.

Our models from the DB are stocked inside the DTO, the temporary models used are stocked inside Model\
Our Persistent layer (DAL) contain all sql requests and our sql connection\
Our Business layer (BLL) contain all function querying the DAL and doing complex operation without directly interacting with the db.\
Our Presentation Layer (UI) contain all displayed pages.

changeLanguage.php allow to change the language\
localSearch.php, query the DB for local autocompletion

Our css folder contains the materialize templates\
our fonts folder contains our fonts\
the js folder contains the scripts we have used\
the languages folder contains the traductions\
the bike_pc_lz.sql file contain the sql database\
the LICENSE file contains informations about our license

├── BLL\
│   ├── changeLanguage.php\
│   ├── localSearch.php\
│   ├── ...Managers.php\
├── css\
│   ├── style.css\
├── DAL\
│   ├── mySQLConnection.php\
│   ├── ...Request.php\
├── DTO\
│   ├── ...\
├── fonts\
│   ├── roboto\
│   │   ├── ...\
├── js\
│   ├── autocompleteLocal.js\
│   ├── autocompleteCFF.js\
│   ├── displayUserRegion.js\
│   ├── ...init.js\
├── languages\
│   ├── ...\
├── Model\
│   ├── ...\
├── UI\
│   ├── images\
│   │   ├── background.js\
│   ├── ...\
├── bike_pc_lz.sql\
├── LICENSE\
└── README.md

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details