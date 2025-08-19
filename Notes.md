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

Voici un résumé clair de ce que tu dois faire pour mettre ton projet Symfony en ligne proprement :

✅ 1. Préparer ton projet en local
Tu dois d’abord compiler les assets et nettoyer les fichiers inutiles :

php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod

# Compile les assets en mode production

yarn encore production
Cela va créer un dossier public/build optimisé, prêt à être mis en ligne.

✅ 2. Ce que tu dois envoyer sur ton serveur
Tu dois transférer seulement les dossiers utiles au fonctionnement du site, par exemple :

- public/ ✅ (les fichiers accessibles sur le web)
- var/ ✅ (vide ou avec permissions correctes)
- vendor/ ✅ (généré par Composer, ou tu l’installes sur le serveur)
- config/ ✅
- src/ ✅
- templates/ ✅
- translations/ ✅ si tu en as
- .env.production ✅ ou .env adapté à ton hébergeur
- composer.json ✅
- composer.lock ✅
  💡 Le dossier node_modules/ et les sources assets/ ou tests/ ne sont pas nécessaires en production.

✅ 3. Sur le serveur
Tu dois :

Avoir PHP 8.1+ installé (avec les extensions nécessaires)

Te placer à la racine de ton projet et faire :

composer install --no-dev --optimize-autoloader
Cela va installer vendor/ si tu ne l’as pas transféré.

Créer un fichier .env.local ou .env.production avec ta config BDD (base de données) + clés API (comme TMDB)

✅ 4. Point d’entrée web = public/
Tu dois configurer ton hébergement pour que le dossier public/ soit le seul exposé au web.
C’est très important : sinon les fichiers sensibles (.env, src/, etc.) seront exposés !

Sur un VPS : tu configures Apache ou Nginx pour ça.

Sur un hébergement mutualisé : tu dois pouvoir définir le dossier racine (public_html, ou www) vers /public.

✅ 5. Uploader avec FileZilla ?

Transfère le bon dossier (voir ci-dessus)

Attention : évite de transférer vendor/, sauf si tu n’as pas Composer sur ton serveur (pas recommandé)

Regarde les permissions sur var/, public/, etc.

En résumé :
🟢 Ne transfère que ce qui est utile
🟢 Compile tes assets avant
🟢 Configure ton hébergement pour pointer sur public/
🟢 Installe les dépendances PHP avec Composer sur le serveur

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
