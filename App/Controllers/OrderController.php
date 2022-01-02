<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\User;

class OrderController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {

    }

    public function orderForm()
    {
        return $this->html(
            [
            ]
        );
    }

    public function daco()
    {
        $newOrder = new Order();

        if(isset($_POST['name']) && isset($_POST['surname'])) {
            $users = User::getAll();
            foreach ($users as $user) {
                if ($user->getName() == $_POST['name'] && $user->getSurname() == $_POST['surname']) {
                    $newOrder->setUserId($user->getId());
                    break;
                }
            }
        }

        if(isset($_POST['street'])) {
            $newOrder->setStreet($_POST["street"]);
        }
        if (isset($_POST['houseNumber'])) {
            $newOrder->setHouseNumber(intval($_POST['houseNumber']));
        }
        if (isset($_POST['psc'])) {
            $newOrder->setPsc($_POST['psc']);
        }
        if (isset($_POST['city'])) {
            $newOrder->setCity($_POST['city']);
        }
        if (isset($_POST['country'])) {
            $newOrder->setCountry($_POST['country']);
        }
        if (isset($_POST['mobile_number'])) {
            $newOrder->setMobileNumber(intval($_POST['mobile_number']));
        }

        $newOrder->save();
    }
}