# rotasummary
Laravel TDD application of a staff rota shift summary


## Instructions for installation

1. Clone repository and cd into 'rotasummary' directory
2. Run 'composer install' to install all the dependencies and packages
3. Create MySQL account with all privileges for username 'homestead'@'localhost' and password 'secret'
4. cd into 'other' directory, login to MySQL and import the db_dump.sql file
5. cd back into the root directory of the app
6. run 'php artisan serve' and navigate in a browser to 127.0.0.1:8000/rotas/332
7. run './vendor/bin/phpunit' for running feature test


## Summary

This is my attempt at using TDD and MVC pattern principles in Laravel. The main features that are complete are:-

1. Create a view to display staff shift times for each day of the week, against their staff id
2. At the bottom of each day, show the total number of hours worked on that day

Features that were not implemented:-

3. Number of minutes per day that a single staff member is working alone in the shop


## Implementation Notes

My overall goal for this application were to strictly adhere to TDD princples, which started off well covering the output of all the shift data to the view. At this point, I had trouble identifying how to best write tests to ensure that the data was being output to the view correctly (i.e. staff in the rows, days in the columns across) and in order to make progress, I started to write controller and model logic directly and echo out the arrays and outputs. 

Considerations for extensibility, each rota is a seperate view and is represented by the unique url endpoint /rotas/{rotaid}. Also, the code has been designed such that it can accommodate a futher increase (or decrease) in staff levels for the shop.


# Thoughts on final feature implementation

Although I haven't written any code directly for this feature, I have spent some time researching on how to implement this. My approach would be to convert the start and end times of each shift into a unix timestamp in seconds, then create arrays to hold every second to cover this period for each employee.

After doing this, I would then push all the timestamp values into a single array, from which I can then extract only the timestamps which are unique. Running a count on this new array will yield the number of seconds the shop is staffed by a single member, and thus the number of minutes can be inferred.
