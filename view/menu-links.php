<style>
    <?php  include 'CSS/menu.css';?>
</style>
<!--<p>
<a href="<?= BASE_URL . "user/about" ?>">O meni</a> |
<a href="<?= BASE_URL . "user/locations" ?>"> Lokacija</a> |
<a href="<?= BASE_URL . "user/reservation" ?>">Rezervacija</a> |
<a href="<?= BASE_URL . "user/login" ?>">Prijava</a> |
</p>-->
<ul id="a">
  <li id="b"><a  class="active"  href="<?= BASE_URL . "user/about?ID=".$_SESSION["userID"]?>">O meni</a></li>
  <li id="b"><a  class="active" href="<?= BASE_URL . "user/locations" ?>">Lokacije</a></li>
  <li id="b"><a  class="active" href="<?= BASE_URL . "user/reservation" ?>">Rezervacija</a></li>
  <li id="b"><a  class="active" href="<?= BASE_URL . "user/messages" ?>">Obvestila</a></li>
  <li id="b"><a  class="active" href="<?= BASE_URL . "families" ?>">Lovske družine</a></li>
  <li id="b"><a  class="active" href="<?= BASE_URL . "" ?>">Domov</a></li>
  <li id="b"><a  class="activeBlue" href="<?= BASE_URL . "user/login" ?>">Odjava</a></li>
  <?php if (isset($_SESSION["moderator"])): ?>
    <?php if ($_SESSION["moderator"] == 1): ?>
        <li id="b"><a  class="active" href="<?= BASE_URL . "family/admin?ID=".$_SESSION["userFamilyID"]?>">Admin</a></li>
    <?php endif; ?>
  <?php endif; ?>
    
</ul>