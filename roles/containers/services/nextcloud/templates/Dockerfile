FROM nextcloud:{{ nextcloud['container_version'] }}

# Install image magick
RUN apt update && apt install libmagickcore-6.q16-6-extra -y
# Install inotify, bzip2, and exif.
RUN pecl install inotify bzip2 exif && docker-php-ext-enable inotify exif
