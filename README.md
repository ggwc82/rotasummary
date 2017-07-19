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


## Thoughts on final feature implementation (updated 19-07-2017)

For this final feature, my revised approach for calculating the number of minutes a shop is staffed by a single team member described below would be more efficient than the method I previously proposed. The algorithm I propose falls within the context of divide and conquer and bi-section methods, and is of a recursive nature where at each stage, the problem is further divided into two or more subproblems and solved independently. 

### Logical steps for implementation

1. Identify shop opening and closing times, and the difference between e.g. 12 hours. Lets call this the shop shift.

2. For the staff working that day, sort them according to shift length in descending order.

3. Create a function that compares each staff shift against the shop's shift (start and end times).

4. As soon as this function detects a minimum of 2 staff with shifts that are equal or greater the shop's shift, return 0 minutes. This is the best possible scenario in terms of speed of computation, and can be considered an edge case.

5. In the case where less than 2 staff either match or completely overlap the shop's shift, bi-section the shop's shift into two equal sub-shifts and recursively call the same function described in step 3, on the two independent sub-shifts. 

6. At each sub-division level, only those sub-shifts which are not entirely covered by a minimum of 2 staff members will be further subdivided and passed back into the recursive function. The end result will be when the level of division is such that each sub-shift represents 1 minute, at which point our code should sum up all the remaining sub-shifts that are not covered by 2 or more staff members. This sum represents the number of minutes during the shop's opening times when there is only one member of staff working (with the assumption that there is never a period where no staff are working).


If we give further consideration to actual context of the use case, that staff members would generally start and end their shifts at hourly, half-hourly or quarter-hour intervals, the implementation describe above can be further optimised through sub-dividing at a faster rate than halving, such that:

**12 hour shift -> 12 x 1 hour sub-shifts -> 24 x 30min sub-shifts -> 48 x 15min sub-shifts -> 144 x 5min sub-shifts**

In the dataset supplied, there was one instance of a staff member starting their shift at 5 minutes past the hour. If we consider this as the opposite edge case scenario (the case requiring the most computational time), we do not need to further divide to a minute resolution level and hence all single-staffed periods would thus be multiples of 5 minutes.


