<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class TeacherModel extends Model{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $allowedFields = [
            'teacher_name',
            'teacher_mobile',
            'email',
            'password',
            'teacher_image',
            'teacher_organisation',
            'created_at',
            'updated_at',
            'class_id',
            'admin_id',
            'user_type',
    ];
}