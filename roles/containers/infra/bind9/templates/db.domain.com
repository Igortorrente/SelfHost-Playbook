$TTL    604800
@                    IN      SOA     dns.{{ server['network']['domain_name'] }}. hostmaster.{{ server['network']['domain_name'] }}. (
                                                       4         ; Serial
                                                  604800         ; Refresh
                                                   86400         ; Retry
                                                 2419200         ; Expire
                                                  604800 )       ; Negative Cache TTL
; name server RR for the domain
                     IN      NS          dns.{{ server['network']['domain_name'] }}.

{% if server['network']['ipv4'] is defined %}
; domain hosts includes NS and MX records defined above
; plus any others required
; for instance a user query for the A RR of joe.example.com will
; return the IPv4 address 170.187.134.150 from this zone file
dns                  IN      A       {{ server['network']['ipv4'] }}
@                    IN      A       {{ server['network']['ipv4'] }}
{% if homer['enabled'] is defined %}
home                 IN      A       {{ server['network']['ipv4'] }}
www.home             IN      A       {{ server['network']['ipv4'] }}
{% endif %}
{% endif %}

{% if server['network']['ipv6'] is defined and dns['AAAA_records'] is true %}
dns                  IN     AAAA     {{ server['network']['ipv6'] }}
@                    IN     AAAA     {{ server['network']['ipv6'] }}
{% if homer['enabled'] is defined %}
home                 IN     AAAA     {{ server['network']['ipv6'] }}
www.home             IN     AAAA     {{ server['network']['ipv6'] }}
{% endif %}
{% endif %}
