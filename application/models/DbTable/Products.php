<?php

class Application_Model_DbTable_Products extends Zend_Db_Table_Abstract
{

    protected $_name = 'products';

     // Метод для получения записи по id
public function getProduct($id)
{
    // Получаем id как параметр

    $id = (int)$id;
    // Используем метод fetchRow для получения записи из базы.
    // В скобках указываем условие выборки (привычное для вас where)
    $row = $this->fetchRow('id = ' . $id);
     // Если результат пустой, выкидываем исключение
    if(!$row){
        throw new Exception('Нет записи с таким id');
    }
    // Возвращаем результат, упакованный в массив
    return $row->toArray();
}
// Метод для добавление новой записи
public function addProduct($title, $description,$image,$spread_type)
{
     // Формируем массив вставляемых значений
    $data = array(
        'title'       => $title,
        'description' => $description,
        'image'       => $image,
    	'spread_type' => $spread_type,
    );
    /// Используем метод insert для вставки записи в базу
    $this->insert($data);
}
// Метод для обновления записи
public function updateProduct($title, $description,$image, $spread_type)
{
      $data = array(
        'title'       => $title,
        'description' => $description,
        'image'       => $image,
      	'spread_type' => $spread_type,
    );
      
    $this->update($data, 'id=' . (int)$id);
}
// Метод для удаления записи
public function deleteProduct($id)
{
    $this->delete('id = ' . (int)$id);
}
}

