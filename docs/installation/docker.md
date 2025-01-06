# Install Faridoon with Docker

The container image for Faridoon can be found on GitHub Container Registry, and can be pulled using the following commands:

```bash
docker pull ghcr.io/jamesread/faridoon:latest
```

Faridoon container images are build for the **amd64** and **arm64** architectures.

The container can be run using the following command:

```bash
docker run -it --name faridoon --port 8080:8080 -e DB_HOST=mysql -e DB_PASS=hunter2 -e DB_USER=faridoon ghcr.io/jamesread/faridoon:latest
```

Consider using [Docker Compose](docker-compose.md) instead though, it's a lot easier.
