# BACK-FRONT Angular&Symfony

Cela consiste à faire 2 projets bien ditincts

## Coté Angular

Faire toute la logique fonctionnelle coté back
c'est à dire la creation, la lecture, la mise à jour et la suppression

## Coté Symfony

Il va être chargé uniquement de faire la liaison avec la base de données

## En pratique

Une fois qu'on a fait notre logique fonctionnelle en angular.
Ensuite on se crée un projet symfony 

``
symfony new mon-projet
``

Une fois le projet créé on le met dans un dossier commun dans lequel on mettra le projet Angular et symfony côte à côte
comme suit 

![Installation](assets/images/capture1.png)

### On va installer toutes les dépendances dont on a besoin
Cette ligne de commande va permettre de pouvoir faire des "make"

``composer require --dev symfony/maker-bundle``

Cette ligne de commande va permettre d'utiliser doctrine

``composer require symfony/orm-pack``

Cette ligne de commande va permettre d'utiliser des annotations

``composer require doctrine/annotations``

Cette ligne de commande va permettre d'utiliser des formulaires

``composer require symfony/form``

Cette ligne de commande va permettre d'utiliser des validateurs de formulaire

``composer require symfony/validator``

Cette ligne de commande va permettre d'utiliser des serializers pour convertir en json

``composer require symfony/serializer``


### Configuration de la base de données

Dans .env on configure notre database

``DATABASE_URL="mysql://db_username:db_userpassword@127.0.0.1:3306/db_name?serverVersion=mariadb-10.4.13&charset=utf8"``

On crée le ou les entités dont on a besoin
 
``bin/console make:entity``

On crée notre base de données 

``bin/console doctrine:database:create``

On prepare une migration

``bin/console make:migration``

On execute la migration

``bin/console doctrine:migrations:migrate``

On peut ajouter quelques  contraintes lors de la validation

``@Assert\NotBlank``

On crée un controller
 par exemple

``bin/console make:controller Todo``

### => READ  Lecture

![Installation](assets/images/capture2.png)

Cette fonction va nous permettre de récupérer tous nos todos enregistrés dans la base de données en lien avec la methode get de notre service
de notre projet angular

![Installation](assets/images/capture5.png)

### => CREATION  Creation

![Installation](assets/images/capture4.png)

Cette va nous permettre l'enregistrement en base de données en lien avec la fonction post de notre service Angular ainsi que de la fonction save du component responsable de l'enregistrement dans notre projet Angular

=> todo.component.ts
![Installation](assets/images/capture7.png)

=> todoService.ts
![Installation](assets/images/capture6.png)

# REMARQUE IMPORTANTE #

Lors de nos requetes en post, la  **methods={"OPTIONS"}** se fait en 1er afin de vérifier si notre requete a des autorisations ou pas 
Pour palier à cela il faut créer une fonction et mettre methods={"OPTIONS"} dans notre Route. Il faut penser à envoyer une réponse json. Cette fonction n'enverra donc que des entetes

![Installation](assets/images/capture3.png)

### => DELETE Suppression

![Installation](assets/images/capture8.png)

Cette va nous permettre la suppression en base de données en lien avec la fonction delete de notre projet Angular

![Installation](assets/images/capture9.png)


# UTILISATION D'UN ECOUTEUR D'EVENEMENTS

Pour ce faire, on va taper en ligne de commande 

``symfony console make:subscriber``

Ensuite dans le fichier créé, on spécifiera toutes les methodes requises pour nos requetes HTTP

![Installation](assets/images/capture10.png)

=> Une fois les évènements d'écoute mis en place, nous pouvons simplement les retirer de notre controller

Voici à quoi devrait ressembler le controller sans les headers


![Installation](assets/images/capture11.png)

![Installation](assets/images/capture12.png)


