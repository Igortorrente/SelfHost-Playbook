## Vagrant container

There's a small container with `molecule[vagrant]` that uses the system libvirt to run molecule.

First install libvirt and podman (or docker if you wish)

```
sudo dnf install libvirt podman
```

(Optional) Add your user to libvirt group

```
sudo usermod -a -G libvirt $(whoami)
```

Build the image

```
podman build --file $(pwd)/dockerfile --tag vagrant:0.1
```

Run the little script (probably you will want to modify it)

```
./vagrant_container/molecule.sh localhost/vagrant:0.1 molecule test 
```