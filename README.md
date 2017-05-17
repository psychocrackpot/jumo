# JUMO
Loan Aggregate Calculator

## Description

Raw php util which accepts a pre-formatted csv and calculates aggregate loan values per month accross different networks and products

## Strategy
Creation of a simple MVC application which creates individual loan models for each row of uploaded csv.
The model is then validates and added to a collection of loans.
Once all models have been created from csv data, we can aggregate and format the output.csv.

Rudimentary handling of errors via static html files.
A simple parser for placeholders in the style of {{placeholder}} has been implemented for dynamic variables and template injection.

## Performance
Temporary uploads are not saved to application directories, and rather parsed immediately (initially planned to save copies in var/uploads but the trade-off in disk IO affected scalibility).
Use of Singletons where possible to limit memory consumption.
Strict validation of rows in input data to prevent unneccessary parsing and calculations.
Throwing of raw PHP Exceptions and a single point of error handling within the main App model to prevent excessive data type validation and additional code within classes. 



## Technical Requirements
- Apache / Nginx Webserver
- PHP >= 5.4

## External Libraries / Dependencies
None

## Demo
Link https://jumo-psychocrackpot.c9users.io/









