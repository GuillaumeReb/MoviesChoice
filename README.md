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

# Déploiement en sous-dossier

## Configuration requise

### 1. Webpack Encore

```js
// webpack.config.js
Encore.setPublicPath("/sous-dossier/public/build").setManifestKeyPrefix(
  "build/"
);
```

### 2. .htaccess

```apache
# public/.htaccess
RewriteEngine On
RewriteBase /sous-dossier/public/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
```

### 3. Templates

```twig
<!-- Utiliser les routes Symfony -->
<a href="{{ path('app_home') }}">Accueil</a>
```

## Déploiement

```bash
npm run build
# Upload via FTP
# Accès : votresite.com/sous-dossier/public/
```

## Troubleshooting

- **Pas de styles** → Vérifier `setPublicPath` et recompiler
- **404 sur les routes** → Vérifier `RewriteBase` dans .htaccess
- **Logo vers mauvaise page** → Utiliser `path()` au lieu de `/`
