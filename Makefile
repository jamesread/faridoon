VERSION := $(shell git branch | awk '{print $$2}')

lint: phpcs phpcbf phpstan

phpcs:
	vendor/bin/phpcs src/

phpcbf:
	vendor/bin/phpcbf src/

phpstan:
	vendor/bin/phpstan analyse src/

dist: clean
	echo "Building: ${VERSION}"
	mkdir -p build/tmp/
	cp -r src/* build/tmp/
	mv build/tmp build/faridoon-${VERSION}/
	zip -r build/faridoon-${VERSION}.zip build/faridoon-${VERSION}/ 

clean:
	rm -rf build

container-image:
	docker kill faridoon || true
	docker rm faridoon && docker rmi faridoon || true
	docker build -t faridoon:latest .

container: container-image
	docker create --name faridoon -p 8080:8080 --env-file=.env.dev faridoon:latest
	docker start faridoon

docker-container-image:
	docker build -t localhost/faridoon/faridoon:latest -f Dockerfile .

.PHONY: dist clean docker-container-image container
