<?php
namespace ZZ\Bundles\UserBundle\Security\Core\User;

class LoginGoogle extends Login{

    public function logMe()
    {
        $user = $this->initialiseUser();
        $data = $this->response->getResponse();
        //@todo implement this picture -> $data['picture'];
        $user->setUsername($this->response->getRealName());
        $user->setFirstname($data['given_name']);
        $user->setLastname($data['family_name']);
        $user->setEmail($this->response->getEmail());
        $user->setPlainPassword($this->response->getEmail());
        $user->setEnabled(true);
        $this->userManager->updateUser($user);

        return $user;
    }
}