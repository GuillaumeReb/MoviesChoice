# MoviesChoice

Site qui utilise l'API TMDB

Symfony 7.1.8 version

### Server Symfony :

Pour démarrer ou arrêter le serveur Symfony :

- Démarrage : `symfony server:start`
- Démarrage en arrière-plan : `symfony server:start -d`
- Arrêt :`symfony server:stop`

## Outils utilisés

### Code Sniffer

[PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer/) permet de vérifier le style du code.
Lancement de la commande de vérification :`vendor/bin/phpcs`

### PHPStan

PHPStan est un outil d'analyse statique pour PHP qui détecte les erreurs de type et les bugs potentiels dans le code avant l'exécution, en analysant le code source pour assurer sa qualité et sa robustesse.\
Lancement de la commande de vérification :
`vendor/bin/phpstan analyse src --level 5` \
Pensez à augmenter --level=1 après chaque validation.

### Utile :

- Vidage du cache : `Php bin/console cache:clear --env=dev`
- Configure un serveur de développement local : `npm run dev`

---
