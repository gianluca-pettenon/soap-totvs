<p align="center">
  <a href="https://packagist.org/packages/gianluca-pettenon/soap-totvs">
    <img src="https://img.shields.io/packagist/v/gianluca-pettenon/soap-totvs.svg?label=soap-totvs&labelColor=orange&color=555555">
  </a>
</p>

---

## Requirements

- PHP >= 8.4
- Composer
- Enabled SOAP extension (`php-soap`)

---

## Installation

Require the package in your project:

```bash
composer require gianluca-pettenon/soap-totvs
```

---

## Configuration

The SOAP adapter reads the following environment variables:

- `WSHOST` – base URL of the TOTVS server (for example: `https://my-server:8051`)
- `WSUSER` – web service user
- `WSPASS` – web service password

You can use any environment management solution (like `vlucas/phpdotenv`) in your application
to load these variables into the environment before creating the `TotvsGateway`.

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

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter()
);
```

---

## SQL Query Web Service

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Enums\{
    SystemEnum,
    AffiliateEnum
};

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter()
);

$result = $gateway->query()->execute(
    sentence: 'Example.001',
    affiliate: AffiliateEnum::DEFAULT,
    system: SystemEnum::EDUCATIONAL,
    parameters: ['cdUser' => 1302]
);
```

---

## Process Web Service

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter()
);

$result = $gateway->process()->execute(
    process: 'ProcessName',
    xml: '<Parameters></Parameters>'
);
```

---

## DataServer Web Service

```php
use SoapTotvs\TotvsGateway;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Enums\ContextEnum;

$gateway = new TotvsGateway(
    adapter: new LaminasAdapter()
);

// SaveRecord
$save = $gateway->dataServer()->saveRecord(
    dataServer: 'DataServerName',
    context: ContextEnum::DEFAULT,
    xml: '<Data></Data>'
);

// ReadRecord
$record = $gateway->dataServer()->readRecord(
    dataServer: 'DataServerName',
    context: ContextEnum::DEFAULT,
    primaryKey: 123
);

// ReadView
$view = $gateway->dataServer()->readView(
    dataServer: 'ViewName',
    context: ContextEnum::DEFAULT,
    filter: 'FIELD = 1'
);
```

---

## Further Documentation

For details about specific parameters, constraints and behaviors of each web service, refer to the official TOTVS documentation.  
Each class under `SoapTotvs\WebServices` contains a link to the corresponding TOTVS docs.
