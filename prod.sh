#!/bin/bash

#cp resources/assets/js/.app.js.prod resources/assets/js/app.js \
#	&& npm run prod

#cp resources/assets/js/.app.js.dev resources/assets/js/app.js

mkdir -p prod/{laravel_supra,public_html}
rsync -av . prod/laravel_supra \
	--exclude prod \
	--exclude node_modules \
	--exclude scripts \
	--exclude vendor \
	--exclude ".git*" \
	--exclude "*.sql" \
	--exclude "*.txt" \
	--exclude "*.md" \
	--exclude "*.csv" \
	--exclude "prod.sh" \
	--exclude ".env" \

cd prod/laravel_supra \
	&& cp public/.index.php.prod public/index.php \
	&& npm install --production \
	&& composer install --optimize-autoloader --no-dev \
	&& mv public ../public_html/registro \


# cron
# ln -s /home/comercialsupra/laravel_supra/storage/app/public /home/comercialsupra/public_html/registro/storage

