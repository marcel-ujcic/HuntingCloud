<!DOCTYPE html>
<style>
    <?php  include 'CSS/style.css';?>
    h3{
       margin-left:40px;
    }
    textarea{
        font-size:20px;
    }
</style>
<meta charset="UTF-8" />
<body>
    <title>Hunting cloud admin</title>
    <?php include("view/menu-links.php"); ?>
    <h1 > Pogled moderatorja </h1>

    <div class="lokacije">
        <p>Lovska družina: <?php echo $familyName[0]["familyName"];?>  </br>

        <h3 >Ustvari obvestilo</h3>

        <form action="<?= BASE_URL . "families/newMsg" ?>" method="post">
        <p>
            <label>Naslov: <input type="text" name="title" autocomplete="off" 
                required /></label><br/>
                <label>Besedilo: </label></br>
            <textarea id="context" name="context" rows="4" cols="50 "required > </textarea>
        
        </p>
        <p><button>Objavi</button></p>
    </form>

       <h3> Zgodovina vseh rezervacij</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Priimek</th>
                <th>Lokacija</th>
                <th>Datum</th>
                <th>Ura</th>
            <?php foreach ($locations as $location): ?>
                <tr> 
                    <td><?= $location["userID"] ?></li><br/>
                    <td><?= $location["userName"] ?></li><br/>
                    <td><?= $location["userSurname"] ?></li><br/>
                    <td><?= $location["lokacija"] ?></li><br/>
                    <td><?= $location["datum"] ?></li><br/>
                    <td><?= $location["ura"] ?></li><br/>
                </tr>
            <?php endforeach; ?>
            </table>
    </div>
</body>
