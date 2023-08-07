<?php

$title = 'Оформить доставку';
ob_start();

?>

<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href="#tab_1">Из Европы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#tab_2">В Европу</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
        <div class="tabs__block" id="tab_1">
           <?php require_once 'app/views/FormOrder/create.php';?>
        </div>
		<div class="tabs__block" id="tab_2">
            да, она вторая Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci nobis temporibus repudiandae perferendis possimus nesciunt ratione nulla voluptate eum consequuntur asperiores doloribus rerum, aspernatur debitis ut incidunt officiis, et omnis.
		</div>
  </div>
</div>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>