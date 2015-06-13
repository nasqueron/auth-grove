#
# Auth Grove
# 

all: assets vendor

assets:
	gulp
	
vendor:
	composer install

clean:
	rm -f storage/framework/sessions/*
	rm -f storage/framework/views/*
