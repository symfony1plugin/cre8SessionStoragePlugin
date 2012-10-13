<?php

class cre8AntiAccountSharingValidator extends sfValidatorBase
{
  
  /**
   * Validate user against account sharing
   *
   * @param Array $options
   * @param Array $messages 
   */
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('throw_global_error', true);

    $this->setMessage('invalid', 'You are already logged-in on another computer.');
    
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    // only validate if user exists
    if (isset($values['user']) && $values['user'] instanceof sfGuardUser ) {

      $user = $values['user'];
      // cleaning old sessions from DB
      cre8SessionStorageQuery::create()->filterByUserId($user->getId())->delete();

    }
    
    // assume a required error has already been thrown, skip validation
    return $values;
  }

}