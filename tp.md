# TP PHP

# ETAPE 1

1. Faire un menu de navigation avec les liens vers les pages suivantes :

   - Inscription
   - Connexion
   - Profil
   - Déconnexion

2. Faire une page d'inscription contenant un formulaire avec les champs suivants :

   - Civilité (bouton radio) : M. ou Mme
   - Nom
   - Prénom
   - Email
   - Mot de passe
   - Confirmation du mot de passe
   - Date de naissance
   - Adresse
   - Code postal
   - Ville
   - Pays
   - Image de profil (format jpg, jpeg, png, taille max 2Mo)
   - prsentez-vous en quelques mots
   - Bouton d'envoi du formulaire

3. Faire une page de connexion contenant un formulaire avec les champs suivants :

   - Email
   - Mot de passe
   - Bouton d'envoi du formulaire

4. Faire une page de profil contenant les informations de l'utilisateur connecté.

5. Faire une page de déconnexion.

# ETAPE 2

1. Créer une base de données nommée "tp_php" contenant la table "users" avec les champs suivants :
   - id_user int(11) AUTO_INCREMENT PRIMARY KEY
   - civility ENUM(M. ou Mme)
   - lastname varchar(80)
   - firstname varchar(100)
   - email varchar(150) UNIQUE
   - password varchar(255)
   - birthdate date
   - address varchar(255)
   - postalCode varchar(10)
   - city varchar(100)
   - country varchar(100)
   - description text
   - created_at datetime DEFAULT CURRENT_TIMESTAMP
   - role INT (1) DEFAULT 0
   - profil_picture varchar(255)

# ETAPE 3

1. Faire le traitement du formulaire d'inscription qui permet d'insérer les données dans la table "users" de la base de données "tp_php". Vous devez vérifier que les données saisies sont correctes et informer l'utilisateur en cas d'erreur avec un message d'erreur clair et précis.

- Vérifier que les champs ne sont pas vides
- Vérifier que l'email n'est pas déjà utilisé
- Vérifier que le mot de passe et la confirmation du mot de passe sont identiques
- Vérifier que la date de naissance est inférieure à la date du jour (date('Y-m-d'))
- Vérifier que le code postal est composé de 5 chiffres
- Vérifier le format de l'email
- Vérifier la longueur des champs nom, prénom (entre 2 et 100 caractères)
- Vérifier la longueur du champ description (minimum 10 caractères)
- Vérifier que la photo de profil est bien une image et qu'elle fait moins de 2Mo au format jpg, jpeg, png. Le nom de la photo doit être unique et commencer par "profil*picture*". Si la photo est valide, vous devez la déplacer dans le dossier "profil" et stocker le nom de la photo dans la base de données.
- hashé le mot de passe avec la fonction password_hash() et stocker le hash dans la base de données

# ETAPE 4

1. Faire le traitement du formulaire de connexion

- Vérifier que les champs ne sont pas vides
- Vérifier que l'email existe dans la base de données
- Vérifier que le mot de passe est correct
- Si les identifiants sont corrects, vous devez créer une session avec les informations de l'utilisateur connecté et le rediriger vers la page de profil.

# ETAPE 5

1. Faire le traitement de la page de profil

- Vérifier que l'utilisateur est connecté
- Si l'utilisateur est connecté, vous devez afficher les informations de l'utilisateur connecté dans la page de profil.Si l'utilisateur n'est pas connecté, vous devez le rediriger vers la page de connexion.

# ETAPE 6

1. Faire le traitement de la page de déconnexion

- Vérifier que l'utilisateur est connecté
- Si l'utilisateur est connecté, vous devez détruire la session et le rediriger vers la page de connexion.
- Si l'utilisateur n'est pas connecté, vous devez le rediriger vers la page de connexion.

# ETAPE 7

1. Créer un utilisateur avec le role administrateur (role = 1) dans la table "users" de la base de données "tp_php".

2. Faire une page d'administration qui permet de lister les utilisateurs inscrits sur le site. Cette page est accessible uniquement aux administrateurs (role = 1). Si l'utilisateur n'est pas connecté ou n'est pas administrateur, vous devez le rediriger vers la page de connexion.

3. L'administrateur doit pouvoir supprimer un utilisateur de la liste.

# TO DO

Si l'user est connecté, dans le menu il doit voir profil et deconnexion.
Si l'user n'est pas connecté, il doit voir inscription et connexion.

Mettre en forme la page de profil

Interdire l'accès à la page décconnexion
