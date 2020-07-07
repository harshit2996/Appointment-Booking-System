# Appointment and Scheduling Platform with live chat support
![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/dee4b64414509d8a1e4ba14018102ffe-original.jpg)

## Demo [Demo](https://book-slot.herokuapp.com) 
(Without Live Chat Support - This is only a demo not a service)

## Login Credentials
  - For Admin
    - email - admin@reservation.com
    - password - password

  - For User
    - email - user@reservation.com
    - password - password    
    - You may also register as new user
## Features
1. The user and admin can create, update, view and cancel/delete appointments
2. The platform has separate dashboards for user and operator
3. Online Realtime Live Chat Support from operator/ admin
4. Interactive Calendars and Tables using REST APIs from the PHP/Laravel server
5. Secure Authentication and Routing with middleware
6. The operator can see all the online users and chat with them and edit the appointment
7. Users can view upcoming appointments
8. The admin can view the appointments for the current day
9. Light and Dark theme Switch

## Developed Using
1. Laravel
2. VueJS
3. Vuetify
4. Socket.io
6. Redis
7. MySQL

## Steps / Guide to Install

1. Download the zip file and extract the files or Clone the the repository
2. Open a terminal and move inside the project folder/directory using the cd commands on a terminal or cmd.
3. Now install the composer dependencies using the command "composer install"
4. Install the npm dependencies using the command "npm install"
5. Copy the. env.example and rename the new generated copy as ".env"
6. Install the laravel app encryption key using the command "php artisan key:generate"
7. Set up the database according to your machine and configure it in the. env file to connect the application to the database. Create a new database named "reservation". Set DB name in .env file as "reservation". Also configure the username and password of the database
8. Register a user and set the value of the "isAdmin" to 1 in the Database to create the admin
9. Setup and Start Laravel echo server and the redis server
8. Run the command php artisan migrate to run the migrations which will create the required tables in the database.
10. If all the above commands executed successfully, you can start your application by starting the server using the command php artisan sereve. Then in a web browser open the url "http://127.1.0.0:8000".
11. If you are able to see a login page you have successfully setup the project.



![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/a99943f705b8b141215df019e8235faa-original.jpg)


![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/2dafb761072a1b83a378e358af75fc59-original.jpg)


![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/9a9e3730bd3fa671a80ef2a9217f1cd0-original.jpg)


![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/7a84e875dcf42ca7749f34b3ffb4468f-original.jpg)


![alt text](https://s3.amazonaws.com/poly-screenshots.angel.co/Project/4a/1116204/bd9fe654ece467179b0672dfdead52e7-original.jpg)