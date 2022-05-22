<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AdminModel extends Model{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $allowedFields = [
            'admin_name',
            'email',
            'password',
            'admin_mobile',
            'admin_image',
            'admin_designation',
            'admin_organisation',
            'created_at',
            'updated_at',
            'user_type'
    ]; 
}