<?php

class BlogController extends Zend_Controller_Action
{
        public function init()
    {
       $this->db = Zend_Db_Table::getDefaultAdapter();
       $this->view->title = 'Tarot Blog';
    }

    public function indexAction()
    {
        $products = $this->db->query('SELECT * FROM products')->fetchAll();
       // var_dump($products);
        $this->view->products = $products;
        $this->view->header = 'Tarot Blog Start';
    }
    
    public function commentsAction()
    {
        $productId = $this->_getParam('id',0);
        $sql = 'SELECT * FROM products WHERE id = '.$productId;
        $product = $this->db->query($sql)->fetchAll();
       //var_dump($product);
        $sql = 'SELECT * FROM messages WHERE id = '.$productId;
        $comments = $this->db->query($sql)->fetchAll();
        
        $this->view->product = $product;
        $this->view->comments = $comments;
        $this->view->title = $product[0]['title'] .'-'.$this->view->title;
        $this->view->header = $product[0]['title'];
        //var_dump($comments);
        //die($productId);
    }


}