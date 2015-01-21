<?php

class IndexController extends Zend_Controller_Action
{

 public function init()
 {
 //$this->db = Zend_Db_Table::getDefaultAdapter();
 }

 public function indexAction()
 {
 //$products = $this->db->query('SELECT * FROM products')->fetchAll();
 //var_dump($products);
 $products = new Application_Model_DbTable_Products();
 $this->view->products = $products->fetchAll();
 }
    
 public function addAction()
 {
   $form = new Application_Form_Product();
   //Укзываем текст для submit 
   $form->submit->setLabel('Добавить');
   //Передаем форму в view
   $this->view->form = $form;
   // Если к нам идёт Post запрос
   if($this->getRequest()->isPost()){
   	$formData = $this->getRequest()->getPost();
   	// Если форма заполнена верно
   	if($form->isValid($formData)){
   		$title = $form->getValue('title');
   		$description = $form->getValue('description');
   		$spread_type = $form->getValue('spread_type');
   		$image = $form->getValue('image');
   		// Создаём объект модели
   		$products = new Application_Model_DbTable_Products();
   		// Вызываем метод модели addMovie для вставки новой записи
   		$products->addProduct($title, $description, $image, $spread_type);
   		// Используем библиотечный helper для редиректа на action = index
   		$this->_helper->_redirector('index');
   	} else {
   		// Если форма заполнена неверно,
   		// используем метод populate для заполнения всех полей
   		// той информацией, которую ввёл пользователь
   		$form->populate($formData);
    	} 	
     }  
  }
  
 public function editAction()
 {
 // Создаём форму
 $form = new Application_Form_Product();
 // Указываем текст для submit
 $form->submit->setLabel('Сохранить');
 $this->view->form = $form;
 // Если к нам идёт Post запрос
 if($this->getRequest()->isPost()){
 	$formData = $this->getRequest()->getPost();
 	// Если форма заполнена верно
 	if($form->isValid($formData)){
 		$id = (int)$form->getValue('id');
 		$title = $form->getValue('title');
 		$description = $form->getValue('description');
 		$spread_type = $form->getValue('spread_type');
 		$image = $form->getValue('image');
 		// Создаём объект модели
 		 $products = new Application_Model_DbTable_Products();
 		 // Вызываем метод модели updateMovie для обновления новой записи
 		 $products->updateProduct($title, $description, $image, $spread_type);
 		 // Используем библиотечный helper для редиректа на action = index
 		 $this->_helper->_redirector('index');
 	} else {
 		$form->populate($formData);
 	}
 	
 } else {
 	// Если мы выводим форму, то получаем id фильма, который хотим обновить
 	$id = $this->_getParam('id', 0);
 	if($id > 0){
 		// Создаём объект модели
 		 	$products = new Application_Model_DbTable_Products();
 		 	// Заполняем форму информацией при помощи метода populate
 		 	$form->populate($products->getProduct($id));
 		}
 	}
 }
 
 public function deleteAction()
 {
 	// Если к нам идёт Post запрос
 	if($this->getRequest()->getPost()){
 		$del = $this->getRequest()->getPost('del');
 		// Если пользователь подтвердил своё желание удалить запись
 		if($del == 'да'){
 			// Принимаем id записи, которую хотим удалить
 			$id = $this->getRequest()->getPost('id');
 			// Создаём объект модели
 			$products = new Application_Model_DbTable_Products();
 			$products->deleteProduct($id);
 		}
 		// Используем библиотечный helper для редиректа на action = index
 		$this->_helper->_redirector('index');
 		
 	 } else {
 	 	// Если запрос не Post, выводим сообщение для подтверждения
 	 	// Получаем id записи, которую хотим удалить
 	 	$id = $this->_getParam('id');
 	 	$products = new Application_Model_DbTable_Products();
 	 	$this->view->product = $products->getProduct($id); 
 	 }
  }
 
}
