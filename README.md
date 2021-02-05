# Task Scheduler (*Simply schedule your tasks by PHP*)

## Getting Started
1. clone it
2. run `composer install` on the root folder
3. run `cp .env.example .env` on the root folder
4. add database details
5. if you like it, **star** it

## Simple Start
1. run `php artisan migrate --seed`
2. run `php artisan tasks:fetch 1` to fetch tasks of first provider
3. run `php artisan tasks:divide` to divide tasks between developers
4. run `php artisan tasks:fetch 2` to fetch tasks of second provider
5. run `php artisan tasks:divide` to divide tasks between developers
6. run `php artisan tasks:divide --force` to re-divide all tasks between developers

## Contribution
If you want to participate in this repo, you always welcomed.
Parts to contribution:
* Adding New Features
* Testing
* Performance Improvement
* Clean Code advices
