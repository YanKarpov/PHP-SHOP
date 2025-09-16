<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    if ($name !== '') {
        try {

            $pdo = new PDO('sqlite:cat.sqlite');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $slug = strtolower(str_replace(' ', '-', $name));
            $stmt = $pdo->prepare("INSERT OR IGNORE INTO categories (name, slug) VALUES (:name, :slug)");
            $stmt->execute([':name' => $name, ':slug' => $slug]);


            header("Location: categories.php");
            exit;

        } catch (PDOException $e) {
            die("Ошибка базы данных: " . $e->getMessage());
        }
    }
}
?>


        <form method="post" class="d-flex gap-2">
            <input type="text" name="name" class="form-control" placeholder="Название категории" required>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

