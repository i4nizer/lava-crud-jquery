<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->call->model('user_model', 'user');
    }

    # Give the page
    public function index()
    {
        $this->call->view('user.php');
    }

    # GET what is searched
    public function search($search)
    {
        $res = $this->user->search($search);
        echo json_encode($res ? $res : []);
    }

    # GET all users
    public function get()
    {
        $res = $this->user->get_users();

        header('Content-Type: application/json');
        echo json_encode($res ? $res : []);
    }

    # POST a user
    public function post()
    {
        if ($this->form_validation->submitted()) {

            # Get data
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $email = $this->io->post('email');
            $gender = $this->io->post('gender');
            $address = $this->io->post('address');

            # Save user
            $res = $this->user->create($firstname, $lastname, $email, $gender, $address);

            # Check 
            if ($res) {
                $data = [
                    'id' => $res,
                    'icas_first_name' => $firstname,
                    'icas_last_name' => $lastname,
                    'icas_email' => $email,
                    'icas_gender' => $gender,
                    'icas_address' => $address
                ];

                header('Content-Type: application/json');
                echo json_encode($data);
            }
            else {
                http_response_code(500);
                echo "Failed to create user.";
            }
        }
        # Wrong method
        else {
            http_response_code(400);
            echo "Incorrect request method.";
        }
    }

    # PATCH a user
    public function patch()
    {
        # Check if PATCH method
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Access data
            $id = $data['id'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $data['email'];
            $gender = $data['gender'];
            $address = $data['address'];

            # Apply patch
            $res = $this->user->update_user($id, $firstname, $lastname, $email, $gender, $address);

            # Check
            if ($res) echo "User updated successfully.";
            else {
                http_response_code(500);
                echo "Failed to update user.";
            }
        }
        # Wrong method
        else {
            http_response_code(400);
            echo "Incorrect request method.";
        }
    }

    # DELETE a user
    public function delete()
    {
        # Get delete data
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        # Delete user with that id
        $res = $this->user->delete_user($data['id']);

        # Check
        if ($res) echo "User deleted successfully.";
        else {
            http_response_code(500);
            echo "Failed to delete user.";
        }
    }
}
