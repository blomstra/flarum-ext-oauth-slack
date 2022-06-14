# Sign in With Slack

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/blomstra/oauth-slack.svg)](https://packagist.org/packages/blomstra/oauth-slack) [![Total Downloads](https://img.shields.io/packagist/dt/blomstra/oauth-slack.svg)](https://packagist.org/packages/blomstra/oauth-slack)

A [Flarum](http://flarum.org) extension. Sign in with Slack

## Installation

Install with composer:

```sh
composer require blomstra/oauth-slack:"*"
```

## Updating

```sh
composer update blomstra/oauth-slack
php flarum cache:clear
```

## Configuration

Once enabled, this extension will add a `Slack` option to the settings page of `fof/oauth`. Toggle `Slack` on, and hit the configure icon.

Follow the [Slack documentation](https://api.slack.com/authentication/sign-in-with-slack) to create an [application](https://api.slack.com/apps)

It is **imperitive** that you grant the following scopes to your new application at Slack:
- `openid`
- `email`
- `profile`

Set the callback URL as given in the extension settings.

Enter the `Client ID` and `Client Secret` as displayed in the `Basic Information` page at Slack into the Flarum configuration.

Enjoy logging in with your Slack credentials!

## Links

- [Packagist](https://packagist.org/packages/blomstra/oauth-slack)
- [GitHub](https://github.com/blomstra/flarum-ext-oauth-slack)
- [Discuss](https://discuss.flarum.org/d/31039)
