# Assessment

I am Akrit Shrestha and this is my task assessment.

## Laravel Setup

Once you have cloned the project into your machine, you need to create a mysql database.

Create a .env file and copy the contents of the .env.example into .env file, update the database configuration accordingly.

In terminal, write command:

```bash
composer install
```

This will install all the necessary dependencies in your machine.

Then we need to migrate the tables using command:

```bash
php artisan migrate --seed
```

This will also seed an admin user to the user table.

Then run command:

```bash
php artisan passport:install
```

Copy the value of Client secret of Password grant client and paste it in .env to update the values of WEB_PASSPORT_CLIENT_SECRET and ADMIN_PASSPORT_CLIENT_SECRET.

To seed artists and music, we need to run

```bash
php artisan tinker
```

```bash
App\Models\Artist::factory()->create()
```

```bash
App\Models\Music::factory()->create()
```

To add multiple data number of data wanted can be entered inside factory as argument.
