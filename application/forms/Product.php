<?php

class Application_Form_Product extends Zend_Form
{

 public function init()
  {
   $this->setName('product');
 // Создаём элемент hidden c именем = id
   $id= new Zend_Form_Element_Hidden('id');
 
  // Указываем, что данные в этом элементе фильтруются как число int
   $id->addFilter('Int');
  // Создаём переменную, которая будет хранить сообщение валидации
  $isEmptyMessage = 'Значение не может быть пустым';

  $title = new Zend_Form_Element_Text('title');
      $title->setLabel('Заголовок')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty', 'true', array(
           array('isEmpty' => $isEmptyMessage)
             ));
  $description = new Zend_Form_Element_Text('description');
  $description->setLabel('Описание')
       ->setRequired(true)
       ->addFilter('StripTags')
       ->addFilter('StringTrim')
       ->addValidator('NotEmpty', 'true', array(
            array('isEmpty' => $isEmptyMessage)
              ));
       
  $spread_type = new Zend_Form_Element_Text('spread_type');
  $spread_type->setLabel('Расклад')
       ->setRequired(true)
       ->addFilter('StripTags')
       ->addFilter('StringTrim')
       ->addValidator('NotEmpty', 'true', array(
            array('isEmpty' => $isEmptyMessage)
              ));
       
  $image = new Zend_Form_Element_Image('image');
  $image->setLabel('Изображение');
  
  $submit = new Zend_Form_Element_Submit('submit');
  $submit->setAttrib('id', 'submitbutton');
  $this->addElements(array($id, $title, $description, $image, $spread_type, $submit));
   }

}

