FROM ubuntu:18.04

# Basic packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    iputils-ping \
    nano \
    zip

# Install npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs

# Install dependencies
RUN npm install -g @vue/cli

# Add scripts
ADD root/bin/ /root/bin/
RUN chmod +x /root/bin/*
