Features
------------
+ Convention Over Configuration
+ MVC/S Architecture
+ Automatic Engine Level Class Auto-Loader
+ Auto-Routing!
+ Authentication Compliant thru Unbroken PHP Encryption / Passwords - all automatic
+ Authorization Compliant thru JsonWebTokens - all automatic
+ Views - Section / Page Composition is Encouraged, But Not Mandatory. Emphasizes DRY Principle.
+ Core Engine handles all Authorization / Authentication, File Loading, Routing and Invoking of correct code
+ Only need to code 'Industry Standard' Models / Views / and Controllers. With the industry standard API Endpoint path.
+ Service layer (business logic, business intelligence layer) also provided for.
+ Easy examples provided. More...

Pages and API endpoints can be authorized, or not, depending on developer needs.  
**Note**: Some pages in this example are placeholders to show behavior.

"Engine" is located at /app/core/Application.  
**Userlist** and **LegalDocs** show "mini-SPA" design and typical CRUD behavior.

Endpoint URL Path Scheme
--

Server Rendered Pages URL End-Point Convention:  
**Website name / Controller / Action**;

Example:  
kentthompson.org/user/getUser

Actions are mapped to a method / function in the controller class.  
Supports a Default Home Controller Scheme when used with only a website name and / or with just a page name.

----

RESTful based API path scheme.  API (api) indicates use of the API controllers and JSON return type.  
**Website name  / api / Controller / Action**

Example:  
kentthompson.org/api/user/getUser

Actions are mapped to a method / function in the controller class.  

Requirements
------------
MySQL Database  
PHP 8.x

Authorization
----
It is not needlessly "enforced."  
If Authorization is desired, in Server side controllers, use '**parent::AuthUI()**' for webpages and '**parent::AuthApi()**' for API calls.  
 See /app/controller/home and app/api/user for examples.

Before Login:
+ GET and POST do not use authorization becuase a JsonWebToken (JWT) has not been issued. This is by design. Static pages, for example, usually do not need authorized as well, but can be if desired, with one line of code.

After Login:
+ One has to register first of course.
+ Logging in (/app/api/user/login) shows how JWTs are initially sent and placed in SessionStorage client side (/app/views/login).

+ GET requests should send the JWT, and the Engine expects, a JWT, if authorization is desired.
+ POST requests should send the JWT, and the Engine expects, a JWT, if authorization is desired.
+ POST requests that are Empty, that is have no data, are rejected by the engine. (Use GET instead, if that is what you want.)

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

Known Issues
----

Server side data validation needs to be improved in the service layer.  
&nbsp;&nbsp;&nbsp;&nbsp;Generalize and paramterize validation functions in service layer.  
Various 'error and exception pages' need to be made pretty and improved.  