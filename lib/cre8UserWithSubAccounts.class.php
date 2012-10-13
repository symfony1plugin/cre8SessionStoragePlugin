<?php

class cre8UserWithSubAccounts extends sfGuardSecurityUser
{
  public function signIn($user, $remember = false, $con = null)
  {
    parent::signIn($user, $remember, $con);

    if(! $this->isAuthenticated()) {
        return;
    }

    if($user->hasAccessToCTO()) {
        $this->addCredential('CTO');
    }
    if($user->hasAccessToQB()) {
        $this->addCredential('QB');
    }

    $loginHistory = new cre8LoginHistory();
    $loginHistory->setUserId($user->getId());
    $loginHistory->setIp(cre8Toolkit::getIP());
    $loginHistory->save();

    $cre8SessionStorage = cre8SessionStorageQuery::create()->findOneBySessId(session_id());
    $cre8SessionStorage->setUserId($user->getId());
    $cre8SessionStorage->save();

  }  

}