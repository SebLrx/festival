FROM ubuntu:20.04

# Install required packages
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y wget curl gnupg2 ca-certificates

# Install XAMPP
RUN wget https://www.apachefriends.org/xampp-files/8.1.2/xampp-linux-x64-8.1.2-0-installer.run && \
    chmod +x xampp-linux-x64-8.1.2-0-installer.run && \
    ./xampp-linux-x64-8.1.2-0-installer.run --mode unattended --disable-components tomcat --disable-components perl --disable-components phpmyadmin --disable-components ftp --disable-components mail --disable-components mercury && \
    rm xampp-linux-x64-8.1.2-0-installer.run

# Add XAMPP to the path
ENV PATH=$PATH:/opt/lampp/bin

# Start Apache
CMD ["/opt/lampp/lampp", "startapache"]
