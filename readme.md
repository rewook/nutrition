Application Symfony pour le site Internet d'une médecin nutritionniste
Cette application Symfony 5.4 LTS est destinée à être utilisée pour créer un site Internet pour une médecin nutritionniste. Elle utilise la bibliothèque PHP Faker pour générer des données de test.

# Installation
### Clonez le dépôt Git :

git clone https://github.com/rewook/nutrition.git

### Installez les dépendances en utilisant Composer :

tapez dans votre termnal : cd nutrition puis composer install

### copier le fichier .env et créer un fichier .env.local :
renseigner les paramètres de connexion à la base de données
mysql://user:password@localhost:3306/nutrition
adapter le nom d'utilisateur et le mot de passe à votre configuration

### Créez la base de données :
php bin/console doctrine:database:create

### Exécutez les migrations pour créer les tables de la base de données :
php bin/console doctrine:migrations:migrate

### Générer des données de test :
php bin/console doctrine:fixtures:load

### Lancer le serveur de développement :
php bin/console server:run

### Accéder à l'application :
http://localhost:8000

# Utilisation
### Compte admin créé par défaut :
email : sandrine@coupart.fr
mot de passe : Pa$$w0rd

### 10 comptes utilisateurs créés par défaut:
email : à récupérer dans la base de données
mot de passe : Pa$$w0rd

