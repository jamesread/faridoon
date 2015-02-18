package-rpm-fedora:
	rm -rf pkg
	mkdir pkg
	
	rpmbuild -ba var/faridoon-fedora.spec	

