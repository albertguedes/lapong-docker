#
# postgresql.dockerfile - a dockerfile to create a postgresql server image.
#
# created: 2023-06-11
# author: albert r. carnier guedes (albert@teko.net.br)
# 
# Distributed under the MIT License. See LICENSE for more information.
#
FROM postgres:alpine

# Create a default database and user to postgresql.
ENV POSTGRES_DB lapongdb
ENV POSTGRES_USER lapong
ENV POSTGRES_PASSWORD lapong
