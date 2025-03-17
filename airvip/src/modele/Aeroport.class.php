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

    public function setCode(int $code): void 
    {
        $this->code = $code;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getPays(): string
    {
        return $this->pays;
    }

    public function setPays(string $pays): void
    {
        $this->pays = $pays;
    }
    
    public function getDistanceMTL(): int
    {
        return $this->distanceMTL;
    }

    public function setDistanceMTL(int $distanceMTL): void
    {
        $this->distanceMTL = $distanceMTL;
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
            "[#%d] %s - %s à %.2f km de Montréal",
            $this->code,
            $this->ville,
            $this->pays,
            $this->distanceMTL
        );
    }
    
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'ville' => $this->ville,
            'pays' => $this->pays,
            'distanceMTL' => $this->distanceMTL
        ];
    }
}

?>
