<!DOCTYPE html>
<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<body>
    <title>Hunting cloud lokacije</title>
    <?php include("view/menu-links.php"); ?>
    <h1 > Lokacije </h1>

    <div class="lokacije">
        <p>Lovska družina: <?php echo $familyName?>

        <ol>
            <?php foreach ($locations as $location): ?>
                <li> 
                    <?= $location["locationName"] ?></li><br/>
            <?php endforeach; ?>

        </ol>
    </div>
</body>
