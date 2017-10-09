# CFR Web Developer Test Site
This is a site built to provide the functionality detailed in the CFR web developer test document.

Both Docksal and a docker-compose based installation system have been provided. Feel free to use whichever you are more familiar with. Docker-Compose system has been tested against the most recent Ubuntu Linux LTS (16.04).

## Docksal Setup instructions

### Step #1: Docksal environment setup

**This is a one time setup - skip this if you already have a working Docksal environment.**

Follow [Docksal environment setup instructions](http://docksal.readthedocs.io/en/master/getting-started/env-setup)

### Step #2: Project setup

1. Initialize the site

    This will initialize local settings and install the site via drush, along with installing the CFR module automatically.

    ```
    fin init
    ```

2. **On Windows** add `192.168.64.100  drupal8.docksal` to your hosts file

3. Point your browser to

    ```
    http://cfr.docksal
    ```
4. Using the links in the main menu, access /cfr/demo or /cfr/alternate to view the functionality.

When the automated install is complete the command line output will display the admin username and password.

## Docker Compose Setup

1. Change directory to the `/docroot` folder.
2. Ensure that the /sites/default/files directory exists and that the settings.php file is writable.
3. Run ```docker-compose up -d```
4. If necessary, add drupal.docker.localhost to your hosts file.
5. Access http://drupal.docker.localhost:8000/
6. Follow the setup instructions for the Standard installation profile.
    1. When you reach the credentials page, the credentials are as follows:
        1. Database: drupal
        2. user: drupal
        3. password: drupal
        4. DB Host name: mariadb
7. Once site has been installed, via /admin/modules, enable the CFR module.
8. Access /cfr/demo or /cfr/alternate to view the functionality.

