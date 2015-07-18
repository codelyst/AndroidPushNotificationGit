<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PushNotificationController extends AppController
{

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *    or MissingViewException in debug mode.
     */

    public function index()
    {


// define variables and set to empty values
        $nameErr = $tokenErr = "";
        $ServerAPIKEY = $token = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $isError = false;

            if (empty($_POST["name"])) {
                $nameErr = "Server Key is required";
                $isError = true;
            } else {
                $ServerAPIKEY = $this->test_input($_POST["name"]);
                // check if name only contains letters and whitespace

            }


            if (empty($_POST["token"])) {
                $tokenErr = "Cloud Notification  is required";
                $isError = true;
            } else {

                $token = $this->test_input($_POST["token"]);
                // check if name only contains letters and whitespace

            }


            $result = "";
            if ($isError == false) {


                // Prepare array containing the GCM message content. What to send and where to send.


                $jData = array(
                    "message" => "Sample Message From Codelyst"
                );


                // Where to send GCM message.
                $jGcmData = array(
                    "to" => $token,
                    "data" => $jData
                );


                // Create connection to send GCM Message request.
                $headers = array
                (
                    'Authorization: key=' . $ServerAPIKEY,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $jGcmData ) );
                $result = curl_exec($ch );
                curl_close( $ch );

                 $result;




            }


        }


        $this->set('name', $ServerAPIKEY);
        $this->set('token', $token);
        $this->set("result",$result);


        $this->set('nameErr', $nameErr);
        $this->set('tokenErr', $tokenErr);


    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
}
