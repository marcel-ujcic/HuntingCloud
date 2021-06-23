<!DOCTYPE html>

<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<title>Hunting cloud dash</title>
<body>
        <?php include("view/menu-links.php"); ?>
        <h1> Sporočila in  obvestila </h1>
        <p class="bold">Sporočila</p>
        <p>Lovske družine: <?= $family[0]["familyName"]?></p>
        <table>
               
                <?php ; foreach ($messages as $msg): ?>
                        <tr class="msg">
                       
                                <td class="title">
                                <?php if (isset($_SESSION["moderator"])): ?>
                                        <?php if ($_SESSION["moderator"] == 1): ?>
                                                <form action="<?= BASE_URL . "user/messages" ?>" method="post">
                                                        <button name="delete" value="<?= $msg["ID"]?>">Izbriši</button></br>
                                                <form>   
                                        <?php endif; ?>
                                <?php endif; ?>
                                 <?= $msg["title"] ?>  </td>
                        
                                <td class="context"> <?= $msg["context"] ?></td>
                       
                                <td class="created"> <?= explode(" ", $msg["created"])[0]?></td>
                         </tr>
                <?php endforeach; ?>
        </table>
</body>
