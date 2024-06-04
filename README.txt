# Création du projet
```
symfony new examsymfony --version=6.4 --webapp
```
# Création de la base de donnée
```
symfony console doctrine:database:create
```
# Installation de Tailwind
```
composer require symfonycasts/tailwind-bundle
```
# Initialisaton de tailwind
```
php bin/console tailwind:init
```
# Lance la compilation et recompilera les CSS lors des changements dans le projet
```
php bin/console tailwind:build --watch
```
# Installation bundle pour les Fixtures
```
composer require --dev orm-fixtures
```
# Installation bundle pour http-client
```
composer require symfony/http-client
```
# IndexController 
symfony console make:Controller IndexController