# Server Farm

Simulation of allocation of servers and virtual machines in a server farm

[![Build Status](https://img.shields.io/travis/facebook/php-graph-sdk/5.4.svg)](https://travis-ci.org/sasakocic/server-farm)
[![Code Style Status](https://styleci.io/repos/83059149/shield)](https://styleci.io/repos/87685511)
[![CodeCov](https://img.shields.io/codecov/c/github/sasakocic/server-farm.svg)](https://codecov.io/gh/sasakocic/server-farm)

## Installation

Installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer install
```

## Usage

Usage can be seen from tests. 

In essence we create a ServerFarm object by specifying `maximum` server specs(cpu, ram and hdd size).
We create an array of Virtual machines and store them (bigger than `maximum` are skipped) with `storeVmachines`,
and then we:
 
- read the array of allocated machines with `getServers()`
- get the count with `count()`
- see detailed allocation list with `toString()`

```php
$vmArray = [
    new VmachineModel(1, 1, 2),
    new VmachineModel(2, 2, 1),
    new VmachineModel(3, 4, 3),
    new VmachineModel(2, 1, 2),
];
$sf = new ServerFarmModel(ServerModel::create(5, 6, 7));
$sf->storeVmachines($vmArray);
$actual = $sf->toString();
$expected = "Server list\n"
    . "1. VM(1 MHz, 1 GB, 2 GB) VM(2 MHz, 2 GB, 1 GB) remains VM(1 MHz, 3 GB, 4 GB)\n"
    . "2. VM(3 MHz, 4 GB, 3 GB) remains VM(1 MHz, 2 GB, 4 GB)\n"
    . "3. VM(2 MHz, 1 GB, 2 GB) remains VM(2 MHz, 5 GB, 5 GB)\n";
$this->assertSame($expected, $actual);
$n = $sf->count();
$this->assertSame(3, $n);
```

## Tests

1. [Composer](https://getcomposer.org/) is a prerequisite for running the tests. Install composer globally, then run `composer install` to install required files.
2. The tests can be executed by running this command from the root directory:

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## License

Please see the [license file](LICENSE) for more information.
