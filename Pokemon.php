<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Pokémon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            background-color: rgb(115, 173, 223);
        }

        .card {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            background-color: #ffeaea;
            display: inline-block;
            vertical-align: top;
            text-align: center;
        }

        .round {
            background-color: #fdd;
            padding: 10px;
            margin: 10px 0;
            font-weight: bold;
        }

        .winner {
            background-color: rgb(170, 240, 170);
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .image {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        img {
            width: 100px;
            height: auto;
        }

        .damage {
            background-color: rgb(158, 157, 157);
            padding: 10px;
            margin-top: 5px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>BATTLE START!</h1>
    <?php
    class AttackPokemon
    {
        private $attackMinimal;
        private $attackMaximal;
        private $specialAttack;
        private $probabilitySpecialAttack;
        public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack)
        {
            $this->attackMinimal = $attackMinimal;
            $this->attackMaximal = $attackMaximal;
            $this->specialAttack = $specialAttack;
            $this->probabilitySpecialAttack = $probabilitySpecialAttack;
        }
        public function getAttackMinimal()
        {
            return $this->attackMinimal;
        }
        public function getAttackMaximal()
        {
            return $this->attackMaximal;
        }
        public function getSpecialAttack()
        {
            return $this->specialAttack;
        }
        public function getProbabilitySpecialAttack()
        {
            return $this->probabilitySpecialAttack;
        }
    }

    class Pokemon
    {
        protected $name;
        protected $url;
        protected $hp;
        protected $attackPokemon;
        public function __construct($name, $url, $hp, $attackPokemon)
        {
            $this->name = $name;
            $this->url = $url;
            $this->hp = $hp;
            $this->attackPokemon = $attackPokemon;
        }
        public function getName()
        {
            return $this->name;
        }

        public function getUrl()
        {
            return $this->url;
        }

        public function getHp()
        {
            return $this->hp;
        }

        public function getAttackPokemon()
        {
            return $this->attackPokemon;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setUrl($url)
        {
            $this->url = $url;
        }

        public function setHp($hp)
        {
            $this->hp = $hp;
        }

        public function setAttackPokemon($attackPokemon)
        {
            $this->attackPokemon = $attackPokemon;
        }

        public function isDead()
        {
            return ($this->hp <= 0);
        }
        public function whoAmI()
        {
            echo "I am " . $this->name . " with hp " . $this->hp;
        }

        public function getType()
        {
            return "normal";
        }
        public function dégats(Pokemon $opponent)
        {
            return 1;
        }
        public function attack(Pokemon $p)
        {
            $attackMinimal = ($this->attackPokemon)->getAttackMinimal();
            $attackMaximal = ($this->attackPokemon)->getAttackMaximal();
            $attack = mt_rand($attackMinimal, $attackMaximal);
            $dégat = $this->dégats($p);
            $probability = $this->attackPokemon->getProbabilitySpecialAttack();
            $aléatoire = (mt_rand() / mt_getrandmax()) * 100;
            if ($aléatoire < $probability) {
                $damage = $attack * ($this->attackPokemon)->getSpecialAttack() * $dégat;
            } else {
                $damage =  $attack * $dégat;
            }
            $p->setHp($p->getHp() - $damage);

            return $damage;
        }
    }

    function afficherCartePokemon($p)
    {
        echo "<div class='card'>";
        echo "<h3>" . $p->getName() . "</h3>";
        echo "<img src='" . $p->getUrl() . "'><br>";
        echo "HP: " . $p->getHp() . "<br>";
        echo "Type: " . $p->getType() . "<br>";
        echo "Min Attack: " . $p->getAttackPokemon()->getAttackMinimal() . "<br>";
        echo "Max Attack: " . $p->getAttackPokemon()->getAttackMaximal() . "<br>";
        echo "</div>";
    }


    function battle($Pokemon1, $Pokemon2)
    {
        echo "<div class='image'>";
        afficherCartePokemon($Pokemon1);
        afficherCartePokemon($Pokemon2);
        echo "</div>";
        $round = 1;
        while (!$Pokemon1->isDead() && !$Pokemon2->isDead()) {
            echo "<div class='round'>Round $round</div>";
            $damage1 = $Pokemon1->attack($Pokemon2);
            echo "<div class='damage'>Dommage infligé par {$Pokemon1->getName()}: $damage1</div>";
            $damage2 = $Pokemon2->attack($Pokemon1);
            echo "<div class='damage'>Dommage infligé par {$Pokemon2->getName()}: $damage2</div>";

            echo "<div class='image'>";
            afficherCartePokemon($Pokemon1);
            afficherCartePokemon($Pokemon2);

            echo "</div>";
            $round++;
        }

        if ($Pokemon1->isDead()) {
            echo "<div class='winner'>" . $Pokemon2->getName() . " gagne !</div>";
        } elseif ($Pokemon2->isDead()) {
            echo "<div class='winner'>" . $Pokemon1->getName() . " gagne !</div>";
        }
    }

    $Attack01 = new AttackPokemon(10, 100, 2, 20);
    $Attack02 = new AttackPokemon(30, 80, 4, 20);

    $Pokemon01 = new Pokemon("Pokemon 1", "Normal.png", 200, $Attack01);
    $Pokemon02 = new Pokemon("Pokemon 2", "Normal02.png", 200, $Attack02);

    battle($Pokemon01, $Pokemon02);

    class PokemonFeu extends Pokemon
    {
        public function __construct($name, $url, $hp, $attackPokemon)
        {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function getType()
        {
            return "feu";
        }
        public function dégats(Pokemon $opponent)
        {
            $type = $opponent->getType();
            if ($type == "eau" || $type == "feu") {
                return 0.5;
            }
            if ($type == "plante") {
                return 2;
            } else {
                return 1;
            }
        }
    };
    class PokemonEau extends Pokemon
    {
        public function __construct($name, $url, $hp, $attackPokemon)
        {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function getType()
        {
            return "eau";
        }
        public function dégats(Pokemon $opponent)
        {
            $type = $opponent->getType();
            if ($type == "eau" || $type == "plante") {
                return 0.5;
            }
            if ($type == "feu") {
                return 2;
            } else {
                return 1;
            }
        }
    }
    class PokemonPlante extends Pokemon
    {
        public function __construct($name, $url, $hp, $attackPokemon)
        {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function getType()
        {
            return "plante";
        }
        public function dégats(Pokemon $opponent)
        {
            $type = $opponent->getType();
            if ($type == "plante" || $type == "feu") {
                return 0.5;
            }
            if ($type == "eau") {
                return 2;
            } else {
                return 1;
            }
        }
    }
    $Attack01 = new AttackPokemon(10, 100, 2, 20);
    $Attack02 = new AttackPokemon(30, 80, 2, 20);
    $Pokemon01 = new PokemonEau("PokemonEau", "Water.png", 200, $Attack01);
    $Pokemon02 = new PokemonFeu("PokemonFeu", "Fire.png", 200, $Attack02);

    echo "<h1>BATTLE START!</h1>";
    battle($Pokemon01, $Pokemon02);

    $Attack01 = new AttackPokemon(10, 100, 2, 20);
    $Attack02 = new AttackPokemon(30, 80, 2, 20);
    $Pokemon01 = new PokemonEau("PokemonEau", "Water.png", 200, $Attack01);
    $Pokemon02 = new PokemonPlante("PokemonPlante", "Plant.png", 200, $Attack02);

    echo "<h1>BATTLE START!</h1>";
    battle($Pokemon01, $Pokemon02);

    $Attack01 = new AttackPokemon(10, 100, 2, 20);
    $Attack02 = new AttackPokemon(30, 80, 4, 20);
    $Pokemon01 = new PokemonFeu("PokemonFeu", "Fire.png", 200, $Attack01);
    $Pokemon02 = new PokemonPlante("PokemonPlante", "Plant.png", 200, $Attack02);

    echo "<h1>BATTLE START!</h1>";
    battle($Pokemon01, $Pokemon02);

    ?>
</body>

</html>