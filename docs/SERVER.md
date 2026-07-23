# Guide de Déploiement et Gestion du Serveur – Portfolio gaudev.cadersaasbl.com

Ce document décrit l’intégralité des procédures de déploiement, de configuration et de dépannage du portfolio **gaudev.cadersaasbl.com**, hébergé sur un serveur mutualisé Hostinger. Il est destiné aux développeurs amenés à maintenir le site en production et couvre :

- La connexion SSH et l’accès aux ressources sensibles
- Le déploiement complet depuis un dépôt Git
- La compilation des assets front-end
- La configuration de la base de données et des variables d’environnement
- La gestion des caches Laravel
- Les problèmes rencontrés et leurs solutions détaillées
- La maintenance quotidienne et les bonnes pratiques Linux/SSH

---

## 1. Informations de connexion et ressources sensibles

> **Ces identifiants ne doivent jamais être divulgués publiquement.**  
> Changez régulièrement les mots de passe et tokens.

| Ressource                | Valeur |
|--------------------------|--------|
| **SSH**                  | `ssh -p 65002 u639795089@82.25.113.188` |
| **Mot de passe SSH**     | *(secret)* |
| **Domaine principal**    | `cadersaasbl.com` |
| **Sous-domaine**         | `gaudev.cadersaasbl.com` |
| **Dossier racine du projet** | `~/domains/cadersaasbl.com/public_html/dev` |
| **Dossier public (point d’entrée)** | `~/domains/cadersaasbl.com/public_html/dev/public` |
| **Base de données**      | `u639795089_gaudev_db` |
| **Utilisateur MySQL**    | `u639795089_gaudev_admin` |
| **Mot de passe MySQL**   | `Gaudev@082333` |
| **Hôte MySQL**           | `127.0.0.1` |
| **Chemin Node.js**       | `/opt/alt/alt-nodejs22/root/usr/bin` |
| **Lien hPanel**          | https://hpanel.hostinger.com/ |

---

## 2. Connexion au serveur

Depuis un terminal local (Linux, macOS, Windows avec OpenSSH) :

```bash
ssh -p 65002 u639795089@82.25.113.188
# Saisir le mot de passe SSH
```

Une fois connecté, placez-vous dans le dossier du projet :

```bash
cd ~/domains/cadersaasbl.com/public_html/dev
```

**Explication :**  
- `ssh -p 65002` : le serveur SSH de Hostinger écoute sur le port **65002** (non standard).  
- `u639795089` est le nom d’utilisateur cPanel.  
- `~/` correspond au répertoire personnel de l’utilisateur (`/home/u639795089`).

---

## 3. Structure du projet et configuration DNS/SSL

Le projet est un **Laravel** classique cloné depuis `https://github.com/gauthierlobanga/portofolio.git`.  
Le sous-domaine `gaudev.cadersaasbl.com` pointe directement sur le dossier `dev` de l’hébergement.

### 3.1 Configuration DNS

Le sous-domaine a d’abord été créé avec un **ALIAS CDN** qui bloquait l’accès direct.  
**Problème** : `ERR_SSL_PROTOCOL_ERROR`, le certificat SSL ne pouvait pas être délivré.  

**Solution appliquée :**  
1. Supprimer l’enregistrement ALIAS `gaudev.cadersaasbl.com.cdn.hstgr.net` dans la zone DNS de `cadersaasbl.com`.  
2. Ajouter un enregistrement **A** pointant sur l’IP du serveur :
   - **Type** : `A`
   - **Nom** : `gaudev`
   - **Valeur** : `82.25.113.188`
   - **TTL** : `1800`
3. Attendre la propagation DNS (quelques minutes à quelques heures).

**Outil** : hPanel → Domaines → cadersaasbl.com → DNS / Nameservers.

### 3.2 Certificat SSL

Une fois l’enregistrement A en place, le certificat Let’s Encrypt a été activé automatiquement par Hostinger.  
Si nécessaire, aller dans **hPanel → SSL** et forcer l’installation pour `gaudev.cadersaasbl.com`.

### 3.3 Répertoire racine du sous-domaine

