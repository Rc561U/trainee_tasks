# Task 13
Create a form for working with users using MVC, the data source is a MySQL database
Foobar is a Python library for dealing with word pluralization.

## Materials
[How to display select option of 'select' tag as selected in php - W3codegenerator](https://w3codegenerator.com/article/how-to-display-select-option-of-select-tag-as-selected-using-foreach-method-in-php)

***
[MVC в PHP](https://www.youtube.com/playlist?list=PLqQ1VsG-wgxfUc8pKsv7MBSbp5Q3zFLi4)

[PHP Namespaces](https://habr.com/ru/post/212773/)

[PHP namespaces documentation](https://www.php.net/manual/ru/language.namespaces.php)

***
[PHP PDO](https://tproger.ru/translations/how-to-configure-and-use-pdo/)

[PHP PDO documentation](https://www.php.net/manual/ru/book.pdo.php)

***

[MVC Design Pattern with a PHP example](https://blog.pusher.com/laravel-mvc-use/)

[How Laravel implements MVC and how to use it effectively](https://choosealicense.com/licenses/mit/)

***

[PHP patterns examples](https://refactoring.guru/)

## Desription
In the developed application, you must be able to add new users, edit user data, delete users, view the list of all users. You design the interface of the application and the structure of the MySQL database yourself.

## Use the following data to work with users

- email field "Email", name="email" - key field
- text field "Your first and last name", name="name"
- drop-down list "Gender" ( male, female ), name="gender"
- drop-down list "Status" ( active, inactive ), name="status"

## Prerequisites

- use Bootstrap
- store data in MySQL
- make checks for field completeness and data correctness using JS and PHP

When we start editing user data, the editable fields must be pre-filled with current data. For the "Delete" button, add a deletion confirmation using javascript code.

Options in the drop-downs "Gender" and "Status" must be like

```html
<option value=”male”>Male</option>

<option value=”active”>Active</option>
```
You should implement this application in OOP. Split logic and templates into separate files.

Logic files should contain PHP code only.

Use separate CSS files for styles.

You must also create either a database dump or write sids/migrations.

## Tags

- PHP,
- OOP,
- MySQL,
- MVC,
- Bootstrap,
- HTML,
- CSS,
- JS,
- GIT