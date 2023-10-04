Endpoint URL path scheme: POST all parameters and arguments

Server Rendered URL End-Point WEB Pages
website name / controller / action; (action is a method/function that can also represented by a pagename)
example:
kentthompson.org/user/getUser

Actions are mapped to a method / function in the controller class.
------

* RESTful * based API path scheme, that ALWAYS returns JSON: (API indicates use of the api controllers and JSON return type )
website name  / api / controller-name / action
example:
kentthompson.org/api/user/getUser

+*+ Also handles a Default Home Controller Scheme when used with only a website name and / or with just a page name.

Features
------------
+ Convention Over Configuration
+ MVC/S Architecture
+ Automatic Engine Level Class Auto-Loader
+ Auto-Routing!
+ Authentication Compliant thru Unbroken PHP Encryption / Passwords - all automatic
+ Authorization Compliant thru JsonWebTokens - all automatic
+ Core Engine handles all Authorization / Authentication, File Loading, Routing and Invoking of correct code
+ Only need to code 'Industry Standard' Models / Views / and Controllers. With the industry standard API Endpoint path.
+ Service layer (business logic, business intelligence layer) also provided for.
+ Easy examples provided. More...

NOTICE:
+ GET requests DO NOT automatically attach a JsonWebToken (JWT), and therefore DO NOT have authorization feature.
+ POST requests DO automatically attach, and Engine expects, a JWT, and therefore DO HAVE authorization.
+ POST requests that are Empty, that is have no data, are rejected by the engine. (Use GET instead, if that is what you want.)