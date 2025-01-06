# Install Faridoon with Docker Compose

Docker compose is the recommended way to run Faridoon. This page assumes that you have a working understanding of Docker and Docker Compose. If you are new to Docker, please refer to the [Docker documentation](https://docs.docker.com/get-started/).

You can use the following `docker-compose.yml` file to run Faridoon with Docker Compose:

```yaml title="docker-compose.yml"
--8<--
docs/installation/docker-compose.yml
--8<--
```

Change your environment variables as necessary to set your passwords (`DB_PASS` should be the same as `MYSQL_PASSWORD`. `DB_USER` should be the same as `MYSQL_USER`, etc).

Save this file as `docker-compose.yml` and run `docker-compose up -d` in the same directory. Faridoon will be available at `http://localhost:8080`.
