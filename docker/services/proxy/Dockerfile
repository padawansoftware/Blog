FROM ubuntu:18.04

# Basic packages
RUN apt-get update && apt-get install -y \
	curl \
	git \
	iputils-ping \
	nano \
	zip

RUN apt-get install -y \
	apt-utils \
	nginx-extras

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

ADD filesystem/ /

EXPOSE 80
EXPOSE 443

CMD /root/bin/entrypoint.sh
