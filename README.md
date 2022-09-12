# Squiz refactoring code review

This project is part of the Squiz product engineering interview process. The codebase has been written to contain multiple issues that could be identified and fixed by an engineer.

## Scenario

Pretend you have just inherited this codebase from the business.

The project is an API that allows users to search for page resource items based on id, tag, or content. 

It was developed by a 3rd party contractor, and once the project was completed they moved on and are no longer contactable. 

It's been decided that you are the new owner of this project. At the moment you have no new requirements but you have been told in the near future this project is going to be critical for an important client. 

This client will want new features and to dramatically increase (around 1000x) the current traffic load. Your job is to get the project ready for that.

> **Note:** This test is not about database performance or the structure of the data at rest. The underlying content service has been mocked so that the focus can be on how the data set is being searched and returned.
> You should ignore any of the files in the `/mocks` directory.

### The project

Please assume that the project has been set up to run on PHP7.4+ 

The project uses composer to install some basic tools such as the Symfony http-foundation package and phpunit. You will need to run `composer install` to get these requirements.

To get the application to run, you can execute the `run.php` file to spin up a PHP development server. You may choose to run the server in any other way you wish.

### The API

The following endpoints are available:

- **Search pages by content:**
  This end point searches through the page content and returns the matching data. The search term is passed in via a query param `term`.
  Example url: `http://localhost:8000/contents/?term=foo`

- **Search pages by tag:**
  This end point searches through the page tags and returns the matching data. The search term is passed in via a query param `term`.
  Example url: `http://localhost:8000/tags/?term=bar`

- **Search pages by id:**
  This end point returns the page data corresponding to the given id. The id is passed in via a path param.
  Example url: `http://localhost:8000/pages/123`

## Your tasks

1. Get the project running, inspect the codebase, and note down any issues you see.
2. Determine the 5 most critical parts of the project that need changing based on the scenario above. For each one, consider the changes that you would make to improve the codebase.
3. Consider the application's architecture and production run time and think about what changes would you make (if any) to accommodate the new requirements.

> **Note:** We will be discussing the issues you have found during the interview, so please make sure you note them down and that you are familiar with the codebase. You don't need to actually write code as part of this process, but you can absolutely do so if that makes things easier or if you prefer to show your own code during the technical review.

## What we're looking for

1. Your ability to read and understand an unfamiliar codebase
2. Your ability to identify issues with an unfamiliar codebase
3. Your ability to communicate those issues, why they're an issue, and what work needs to be done to resolve the issue
