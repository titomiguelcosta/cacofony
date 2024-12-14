.PHONY: docker-run
docker-run:
	docker compose up

.PHONY: fix-permissions
fix-permissions:
	sudo chown ${USER}:${USER} *

.PHONY: deploy
deploy:
	php vendor/bin/dep deploy
