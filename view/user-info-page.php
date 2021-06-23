<!DOCTYPE html>

<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<title>Hunting cloud dash</title>
<body>
        <?php include("view/menu-links.php"); ?>
        <h1> O meni </h1>
        <ol style=" list-style-type: none;">
                <li> Ime: <?= $name ?></li><br>
                <li> Priimek: <?= $surname ?></li><br>
                <li> Lovska družina: <?= $familyName ?></li><br>

        </ol>
        <p class="bold">Zgodovina rezervacij</p>
        <table>
                <tr>
                        <th>Lokacija</th>
                        <th>Datum</th>
                        <th>Ura</th>
                <tr>
                <?php foreach ($history as $location): ?>
                        <tr>
                                <td> <?= $location["lokacija"] ?></td>
                                <td> <?= $location["datum"] ?></td>
                                <td> <?= $location["ura"] ?></td>
                        </tr>
                <?php endforeach; ?>
        </table>
</body>
