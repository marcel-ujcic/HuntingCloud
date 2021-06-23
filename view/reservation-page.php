<!DOCTYPE html>

<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<title>Hunting cloud locations</title>
<body>
    <?php include("view/menu-links.php"); ?>
    <h1> Rezervacija </h1>
    <p>Lovska družina: <?php echo $familyName?>

    <?php $date=date("d-m-Y") ?>

    <form action="<?= BASE_URL . "user/reserve" ?>" method="post">
        <div class ="lokLova">
            <label for="locations">Izberi lokacijo lova </label>
            <select id="locations" name ="locID">
                <?php foreach ($locations as $location): ?>
                    <p><option  value="<?= $location["locationID"] ?>"> <?= $location["locationName"] ?></option><p>
                <?php endforeach; ?>
            </select>
                </div>
        <p><label>Čas: <input type="time" name="time" value="<?= $time ?>" /></label>
        <label><?=$errorMessage?></label></p>
        <p>Datum: <input style="pointer-events: none;" id="time" type="text" name="date" value="<?= $date ?>" /></label></p>
        <p><button>Rezerviraj</button></p>
    </form>
</body>
<script>
d = new Date();
h= d.getHours();
m=d.getMinutes();

str1 =h+":"+m;
str2 = document.getElementById("time").value;
if(str1>=str2 && str1<=str2){
    alert("ok")
}else{
    return;
}
//document.getElementById("time").innerHTML  = d + "/" + m + "/" + y;
</script>