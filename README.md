# SelfHost Playbook

SelfHost is a ansible playbook to install, configure, and integrate a series of services. It is intended for a homelab with flexibility and easy of use in mind.

Here we use rootless docker containers to make the things more easily reproducible, upgradable, fast and secure. The only rootfull container is the nginx-proxy container that requires access to the privileged ports.

All services used in this playbook are FLOSS.

## Services

- [Bind9 DNS server](https://www.isc.org/bind/).

- [Keycloak authentication server](https://www.keycloak.org/).

- [Mailu mail server](https://github.com/Mailu/Mailu).

- [Nextcloud](https://nextcloud.com/) 
   - [High performance files backend](https://github.com/nextcloud/notify_push) 
   - [Collabora office](https://github.com/CollaboraOnline/online)
   - Keycloak integration

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
sudo apt install python3-venv
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

If you having issues, try these versions (Unfortunately molecule/molecule[vagrant] are not as stable as we would like):

```Console
pip3 install yamllint ansible-lint netaddr molecule==25.1.0 ansible==11.2 'molecule-plugins[vagrant]==23.7.0'
```

And run the molecule inside the project folder:

```Console
molecule test
```

*If your distro doesn't have vagrant take a look at this [handly container](vagrant_container/README.md)

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