Dans **hPanel → Domaines → cadersaasbl.com → Sous-domaines**, le répertoire racine de `gaudev` est défini sur :
```
/home/u639795089/domains/cadersaasbl.com/public_html/dev
```
Un fichier `.htaccess` à la racine du dossier `dev` redirige toutes les requêtes vers le sous-dossier `public` de Laravel (voir section 4).

---

## 4. Fichier .htaccess pour pointer vers `public`

Le serveur Apache doit servir le contenu du dossier `public`. Comme le sous-domaine pointe sur le dossier parent `dev`, nous avons créé un `.htaccess` de redirection.

**Contenu du fichier `~/domains/cadersaasbl.com/public_html/dev/.htaccess` :**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Explication** : chaque requête entrante (ex: `http://gaudev.../css/app.css`) est réécrite en `public/css/app.css`. Cela évite de devoir pointer le sous-domaine directement sur `public` (ce qui n’est pas toujours possible dans hPanel).

---

## 5. Configuration du fichier `.env` et génération de la clé

À la racine du projet (`~/domains/cadersaasbl.com/public_html/dev`), le fichier `.env` contient les paramètres sensibles.

**Création / modification :**
```bash
cp .env.example .env
nano .env
```

**Paramètres essentiels :**
```
APP_NAME=Gaudev
APP_ENV=production
APP_DEBUG=true   # (à passer à false en production stable)
APP_URL=https://gaudev.cadersaasbl.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u639795089_gaudev_db
DB_USERNAME=u639795089_gaudev_admin
DB_PASSWORD=Gaudev@082333

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

**Génération de la clé d’application :**
```bash
php artisan key:generate
```
Cette commande remplit `APP_KEY` dans `.env`, indispensable pour le chiffrement des sessions.

**Problème rencontré :** Les lignes `DB_*` étaient commentées (`#`), donc Laravel utilisait les valeurs par défaut (`root` sans mot de passe).  
**Solution :** Décommenter toutes les lignes avec `sed` ou manuellement.

---

## 6. Base de données et migrations

### 6.1 Création de la base et de l’utilisateur

Via **hPanel → Bases de données MySQL** :
- Base : `u639795089_gaudev_db`
- Utilisateur : `u639795089_gaudev_admin`
- Mot de passe : `Gaudev@082333`

### 6.2 Exécution des migrations et seeders

```bash
php artisan migrate --seed --force
```

L’option `--force` évite la confirmation en environnement de production.  
Toutes les tables ont été créées, y compris celles de Spatie/laravel-settings, Livewire, Filament, etc.

**Problème rencontré** : la table `cache` était absente malgré la migration `0001_01_01_000001_create_cache_table` marquée comme exécutée.  
**Cause possible** : la table a été supprimée manuellement ou une contrainte a empêché sa création.  
**Solution** : recréation manuelle via le client MySQL.

```bash
mysql -u u639795089_gaudev_admin -p -h 127.0.0.1 u639795089_gaudev_db
```

