Features
------------
+ Convention Over Configuration
+ MVC/S Architecture
+ Automatic Engine Level Class Auto-Loader- Incredibly Fast and Efficient, Only Loads What's Needed for Each Request
+ Automatic Auto-Routing!
+ Automatic Inversion of Control
+ Automatic Authentication, Compliant through Unbroken PHP Encryption / Passwords
+ Automatic Authorization, Compliant through JsonWebTokens
+ Automatic Working Design and Code Upon Installation
+ Views - Section / Page Composition is Encouraged, But Not Mandatory. Emphasizes DRY Principle
+ Core Engine handles all Authorization / Authentication, File Loading, Routing and Invoking of correct code
+ Need only code 'Industry Standard' Models / Views / Controllers. Use industry standard API Endpoint paths
+ Service layer supported; business logic, validation, error handling, et cetera
+ Pages and API Endpoints can be Authorized, or Not, depending on developer needs
+ All Modern Object-Oriented Code and Design
+ Easy to use Generalized Error Handling Design
+ Easy examples provided. More...

Some pages in this example are placeholders to show above behavior.  
**Notice:** "*Partial Views*" and logic are used to accommodate real-time UI Composition following DRY principles. Thus, the online github code viewer will occasionally show html tags in red, indicating an error? THERE IS NO ERROR. Upon loading the full code at run-time, all tags are correctly matched.

Copyright (c) 2024 Kent Thompson, All rights reserved. All source code and IP.

"Engine" is located at /app/core/Application.

**Userlist** shows "mini-SPA" design and typical CRUD API behavior.

Endpoint URL Path Design
--
Server-side Rendered Pages URL End-Point Convention:  
**Website name / controller / action**;

Example:  
kentthompson.org/user/getUser

+ Actions are mapped to a method / function in the controller class.
+ Automaticaly supports a Default, Home Controller Design when used with only a website name and / or just a page name.

----

RESTful AJAX based API path scheme.  API (api) indicates use of the API controllers and JSON return type.  
**Website name  / api / controller / action**;

Example:  
kentthompson.org/api/user/getUser

Actions are mapped to a method / function in the controller class.  

Requirements
------------
SQL Database  
PHP 8.x

Recommended:
Datatables.js
jQuery.js

Note: If one does not have access to the php.ini, then a .htaccess file must be used. The one provided needs to have the website name (line 6) changed to a desired site.

Authorization (as opposed to Authentication)
----
It is not needlessly "enforced."  
If Authorization is desired, in Server side controllers, use '**parent::AuthUI()**' for webpages and '**parent::AuthApi()**' for API calls.  
 See /app/controller/home and app/api/user for examples.

Before Login:
+ GET and POST do not use authorization becuase a JsonWebToken (JWT) has not been issued. This is by design. Static pages, for example, usually do not need authorized as well, but can be if desired, with one line of code.

After Login:
+ One has to register as a user first, of course.
+ Logging in (/app/api/user/login) shows how JWTs are initially sent and placed in  client side SessionStorage, (/app/views/login). This has to be done.

+ GET and POST requests should send the client side stored JWT, and the Engine expects, a JWT, if authorization is desired.

Get / Post based "Routing"
----
No Need For Seperate Methods for Each Http / REST Verb. Using the DRY principle.  
Inside a controller mapped method use this technique:
```c++
    if( $this->reqType === GET ) {
        $id = $_GET['id'];
        $uname = $_GET['uname'];
    }

    if( $this->reqType === POST ) {
        $id = $_POST['id'];
        $uname = $_POST['uname'];
    }
```
----

**Database:**  See sql directory for database schemas. See /app/core/Database to set up database connection, et cetera.

ADDED
----

+ Greatly Improved Error Handling and created a "entry point" in the Service Layer. ErrorHandler.php.  
This file represents an "entry point" to gracefully handle and report errors and exceptions.  
Could go on to LOG errors, display various page types 404, 500 et cetra, and make them end-user 'pretty.'  
Whatever the Problem Domains dictates. It can spring from here.

Known Issues
----

Server side data validation needs to be improved in the service layer.  
&nbsp;&nbsp;&nbsp;&nbsp;Generalize and paramterize validation functions in service layer.  
Various 'error and exception pages' need to be made pretty and improved.  
Finish LegalDocs examples.

https://github.com/kent-thompson/test.git