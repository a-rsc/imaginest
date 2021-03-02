<?php

namespace Imaginest\php\Models;

    class User{
        private $iduser;
        private $username;
        private $email;
        private $password;
        private $firstname;
        private $lastname;
        private $openSession;
        private $lastLogin;
        private $active;
        private $activationDate;
        private $activationCode;
        private $resetPassword;
        private $resetPasswordExpiry;
        private $resetPasswordCode;
        private $datetimezone;
        private $removedOn;
        private $changedOn;
        private $createdOn;

        //Constructor de la classe
        function __construct($username, $email, $firstname, $lastname){
            $$this->username = $username;
            $$this->email = $email;
            $$this->firstname = $firstname;
            $$this->lastname = $lastname;
        }

        public function getIduser() {
            return $this->iduser;
        }

        public function setIduser($iduser) {
            $this->iduser = $iduser;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getFirstname() {
            return $this->firstname;
        }

        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        public function getLastname() {
            return $this->lastname;
        }

        public function setLastname($lastname) {
            $this->lastname = $lastname;
        }

        public function getOpenSession() {
            return $this->openSession;
        }

        public function setOpenSession($openSession) {
            $this->openSession = $openSession;
        }

        public function getLastLogin() {
            return $this->lastLogin;
        }

        public function setLastLogin($lastLogin) {
            $this->lastLogin = $lastLogin;
        }

        public function getActive() {
            return $this->active;
        }

        public function setActive($active) {
            $this->active = $active;
        }

        public function getActivationDate() {
            return $this->activationDate;
        }

        public function setActivationDate($activationDate) {
            $this->activationDate = $activationDate;
        }

        public function getActivationCode() {
            return $this->activationCode;
        }

        public function setActivationCode($activationCode) {
            $this->activationCode = $activationCode;
        }

        public function getresetPassword() {
            return $this->resetPassword;
        }

        public function setresetPassword($resetPassword) {
            $this->resetPassword = $resetPassword;
        }

        public function getresetPasswordExpiry() {
            return $this->resetPasswordExpiry;
        }

        public function setresetPasswordExpiry($resetPasswordExpiry) {
            $this->resetPasswordExpiry = $resetPasswordExpiry;
        }

        public function getresetPasswordCode() {
            return $this->resetPasswordCode;
        }

        public function setresetPasswordCode($resetPasswordCode) {
            $this->resetPasswordCode = $resetPasswordCode;
        }

        public function getDatetimezone() {
            return $this->datetimezone;
        }

        public function setDatetimezone($datetimezone) {
            $this->datetimezone = $datetimezone;
        }

        public function getRemovedOn() {
            return $this->removedOn;
        }

        public function setRemovedOn($removedOn) {
            $this->removedOn = $removedOn;
        }

        public function getChangedOn() {
            return $this->changedOn;
        }

        public function setChangedOn($changedOn) {
            $this->changedOn = $changedOn;
        }

        public function getCreatedOn() {
            return $this->createdOn;
        }

        public function setCreatedOn($createdOn) {
            $this->createdOn = $createdOn;
        }
    }
