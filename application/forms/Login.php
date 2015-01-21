<?php

class Form_Login extends Zend_Form
{
    public function init()
    {
        $isAjax = false;
        //указываем атрибут action для формы
        $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user-login'));
        //Если атрибут Ajax использовался при создании формы, мы записывает true $isAjax
        if(isset($this->_attribs['ajax'])){
            if($this->_attribs['ajax']==true){
                $isAjax = true;
            }
            $this->removeAttrib('ajax');
        }
        
        $decors = array(
            'ViewHelper',
            'Errors',
            //элемент Input будет окружен тегами <li>
            array(array('data' => 'HtmlTag'), array('tag' => 'li', 'class'=> 'element')),
            //указываем, что для полей ввода будут испльзоваться также поля label
            array('label'),
            //элемент label будет окружен в теги <li>
            array(array('row' => 'HtmlTag'), array('tag' => 'li', 'class' => 'element-label'))
        );
        //указываем аттрибут для формы
        $this->setAttrib('class', 'login well');
        //создаем поля
        $email = $this->createElement('text','email');
        $email->setLabel('Email')
              ->setRequired()
              ->addFilter('StripTags')
              ->setAttib('placehoder', 'Enter your email')
              ->setDecorators($decors);
        $this->addElement($email);
       
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password')
                 ->setRequired()
                 ->setAttrib('placeholder', 'Enter your password')
                 ->setDecorators($decors);
        $this->addElement($password);
        
        //здесь меняем класс элемента <li> который окружает кнопку login
        //если переменная равна true ставим, если нет нужно задать css
        
        $decors = array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'),
            array('tag' => 'li', 'class' => $isAjax? 'form-actions clear submit':'form-actions no-ajax clear submit')),
                );
        
        $submit = $this->addElement('button' ,'loginsubmit', array(
            'label' => 'Login',
            'class' => 'btn btn-primary',
            'type' => 'submit',
            'decorators' => $decors));
        
        //Если это форма с ajax создаем кнопку Cancel которая будет закрывать окно логина
        
        if($isAjax){
            $decors = array(
                'ViewHelper',
                'Errors',
                array(array('data' => 'HtmlTag'),
                array('tag'=> 'li', 'class' => 'form-actions-cancel')),
            );
            $this->addElement('button', 'logincancel', array(
                'label' => 'Cancel',
                'class' => 'btn',
                'decorators' => $decors));
        }
        $this->addDecorators(array(
            'FormElements',
            array(array('data' => 'HtmlTag', 'tag' => 'ul'),
                array('tag' => 'ul', 'class' => 'login-form'))));
        $this->addDecorators(array(
            'tag' => 'form'
        ));
    }
}
