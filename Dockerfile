FROM fedora:26
MAINTAINER thinh <thinh.nguyenxuan@edge-works.net>

RUN dnf -y install httpd php php-common php-pecl-apcu php-cli php-pear php-pdo php-mysqlnd php-pgsql php-pecl-mongodb php-pecl-memcache php-pecl-memcached php-gd php-mbstring php-mcrypt php-xml supervisor

ADD supervisord.conf /etc/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord"]