$TTL    259200
@                    IN      SOA     dns.{{ server['network']['domain_name'] }}. hostmaster.{{ server['network']['domain_name'] }}. (
                                                       4         ; Serial
                                                  604800         ; Refresh
                                                   86400         ; Retry
                                                 2419200         ; Expire
                                                  259200 )       ; Negative Cache TTL
; name server RR for the domain
                     IN      NS          dns.{{ server['network']['domain_name'] }}.
{% if mailu['enabled'] is defined %}
; mail server RRs for the zone (domain)
        1w           IN      MX      0   {{ mailu['mail_domain'] }}.
{% endif %}

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
{% if keycloak['enabled'] is defined %}
accounts             IN      A       {{ server['network']['ipv4'] }}
www.account          IN      A       {{ server['network']['ipv4'] }}
{% endif %}
{% if mailu['enabled'] is defined %}
mail                 IN      A       {{ server['network']['ipv4'] }}
www.mail             IN      A       {{ server['network']['ipv4'] }}
autoconfig           IN      A       {{ server['network']['ipv4'] }}
autodiscover         IN      A       {{ server['network']['ipv4'] }}
{% endif %}
{% if collabora_office['enabled'] is defined %}
collaboraonline      IN      A       {{ server['network']['ipv4'] }}
www.collaboraonline  IN      A       {{ server['network']['ipv4'] }}
{% endif %}
{% endif %}

{% if server['network']['ipv6'] is defined and dns['AAAA_records'] is true %}
dns                  IN     AAAA     {{ server['network']['ipv6'] }}
@                    IN     AAAA     {{ server['network']['ipv6'] }}
{% if homer['enabled'] is defined %}
home                 IN     AAAA     {{ server['network']['ipv6'] }}
www.home             IN     AAAA     {{ server['network']['ipv6'] }}
{% endif %}
{% if keycloak['enabled'] is defined %}
accounts             IN     AAAA     {{ server['network']['ipv6'] }}
www.accounts         IN     AAAA     {{ server['network']['ipv6'] }}
{% endif %}
{% if mailu['enabled'] is defined %}
mail                 IN     AAAA     {{ server['network']['ipv6'] }}
www.mail             IN     AAAA     {{ server['network']['ipv6'] }}
autoconfig.mail      IN     AAAA     {{ server['network']['ipv6'] }}
autodiscover.mail    IN     AAAA     {{ server['network']['ipv6'] }}
{% endif %}
{% if collabora_office['enabled'] is defined %}
collaboraonline      IN     AAAA     {{ server['network']['ipv6'] }}
www.collaboraonline  IN     AAAA     {{ server['network']['ipv6'] }}
{% endif %}
{% endif %}
{% if mailu['enabled'] is defined %}

_imap._tcp.{{ mailu['mail_domain'] }}.         600 IN  SRV  20 1 143 mail.{{ server['network']['domain_name'] }}.
_imaps._tcp.{{ mailu['mail_domain'] }}.        600 IN  SRV  10 1 993 mail.{{ server['network']['domain_name'] }}.
_pop3._tcp.{{ mailu['mail_domain'] }}.         600 IN  SRV  20 1 110 mail.{{ server['network']['domain_name'] }}.
_pop3s._tcp.{{ mailu['mail_domain'] }}.        600 IN  SRV  10 1 995 mail.{{ server['network']['domain_name'] }}.
_submission._tcp.{{ mailu['mail_domain'] }}.   600 IN  SRV  20 1 587 mail.{{ server['network']['domain_name'] }}.
_submissions._tcp.{{ mailu['mail_domain'] }}.  600 IN  SRV  10 1 465 mail.{{ server['network']['domain_name'] }}.
_autodiscover._tcp.{{ mailu['mail_domain'] }}. 600 IN  SRV  10 1 443 mail.{{ server['network']['domain_name'] }}.

{{ mailu['mail_domain'] }}.                    600 IN  TXT  "v=spf1 mx a:{{ mailu['mail_domain'] }} ~all"
_dmarc.{{ mailu['mail_domain'] }}.             600 IN  TXT  "v=DMARC1; p=reject; rua=mailto:{{ mailu['postmaster'] }}@{{ mailu['mail_domain'] }}; ruf=mailto:{{ mailu['postmaster'] }}@{{ mailu['mail_domain'] }}; adkim=s; aspf=s"
{{ mailu['mail_domain'] }}._report._dmarc.{{ mailu['mail_domain'] }}. 600 IN TXT "v=DMARC1"
; At least for now you need generate and fill the dkim field
;dkim._domainkey.{{ mailu['mail_domain'] }}.    600 IN  TXT  "v=DKIM1; k=rsa; p=MIIBIjA..."
{% endif %}
