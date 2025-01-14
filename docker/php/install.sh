#!/bin/bash

handle_error() {
    echo "❌ Error occurred: $1"
    exit 1
}

WORDPRESS_DIR="/var/www/html/data/wordpress"

mkdir -p "$WORDPRESS_DIR"
cd "$WORDPRESS_DIR" || handle_error "Failed to change directory to $WORDPRESS_DIR"

# Check if WordPress files are already here
if [ ! -f "wp-load.php" ]; then
    echo "Downloading WordPress version $WORDPRESS_VERSION... 🎉"
    wp core download --version="$WORDPRESS_VERSION" --skip-content || handle_error "Failed to download WordPress"
    echo "Download complete. WordPress is now in the house! 🏠"
else
    echo "WordPress is already downloaded. No double-dipping here! 🚫"
fi

# Check if wp-config.php exists
if [ ! -f "wp-config.php" ]; then
    echo "Creating wp-config.php... Hold my coffee ☕"
    wp config create \
        --dbname="$WORDPRESS_DB_NAME" \
        --dbuser="$WORDPRESS_DB_USER" \
        --dbpass="$WORDPRESS_DB_PASSWORD" \
        --dbhost="$WORDPRESS_DB_HOST" \
        --skip-check || handle_error "Failed to create wp-config.php"
    echo "wp-config.php created successfully. It's alive! ⚡"
else
    echo "wp-config.php already exists. Nothing to see here, move along. 🚶‍♂️"
fi

# Check if WordPress is already installed
if ! wp core is-installed; then
    echo "Installing WordPress... This is where the magic happens! ✨"
    wp core install \
        --url="$TEST_SITE_URL" \
        --title="$TEST_SITE_TITLE" \
        --admin_user="$TEST_SITE_ADMIN_USER" \
        --admin_password="$TEST_SITE_ADMIN_PASSWORD" \
        --admin_email="$TEST_SITE_ADMIN_EMAIL" \
        --skip-plugins --skip-themes || handle_error "Failed to install WordPress"
    echo "WordPress installation complete. Let's get this party started! 🎉"
else
    echo "WordPress is already installed. No need to fix what's not broken! 💪"
fi