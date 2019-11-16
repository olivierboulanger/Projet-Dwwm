<?php
require_once 'Message.php';

class GuestBook {

    private $file; // création d'une propriété qui contient le fichier

    public function __construct(string $file)
    {
        $directory = dirname($file); //indique le dossier dans lequel on souhaite sauvegarder le fichier
        if (!is_dir($directory)) { // si ce n'est pas un dossier alors on le crée
            mkdir($directory, 0777, true); // nom du chier, permissions, de manière recursive
        }
        if (!file_exists($file)) {  // si le fichier n'existe pas on le crée avec touch
            touch($file);
        }
        $this->file = $file;
    }

    public function addMessage(Message $message): void
    {
         file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND); // nom du fichier, le message, FILE_APPEND permet d'ajouter et ne pas écraser
    }

    public function getMessages(): array // créatoin d'une nouvelle méthode qui renvoie un tableau de l'ensemble des messages
    {
        $content = trim(file_get_contents($this->file)); // récupére le contenu de mon fichier en enlevant les caractères en trop
        $lines = explode(PHP_EOL, $content); // on explose en plusieurs lignes le contenu du fichier EOL(end of line)
        $messages = [];
        foreach($lines as $line){
            // $data = json_decode($line, true);
            // $messages[] = new Message($data['pseudo'], $data['msg'], new DateTime("@" . $data['date']));
            $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }
}