.PHONY: test

test:
	vendor/bin/phpunit --do-not-cache-result
