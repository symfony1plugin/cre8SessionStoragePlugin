<?php

class cre8PDOSessionStorage extends sfPDOSessionStorage
{
  public function sessionDestroy($id)
  {
    $retVal = parent::sessionDestroy($id);
    if($retVal) {
//      sfContext::getInstance()->getStorage()->getOptions();
    }
    return $retVal;
  }
}