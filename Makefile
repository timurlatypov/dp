ifeq ($(shell uname), "Darwin")
SHELL=zsh
endif

.PHONY: vendor optimize clean destroy start up

up: vendor start

vendor:
	docker volume create dp-data
	docker-compose run --rm \
		-v ~/.ssh:/var/www/.ssh:delegated \
		-v ~/.composer:/var/www/.composer:delegated \
		-e COMPOSER_MEMORY_LIMIT=-1 \
		dp-app \
		composer install -o

optimize:
	docker-compose run --rm dp-app php artisan optimize:clear

build:
    docker-compose run --rm dp-npm npm run production

start:
	docker-sync start
	docker-sync-stack start

clean:
	docker-compose down -v
	docker-sync stop && docker-sync clean

destroy: _destroy-message clean
	rm -rf \
		storage/logs/* \
		storage/debugbar/* \
		storage/framework/cache/data/* \
		storage/framework/sessions/* \
		storage/framework/views/* \
		bootstrap/cache/* \
		vendor \
		&& echo $$?

_destroy-message:
	echo "Эта команда удалит все файлы настроек проекта\nДля продолжения нажмите Enter" && read

%:
	@$*