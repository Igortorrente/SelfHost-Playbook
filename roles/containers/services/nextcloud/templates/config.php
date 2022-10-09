<?php
$CONFIG = array (
  'passwordsalt' => '{{ nc_passwordsalt }}',
  'secret' => '{{ nc_secret }}',
  'instanceid' => '{{ nc_instanceid }}',
  'version' => '{{ nc_version }}',
  'installed' => {{ nc_installed }},
  'datadirectory' => '{{ nc_datadirectory }}',
  'trusted_domains' =>
  array (
    0 => 'localhost',
    1 => '{{ server["network"]["domain_name"] }}',
    2 => 'nginx-nextcloud',
  ),
  'trusted_proxies' =>
  array (
    0 => '{{ server["network"]["ipv4"] }}',
    1 => '{{ server["network"]["ipv6"] }}',
    2 => '{{ containers["subnet"] }}',
  ),
  'overwrite.cli.url' => '{{ nc_overwrite_cli_url }}',
  'dbtype' => 'pgsql',
  'dbname' => '{{ nextcloud["db_name"] }}',
  'dbhost' => 'postgres',
  'dbport' => '',
  'dbtableprefix' => '{{ nc_dbtableprefix }}',
  'dbuser' => '{{ nextcloud["postgres_user"] }}',
  'dbpassword' => '{{ nextcloud["postgres_password"] }}',
  'filelocking.enabled' => true,
  'memcache.locking' => '\OC\Memcache\Redis',
  'memcache.distributed' => '\OC\Memcache\Redis',
  'memcache.local' =>'\OC\Memcache\Redis',
  'maintenance_window_start' => 1,
  'redis' =>
  array (
    'host' => 'redis',
    'port' => 6379,
    'user' => 'default',
    'password' => '{{ redis["password"] }}',
    'dbindex' => 0,
    'timeout' => 10,
  ),
  'default_phone_region' => '{{ nextcloud["phone_region"] }}',
  'default_language' => '{{ nextcloud["default_language"] }}',
  'auth.webauthn.enabled' => false,
  'allow_local_remote_servers' => true,
{% if services_mail['enabled'] is true %}
  'mail_smtpmode' => 'smtp',
{% if services_mail["smtp_securty"] == 'starttls' %}
  'mail_smtpsecure' => 'tls',
{% elif services_mail["smtp_securty"] == 'tls' %}
  'mail_smtpsecure' => 'ssl',
{% else %}
  'mail_smtpsecure' => '',
{% endif %}
  'mail_sendmailmode' => 'smtp',
  'mail_from_address' => '{{ services_mail["sender_name"] }}',
{% if services_mail['smtp_auth_type'] == 'login' %}
  'mail_smtpauthtype' => 'LOGIN',
{% else %}
  'mail_smtpauthtype' => 'PLAIN',
{% endif %}
  'mail_smtpauth' => 1,
  'mail_smtphost' => '{{ services_mail["smtp_host"] }}',
  'mail_domain' => '{{ services_mail["mail_domain"] }}',
  'mail_smtpport' => '{{ services_mail["smtp_port"] }}',
  'mail_smtpname' => '{{ services_mail["smtp_name"] }}@{{ services_mail["mail_domain"] }}',
  'mail_smtppassword' => '{{ services_mail["smtp_password"] }}',
{% if mailu['enabled'] is true and
      mailu['services_mail']['enabled'] is true and
      nginx_proxy['certbot']['enabled'] is false
%}
  'mail_smtpstreamoptions' => [
    'ssl' => [
      'allow_self_signed' => true,
      'verify_peer_name' => false
    ]
  ],
{% endif %}
{% endif %}
);
