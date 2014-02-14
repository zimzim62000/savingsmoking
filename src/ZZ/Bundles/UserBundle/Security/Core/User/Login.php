<?php
namespace ZZ\Bundles\UserBundle\Security\Core\User;


use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;


Abstract class Login
{

    protected $userManager;
    protected $response;
    protected $service;
    protected $idservice;

    public function __construct($userManager, UserResponseInterface $response)
    {
        $this->userManager = $userManager;
        $this->response = $response;
        $this->service = $response->getResourceOwner()->getName();
        $this->idservice = $response->getUsername();
    }

    public function checkIfExist()
    {
        $email = $this->response->getEmail();
        $username = $this->response->getRealName();

        $user = $this->userManager->findUserBy(array('username' => $username));

        if (isset($user)) {
            $this->initialiseUser($user);

            return $user;
        }

        $user = $this->userManager->findUserBy(array('email' => $email));

        if (isset($user)) {
            $this->initialiseUser($user);
            return $user;
        }

        return null;
    }

    public function initialiseUser($user = null)
    {
        $setter = 'set' . ucfirst($this->service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';
        if (!isset($user)) {
            $user = $this->userManager->createUser();
        }
        $user->$setter_id($this->idservice);
        $user->$setter_token($this->response->getAccessToken());

        return $user;
    }

}