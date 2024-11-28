# Coding Challenge
## Student's Assessment Reporting Application

This project is built with PHP programming language, PHP Unit testing framework, Composer dependency management tool.

## Description

- The test data is located inside data directory under project root.  
- The input is read from the files in data directory under project root.  
- The output will be displayed on the CLI
- Please ensure that the user input is entered when prompted. The prompt will reappear if the input in invalid.
- Database configuration has been setup but for this project database is not being implemented in the solution.
- PHP framework has not been implemented as part of this project
- Automated tests, Functional & Integration testing are not covered in this project. PHPUnit testing is covered.

## Assumptions or Limitations

The program works based on the following assumptions made during development.

- The test data is assumed to have no duplicate records.
- The year level in students.json and student-responses.json is ambiguous and inconsistent.
- In Progress Report section, The difference in the maximum and minimum rawscore is calculated without considering the evaluation of the date completion.
- If the date completion is considered then there is a technical debt which needs to be addressed to get more accurate representation of the message in the last line.

## Getting Started

### Prerequisites

Before starting the installation you must have the following prerequisites. 

1. **macOS Terminal/ Linux Shell Prompt:** You must have Mac Terminal access and little knowledge about working with the terminal application. Login to your Mac system and open terminal or open Linux Shell Prompt.
2. **PHP 8.3.x or Latest Package**: Hypertext Preprocessor server-side programming language.
2. **Composer:** Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.
2. **Docker Desktop:** Docker is used for containerising the PHP Application and build neccssary images for the application.
3. **GitHub or CLI Git**: Clone the github repository from the provided URL or download and unzip the project files. Clone or place the project in a desired location of your local_dev_path. 
    
### Installing

This section details a step by step approach that tell you how to install PHP and Composer which are required to run this application successfully.

1. **Download & Install PHP on macOS:** [PHP - Downloads](https://www.php.net/downloads), [Supported Versions](https://www.php.net/supported-versions.php)
    
    * Install PHP 8.3.x using Homebrew or Macports third-party package installation options
    * Verify PHP Installation
        ```
        php -v
        ```    
        ```
        PHP 8.3.12 (cli) (built: Oct 13 2024 13:05:51) (NTS)
        Copyright (c) The PHP Group
        Zend Engine v4.3.12, Copyright (c) Zend Technologies
        ```

2. **Download & Install Composer:** [Composer](https://getcomposer.org/)  
    * Install Composer which is a dependency management tool . You can install packages using composer.  
    * Please follow [Introduction - Composer](https://getcomposer.org/doc/00-intro.md) to install Composer.  
        1. Download the installer to the current directory  
            ```
            php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
            ```
        2. Verify the installer SHA-384  
            ```
            php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
            ```
        3. Run the installer  
            ```
            php composer-setup.php
            ```
        4. Remove the installer  
            ```
            php -r "unlink('composer-setup.php');"
            ```
           
        5. You can also install Composer to a specific directory or install it globally. Please follow the latest commands from the documentation.
        6. Run this command if -sh: composer: command not found  
            ```
            ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
            ```  
        7. Install all the bundles for the project using the below command.  
            ```
            composer install
            ```  
        8. Update necessary bundles for the project using the below command.   
            ```
            composer update
            ```
3. **Download & Install Docker Desktop:** Download [Docker Desktop](https://www.docker.com/products/docker-desktop/) for your OS, create a personal account and verify your account email address to enable default PAT (Personal Access Token).
4. **GitHub Desktop:** Download [GitHub Desktop](https://github.com/apps/desktop?ref_cta=download+desktop&ref_loc=installing+github+desktop&ref_page=docs), Follow steops for [Installing GitHub Desktop](https://docs.github.com/en/desktop/installing-and-authenticating-to-github-desktop/installing-github-desktop) 

## Docker conatiners for PHP application

To build images using docker and run the PHP application, execute following command in the root directory.
```
docker compose up --build 
``` 
To start docker containers,
```
docker compose up
```
To stop docker containers,
```
docker compose down
```
To gracefully exit the prompt, click `Control + C` on the terminal.

To remove the containers, run the following command in the root directory.
```
docker compose rm
```

## Running the application

`src/RunApp.php` is the entry point of this application in command line interface.
In your CLI, go to project root directory and run the below command. 
```
php src/RunApp.php
```  
     
## Executing the PHP Unit Tests

1. Run all PHPUnit Tests & Assertions  
    ```
    php vendor/bin/phpunit tests
    ```  
   
2. Run specific PHPUnit Tests & Assertions  
    ```  
    php vendor/bin/phpunit tests/<NameYourTest>.php
    ```

3. Run Students PHPUnit Test & Assertions  
    ```  
    php vendor/bin/phpunit tests/StudentsTest.php
    ```

4. Run Assessments PHPUnit Tests & Assertions  
    ```  
    php vendor/bin/phpunit tests/AssessmentsTest.php
    ```

## Terminal or CLI Output Screenshots



## Built With

* [PHP](https://www.php.net/) - PHP programming language 
* [Composer](https://getcomposer.org/) - A dependency management tool
* [PHPUnit](https://phpunit.de/) - A programmer-oriented Unit testing framework
* [PHPUnit Manual](https://docs.phpunit.de/en/10.5/index.html) - PHPUnit testing framework Manual

## Authors

* [Harish Chander Setty](mailto:chanderharish1@gmail.com)
