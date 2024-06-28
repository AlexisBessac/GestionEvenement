<?php 

namespace App\DTO;

class SearchFormDataDTO
{
    private ?string $titre = null;

    /**
     * Get the value of titre
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     */
    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}