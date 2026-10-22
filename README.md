<p align="center">
    <img src="https://img.shields.io/static/v1?label=php&message=8.5&color=18181B&labelColor=5354FD" alt="PHP version">
    <img src="https://img.shields.io/codecov/c/github/gianluca-pettenon/soap-totvs" alt="Code Coverage">
    <img src="https://img.shields.io/packagist/dt/gianluca-pettenon/soap-totvs" alt="Total Downloads">
    <img src="https://img.shields.io/packagist/v/gianluca-pettenon/soap-totvs" alt="Latest Stable Version">
    <img src="https://img.shields.io/packagist/l/gianluca-pettenon/soap-totvs" alt="License">
</p>

---

## Requirements

- `PHP` >= `8.5`
- `Composer`
- Enabled `SOAP` extension (`php-soap`)

---

## Installation

Require the package in your project:

```bash
composer require gianluca-pettenon/soap-totvs
```

---

## Configuration

Pass the host, user and password to `SoapConfig`. The fourth argument is extra SoapClient options and overrides the defaults (`connection_timeout` is 25 seconds).

```php
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Adapters\SoapConfig;
use SoapTotvs\TotvsGateway;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter(new SoapConfig(
        host: 'https://localhost:8051',
        user: 'user',
        password: 'secret',
    ))
);
```

---

## Usage Overview

The main entry point of this SDK is `TotvsGateway`, which exposes dedicated gateways for each web service:

- `query()` – SQL Query Web Service
- `process()` – Process Web Service
- `dataServer()` – DataServer Web Service

Example of basic bootstrap:

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Adapters\SoapConfig;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter(new SoapConfig(
        host: 'https://localhost:8051',
        user: 'user',
        password: 'secret',
    ))
);
```

---

## SQL Query Web Service

`affiliate` is the coligada code. `system` is the RM system code (`S` for educational).

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Adapters\SoapConfig;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter(new SoapConfig(
        host: 'https://localhost:8051',
        user: 'user',
        password: 'secret',
    ))
);

$result = $gateway->query()->execute(
    sentence: 'Example.001',
    affiliate: 1,
    system: 'S',
    parameters: ['cdUser' => 1302]
);
```

---

## Process Web Service

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Adapters\SoapConfig;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter(new SoapConfig(
        host: 'https://localhost:8051',
        user: 'user',
        password: 'secret',
    ))
);

$result = $gateway->process()->execute(
    process: 'ProcessName',
    xml: '<Parameters></Parameters>'
);
```

---

## DataServer Web Service

`context` is the DataServer context (`int` or `string`, for example `CODCOLIGADA=1;CODSISTEMA=S`).

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Adapters\SoapConfig;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter(new SoapConfig(
        host: 'https://localhost:8051',
        user: 'user',
        password: 'secret',
    ))
);

// SaveRecord
$save = $gateway->dataServer()->saveRecord(
    dataServer: 'DataServerName',
    context: 'CODCOLIGADA=1;CODSISTEMA=S',
    xml: '<Data></Data>'
);

// ReadRecord
$record = $gateway->dataServer()->readRecord(
    dataServer: 'DataServerName',
    context: 'CODCOLIGADA=1;CODSISTEMA=S',
    primaryKey: 123
);

// ReadView
$view = $gateway->dataServer()->readView(
    dataServer: 'ViewName',
    context: 'CODCOLIGADA=1;CODSISTEMA=S',
    filter: 'FIELD = 1'
);
```

---

## Further Documentation

For details about specific parameters, constraints and behaviors of each web service, refer to the official TOTVS documentation.  
Each gateway class contains a link to the corresponding TOTVS docs.
