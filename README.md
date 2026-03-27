# Pimcore Backend Branding Bundle

This bundle allows you to configure the branding of thr Pimcore admin backend.

## Installation

1.  **Require the bundle**

    ```shell
    composer require teamneusta/pimcore-backend-branding-bundle
    ```

2. **Enable the bundle**

    Add the Bundle to your `config/bundles.php`:

   ```php
   Neusta\Pimcore\BackendBrandingBundle\NeustaPimcoreBackendBrandingBundle::class => ['all' => true],
   ```

## Configuration

```yaml
neusta_pimcore_backend_branding:
    favicon: <url-of-your-fav-icon>
    signet: # or just: <url-of-your-logo>
        url: <url-of-your-logo>
        size: 70%
        position: center
        color: '#000'
    tab_bar_icon:
        url: <url-of-your-logo>
        size: 40px
    # Configure Pimcore's own branding settings (pimcore_admin.branding)
    login:
        color: '#fff'               # => color_login_screen
        invert_colors: true         # => login_screen_invert_colors
        image: <url-of-your-logo>   # => login_screen_custom_image
    backend:
        color: '#fff'               # => color_admin_interface
        background_color: '#000'    # => color_admin_interface_background

when@dev:
    neusta_pimcore_backend_branding:
        title: ACME Development
        sidebar_color: '#fcc243'

when@test:
    neusta_pimcore_backend_branding:
        title: ACME Testing
        sidebar_color: '#005ea1'

when@prod:
    neusta_pimcore_backend_branding:
        title:
            login: Welcome to ACME!
            backend: '{hostname} :: ACME'
        bezel_color: '#00a13a'
```

## Contribution

Feel free to open issues for any bug, feature request, or other ideas.

Please remember to create an issue before creating large pull requests.

### Local Development

To develop on your local machine, instance identification for Pimcore 12 is needed.

Copy the `compose.override.yaml.dist` file to `compose.override.yaml`:

```shell
cp -n compose.override.yaml.dist compose.override.yaml
```

And replace all `replace_with_secret` values with your data.

Then install the dependencies:

```shell
bin/composer install
```

We use composer scripts for our main quality tools. They can be executed via the `bin/composer` file as well.

```shell
bin/composer cs:fix
bin/composer phpstan
```

For the tests there is a different script that includes a database setup.

```shell
bin/run-tests
```
