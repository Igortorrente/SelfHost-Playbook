FROM nextcloud:{{ nextcloud['container_version'] }}

# Install image magick
RUN apt update && apt install libmagickcore-7.q16-10-extra -y
# Install inotify, bzip2, and exif.
RUN pecl install inotify bzip2 exif && docker-php-ext-enable inotify exif
