<?php

namespace App\Entity;

use App\Repository\LodgingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LodgingRepository::class)]
class Lodging
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column]
    private ?float $price_per_night = null;

    #[ORM\Column]
    private ?bool $animals_allowed = null;

    #[ORM\Column]
    private ?int $simple_bed_count = null;

    #[ORM\Column]
    private ?int $double_bed_count = null;

    #[ORM\Column]
    private ?int $bedroom_count = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'lodgings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LodgingCategory $lodging_category = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'lodge')]
    private Collection $reservations;

    /**
     * @var Collection<int, Picture>
     */
    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'lodge')]
    private Collection $pictures;

    /**
     * @var Collection<int, Amenities>
     */
    #[ORM\ManyToMany(targetEntity: Amenities::class, inversedBy: 'lodgings')]
    private Collection $amenities;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->amenities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPricePerNight(): ?float
    {
        return $this->price_per_night;
    }

    public function setPricePerNight(float $price_per_night): static
    {
        $this->price_per_night = $price_per_night;

        return $this;
    }

    public function isAnimalsAllowed(): ?bool
    {
        return $this->animals_allowed;
    }

    public function setAnimalsAllowed(bool $animals_allowed): static
    {
        $this->animals_allowed = $animals_allowed;

        return $this;
    }

    public function getSimpleBedCount(): ?int
    {
        return $this->simple_bed_count;
    }

    public function setSimpleBedCount(int $simple_bed_count): static
    {
        $this->simple_bed_count = $simple_bed_count;

        return $this;
    }

    public function getDoubleBedCount(): ?int
    {
        return $this->double_bed_count;
    }

    public function setDoubleBedCount(int $double_bed_count): static
    {
        $this->double_bed_count = $double_bed_count;

        return $this;
    }

    public function getBedroomCount(): ?int
    {
        return $this->bedroom_count;
    }

    public function setBedroomCount(int $bedroom_count): static
    {
        $this->bedroom_count = $bedroom_count;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLodgingCategory(): ?LodgingCategory
    {
        return $this->lodging_category;
    }

    public function setLodgingCategory(?LodgingCategory $lodging_category): static
    {
        $this->lodging_category = $lodging_category;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setLodge($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getLodge() === $this) {
                $reservation->setLodge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setLodge($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getLodge() === $this) {
                $picture->setLodge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Amenities>
     */
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Amenities $amenity): static
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities->add($amenity);
        }

        return $this;
    }

    public function removeAmenity(Amenities $amenity): static
    {
        $this->amenities->removeElement($amenity);

        return $this;
    }
}
