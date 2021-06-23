<!DOCTYPE html>

<style>
    <?php  include 'CSS/style.css';?>
    

input[type=text], input[type=password] {
  width: 25%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
input[type=password] {
    margin-left:80px
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
    margin-left:25%;
  border: none;
  cursor: pointer;
  width: 50%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
label{
    margin-left:25%;
}
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<meta charset="UTF-8" />
<title>Login form</title>
<body>
    <h1>Prosim prijavite se</h1>


    <?php if (!empty($errorMessage)): ?>
        <p style="margin-left: 40px;"class="important"><?= $errorMessage ?></p>
    <?php endif; ?>
<div> 
    <form action="<?= BASE_URL . "user/login" ?>" method="post">
        <p>
            <label>Uporabniško ime: <input type="text" name="username" autocomplete="off" 
                required autofocus /></label><br/>
            <label>Geslo: <input type="password" name="password" required /></label>
        </p>
        <p><button>Prijava</button></p>
    </form>
    <form action="<?= BASE_URL . "user/register" ?>" method="post">
        <p><button>Registracija</button></p>
    </form>

    <form action="<?= BASE_URL . "" ?>" method="post">
        <p><button>Domov</button></p>
    </form>
<div>


</body>


