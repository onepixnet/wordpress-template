#!/usr/bin/env bash
set -Eeuo pipefail

if ! wp core is-installed; then
    echo "WordPress core is not installed. Installing now..."
    wp core install --url="$TEST_SITE_URL" --title="$TEST_SITE_TITLE" --admin_user="$TEST_SITE_ADMIN_USER" --admin_email="$TEST_SITE_ADMIN_EMAIL"
else
    echo "WordPress core is already installed."
fi

exec "$@"