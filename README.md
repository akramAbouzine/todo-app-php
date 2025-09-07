# 📝 Application To-Do List (PHP/MySQL)

## 📌 Description
Application web académique permettant de gérer une liste de tâches.  
Les utilisateurs peuvent ajouter, modifier, supprimer et marquer les tâches comme terminées.

## ⚙️ Technologies utilisées
- PHP (PDO)
- MySQL
- HTML5 / CSS3 / JavaScript
- Bootstrap 5
- XAMPP (Apache, PHP, MySQL)

## 🗄️ Base de données
Exécuter ce script SQL dans **phpMyAdmin** :
```sql
CREATE DATABASE todo_app;
USE todo_app;
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  is_done TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
