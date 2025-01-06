## Database Migrations

Faridoon does not automatically apply database upgrades (called "migrations" in database terminology), and it does not install the initial database for you. This means you must run this step on *installation* and when asked to do so after an *upgrade*.

However, ruinning migrations is easy. You will need to get a shell on the `faridoon` container. You can do this like this;

``` bash
docker exec -it faridoon /bin/bash
```

This will give you a command prompt like this;

```bash
www-data@70fc8f2b445c:/var/faridoon$
```

Change to the database directory, and you should be able to run `sql-migrate up` without any problems - as the database username, password, and database name are all set in the environment variables.

```bash
www-data@70fc8f2b445c:/var/faridoon$ cd database
www-data@70fc8f2b445c:/var/faridoon$ sql-migrate up
```

This will run all the available migrations, and you should see output like this;

```bash
www-data@70fc8f2b445c:/var/faridoon/database$ sql-migrate up
Applied 1 migration
```

If you see this, then the migrations have been applied successfully.

You can exit the container by typing `exit` at the command prompt.
