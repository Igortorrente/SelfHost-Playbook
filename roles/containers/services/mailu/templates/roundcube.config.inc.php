<?php

// Folder: /etc/roundcube/config.inc.php
/*
+-----------------------------------------------------------------------+
| Local configuration for the Roundcube Webmail installation.           |
|                                                                       |
| This is a sample configuration file only containing the minimum       |
| setup required for a functional installation. Copy more options       |
| from defaults.inc.php to this file to override the defaults.          |
|                                                                       |
| This file is part of the Roundcube Webmail client                     |
| Copyright (C) 2005-2013, The Roundcube Dev Team                       |
|                                                                       |
| Licensed under the GNU General Public License version 3 or            |
| any later version with exceptions for skins & plugins.                |
| See the README file for a full license statement.                     |
+-----------------------------------------------------------------------+
*/

// ----------------------------------
// LOGGING/DEBUGGING
// ----------------------------------

// Log IMAP conversation
$config['imap_log'] = true;

// Log SMTP conversation
$config['smtp_log'] = true;

// log driver:  'syslog', 'stdout' or 'file'.
$config['log_driver'] = 'file';

// Log successful/failed logins to <log_dir>/userlogins.log or to syslog
$config['log_logins'] = true;

// Default extension used for log file name
$config['log_file_ext'] = '.log';

// Log session debug information/authentication errors to <log_dir>/session.log or to syslog
$config['session_debug'] = false;

// Log SQL queries to <log_dir>/sql.log or to syslog
$config['sql_debug'] = false;

// Log IMAP conversation to <log_dir>/imap.log or to syslog
$config['imap_debug'] = false;

// Log SMTP conversation to <log_dir>/smtp.log or to syslog
$config['smtp_debug'] = false;

// Log Redis conversation to <log_dir>/redis.log or to syslog
$config['redis_debug'] = false;


// ----------------------------------
// CACHE(S)
// ----------------------------------

// Use these hosts for accessing Redis.
// Currently only one host is supported. Cluster support may come in a future release.
// You can pass 4 fields, host, port (optional), database (optional) and password (optional).
// Unset fields will be set to the default values host=127.0.0.1, port=6379.
// Examples:
//     array('localhost:6379');
//     array('192.168.1.1:6379:1:secret');
//     array('unix:///var/run/redis/redis-server.sock:1:secret');
$config['redis_hosts'] = array('{{ containers['loopback_network_address'] }}:6379');


// ----------------------------------
// SYSTEM
// ----------------------------------

// Enables possibility to log in using email address from user identities
$config['user_aliases'] = true;

// Location of temporary saved files such as attachments and cache files
// must be writeable for the user who runs PHP process (Apache user if mod_php is being used)
$config['temp_dir'] = '/tmp/';

// Name your service. This is displayed on the login screen and in the window title
$config['product_name'] = '{{ mailu["site_name"] }} Webmail powered by Roundcube';

// Enforce connections over https
// With this option enabled, all non-secure connections will be redirected.
// It can be also a port number, hostname or hostname:port if they are
// different than default HTTP_HOST:443
$config['force_https'] = false;

// Allow browser-autocompletion on login form.
// 0 - disabled, 1 - username and host only, 2 - username, host, password
$config['login_autocomplete'] = 2;

// check client IP in session authorization
$config['ip_check'] = false;

// provide an URL where a user can get support for this Roundcube installation
// PLEASE DO NOT LINK TO THE ROUNDCUBE.NET WEBSITE HERE!
//$config['support_url'] = '';

// number of chars allowed for line when wrapping text.
// text wrapping is done when composing/sending messages
$config['line_length'] = 72;

// Backend to use for session storage. Can either be 'db' (default), 'redis', 'memcache', or 'php'
//
// If set to 'memcache' or 'memcached', a list of servers need to be specified in 'memcache_hosts'
// Make sure the Memcache extension (https://pecl.php.net/package/memcache) version >= 2.0.0
// or the Memcached extension (https://pecl.php.net/package/memcached) version >= 2.0.0 is installed.
//
// If set to 'redis', a server needs to be specified in 'redis_hosts'
// Make sure the Redis extension (https://pecl.php.net/package/redis) version >= 2.0.0 is installed.
//
// Setting this value to 'php' will use the default session save handler configured in PHP
//$config['session_storage'] = 'db';

// Add this user-agent to message headers when sending
$config['useragent'] = 'Roundcube Webmail'; // Hide version number

// Automatically add this domain to user names for login
// Only for IMAP servers that require full e-mail addresses for login
// Specify an array with 'host' => 'domain' values to support multiple hosts
// Supported replacement variables:
// %h - user's IMAP hostname
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %z - IMAP domain (IMAP hostname without the first part)
//$config['username_domain'] = 'mail.example.com';

