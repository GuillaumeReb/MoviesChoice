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
