; https://bind9.readthedocs.io/en/latest/chapter3.html#private-ip-reverse-map-zone-files
;
; BIND reverse data file for local loopback interface
;

$TTL    259200
@       IN      SOA     dns.{{ server['network']['domain_name'] }}. hostmaster.{{ server['network']['domain_name'] }}. (
                              2         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         259200 )       ; Negative Cache TTL
;
@       IN      NS      ns.
{{ ipv4_part[3] }}     IN      PTR     dns.{{ server['network']['domain_name'] }}.

; also list other computers
;21      IN      PTR     box.example.com.
