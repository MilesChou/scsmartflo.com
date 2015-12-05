#!/usr/bin/make -f
IMAGE := scsmartflo
VERSION := latest

.PHONY: all build

# ------------------------------------------------------------------------------

all: build

build:
	docker build -t=base ./docker/base
	docker build -t=phpmyadmin ./docker/phpmyadmin
	docker build -t=scsmartflo .
	
