<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class TeacherModel extends Model{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $allowedFields = [
            'admin_id',
            'teacher_name',
            'teacher_email',
            'teacher_password',
            'teacher_mobile',
            'teacher_image',
            'teacher_organisation',
            'teacher_isloggedin',
            'created_at',
            'updated_at',
    ];
}