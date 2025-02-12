<?php 

namespace App\DTO ; 

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO{

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    public ?string $firstname = null;

   #[Assert\NotBlank]
    public ?string $lastname = null;
    #[Assert\NotBlank]
    public ?string $email = null;

    public ?string $phone = null;

    #[Assert\NotBlank]
    public ?string $message = null;
}