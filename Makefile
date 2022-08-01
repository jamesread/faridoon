VERSION := $(shell git branch | awk '{print $$2}')

dist: clean
	echo "Building: ${VERSION}"
	mkdir -p build/tmp/
	cp -r src/* build/tmp/
	mv build/tmp build/faridoon-${VERSION}/
	zip -r build/faridoon-${VERSION}.zip build/faridoon-${VERSION}/ 

clean:
	rm -rf build

container:
	mkdir -p /tmp/dockerConfig
	podman kill faridoon || true
	podman rm  faridoon && podman rmi faridoon || true
	buildah bud -t faridoon:latest .
	podman create --name faridoon -p 8080:8080 -v /tmp/dockerConfig:/config/ faridoon:latest
	podman start faridoon 

.PHONY: dist clean
