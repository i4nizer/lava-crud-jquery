<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class User_model extends Model
{

    # Find tuples
    public function search($search) {
        
        $res = $this->db->table('icas_users')
            ->like('icas_first_name', "%$search%")
            ->or_like('icas_last_name', "%$search%")
            ->or_like('icas_email', "%$search%")
            ->or_like('icas_gender', "%$search%")
            ->or_like('icas_address', "%$search%")
            ->get_all();

        return $res;
    }

    # Insert tuple
    public function create($fname, $lname, $email, $gender, $address)
    {
        $data = [
            'icas_last_name' => $lname,
            'icas_first_name' => $fname,
            'icas_email' => $email,
            'icas_gender' => $gender,
            'icas_address' => $address
        ];

        return $this->db->table('icas_users')->insert($data);
    }

    # Get all users
    public function get_users()
    {
        return $this->db->table('icas_users')->get_all();
    }

    # Update a user
    public function update_user($id, $fname, $lname, $email, $gender, $address)
    {
        $data = [
            'icas_last_name' => $lname,
            'icas_first_name' => $fname,
            'icas_email' => $email,
            'icas_gender' => $gender,
            'icas_address' => $address
        ];
        
        return $this->db->table('icas_users')->where('id', $id)->update($data);
    }

    # Delete a user
    public function delete_user($id) 
    {
        return $this->db->table('icas_users')->where('id', $id)->delete();
    }

}
