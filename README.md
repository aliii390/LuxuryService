# Saint-Etienne-P4-Luxury-Services


Instructions pour récupérer le projet :

* **Cloner** le projet :

    ```git
    git clone https://github.com/JeremyAMichel/Saint-Etienne-P4-Luxury-Services.git
    ```

* Ouvrir le **dossier du projet** avec VS Code

* Installer les **dépendances** : 

    ```bash
    composer install
    ```

* Dupliquer le fichier `.env` et le renommer `.env.local`

* Mettre vos informations de **connexion** à la base de donnée

* Créer la BDD :
    
    ```bash
    php bin\console d:d:c
    ```

* Si il y en a, executez les **migrations** :

    ```bash
    php bin\console d:m:m
    ```

* Mettre vos variables d'environnement **Mailtrap**

* Faire tourner Messenger pour les tâches asynchrone comme l'envoie de mail :

    ```bash
    php bin/console messenger:consume async -vv
    ```


# LuxuryService