```sql
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 6.3 Liaison symbolique du stockage

```bash
ln -sfn ../storage/app/public public/storage
```

**Pourquoi ?** La commande `php artisan storage:link` utilise `exec()`, fonction désactivée sur l’hébergement. Le lien symbolique manuel résout le problème.  
**Vérification :** `ls -la public/storage` doit afficher `public/storage -> ../storage/app/public`.

---

## 7. Compilation des assets (Vite)

Le projet utilise **Vite** pour compiler les assets (CSS, JS). Sur le serveur mutualisé, la compilation échouait systématiquement avec une erreur de thread pool :

> `The global thread pool has not been initialized.: ThreadPoolBuildError ... Resource temporarily unavailable`

**Cause :** limitations de l’hébergement partagé qui empêchent l’utilisation de threads multiples par Rolldown (Vite).

**Solution appliquée :** compiler en local puis transférer le dossier `public/build` via SCP.

### 7.1 Build local (sur votre PC)

```bash
npm install
npm run build
```

### 7.2 Transfert vers le serveur

```bash
scp -P 65002 -r public/build u639795089@82.25.113.188:~/domains/cadersaasbl.com/public_html/dev/public/
```

**Alternative :** si vous disposez d’un environnement CI/CD, le build peut y être effectué puis publié de la même manière.

**Permissions finales sur le serveur :**
```bash
chmod -R 755 public/build
```

---

## 8. Erreurs rencontrées et solutions

### 8.1 Erreur 500 – `Route [#] not defined`

**Symptôme :** page blanche ou erreur 500 avec dans les logs `Route [#] not defined`.  
**Cause :** un paramètre de configuration Spatie (`about.impact_highlight_cta_url`) contient la valeur `#`. Un composant Livewire appelle `route('#')`, ce qui provoque une exception car aucune route nommée `#` n’existe.

**Diagnostic :**
```bash
tail -n 50 storage/logs/laravel.log | grep -A 2 "production.ERROR"
```

**Solution appliquée :**  
1. Ajouter temporairement une route nommée `#` dans `routes/web.php` pour absorber l’erreur :
   ```php
   Route::get('/#', fn() => redirect('/'))->name('#');
   ```
2. Modifier la valeur en base de données pour pointer vers une route existante (`contact` par exemple).

**Mise à jour du paramètre Spatie :**
```bash
php artisan tinker --execute="setting(['about.impact_highlight_cta_url' => 'contact']);"
```
Ou via SQL direct (si contrainte JSON) :
```bash
php artisan tinker --execute="DB::table('settings')->where('group','about')->where('name','impact_highlight_cta_url')->update(['payload' => json_encode('contact')]);"
```
3. Supprimer la route `#` du fichier `web.php` après vérification.

**Pour éviter la réapparition** : modifier le seeder source (`database/seeders/AboutSettingsSeeder.php`) pour y mettre `'contact'` à la place de `'#'`.

### 8.2 `Call to undefined function Illuminate\Filesystem\exec()`

**Lors de** `php artisan storage:link`.  
**Cause :** la fonction PHP `exec()` est désactivée pour des raisons de sécurité sur l’hébergement.  
**Solution :** créer le lien symbolique manuellement :
```bash
ln -sfn ../storage/app/public public/storage
```

### 8.3 Contrainte SQL `settings.payload` lors d’un UPDATE avec chaîne vide

**Message :** `CONSTRAINT settings.payload failed ... update 'settings' set 'payload' = ...`  
**Cause :** une contrainte CHECK empêche de mettre un champ vide dans la colonne `payload`.  
**Solution :** utiliser `json_encode('contact')` pour insérer une valeur non vide au format JSON, respectant ainsi la contrainte.

### 8.4 Fichiers d’images manquants (logo, favicon, images du portfolio)

**Symptômes :** erreurs 404 dans la console navigateur.  
**Cause :** les fichiers n’avaient pas été transférés depuis le dépôt local.  
**Solution :** transférer le dossier `storage/app/public/images` via `scp` :
```bash
scp -P 65002 -r storage/app/public/images u639795089@82.25.113.188:~/domains/cadersaasbl.com/public_html/dev/storage/app/public/
```
Et copier les fichiers statiques (logo, favicon) directement dans `public/images/` si nécessaire.

### 8.5 Erreur DNS / CDN (ERR_SSL_PROTOCOL_ERROR)

**Cause :** l’ALIAS CDN pointait sur un proxy qui ne délivrait pas de certificat pour le sous-domaine.  
**Solution :** remplacer l’ALIAS par un enregistrement A vers l’IP du serveur (voir section 3).

---

## 9. Gestion des caches Laravel

Après chaque modification (code, configuration, migrations), il est impératif de vider les caches :

```bash
php artisan optimize:clear
```

Cette commande unique regroupe :
- `config:clear` : vide le cache de configuration
- `cache:clear` : vide le cache applicatif
- `view:clear` : supprime les vues compilées
- `route:clear` : vide le cache des routes
- `event:clear` : vide le cache des événements
- `filament:clear` (si Filament est installé)
- etc.

**Reconstruction des caches (optionnelle mais recommandée) :**
```bash
php artisan optimize
```
Cela crée un cache de configuration et de routes pour améliorer les performances.

**Attention :** si vous utilisez `config:cache`, toute modification du `.env` nécessitera un `config:clear` puis un nouveau `config:cache`.

---

## 10. Commandes utiles pour la maintenance via SSH

### 10.1 Navigation et fichiers
- `ls -la` : liste détaillée des fichiers.
- `cd ~/domains/...` : se déplacer dans les répertoires.
- `tail -n 100 storage/logs/laravel.log` : voir les 100 dernières lignes des logs.
- `grep "production.ERROR" storage/logs/laravel.log` : filtrer les erreurs.
- `nano .env` : éditer un fichier.

### 10.2 Base de données
- `php artisan tinker` : shell interactif pour exécuter du code Laravel.
- `mysql -u user -p -h 127.0.0.1 dbname` : se connecter à MySQL.
- `SHOW TABLES;` : lister les tables.
- `DESCRIBE nom_table;` : structure d’une table.
- `SELECT * FROM settings WHERE ...` : interroger la table settings.

### 10.3 Git
- `git status` : voir les modifications locales.
- `git stash` / `git stash pop` : mettre de côté / restaurer des changements.
- `git pull origin main` : récupérer les derniers commits.
- `git log --oneline -5` : derniers commits.

### 10.4 Permissions
- `chmod -R 755 public/build` : droits de lecture/exécution pour le serveur web.
- `chmod -R 775 storage bootstrap/cache` : droits d’écriture pour l’application.

### 10.5 Processus et ressources
- `top` ou `htop` : surveillance de la charge CPU/mémoire.
- `df -h` : espace disque disponible.
- `free -m` : mémoire vive.

---

## 11. Bonnes pratiques de déploiement

1. **Toujours pousser le code sur GitHub** et ne jamais modifier directement les fichiers sur le serveur.
2. **Avant un déploiement :**  
   - En local : `git add`, `commit`, `push`.
   - Sur le serveur : `git stash` (sécurité), `git pull`, puis les commandes de build/cache.
3. **Après un déploiement** : vider les caches (`optimize:clear`), vérifier les logs, tester les pages critiques.
4. **Sauvegardes** : exporter régulièrement la base de données et les fichiers uploadés (dossier `storage/app/public`).  
   Exemple de backup DB :
   ```bash
   mysqldump -u u639795089_gaudev_admin -p -h 127.0.0.1 u639795089_gaudev_db > ~/backups/db_$(date +%Y%m%d_%H%M).sql
   ```
5. **Variables d’environnement** : ne versionnez jamais le fichier `.env`. Gardez un `.env.example` à jour.
6. **Mode production** : une fois stable, mettez `APP_DEBUG=false` et `APP_ENV=production` dans le `.env`. Lancez `php artisan optimize` pour le cache des routes et de config.

---

## 12. Résumé des commandes pour un déploiement complet

```bash
# 1. Connexion
ssh -p 65002 u639795089@82.25.113.188
cd ~/domains/cadersaasbl.com/public_html/dev

# 2. Récupérer le code
git stash push -m "sauvegarde"
git pull origin main

# 3. Installer les dépendances PHP (si composer.lock a changé)
composer install --no-dev --optimize-autoloader

# 4. Build des assets (à faire en local puis transférer, car le build serveur échoue)
# En local :
npm run build
scp -P 65002 -r public/build u639795089@82.25.113.188:~/domains/cadersaasbl.com/public_html/dev/public/

# 5. Mise à jour de la base de données
php artisan migrate --force

# 6. Permissions
chmod -R 775 storage bootstrap/cache
chmod -R 755 public/build

# 7. Vider les caches
php artisan optimize:clear
php artisan optimize   # optionnel

# 8. Vérifier les logs
tail -n 50 storage/logs/laravel.log
```

---

## 13. Maintenance continue

- **Surveiller les logs** régulièrement : `tail -f storage/logs/laravel.log`.
- **Espace disque** : supprimer les anciens logs (`storage/logs/laravel-*.log`) si l’espace devient critique.
- **Mettre à jour les dépendances** uniquement après test en local ; ne jamais lancer `composer update` en production.
- **Renouveler le certificat SSL** : normalement automatique, vérifier avec `https://gaudev.cadersaasbl.com` de temps en temps.
- **Sauvegardes hebdomadaires** de la base et des fichiers utilisateurs.

---

Ce document constitue la référence pour la gestion du portfolio **gaudev.cadersaasbl.com**. En cas de problème non couvert, se référer aux logs Laravel et aux outils d’administration Hostinger.
