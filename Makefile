VERSION := $(shell git branch | awk '{print $$2}')

dist: clean
	echo "Building: ${VERSION}"
	mkdir -p build/tmp/
	cp -r src/* build/tmp/
	mv build/tmp build/faridoon-${VERSION}/
	zip -r build/faridoon-${VERSION}.zip build/faridoon-${VERSION}/ 

clean:
	rm -rf build

.PHONY: dist clean
