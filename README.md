# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  - you can test the demo script in your shell: "php index.php"

## 2. Expectations

This simple application works, but with very old-style monolithic codebase, so do anything you want with it, to make it:

  - easier to work with
  - more maintainable

## 3. Explanations

I've made it MVC with routes.

- in the controller - I added a BaseController and HomeController to route the index page
- in the core - I added a base Model class to be extensible on Models. I also added Router class to navigate from routes to call controllers
- in the Model - I use the Comment and News class. I also updated the codebase to make sql queries on the model
- in the Utils - it is like a repository pattern for CommentManager and NewsManager, for the DB I decided to stay it on Utils and not put it in Core
- for the view - it is a basic html with variables from the controller to display the data

## 4. Additional info

I use `laravel/pint` for formatting files and `vlucas/phpdotenv` to store DB info and not hardcoded on the files.