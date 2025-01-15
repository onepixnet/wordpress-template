#!/bin/bash

handle_error() {
    echo "❌ Error occurred: $1"
    exit 1
}

download() {
    if [ `which curl` ]; then
        curl -s "$1" > "$2";
    elif [ `which wget` ]; then
        wget -nv -O "$2" "$1"
    fi
}

WORDPRESS_DIR="/var/www/html/data/wordpress"
WORDPRESS_TEST_DIR="/var/www/html/data/wordpress-tests-lib"

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
    sleep 5s #The db does not have enough time to start
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

# Determine the WordPress tests tag
if [[ $WORDPRESS_VERSION =~ ^[0-9]+\.[0-9]+\-(beta|RC)[0-9]+$ ]]; then
    WP_BRANCH=${WORDPRESS_VERSION%\-*}
    WP_TESTS_TAG="branches/$WP_BRANCH"
elif [[ $WORDPRESS_VERSION =~ ^[0-9]+\.[0-9]+$ ]]; then
    WP_TESTS_TAG="branches/$WORDPRESS_VERSION"
elif [[ $WORDPRESS_VERSION =~ [0-9]+\.[0-9]+\.[0-9]+ ]]; then
    if [[ $WORDPRESS_VERSION =~ [0-9]+\.[0-9]+\.[0] ]]; then
        WP_TESTS_TAG="tags/${WORDPRESS_VERSION%??}"
    else
        WP_TESTS_TAG="tags/$WORDPRESS_VERSION"
    fi
elif [[ $WORDPRESS_VERSION == 'nightly' || $WORDPRESS_VERSION == 'trunk' ]]; then
    WP_TESTS_TAG="trunk"
else
    echo "Fetching the latest WordPress version... 🔍"
    download http://api.wordpress.org/core/version-check/1.7/ /tmp/wp-latest.json || handle_error "Failed to fetch latest version info"
    LATEST_VERSION=$(grep -o '"version":"[^"]*' /tmp/wp-latest.json | sed 's/"version":"//')
    [ -z "$LATEST_VERSION" ] && handle_error "Latest WordPress version could not be determined"
    WP_TESTS_TAG="tags/$LATEST_VERSION"
    echo "Latest WordPress version is $LATEST_VERSION. 🚀"
fi

# Set up testing suite
if [ ! -d $WORDPRESS_TEST_DIR ]; then
    echo "Setting up the testing suite... Preparing for takeoff! 🚀"
    mkdir -p $WORDPRESS_TEST_DIR
    rm -rf $WORDPRESS_TEST_DIR/{includes,data}
    svn export --quiet --ignore-externals https://develop.svn.wordpress.org/${WP_TESTS_TAG}/tests/phpunit/includes/ $WORDPRESS_TEST_DIR/includes || handle_error "Failed to export test includes"
    svn export --quiet --ignore-externals https://develop.svn.wordpress.org/${WP_TESTS_TAG}/tests/phpunit/data/ $WORDPRESS_TEST_DIR/data || handle_error "Failed to export test data"
    echo "Testing suite setup complete. Ready to rumble! 🥊"
else
    echo "Testing suite already exists. Ain't nobody got time for duplicates! 🤷"
fi

# Configure wp-tests-config.php
if [ ! -f "$WORDPRESS_TEST_DIR/wp-tests-config.php" ]; then
    echo "Downloading wp-tests-config-sample.php... Almost there! 🛠️"
    download https://develop.svn.wordpress.org/${WP_TESTS_TAG}/wp-tests-config-sample.php "$WORDPRESS_TEST_DIR/wp-tests-config.php" || handle_error "Failed to download wp-tests-config-sample.php"
    WORDPRESS_DIR=$(echo $WORDPRESS_DIR | sed "s:/\+$::")
    sed -i "s#dirname( __FILE__ ) . '/src/'#'$WORDPRESS_DIR/'#" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    sed -i "s#__DIR__ . '/src/'#'$WORDPRESS_DIR/'#" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    sed -i "s/youremptytestdbnamehere/$WORDPRESS_DB_NAME/" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    sed -i "s/yourusernamehere/$WORDPRESS_DB_USER/" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    sed -i "s/yourpasswordhere/$WORDPRESS_DB_PASSWORD/" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    sed -i "s|localhost|${WORDPRESS_DB_HOST}|" "$WORDPRESS_TEST_DIR/wp-tests-config.php"
    echo "wp-tests-config.php is ready to roll! 🎯"
else
    echo "wp-tests-config.php already exists. Nothing to change here, folks. ✋"
fi
