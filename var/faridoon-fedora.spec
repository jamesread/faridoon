Name:		faridoon
Version:	1.0.0
Release:	1%{?dist}
Summary:	A really simple PHP based quotes system.

Group:		Web
License:	GPL
URL:		http://github.com/faridoon
Source0:	../build/distributions/faridoon.zip

BuildRequires:	make
Requires:	php5

%description
A really simple PHP based quotes system.

%prep
%setup -q


%build
unzip faridoon.zip

%install


%files
%doc



%changelog

