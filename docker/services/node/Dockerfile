FROM ubuntu:18.04

# Basic packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    iputils-ping \
    nano \
    zip

# Install npm
RUN apt-get update && apt-get install -y npm

# Install dependencies
RUN npm install -g @vue/cli

# Add scripts
ADD root/bin/ /root/bin/
RUN chmod +x /root/bin/*
