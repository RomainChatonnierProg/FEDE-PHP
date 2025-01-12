# **ContactApp** 📇
[![Version PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net)  
[![Version Symfony](https://img.shields.io/badge/Symfony-7.1.8-black?logo=symfony)](https://symfony.com)  
[![Licence: MIT](https://img.shields.io/badge/Licence-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

<p align="center">
  <img src="https://symfony.com/logos/symfony_black_02.png" height="100" alt="Symfony Logo">
</p>

---

## 🌟 **À propos du projet**

**ContactApp** est une application web conçue pour gérer efficacement les contacts, les groupes et leurs informations personnalisées. L'application offre une interface intuitive, alimentée par Symfony, pour une gestion fluide des données.

### **Fonctionnalités principales :**
- **Gestion de contacts** : Ajouter, modifier et supprimer des contacts avec des champs personnalisables.
- **Organisation par groupes** : Créer et gérer des groupes pour organiser les contacts.
- **Champs dynamiques** : Ajout de champs personnalisés pour chaque contact.
- **Recherche avancée** : Filtrage dynamique des contacts selon divers critères.

---

## 🛠️ **Prérequis**
Avant de commencer, assurez-vous d’avoir les outils suivants installés :
- 🐘 **PHP** : Version 8.2 ou supérieure.
- 📦 **Composer** : Pour gérer les dépendances PHP.
- ⚒️ **Symfony CLI** : Pour exécuter et gérer le projet Symfony.
- 🗄️ **SQLite** : Système de base de données utilisé dans le projet.

---

## 🚀 **Installation**

### 1️⃣ **Cloner le dépôt**
```bash
git clone https://github.com/RomainChatonnierProg/FEDE-PHP.git
cd ContactSymfonyApp
```

### 2️⃣ **Installer les dépendances**
```bash
composer install
```

### 3️⃣ **Configurer l'environnement**
Copiez le fichier `.env` et personnalisez-le :
```bash
cp .env .env.local
```
Configurez la base de données dans `.env.local` :
```env
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

### 4️⃣ **Initialiser la base de données**
Créez la base de données et appliquez les migrations :
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5️⃣ **Lancer le serveur Symfony**
```bash
symfony server:start
```
Ouvrez l’application sur [http://localhost:8000](http://localhost:8000).

---

## 🛠️ **Commandes utiles**

### **Démarrer le serveur de développement**
```bash
symfony server:start
```



## 🎨 **Fonctionnalités clés implémentées**

1. **Gestion de contacts :**
    - Champs obligatoires : prénom, nom, numéro, email.
    - Possibilité d’ajouter une photo.

2. **Groupes :**
    - Associer des contacts à des groupes.
    - Gestion dynamique dans les formulaires (ajout/suppression).

3. **Champs personnalisés :**
    - Ajouter dynamiquement des champs pour enrichir les informations des contacts.

4. **Recherche avancée :**
    - Rechercher des contacts par nom, numéro, email, groupes ou champs personnalisés.

5. **Design moderne :**
    - Utilisation de **Tailwind CSS** pour une interface élégante et réactive.

---

## 🗂️ **Structure du projet**

Le projet suit la structure standard de Symfony :

- **📁 `src/`** : Contient les fichiers principaux comme les entités, contrôleurs et services.
- **📁 `templates/`** : Contient les templates Twig pour les vues.
- **📁 `public/`** : Contient les fichiers accessibles publiquement (CSS, JS, images).
- **📁 `var/`** : Fichiers de cache et base de données SQLite.

---

## 🌐 **Fonctionnalités futures**

- 📤 **Exportation de contacts** : Exporter les données des contacts au format CSV.
- 🔄 **Synchronisation avec des APIs tierces** : Intégration avec Google Contacts.

---

## 👥 **Contribuer**

Les contributions sont les bienvenues ! Pour contribuer :

1. Créez une branche pour vos fonctionnalités (`git checkout -b feature/ma-fonctionnalite`).
2. Effectuez vos modifications et validez-les (`git commit -m 'Ajout d'une fonctionnalité'`).
3. Poussez vos modifications (`git push origin feature/ma-fonctionnalite`).
4. Soumettez une pull request.

---

## 📬 **Contact**

Développeur : [RomainChatonnierProg](https://github.com/votre-utilisateur)  
Projet hébergé sur : https://github.com/RomainChatonnierProg/FEDE-PHP.git

---

⭐ **N'oubliez pas de mettre une étoile si ce projet vous est utile !** 😊
