<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario extends EntidadBase implements UserInterface {
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	protected $username;
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	protected $usernameCanonical;
	
	/**
	 * Encrypted password.
	 * Must be persisted.
	 *
	 * @ORM\Column(type="string", length=250)
	 */
	protected $password;
	
	/**
	 * @ORM\Column(type="string", length=10)
	 */
	protected $cedula;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $telefonoConvencional;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $telefonoCelular;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $email;
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	protected $cargo;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fechaInicio;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fechaFin;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $estadoActividad;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $enabled;
	
	/**
	 * The salt to use for hashing.
	 *
	 * @var string
	 */
	protected $salt;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $lastLogin;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $passwordRequestedAt;
	
	/**
	 * @ORM\Column(type="array")
	 */
	protected $roles;
	
	/**
	 * Random string sent to the user email address in order to verify it.
	 *
	 * @ORM\Column(type="string", length=250)
	 */
	protected $confirmationToken;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	protected $junta;
	
	// TODO: add direccion
	// protected $direccion;
	
	/**
	 * User constructor.
	 */
	public function __construct() {
		$this->enabled = false;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function serialize() {
		return serialize ( array (
				$this->password,
				$this->salt,
				$this->usernameCanonical,
				$this->username,
				$this->enabled,
				$this->id,
				$this->email
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function unserialize($serialized) {
		$data = unserialize ( $serialized );
		
		if (13 === count ( $data )) {
			// Unserializing a User object from 1.3.x
			unset ( $data [4], $data [5], $data [6], $data [9], $data [10] );
			$data = array_values ( $data );
		} elseif (11 === count ( $data )) {
			// Unserializing a User from a dev version somewhere between 2.0-alpha3 and 2.0-beta1
			unset ( $data [4], $data [7], $data [8] );
			$data = array_values ( $data );
		}
		
		list ( $this->password, $this->salt, $this->usernameCanonical, $this->username, $this->enabled, $this->id, $this->email) = $data;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function eraseCredentials() {
		$this->plainPassword = null;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getUsernameCanonical() {
		return $this->usernameCanonical;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getEmailCanonical() {
		return $this->email;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * Gets the last login time.
	 *
	 * @return \DateTime
	 */
	public function getLastLogin() {
		return $this->lastLogin;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getPlainPassword() {
		return $this->password;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getConfirmationToken() {
		return $this->confirmationToken;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getRoles() {
		$roles = $this->roles;
		
		// we need to make sure to have at least one role
		$roles [] = static::ROLE_DEFAULT;
		
		return array_unique ( $roles );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function hasRole($role) {
		return in_array ( strtoupper ( $role ), $this->getRoles (), true );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function addRole($role) {
		$role = strtoupper ( $role );
		if ($role === static::ROLE_DEFAULT) {
			return $this;
		}
		
		if (! in_array ( $role, $this->roles, true )) {
			$this->roles [] = $role;
		}
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isAccountNonExpired() {
		return true;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isAccountNonLocked() {
		return true;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isCredentialsNonExpired() {
		return true;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isEnabled() {
		return $this->enabled;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isSuperAdmin() {
		return $this->hasRole ( static::ROLE_SUPER_ADMIN );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function removeRole($role) {
		if (false !== $key = array_search ( strtoupper ( $role ), $this->roles, true )) {
			unset ( $this->roles [$key] );
			$this->roles = array_values ( $this->roles );
		}
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setUsername($username) {
		$this->username = $username;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setUsernameCanonical($usernameCanonical) {
		$this->usernameCanonical = $usernameCanonical;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setEmailCanonical($emailCanonical) {
		$this->email = $emailCanonical;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setEnabled($boolean) {
		$this->enabled = ( bool ) $boolean;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setPassword($password) {
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setSuperAdmin($boolean) {
		if (true === $boolean) {
			$this->addRole ( static::ROLE_SUPER_ADMIN );
		} else {
			$this->removeRole ( static::ROLE_SUPER_ADMIN );
		}
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setPlainPassword($password) {
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setLastLogin(\DateTime $time = null) {
		$this->lastLogin = $time;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setConfirmationToken($confirmationToken) {
		$this->confirmationToken = $confirmationToken;
		
		return $this;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setPasswordRequestedAt(\DateTime $date = null) {
		$this->passwordRequestedAt = $date;
		
		return $this;
	}
	
	/**
	 * Gets the timestamp that the user requested a password reset.
	 *
	 * @return null|\DateTime
	 */
	public function getPasswordRequestedAt() {
		return $this->passwordRequestedAt;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function isPasswordRequestNonExpired($ttl) {
		return $this->getPasswordRequestedAt () instanceof \DateTime && $this->getPasswordRequestedAt ()->getTimestamp () + $ttl > time ();
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function setRoles(array $roles) {
		$this->roles = array ();
		
		foreach ( $roles as $role ) {
			$this->addRole ( $role );
		}
		
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function __toString() {
		return ( string ) $this->getUsername ();
	}
	
	/**
	 * Set cedula
	 *
	 * @param string $cedula        	
	 *
	 * @return Usuario
	 */
	public function setCedula($cedula) {
		$this->cedula = $cedula;
		
		return $this;
	}
	
	/**
	 * Get cedula
	 *
	 * @return string
	 */
	public function getCedula() {
		return $this->cedula;
	}
	
	/**
	 * Set telefonoConvencional
	 *
	 * @param string $telefonoConvencional        	
	 *
	 * @return Usuario
	 */
	public function setTelefonoConvencional($telefonoConvencional) {
		$this->telefonoConvencional = $telefonoConvencional;
		
		return $this;
	}
	
	/**
	 * Get telefonoConvencional
	 *
	 * @return string
	 */
	public function getTelefonoConvencional() {
		return $this->telefonoConvencional;
	}
	
	/**
	 * Set telefonoCelular
	 *
	 * @param string $telefonoCelular        	
	 *
	 * @return Usuario
	 */
	public function setTelefonoCelular($telefonoCelular) {
		$this->telefonoCelular = $telefonoCelular;
		
		return $this;
	}
	
	/**
	 * Get telefonoCelular
	 *
	 * @return string
	 */
	public function getTelefonoCelular() {
		return $this->telefonoCelular;
	}
	
	/**
	 * Set cargo
	 *
	 * @param string $cargo        	
	 *
	 * @return Usuario
	 */
	public function setCargo($cargo) {
		$this->cargo = $cargo;
		
		return $this;
	}
	
	/**
	 * Get cargo
	 *
	 * @return string
	 */
	public function getCargo() {
		return $this->cargo;
	}
	
	/**
	 * Set fechaInicio
	 *
	 * @param \DateTime $fechaInicio        	
	 *
	 * @return Usuario
	 */
	public function setFechaInicio($fechaInicio) {
		$this->fechaInicio = $fechaInicio;
		
		return $this;
	}
	
	/**
	 * Get fechaInicio
	 *
	 * @return \DateTime
	 */
	public function getFechaInicio() {
		return $this->fechaInicio;
	}
	
	/**
	 * Set fechaFin
	 *
	 * @param \DateTime $fechaFin        	
	 *
	 * @return Usuario
	 */
	public function setFechaFin($fechaFin) {
		$this->fechaFin = $fechaFin;
		
		return $this;
	}
	
	/**
	 * Get fechaFin
	 *
	 * @return \DateTime
	 */
	public function getFechaFin() {
		return $this->fechaFin;
	}
	
	/**
	 * Set estadoActividad
	 *
	 * @param string $estadoActividad        	
	 *
	 * @return Usuario
	 */
	public function setEstadoActividad($estadoActividad) {
		$this->estadoActividad = $estadoActividad;
		
		return $this;
	}
	
	/**
	 * Get estadoActividad
	 *
	 * @return string
	 */
	public function getEstadoActividad() {
		return $this->estadoActividad;
	}
	
	/**
	 * Set junta
	 *
	 * @param \AppBundle\Entity\Junta $junta        	
	 *
	 * @return Usuario
	 */
	public function setJunta(\AppBundle\Entity\Junta $junta = null) {
		$this->junta = $junta;
		
		return $this;
	}
	
	/**
	 * Get junta
	 *
	 * @return \AppBundle\Entity\Junta
	 */
	public function getJunta() {
		return $this->junta;
	}
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->username 
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"usuario" 
		);
	}
	public static function getNombreEntidad() {
		return "usuario";
	}
}
