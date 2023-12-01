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

TODO

## Configuration

TODO

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
