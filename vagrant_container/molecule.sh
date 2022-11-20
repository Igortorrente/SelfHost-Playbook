#!/bin/bash
set -x

mkdir -p $HOME/.cache/molecule/ $HOME/.config/vagrant $HOME/.config/ansible

podman run -it --rm --privileged --net=host -e TERM=xterm-256color \
       -v /run/libvirt:/run/libvirt:z -v /var/lib/libvirt:/var/lib/libvirt:z \
       -v $HOME/.cache/molecule/:/root/.cache/molecule/:rw \
       -v $HOME/.config/vagrant:/root/.vagrant.d:rw \
       -v $HOME/.config/ansible:/root/.ansible:rw \
       -v $(git rev-parse --show-toplevel):/repo:ro \
       $@
