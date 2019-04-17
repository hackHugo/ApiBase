<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 20/10/2018
 * Time: 06:34 PM
 */
namespace ApiBase\Contracts;
interface RequestValidationInterface
{
  public function rules();
  public function messages();
}
