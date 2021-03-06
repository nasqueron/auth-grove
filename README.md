
       \        |   |      __|                 
      _ \  |  |  _|   \   (_ |  _|_ \\ \ / -_) 
    _/  _\\_,_|\__|_| _| \___|_|\___/ \_/\___| 
                                           
Welcome to Auth Grove, an authentication grove application.

## What we do

An authentication grove is the fount of your authentication system. From here,
you can implement SSO for any other website and service on your domain.

You also provide your users a clean UI to register or recover a password.

Registration could be implemented by traditional login/pass, social sources
like GitHub or Google OAuth2 or SSO sources like SAML.

## Why we build this

Nasqueron uses a variety of services.

We love single sign on and unified login. Actually, we implemented our first
unified back to 2001. We aren't really into create a login by site.

## Requirements

* PHP 5.5.9+

## How to run an instance of Auth Grove?

We provide a supported docker image.

`docker pull nasqueron/auth-grove`

It provides nginx, php-fpm and requires an access to a MySQL external server,
or a link to a MySQL container.

To run it, see https://devcentral.nasqueron.org/P194 for an example of a launch
script.

A minimal way to run the container is:

```
docker run -t -d \
	--link <a MySQL or MariaDB container>:mysql \
	-p 127.0.0.1:<the port you want>:80 \
	-e TRUST_ALL_PROXIES=1 \
	-e DB_HOST=mysql \
	-e DB_DATABASE=<name of the database> \
	-e DB_USERNAME=<login for this database> \
	-e DB_PASSWORD=<pass for this database> \
	nasqueron/auth-grove
```

## How to develop for Auth Grove?

You'll find these tools handy:

* Node
* Composer
* Gulp
* PHPUnit

To get dependencies:

    git clone <this repository>
    cd auth-grove
    composer install
    npm install

## If you wish to contribute to development

We would especially like to see dashboard features to:

* allow any user to download their data
* offer a view of services used and data in the system

We also welcome anyone who wants to work on SAML integration, especially Shibboleth.

## What we use

* [Laravel](http://laravel.com/docs/5.1), as web application framework
* [Laravel socialite](https://github.com/laravel/socialite), for social authentication
* A [Bootstrap](http://getbootstrap.com/) interface, to provide a familiar interface

## Support

* [IRC support](http://irc.lc/wolfplex)
* [Forum](http://purl.org/NET/Nasqueron/AuthGrove/Forum)
* [DevCentral](https://devcentral.nasqueron.org/tag/auth_grove/)
  (bug tracker, code review)

## License

Auth Grove is open-sourced software licensed
under the [BSD license](http://purl.org/NET/Nasqueron/Software/Licenses/BSD).
