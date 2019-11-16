<?php
class Message
{

    private $pseudo;
    private $msg;
    private $date;

    public function __construct(string $pseudo, string $msg, ?DateTime $date = null)
    {
        $this->pseudo = $pseudo;
        $this->msg = $msg;
        $this->date = $date ?: new DateTime(); // si ça n'existe pas on crée un nouveau DateTime  
    }

    public function isValid(string $user): bool
    {
        return  strlen($this->msg) > 9 && strlen($this->msg) < 501 && $this->pseudo == $user;
        //  return empty($this->getErrors());
    }

    public function getErrors(string $user): array
    {
        $errors = [];
        if (strlen($this->msg) < 10 || strlen($this->msg) > 500) {
            $errors['msg'] = "Votre message ne respecte pas les regles";
        }
        if ($this->pseudo !== $user) {
            $errors['pseudo'] = "Le pseudo ne correspond pas à la session ouverte";
        }
        return $errors;
    }

    public function toHTML(): string
    {
        $pseudo = htmlentities($this->pseudo);
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d/m/Y à H:i');
        $msg = nl2br(htmlentities($this->msg));
        return <<<HTML
        <p class="mss">
            <strong style="color:#F28500">{$pseudo}</strong> <em>le {$date}</em><br>
            {$msg}
        </p>
HTML;
    }

    public static function fromJSON(string $json): Message
    {
        $data = json_decode($json, true);
        return new self($data['username'], $data['message'], new DateTime("@" . $data['date']));
    }

    public function toJSON(): string  // retourne sous forme de caractères notre message encodé
    {
        return json_encode([
            'pseudo' => $this->pseudo,
            'msg' => $this->msg,
            'date' => $this->date->getTimestamp()
        ]);
    }
}
