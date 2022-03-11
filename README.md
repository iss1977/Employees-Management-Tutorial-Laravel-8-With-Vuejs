<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1 align="center">
<p>Complete Employees Management Tutorial | Laravel 8 With Vuejs | Full Laravel 8 Course</p>
<a href="https://youtu.be/xvLWgxExiEM"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"> Youtube Link</a>
</h1>

# Thanx to Laraveller

## Specifications

### Programming Framework & Database
1. Use `Laravel 8` framework as development framework.
2. `Mysql` Database
3. `Vue.js` + `Laravel Mix` to compile assets ( js,css, images)
    1. Implement Vue.js on employee management only - CRUD + search features.
4. `Bootstrap 4`

### User interface

1. Responsive user interface using HTML + Bootstrap 4
2. User layout should have a sidebar, header and a menu
    1. Side bar:
        1. Dashboard
        2. Employee management
        3. System management
            - Country - submenu
            - State - sub menu
            - City - submenu
            - Department - submenu
3. User management
    1. User
    2. Role
    3. Permission
4. Header should contain user name and loggout option in a submenu
5. After login, the user should be redirected to the dashboard.
6. Autethication
    1. User logs in with user and password
    2. After 3 unsuccessful login attempts, user will be locked for 5 minutes.
7. User management
    1. Create, Update and Delete user
    2. Search for user using username or email adress.
        - Role and permission Crud
8. Employee management
    1.List of employees with search and filter by employee name and department
    2. Create, Edit and Delete employee
9. System management
    1. Country
        - List countries with search option
        - Create , update and delete
    2. State
        - List countries with search option
        - Create , update and delete
    3. City
        - List countries with search option
        - Create , update and delete
    4. Department
        - List countries with search option
        - Create , update and delete


10. API
    - Create API Endpoint for user
    - registration and authetication



## Development steps:

- * Spin up a docker app with 3 containers using Laravel Sail. Modify SAIL configuration file to use Laravel 8.x.
<i>default SAIL configuration is using Laravel 9.0</i>
- Installing Laravel/ui 
- * rollback to bootstrap 4.6
- Generate login / registration scaffolding -> _php artisan ui bootstrap --auth_
- adding vue via : _php artisan ui vue_
- creating migrations
- modifying the registration form
- * change from docker to XAMP for better performance.
- Dashbord development using SB Admin _https://github.com/startbootstrap/startbootstrap-sb-admin_
- importing main Dashboard
- * changing precompiled dashboard css file with on fly compiled scss file via laravel mix
- * adding jquery to node modules - loading via laravel mix. 
- * upgrade from SB Admin ver 6.0.3 to SB Admin 2 ver 4.1.4
- * adding fontawesome to project via laravel mix
- dashboard configuration for employee management
- adding user locked for 5 minutes after 3 unsuccesful attempts
- creating UserController for User management ( create, modify adn delete _ php artisan make:controller Backend/UserController --resource _), routes in web.php
- creating views for view, create and edit the user
- * moving image assets via webpack from resources to public folder to be prepared for distribution
- creating Form Request validator
- * implementing toast messages
- implementing search with * reset button
- *adding pagination to user list
- * setting up user seeder with Faker
- implementing change user password in edit user blade + controller
- * creating modal confirmation dialog for deletes - template tag / bootstrap / javascript
- * wrapping up javascript for confirmation modal in seprate javascript file and merge in app.js with webpack mix
- creating countries views, FormRequests and controllers
- creating states views, FormRequests and controllers
- * creating validation FormRequest after hook for country_id validation.
- TODO : prevent deleting when a state is present in employees table
- TODO : search in index blade in states view
- * update search for user, country and state for better usere experence. Reset search field added.
- creating views, controllers and validation for cities
- * adding extra functionality to choose country-> state -> city for better user experience :
    user chooses Country -> gets States from the Country: Ajax controller, route, javascript
- creating views, controllers and validation for departments
- adding Vue and VueRouter
- creating employees vue component structure
- adding vue datepicker
- creating controller & route for api calls from Vue components


