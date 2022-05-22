<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;



class AssignmentController extends Controller
{
    public function index()
    {   session();
        return view('assignment/manage_assignment');
    }
    
    public function view_post_assignment(){
        session();
        return view('assignment/post_assignment');
    }
}