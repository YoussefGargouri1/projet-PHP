<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            display: flex;
            gap: 20px;
            font-family: Arial, sans-serif;
        }

        h3 {
            text-align: center;
        }

        .student {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .moyenne {
            margin-top: 10px;
            background-color: #d1ecf1;
            padding: 5px;
        }

        .bien {
            background-color: rgb(98, 231, 131);
            padding: 5px;
        }

        .moyen {
            background-color: hsl(50, 65.50%, 60.20%);
            padding: 5px;
        }

        .pas_bien {
            background-color: rgb(243, 134, 134);
            padding: 5px;
        }
    </style>
</head>

<body>


    <div class="container">

        <?php
        class Etudiant
        {
            private $nom;
            private $notes;

            public function __construct($nom, $notes)
            {
                $this->nom = $nom;
                $this->notes = $notes;
            }
            public function AfficheNote()
            {
                echo "<div class='student'>";
                echo "<h3>$this->nom</h3>";
                foreach ($this->notes as $note) {
                    if ($note < 10) {
                        echo '<div class="pas_bien">' . $note . '</div>';
                    } else if ($note > 10) {
                        echo '<div class="bien">' . $note . '</div>';
                    } else {
                        echo '<div class="moyen">' . $note . '</div>';
                    }
                }
                $moyenne = $this->CalculMoyenne();
                echo "<div class='moyenne'>Votre moyenne est " . number_format($moyenne, 9) . "</div>";
                echo "</div>";
            }
            public function CalculMoyenne()
            {
                $somme = 0;
                foreach ($this->notes as $note) {
                    $somme = $somme + $note;
                }
                $moyenne = $somme / count($this->notes);
                return $moyenne;
            }
            public function Admis()
            {
                if ($this->CalculMoyenne() >= 10) {
                    echo "Admis";
                } else {
                    echo "Non Admis";
                }
            }
        };
        $etudiant01 = new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]);
        $etudiant02 = new Etudiant("Skander", [15, 9, 8, 16]);
        $etudiant01->AfficheNote();
        $etudiant02->AfficheNote();
        ?>
    </div>

</body>

</html>
