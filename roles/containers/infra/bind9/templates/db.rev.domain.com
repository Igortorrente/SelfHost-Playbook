; https://bind9.readthedocs.io/en/latest/chapter3.html#private-ip-reverse-map-zone-files
;
; BIND reverse data file for local loopback interface
;

$TTL    604800
@       IN      SOA     dns.{{ server['network']['domain_name'] }}. hostmaster.{{ server['network']['domain_name'] }}. (
                              2         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns.
{{ ipv4_part[3] }}     IN      PTR     dns.{{ server['network']['domain_name'] }}.
{% if homer['enabled'] is defined %}
{{ ipv4_part[3] }}     IN      PTR     home.{{ server['network']['domain_name'] }}.
{% endif %}
{% if keycloak['enabled'] is defined %}
{{ ipv4_part[3] }}     IN      PTR     accounts.{{ server['network']['domain_name'] }}.
{% endif %}
{% if mailu['enabled'] is defined %}
{{ ipv4_part[3] }}     IN      PTR     mail.{{ server['network']['domain_name'] }}.
{{ ipv4_part[3] }}     IN      PTR     autoconfig.{{ mailu["mail_domain"] }}.
{{ ipv4_part[3] }}     IN      PTR     autodiscover.{{ mailu["mail_domain"] }}.
{% endif %}

; also list other computers
;21      IN      PTR     box.example.com.
