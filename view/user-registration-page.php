<!DOCTYPE html>

<style>
    <?php  include 'CSS/style.css';?>
</style>
<meta charset="UTF-8" />
<title>Register form</title>
<body>
    <h1>Registrirajte se</h1>


    <?php if (!empty($errorMessage)): ?>
        <p class="important"><?= $errorMessage ?></p>
    <?php endif; ?>
    <form action="<?= BASE_URL . "user/register" ?>" method="post">
        <p>
            <label>Ime: <input type="text" name="name" autocomplete="off" 
            required autofocus /></label><br/>

            <p><label>Priimek: <input type="text" name="surname" required /></label>
            <p><label>Izberite svojo lovsko družino: <select id="family" name ="familyID">
            <?php foreach ($families as $family): ?>
                <p><option  value="<?= $family["familyID"] ?>"> <?= $family["familyName"] ?></option><p>
            <?php endforeach; ?>
        </select></label>
        <p><label>Uporabniško ime: <input type="text" name="username" required />
            <?php if (!empty($errorMessage)): ?>
                <p style="margin-left: 40px; color:red"class="important"><?= $errorMessage ?></p>
            <?php endif; ?>
            </label>
        
        <p> <label>Geslo: <input type="password" name="password" required /></label>
        </p>
        <p><button>Registracija</button></p>
           
    </form>
    <form action="<?= BASE_URL . "" ?>" method="post">
            <button style="margin-left:40px">Nazaj</button>
    </form>
</body>