// Absolute path to a local mime.types mapping table file.
// This is used to derive mime-types from the filename extension or vice versa.
// Such a file is usually part of the apache webserver. If you don't find a file named mime.types on your system,
$config['mime_types'] = '/etc/mime.types';

// Message size limit. Note that SMTP server(s) may use a different value.
// This limit is verified when user attaches files to a composed message.
// Size in bytes (possible unit suffix: K, M, G)
$config['max_message_size'] = '50M';

// ----------------------------------
// PLUGINS
// ----------------------------------

// List of active plugins (in plugins/ directory)
$config['plugins'] = array('managesieve', 'zipdownload','emoticons',
                           'identicon', 'vcard_attachments', 'mailu',
                           'archive', 'markasjunk', 'enigma',
                           'newmail_notifier','subscriptions_option');

// ----------------------------------
// USER INTERFACE
// ----------------------------------

// Default language
$config['language'] = 'pt_BR';

// use this format for date display (date or strftime format)
$config['date_format'] = 'd/m/Y';

// use this format for detailed date/time formatting (derived from date_format and time_format)
$config['date_long'] = 'H:i d/m/Y';

// Disable spellchecking
// Debian: spellshecking needs additional packages to be installed, or calling external APIs
//         see defaults.inc.php for additional informations
$config['enable_spellcheck'] = false;

// automatically create the above listed default folders on user login
$config['create_default_folders'] = true;

// if in your system 0 quota means no limit set this option to true
$config['quota_zero_as_unlimited'] = true;

// Set the spell checking engine. Possible values:
// - 'googie'  - the default (also used for connecting to Nox Spell Server, see 'spellcheck_uri' setting)
// - 'pspell'  - requires the PHP Pspell module and aspell installed
// - 'enchant' - requires the PHP Enchant module
// - 'atd'     - install your own After the Deadline server or check with the people at http://www.afterthedeadline.com before using their API
// Since Google shut down their public spell checking service, the default settings
// connect to http://spell.roundcube.net which is a hosted service provided by Roundcube.
// You can connect to any other googie-compliant service by setting 'spellcheck_uri' accordingly.
$config['spellcheck_engine'] = 'pspell';

// ----------------------------------
// USER PREFERENCES
// ----------------------------------

// skin name: folder from skins/
$config['skin'] = 'elastic';

// Use this charset as fallback for message decoding
$config['default_charset'] = 'UTF-8';

// sort contacts by this col (preferably either one of name, firstname, surname)
$config['addressbook_sort_col'] = 'name';

// save compose message every 300 seconds (5min)
$config['draft_autosave'] = 60;

// Default messages listing mode. One of 'threads' or 'list'.
$config['default_list_mode'] = 'threads';

// 0 - Do not expand threads
// 1 - Expand all threads automatically
// 2 - Expand only threads with unread messages
$config['autoexpand_threads'] = 2;

// If true all folders will be checked for recent messages
$config['check_all_folders'] = true;

// Default font size for composed HTML message.
$config['default_font_size'] = '12pt';

// Enables display of email address with name instead of a name (and address in title)
$config['message_show_email'] = true;

// Interface layout. Default: 'widescreen'.
//  'widescreen' - three columns
//  'desktop'    - two columns, preview on bottom
//  'list'       - two columns, no preview
$config['layout'] = 'widescreen';   // three columns

// Set true if deleted messages should not be displayed
// This will make the application run slower
//$config['skip_deleted'] = true;

// ----------------------------------
//  THUNDERBIRD_LABELS PLUGIN
// ----------------------------------

// whether to globally enable thunderbird labels
$rcmail_config['tb_label_enable'] = true;
// add labels to contextmenu (if contextmenu plugin is present)
$rcmail_config['tb_label_enable_contextmenu'] = true;
// enable kb shortcuts (1-5)
$rcmail_config['tb_label_enable_shortcuts'] = true;
// users can modify labels
$rcmail_config['tb_label_modify_labels'] = true;
// style for UI: 'bullets' or 'thunderbird'
$rcmail_config['tb_label_style'] = "bullets";
// custom hidden flags
$rcmail_config['tb_label_hidden_flags'] = array();

// ----------------------------------
//  MANAGESIEVE PLUGIN
// ----------------------------------

// Managesieve server host (and optional port). Default: localhost.
// Replacement variables supported in host name:
// %h - user's IMAP hostname
// %n - http hostname ($_SERVER['SERVER_NAME'])
// %d - domain (http hostname without the first part)
// For example %n = mail.domain.tld, %d = domain.tld
// If port is omitted it will be determined automatically using getservbyname()
// function, with 4190 as a fallback.
// Note: Add tls:// prefix to enable TLS
$config['managesieve_host'] = 'dovecot';

