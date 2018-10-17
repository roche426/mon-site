<?php
/**
 * Created by PhpStorm.
 * User: wcs
 * Date: 23/10/17
 * Time: 10:57
 * PHP version 7
 */
namespace Model;
/**
 * Class User
 */
class Validator
{
   public function blank($formData)
   {
       return !empty(trim($formData));
   }

   public function minNumber($numberData)
   {
        return !($numberData <1);
   }

   public function emailVerify($email)
   {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
   }
}

