<?php
namespace App\Presenters;
use Nette;
use Nette\Database\Context;

class MyPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function actionLoadUserData($id)
    {
        $user = $this->database->table('contacts')->get($id);

        if ($user) {
            $this->template->firstName = $user->first_name;
            $this->template->lastName = $user->last_name;
            $this->template->email = $user->email;
        } else {
            $this->template->firstName = null;
            $this->template->lastName = null;
            $this->template->email = null;
        }
    }
    
}

?>
