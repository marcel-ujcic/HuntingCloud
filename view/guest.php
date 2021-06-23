<!DOCTYPE html>
<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<body>
    <title>Hunting cloud lokacije</title>
    <?php include("view/menu-links.php"); ?>
    <h1 > Registrirane lovske družine </h1>

    <ol>
        <?php foreach ($families as $family): ?>
            <li> 
                <?= $family["familyName"] ?></li><br/>
        <?php endforeach; ?>

    </ol>
</body>