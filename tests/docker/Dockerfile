FROM ubuntu

RUN apt-get update
RUN apt-get --assume-yes install \
    php5-cli \
    php-pear \
    php5-pgsql \
    php5-curl \
    php5-dev \
    build-essential \
    postgresql-client \
    bzip2 \
    git \
    socat


RUN pear channel-discover pear.phing.info
RUN pear install --alldeps phing/phing
RUN pear channel-discover pear.propelorm.org
RUN pear install -a propel/propel_runtime
RUN pear install Log
RUN pear install Console_CommandLine
RUN pear install -f Console_Table
RUN pear install channel://pear.php.net/Console_ProgressBar-0.5.2beta

RUN sed -i '/phar.readonly = /s/^.*/phar.readonly = Off/' /etc/php5/cli/php.ini

RUN git clone https://github.com/sstephenson/bats.git; \
    cd bats; \
    ./install.sh /usr/

