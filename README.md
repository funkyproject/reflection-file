# ReflectionFile

Use `Attraktiv\ReflectionFile` to retrieve a lot of information about class into the file.

[![Build Status](https://travis-ci.org/funkyproject/reflection-file.png)](https://travis-ci.org/funkyproject/reflection-file) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/funkyproject/reflection-file/badges/quality-score.png?s=fe5962c1611b11c9597787c967742552acb750ba)](https://scrutinizer-ci.com/g/funkyproject/reflection-file/) [![Code Coverage](https://scrutinizer-ci.com/g/funkyproject/reflection-file/badges/coverage.png?s=d4e9c73e071e072895c7ce43d55b8fa09236466b)](https://scrutinizer-ci.com/g/funkyproject/reflection-file/)

## Installation

You can install this lib using composer

    composer require funkyproject/reflection-file

or add the package to your ``composer.json`` file directly

## Usage

    use Funkyproject\ReflectionFIle;

    $reflectionFile = new ReflectionFile($pathFileValid);
    $reflectionFile->getName() // Namespace/ClassName
    $instance = $reflectionFile->newInstance();

More information about methods are available on http://www.php.net/manual/en/class.reflectionclass.php

If file not found, `ReflectionFile` will throw a `FileNotFoundException`

If file is not a class, ReflectionFile will throw a `ReflectionException`

## Tests

 You can run the unit tests with the following command:

     $ cd path/to/ReflectionFile/
     $ composer.phar install
     $ phpunit