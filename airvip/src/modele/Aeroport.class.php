<?php


class Aeroport implements JsonSerializable
{
    private ?int $code; // nullable
    private string $ville;
    private string $pays;
    private int $distanceMTL;

    private array $features = [];

    public function __construct(
        ?int $code; // nullable
        string $ville;
        string $pays;
        int $distanceMTL;
    ) {
        $this->id = $code;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->distanceMTL = $distanceMTL;
    }

    // Getters and Setters
    public function getCode(): int
    {
        return $this->code;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function addFeature(Feature $feature): void
    {
        if(!($feature instanceof Feature)){
            throw new Exception("Le paramètre de addFeature doit être une instance de la classe Feature");
        }
        $this->features[] = $feature;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function __toString(): string
    {
        return sprintf(
            "[#%d] %s - %s @%.2f$ (%d en stock)",
            $this->id,
            $this->name,
            $this->category,
            $this->price,
            $this->quantity
        );
    }

    
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'image' => $this->image, 
            'description' => $this->description, 
            'quantity' => $this->quantity,
        ];
    }
}

?>
