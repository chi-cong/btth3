<?php
require_once '../../vendor/autoload.php';
require_once 'config.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
  case 'add':
    $id = time();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $stmt = $db->prepare("INSERT INTO users (id, name, email) VALUES (?, ?, ?)");
      $stmt->execute([$id, $name, $email]);
      header('Location: index.php');
      exit;
    }
    echo $twig->render('add.twig.html', ['id' => $id]);
    break;
  case 'edit':
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
      $stmt->execute([$name, $email, $id]);
      header('Location: index.php');
      exit;
    }
    echo $twig->render('edit.twig.html', ['user' => $user]);
    break;
  case 'delete':
    $id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
    break;
  default:
    $stmt = $db->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $twig->render('index.twig.html', ['users' => $users]);
    break;
}
