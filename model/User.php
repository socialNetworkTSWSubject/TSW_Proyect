<?php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Clase User
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class User {
  /**
   * El email del usuario
   * @var string
   */
  private $email;
  /**
   * La password del usuario
   * @var string
   */
  private $password;
    /**
   * El nombre del usuario
   * @var string
   */
  private $name;
  
  /**
   * El constructor
   * 
   * @param string $email El email del usuario
   * @param string $password La password del usuario
   * @param string $name El nombre del usuario
   */
  public function __construct($email=NULL, $password=NULL, $name=NULL) {
    $this->email = $email;
    $this->password = $password;   
	$this->name = $name; 
  }
  /**
   * Devuelve el email de ese usuario
   * 
   * @return string El email de ese usuario
   */  
  public function getEmail() {
    return $this->email;
  }
  /**
   * Modifica el email de ese usuario
   * 
   * @param string $email El email de ese usuario
   * @return void
   */  
  public function setEmail($email) {
    $this->email = $email;
  }
  
  /**
   * Devuelve la password de ese usuario
   * 
   * @return string la password de ese usuario
   */  
  public function getPassword() {
    return $this->password;
  }  
  /**
   * Modifica la password de ese usuario
   * 
   * @param string $password la password de ese usuario
   * @return void
   */    
  public function setPassword($password) {
    $this->password = $password;
  }
   /**
   * Devuelve el nombre de ese usuario
   * 
   * @return string el nombre de ese usuario
   */  
  public function getName() {
    return $this->name;
  }  
  /**
   * Modifica nombre de ese usuario
   * 
   * @param string $name el nombre de ese usuario
   * @return void
   */    
  public function setName($name) {
    $this->name = $name;
  }
  
  /**
   * Comprueba si el usuario actual es valido para 
   * ser insertado en la base de datos
   * 
   * @throws ValidationException si no es valido
   * 
   * @return void
   */  
  public function checkIsValidForRegister($repeat_password) {
      $errors = array();
      if (strlen($this->email) < 5) {
		$errors["email"] = "El email debe tener por lo menos 5 caracteres";
      }
      if (strlen($this->password) < 5) {
		$errors["password"] = "La contraseña debe tener por lo menos 5 caracteres";	
      }
	  if (strlen($this->name) < 5) {
		$errors["name"] = "El nombre debe tener por lo menos 5 caracteres";	
      }
	  if($this->password != $repeat_password) {
		$errors["repeat_password"] = "Las passwords no son iguales";	
	  }
      if (sizeof($errors)>0){
		throw new ValidationException($errors, "El usuario no es valido");
      }
  }


   /**
   * Comprueba si el usuario actual es valido para 
   * ser actualizado en la base de datos
   * 
   * @throws ValidationException si no es valido
   * 
   * @return void
   */  
  public function checkIsValidForUpdate($password2) {
      $errors = array();
      if (strlen($this->password) < 4) {
		$errors["password"] = "La password debe tener por lo menos 4 caracteres";	
      }
	  if($this->password != $password2) {
		$errors["password2"] = "Las password no son iguales";	
	  }
      if (sizeof($errors)>0){
		throw new ValidationException($errors, "El usuario no es valido");
      }
  }
}