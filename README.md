# Pimcore Backend Branding Bundle

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

## Usage

This bundle allows you to configure the backend branding per environment.
The current environment is determined through Symfony's [`kernel.runtime_environment`](https://symfony.com/doc/6.4/reference/configuration/kernel.html#kernel-runtime-environment) parameter,
which can be set via the `APP_RUNTIME_ENV` environment variable.
If not set, it falls back to the [`kernel.environment`](https://symfony.com/doc/6.4/reference/configuration/kernel.html#kernel-environment), 
which is set via the `APP_ENV` environment variable.

## Configuration

```yaml
neusta_pimcore_backend_branding:
    environments:
        dev:
            bezelColor: '#fcc243'
        staging:
            bezelColor: '#005ea1'
        prod:
            bezelColor: '#00a13a'
```

## Contribution

Feel free to open issues for any bug, feature request, or other ideas.

Please remember to create an issue before creating large pull requests.

### Local Development

To develop on your local machine, the vendor dependencies are required.

```shell
bin/composer install
```

We use composer scripts for our main quality tools. They can be executed via the `bin/composer` file as well.

```shell
bin/composer cs:fix
bin/composer phpstan
bin/composer tests
```
