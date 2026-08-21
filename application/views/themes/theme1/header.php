<?php
$this->load->model('Menu_model');
$menus = $this->Menu_model->getMenu($this->domain->id_domain);
?>

<ul>

    <?php foreach ($menus as $m): ?>

        <li>
            <a href="<?= base_url($m->menu_link) ?>">
                <?= $m->menu_name ?>
            </a>
        </li>

    <?php endforeach ?>

</ul>