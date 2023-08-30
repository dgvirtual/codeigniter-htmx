# CodeIgniter HTMX, adapted for PHP 7.4

This fork is meant to adapt the library for PHP 7.4 (the original library only works with PHP 8.x)

A set of methods for `IncomingRequest`, `Response` and `RedirectResponse` classes to help you work with [htmx](https://htmx.org) fluently in CodeIgniter 4 framework.

It also provides some additional help with **handling errors** and **Debug Toolbar** in development mode as well as support for **view fragments**.

[![PHPUnit](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/phpunit.yml/badge.svg)](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/phpunit.yml)
[![PHPStan](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/phpstan.yml/badge.svg)](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/phpstan.yml)
[![Deptrac](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/deptrac.yml/badge.svg)](https://github.com/dgvirtual/codeigniter-htmx/actions/workflows/deptrac.yml)
[![Coverage Status](https://coveralls.io/repos/github/dgvirtual/codeigniter-htmx/badge.svg?branch=develop)](https://coveralls.io/github/dgvirtual/codeigniter-htmx?branch=develop)

![PHP](https://img.shields.io/badge/PHP-%5E7.4-blue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-%5E4.3-blue)

## Installation

To install in an **existing composer project**, run in command line:

    composer config minimum-stability dev
    composer config repositories.codeigniter-htmx vcs git@github.com:dgvirtual/codeigniter-htmx.git
    composer require michalsn/codeigniter-htmx:dev-php7port

For **manual installation**, follow the manual installation instructions in the docs, while downloading package from this repository.

Remember - you still need to include the `htmx` javascript library inside the `head` tag.

## Docs

https://michalsn.github.io/codeigniter-htmx/

## Demos

https://github.com/michalsn/codeigniter-htmx-demo

As of 2023-01-20, the demos seem to not include any PHP8-only code and should work out-of-the-box.
