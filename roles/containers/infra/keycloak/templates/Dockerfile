#https://www.keycloak.org/server/containers#_building_your_optimized_keycloak_docker_image
FROM debian:stable-slim as downloader

RUN apt update
RUN apt install curl -y
# Download providers
RUN curl -sL https://github.com/sventorben/keycloak-restrict-client-auth/releases/download/v{{ keycloak['container_version'] }}.0/keycloak-restrict-client-auth.jar \
         -o /tmp/keycloak-restrict-client-auth.jar

FROM quay.io/keycloak/keycloak:{{ keycloak['container_version'] }} as builder

# Copy providers
COPY --from=downloader /tmp/keycloak-restrict-client-auth.jar /opt/keycloak/providers/
COPY --chown=keycloak:root keycloak.conf /opt/keycloak/conf/
RUN /opt/keycloak/bin/kc.sh build

FROM quay.io/keycloak/keycloak:{{ keycloak['container_version'] }}
COPY --from=builder /opt/keycloak/ /opt/keycloak/
WORKDIR /opt/keycloak

# change these values to point to a running postgres instance
ENTRYPOINT ["/opt/keycloak/bin/kc.sh", "start"]
