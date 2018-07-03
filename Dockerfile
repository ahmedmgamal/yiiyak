FROM emco/pvradar

#Server port
ENV listenport=8888
RUN sed -i -e "s/listen\ 80/listen\ $listenport/" /etc/nginx/sites-enabled/pvradar
EXPOSE $listenport/tcp

ADD ci/start-db/yak1.sql /pvradar/
RUN rm -r /pvradar/www
RUN mkdir /pvradar/www
ADD ./ /pvradar/tmp
RUN rsync -crvl --exclude=/yii --exclude=/backend/web/files --exclude=.idea --exclude=nbproject --exclude=.buildpath --exclude=.project --exclude=.settings --exclude=Thumbs.db --exclude=/vendor --exclude=/backend/web/files/* --exclude=composer.phar --exclude=.DS_Store --exclude=phpunit.phar --exclude=/phpunit.xml --exclude=.git* --exclude=/common/config/main-local.php /pvradar/tmp/ /pvradar/www/
WORKDIR /pvradar/www
RUN composer global require "fxp/composer-asset-plugin:^1.2.0"
RUN composer dump-autoload
RUN composer clear-cache
RUN composer update
RUN echo -e "0" | ./init
RUN echo "<?php" > /pvradar/www/common/config/main-local.php
RUN echo "return [" >> /pvradar/www/common/config/main-local.php
RUN echo "    'components' => [" >> /pvradar/www/common/config/main-local.php
RUN echo "        'db' => [" >> /pvradar/www/common/config/main-local.php
RUN echo "            'class' => 'yii\db\Connection'," >> /pvradar/www/common/config/main-local.php
RUN echo "            'dsn' => 'mysql:host=localhost;dbname=pvradar'," >> /pvradar/www/common/config/main-local.php
RUN echo "            'username' => 'pvradar'," >> /pvradar/www/common/config/main-local.php
RUN echo "            'password' => 'pvradar'," >> /pvradar/www/common/config/main-local.php
RUN echo "            'charset' => 'utf8'," >> /pvradar/www/common/config/main-local.php
RUN echo "        ]," >> /pvradar/www/common/config/main-local.php
RUN echo "        'mailer' => [" >> /pvradar/www/common/config/main-local.php
RUN echo "            'class' => 'yii\swiftmailer\Mailer'," >> /pvradar/www/common/config/main-local.php
RUN echo "            'viewPath' => '@common/mail'," >> /pvradar/www/common/config/main-local.php
RUN echo "        ]," >> /pvradar/www/common/config/main-local.php
RUN echo "    ]," >> /pvradar/www/common/config/main-local.php
RUN echo "];" >> /pvradar/www/common/config/main-local.php

RUN echo "#!/bin/bash" > /mysql.sh
RUN echo "mysql -uroot -e \"CREATE DATABASE pvradar DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_general_ci; grant all privileges on pvradar.* to 'pvradar'@'localhost' identified by 'pvradar' with grant option;flush privileges;\"" >> /mysql.sh 
RUN echo "mysql -uroot pvradar < /pvradar/yak1.sql" >> /mysql.sh
RUN echo "cd /pvradar/www/" >> /mysql.sh
RUN echo "./yii migrate --interactive=0" >> /mysql.sh
RUN chmod 755 /mysql.sh
