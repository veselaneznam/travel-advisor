# Travel Advisor

A Symfony 4 project which purpose is to sort a bucket of travel cards
Which are initially unordered and their start and end is unknown.

As a architecture I have used Domain Driven Development principles, that is why almost everywhere I am relying on abstraction.

## Getting Started

To be able to run the project you just need to run:
 ```
 composer install.
 ```
  And then after that to run:
   ```
   bin/console server:start
  ```  
in order to use symfony web server
The API can be reached, like that you can get an example of the required input for the other endpoints
```
GET http://127.0.0.1:8000//api/boarding-cards

```

In order to see sorted this cards you need to execute 
```
POST http://127.0.0.1:8000//api/boarding-cards/sort

```
With the provided example from the other endpoint.

I have added one more additional endpoint which is usable if you want to get the first card from the unsorted list
```
POST http://127.0.0.1:8000//api/boarding-cards/first

```
where in the body you need to provide the example request body.

### Prerequisites

You need to have composer, and postman

## Running the tests

In order to run the tests you need to run from the project folder
```
./vendor/bin/simple-phpunit

```
or if you want you can create a symlink.