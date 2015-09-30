## TwigStarter

TwigStarter is a small app for Twig integrators.

It allows them to easily create templates, using the power of Twig.

### Requirements

- PHP >= 5.4
- [Composer](https://getcomposer.org/)

### Installation

- Clone the repo : ` git clone git@github.com:blaiskillian/twigstarter`
- Install dependancies :
	- Composer : `composer install`
	- NodeJS : `npm install`
- Copy the .env-example file to .env, and edit the `BASE_URL` with your own if necessary

### How To

Just use the `grunt watch` command, and the script will watch your assets files (located in `/resources/assets/`) and run the app with the PHP built-in webserver

### Usage

#### Routing

Let's say you need to create a route for the URL `/foo/bar`.

The only thing you need to do is to create the file `app/foo/bar.php`, that's it ! (you can also create a `app/foo/bar/index.php`)

#### Templating

Put your Twig templates in `resources/views`.

Templates can be called with a dot notation.

Let's imagine you need to extend the `foo/bar.twig` file, use `{% extends 'foo.bar' %}`.

#### Faker

You can generate fake data using the `$faker` variable.

It uses [F. Zaninotto's Faker lib](https://github.com/fzaninotto/Faker). The formatter's list is available [here](https://github.com/fzaninotto/Faker#formatters).

#### Request/Response

This app uses [sabre/http](sabre.io/http/) library, that provides `Request` and `Response` objects to interact with HTTP requests and reponses.

To access the `Request` object, use the `request()` function in your code.

Then, using the `view($tpl_name, $data, $status_code)` function, you can send back a `Response` containing the rendered view with the given data. You can also create a custom `Response` instance, look at [Sabre's doc](http://sabre.io/http/sapi/) for more informations.
