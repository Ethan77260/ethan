<?php
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit;
}

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $date_limite = $_POST['date_limite'];
            $statut = $_POST['statut'] ?? null;
            $date_limite = date('Y-m-d', strtotime($date_limite));
            if ($date_limite === false) {
                echo "Date invalide.";
                exit;
            }
            $utilisateur_id = $_SESSION['utilisateur_id'];
            
            try {
            $stmt = $pdo->prepare ("INSERT INTO taches (titre, description, date_limite, statut, utilisateur_id) 
            VALUES (?, ?, ?, ?, ?)");
            $stmt -> execute([$titre, $description, $date_limite, $statut, $utilisateur_id]);
             } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
?>

<!DOCTYPE html>
 <html lang="fr">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="connexion.css">
   <title>Formulaire d'ajout</title>
 </head>
 <body>
  <style>
      body {
        background-color: beige;
      }
  </style>
 <div class="contactez-nous">
  
 <div class="card" style="width: 25rem;">
  <div class="card-body">
   <h1>Ajouter une tache</h1>
   <form method="POST">
<div>

<div>
  <label for="titre">Votre titre</label><br>
  <input type="text" id="titre" name="titre" placeholder="votre titre" required>
      </div>

<div>
  <label for="description">Votre description</label><br>
  <input id="description" name="description" placeholder="votre description" required>
</div>

<div>
  <label for="date_limite">Votre date_limite</label><br>
  <input id="date_limite" name="date_limite" placeholder="votre date_limite" required>
</div>
<div>
  <label for="statut">statut de la tache</label><br>
<select name="statut">statut<br>
        <option value="En attente">En attente</option>
        <option value="En cours">En cours</option>
        <option value="Terminée">Terminée</option>
    </select><br>
<div>
  <button type="submit" name="ajouter">Envoyer</button>
</div>
</form>
</div>
</body>
</html>

