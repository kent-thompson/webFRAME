#### Endpoint URL Path Scheme

Server Rendered Pages URL End-Point Convention:  
**Website name / Controller / Action**;

Example:  
kentthompson.org/User/getUser

Actions are mapped to a method / function in the controller class.  

Also handles a Default Home Controller Scheme when used with only a website name and / or with just a page name.

----

RESTful based API path scheme, that **always** returns JSON: (API indicates use of the api controllers and JSON return type )  
**Website name  / api / Controller / Action**

Example:  
kentthompson.org/api/User/getUser

Also handles a Default Home Controller Scheme when used with only a website name and / or with just a page name.

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

NOTICE:
+ GET requests DO NOT automatically attach a JsonWebToken (JWT), and therefore DO NOT have authorization feature.
+ POST requests DO automatically attach, and Engine expects, a JWT, and therefore DO HAVE authorization.
+ POST requests that are Empty, that is have no data, are rejected by the engine. (Use GET instead, if that is what you want.)
