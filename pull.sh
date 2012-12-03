#!/bin/bash
# Basic update script to simplify pulling everything from git to an install.
# Script runs on the assumption it will be run from one level below arcfolder
# Don't leave this in a production Arcfolder installation, it could be a security risk.

if [ ! -d ./arcfolder/ ]; then
	git clone git://github.com/Binary-Heartbeat/Arcfolder.git ./arcfolder/ && cd ./arcfolder/
else
	cd ./arcfolder/ && git reset --hard && git clean -f -d && git pull
fi

if [ ! -d ./auth/ ]; then
	git clone git://github.com/Binary-Heartbeat/Auth.git ./auth/
else
	cd ./auth/ && git reset --hard && git clean -f -d && git pull && cd ../
fi

if [ ! -d ./common/ ]; then
	git clone git://github.com/Binary-Heartbeat/Common.git ./common/
else
	cd ./common/ && git reset --hard && git clean -f -d && git pull
fi
