# surveyplugin Version 1.0.0 
This is a MVP, the plugin works and meets the minimal requirements to be integrated into the moodle project

# User manual - Plugin installation
# Preparation
Call the following commands in case the previous installation of surveyplugin went wrong
and to make sure there will be no conflicts while installation process. Additionally we have to
delete the old plugin folder, if it exists under mod/ directory.
```
php admin/cli/uninstall_plugins.php --plugins=surveyplugin --run
php admin/cli/upgrade.php
```

This extra step is for a developer: Create a zip file from a plugin folder, e.g.

`zip -r surveyplugin.zip surveyplugin/`

# Plugin installation
1. Open Moodle website and go to Site administration –> Plugins –> Install Plugins –>
Install plugin from ZIP file
2. Upload the zip file and click Install plugin
3. You should see the page with this information:
```
Install plugin from ZIP file
Validating mod_surveyplugin ... OK
Validation successful, installation can continue
```
Click Continue
4. You should land to the page with the following information
Current release information
Moodle [3.11.4 or current release] (Build: [timestamp])
5. Scroll and click Continue
On Plugins check page click "Upgrade Moodle database now". You should see:
```
Upgrading to new version
mod_surveyplugin
Success
```
Click Continue
7. In case of successful installation you will land on the main page (Moodle dashboard)
8. Check if the plugin is available now. Go to any course page or create a new course to be
able to add a plugin as an activity or resource
• Turn on editing mode
• And click Add an activity or resource
• Your plugin should be in the list

# Technical manual - IDE installation for Moodle
1. Apache HTTP Server
A command line interface was used to install the apache2 webserver:
`$ sudo /etc/init.d/apache2 restart`
or
`$ sudo service apache2 restart`
2. PHP5
For installing PHP5 we used the package libapache2-mod-php5 and enabled it by running
the following command
`$ sudo a2enmod php5`
which creates a symbolic link pointing to
`/etc/apache2/mods-enabled/php5`
3. MySQL
MySQL is one of the popular open source databases. It is mostly used for web-based
applications [Abo(2022)]. For this work we installed MySQL Community Server version
8.0.27 on a local system.
4. Moodle GIT repository
One of the last steps was to clone and install Moodle repository by running the following
command. To choose the most suitable and stable Moodle version was crucial for set up
and further work.
`git clone -b MOODLE_36_STABLE git://git.moodle.org/moodle.git`
41After cloning the repository one should call and install the script below to complete the
process.
`/usr/bin/php /var/www/moodle/admin/cli/install.php`
