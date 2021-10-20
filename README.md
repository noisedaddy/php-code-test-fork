#Tymeshift PHP code test 🧪

## Task Description 
This project is one small part of our backend, simplified and
not really identical to what we're using in our production but gives you a 
taste of what you might be dealing with in Tymeshift.

## Prerequisites
- make installed on your PC 
- Docker for running project locally

## Guidelines 
- To build image run `make build` or run `docker build` command from Makefile
- Run `make run` to start container or run `docker run` command from Makefile
- Inside container run `composer install` to install all dependencies 
- and `make test` to run unit test suite
- You can upload your solution to GitHub or send us a ZIP file with the solution at careers@tymeshift.com

## Tasks
- Look around see what you like\don't like get familiar with code structure, so we can discuss it on interview
- Fix tests and add any improvement you see suitable 
- BONUS Implement `ScheduleService` which picks up a `ScheduleEntity` via `DatabaseInterface` mock and `TaskCollection`
via mocking `HttpClientInterface` response and fills `ScheduleEntity::$items`




Happy coding! 