# SelfHost Playbook

SelfHost is a ansible playbook to install, configure, and integrate a series of services. It is intended for a homelab with flexibility and easy of use in mind.

Here we use rootless docker containers to make the things more easily reproducible, upgradable, fast and secure. The only rootfull container is the nginx-proxy container that requires access to the privileged ports.

All services used in this playbook are FLOSS.

## Services

- [Bind9 DNS server](https://www.isc.org/bind/).

- [Mailu mail server](https://github.com/Mailu/Mailu).

- [Keycloak authentication server](https://www.keycloak.org/).

- [Nextcloud](https://nextcloud.com/) + [High performance files backend](https://github.com/nextcloud/notify_push) + [Collabora office](https://github.com/CollaboraOnline/online).

- [Vaultwarden](https://github.com/dani-garcia/vaultwarden).

- [Homer](https://github.com/bastienwirtz/homer).

- [Fail2ban](https://github.com/fail2ban/fail2ban).

- [Certbot](https://certbot.eff.org/).

## Supported O.S.

- Debian 12 (Tested)
- Ubuntu 22.04/20.04 (Not tested but probably works)

## How to test/develop

This repository contains the molecule files to test the playbook. The easiest way to setup the development environment is using python venv.

The molecule is configured to use vagrant, so lets install it first.

```Console
sudo apt install vagrant vagrant-libvirt libvirt-daemon-system
```

Install Venv and python netaddr.

```Console
sudo apt install python3-venv python3-netaddr
```

Setup and enter the Virtual environment:

```Console
python3 -m venv python3_venv
source python3_venv/bin/activate
```

Install the python packges:

```Console
pip3 install yamllint ansible-lint ansible 'molecule-plugins[vagrant]' netaddr
```

And run the molecule inside the project folder:

```Console
molecule test
```

## How to run

1. First you need add your server IP in the inventory file.

2. Change `user_vars.yaml` configuration for your needs.

   **Don't forget to add the passwords If you need rerun this playbook on an already configured server**

3. Install some packages.

```Console
sudo apt install ansible python3-netaddr
```

4. Install the ansible-galaxy collections

```Console
ansible-galaxy install -r requirements.yml
```

5. And then run the playbook:

```Console
ansible-playbook -u <remote-user> -i inventory main.yml
```
