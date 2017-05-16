# JUMO
Loan Aggregate Calculator

## Description

Raw php util which accepts a pre-formatted csv and calculates aggregate loan values per month accross different networks and products

## Strategy
Creation of a simple MVC application which creates individual loan models for each row of uploaded csv.
The model is then validates and added to a collection of loans.
Once all models have been created from csv data, we can aggregate and format the output.csv.

Rudimentary handling of errors via static html files.
A simle parser for placeholders in the style of {{placeholder}} has been implemented for dynamic variables and template injection.


## Technical Requirements
Apache / Nginx Webserver
PHP >= 5.4

## External Libraries / Dependencies
None

## Demo
Link https://jumo-psychocrackpot.c9users.io/









