<?php
class ApiController extends AppController {

    public $uses = array('SmallCategory');

    public $components = array('RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

}