This repository helps in the consumption of TOTVS Web Service via SOAP with PHP.
============================

## Installation
- Clone the repository (`git clone https://github.com/gianluca-pettenon/soap-totvs.git`).
- Run `composer install` to install the dependencies ([get composer here](https://getcomposer.org/download)).

## Settings
- Enable the `php_soap.dll` extension in your `php.ini`.
- Rename the `env` file to `.env` and fill in your settings.

## Instruction for use
- In each class located in the `App\WebService` directory, there is a `link` to inform how to pass the parameters.
- To run the project, at the `root of the directory`, run `composer start` through the terminal.
