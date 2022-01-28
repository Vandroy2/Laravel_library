<?php

namespace App\DTO;


use App\Helpers\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;


class UserDto implements Arrayable
{
        /**
         * @var string
         */
        protected $type;
        /**
         * @var integer
         */
        protected $premium;
        /**
         * @var string
         */
        protected $name;
        /**
         * @var string
         */
        protected $surname;
        /**
         * @var string
         */
        protected $email;
        /**
         * @var integer
         */
        protected $birthday;
        /**
         * @var integer
         */
        protected $banned;
        /**
         * @var integer
         */
        protected $cartNumber;
        /**
         * @var int
         */
        protected $balance;

        /**
         * @UserDTO constructor
         *
         * @param string $type
         * @param integer $premium
         * @param string $name
         * @param string $surname
         * @param string $email
         * @param integer $birthday
         * @param integer $banned
         * @param integer $cartNumber
         * @param integer $balance
         *
         */

        public function __construct
        (
            string $type,
            int $premium,
            string $name,
            string $surname,
            string $email,
            int $birthday,
            int $banned,
            int $cartNumber,
            int $balance
        )
        {
            $this->type = $type;
            $this->premium = $premium;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->birthday = $birthday;
            $this->banned = $banned;
            $this->cartNumber = $cartNumber;
            $this->balance = $balance;

        }

        /**
         * @return string
         */
        public function getType(): string
        {
            return $this->name;
        }
        /**
         * @return int
         */
        public function getPremium(): int
        {
            return $this->premium;
        }
        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }
        /**
         * @return string
         */
        public function getSurname(): string
        {
            return $this->surname;
        }


        /**
         * @return string
         */
        public function getEmail(): string
        {
            return $this->email;
        }
        /**
         * @return int
         */
        public function getBirthday(): int
        {
            return $this->birthday;
        }
        /**
         * @return int
         */
        public function getBanned(): int
        {
            return $this->banned;
        }
        /**
         * @return int
         */
        public function getCartNumber(): int
        {
            return $this->cartNumber;
        }

    /**
     * @return int
     */


        public function getBalance(): int
        {
            return $this->balance;
        }

        /**
         * @return array
         */



    /**
     * @param array $attributes
     * @return UserDTO
     */

        public static function createFromArray(array $attributes):self{
            return new self(
                (string)ArrayHelper::getNotEmptyValue($attributes, 'type', 'guest'),
                (int)ArrayHelper::getNotEmptyValue($attributes, 'premium', 0),
                (string)ArrayHelper::getNotEmptyValue($attributes, 'name', ''),
                (string)ArrayHelper::getNotEmptyValue($attributes, 'surname', ''),
                (string)ArrayHelper::getNotEmptyValue($attributes, 'email', ''),
                (string)ArrayHelper::getNotEmptyValue($attributes, 'birthday', ''),
                (string)ArrayHelper::getNotEmptyValue($attributes, 'banned', 0),
                (int)ArrayHelper::getNotEmptyValue($attributes, 'cart_number', ''),
                (int)ArrayHelper::getNotEmptyValue($attributes, 'balance', 0),
            );
        }

    public function toArray(): array
    {
        return [
            'type'=>$this->type,
            'premium'=>$this->premium,
            'name'=> $this->name,
            'surname'=> $this->surname,
            'email'=> $this->email,
            'birthday'=> $this->birthday,
            'banned'=> $this->banned ,
            'cart_number'=>$this->cartNumber,
            'balance' => $this->balance,
        ];
    }
    }
