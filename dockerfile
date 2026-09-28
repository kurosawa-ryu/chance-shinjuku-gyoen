FROM wordpress:latest

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
	mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# install wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

ADD script/init.sh /opt/script/init.sh
RUN chmod +x /opt/script/init.sh
