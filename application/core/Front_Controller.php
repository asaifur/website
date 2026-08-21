<?php
class Front_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load menu frontend
        $this->load->model('Menu_model');

        $this->menu =
            $this->Menu_model->getMenu(
                'header',
                $this->domain['url_domain']
            );

        $this->load->vars('menu_header', $this->menu);
    }
}
