## Laravel 8 Monolith Starter

A simple and clean monolith Laravel app boilerplate with a custom authentication system covered by tests. It uses the best parts of Laravel like Auth guards and the built-in password broker, but doesn't require digging through layers of default framework abstractions just to be overriden for simple extensions and adjustments in the way you need them to be done.

## What's under the hood?

- Laravel 8
- Custom authentication logic for different user types
- Tests covering all of the starter app
- Domain-based Action classes
- Tailwind CSS-ready configuration
- Inertia.js-ready configuration
- Vue.js-ready configuration
- Laravel Mix config for separate public and admin frontends
- Separate routing for public and admin
- Tests written with Pest framework

### Pest PHP testing framework

This boilerplate utilizes the [brilliant Pest testing framework](https://github.com/pestphp/pest). I find its API more natural and clean in terms of perception and code readability. It's also just nice to work with overall.

Having this starter app covered by tests will let you experiment with customization without any guesswork and hoping you don't accidentally break something.

### Separate authentication for users and admins

In real-world apps I've built for my clients and for my side projects, I never liked keeping users of different roles and access layers in a single database table. Instead, I prefer to give them separate tables and separate authentication process.

Laravel's built-in authentication system is great when you have only a single authentication process for everyone. But it becomes quite a pain to customize the existing system when you need to set up custom auth flow for different groups of users.

Luckily, Laravel provides all the tools to create any custom auth process you'd like from scratch. Which I did with this boilerplate, and it will be easy for you to customize the auth process the way you want for any user groups, following the blueprint of this starter app.

### Action classes

Personally, I don't like the process of setting up Laravel events in practice. It gets too messy too fast. What I do is delegate the pieces logic to domain-based Action classes. It keeps the controllers clean and thin, helps keeping models from becoming "god objects", and goes hand in hand with the domain-driven design.

### Laravel Mix configuration for separate frontends

In this boilerplate, you'll find **webpack.mix.js** to be configured to build separate frontends for the public-facing part of your app and your admin panel.

It's configured for Tailwind CSS with separate config for each frontend. I found this approach very practical over the years of [using Tailwind CSS](https://tailwindcss.com/). If you don't use Tailwind CSS, you can easily get rid of its config and set things up your way, according to [Laravel Mix Documentation](https://laravel-mix.com/).

There's also configuration for admin frontend to be a Vue app. I set it up this way because, personally, I build admin panels either as Vue + Vuex apps or just use [Inertia.js](https://inertiajs.com/), which is an amazing tool for that, and I highly recommend this approach.

## Monolith approach

This boilerplate is made for building monolith apps with "sprinkles" of JS or using Inertia.js to create an SPA. If you'd like, it's totally up to you to use it with Sanctum, etc. in your apps.

At the end of the day, it's just a minimal Laravel setup with the convenience of a custom authentication system tested and ready for you.

## Requirements

- PHP 8.0 and up.

## Can I use it?

You are free to use this boilerplate however you want, as long as you don't violate the licensing terms of the underlying open-source software.

Go build great stuff with it, tigers!