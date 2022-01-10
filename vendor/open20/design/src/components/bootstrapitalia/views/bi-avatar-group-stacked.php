<?php
$numberExpose = (isset($numberExpose)) ? $numberExpose :  5;
?>

<ul class="avatar-group-stacked <?= $additionalClass ?>">
  <?php
  $i = 1;
  for ($i; $i <= $numberExpose && $i <= $usersNumber; $i++) {
  ?>
    <li>
      <a class="avatar size-sm" href="#" data-toggle="tooltip" data-html="true" data-placement="top" title="<strong>Mario Rossi</strong><br/><em>Editor</em>">
        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Arianna Rossi">
      </a>
    </li>
  <?php }
  if ($i < $usersNumber) {
  ?>
    <!--dropdown-->
    <li>
      <div class="avatar avatar-dropdown size-sm">
        <div class="dropdown">
          <a class="btn btn-dropdown dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Visualizza altri 3 utenti</span>
            <span aria-hidden="true">+<?= $usersNumber - $numberExpose ?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <div class="link-list-wrapper">
              <ul class="link-list">
                <?php for ($i; $i <= $usersNumber; $i++) {  ?>
                  <li>
                    <a class="list-item" href="#">
                      <div class="avatar size-sm"><img src="https://randomuser.me/api/portraits/men/46.jpg" alt="Mario Rossi"></div>
                      <span>Mario Rossi</span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </li>
  <?php } ?>
</ul>