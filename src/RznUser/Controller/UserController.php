<?php
 /**
  * ----------------------------------------------------
  * | Автор: Андрей Рыжов (Dune) <info@rznw.ru>         |
  * | Сайт: www.rznw.ru                                 |
  * | Телефон: +7 (4912) 51-10-23                       |
  * | Дата: 07.11.14                                      
  * ----------------------------------------------------
  *
  */

namespace RznUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class UserController extends AbstractActionController
{
    protected $loginForm = null;
    protected $registerForm = null;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UserControllerOptionsInterface
     */
    protected $options;


    public function __construct($userService, $options)
    {
        $this->userService = $userService;
        $this->options = $options;
    }

    /**
     * User page
     */
    public function indexAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        return new ViewModel();
    }


    public function setLoginForm($form)
    {
        $this->loginForm = $form;
    }

    public function getLoginForm()
    {
        if (!$this->loginForm) {
            $this->getEventManager()->trigger('getLoginForm', $this);
        }
        return $this->loginForm;
    }

    public function setRegisterForm($form)
    {
        $this->registerForm = $form;
    }

    public function getRegisterForm()
    {
        if (!$this->registerForm) {
            $this->getEventManager()->trigger('getRegisterForm', $this);
        }
        return $this->registerForm;

    }

} 