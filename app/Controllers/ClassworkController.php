<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
use App\Models\ClassworkModel;




class ClassworkController extends Controller
{  
    public function index(){
        session();
        $ClassworkModel = new ClassworkModel;
        $data['classworks']= $ClassworkModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll() ;
        return view('classwork/manage_classwork',$data);
    }

    public function view_add_classwork()
    {
        session();
        $ClassModel = new ClassModel();
        $ClassworkModel = new ClassworkModel();
        $SubjectModel = new SubjectModel();
        $data['subjects']= $SubjectModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll();
        $data['classes']= $ClassModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll();
        return view('classwork/add_classwork',$data);
    }


    public function add_classwork(){
    {
        session();
        $date = date('d-m-y h:i:s');
        $ClassModel = new ClassModel();
        $SubjectModel = new SubjectModel();
        $ClassworkModel = new ClassworkModel();
        //$data['classes']= $ClassworkModel->findAll();
        $file = $this->request->getFile('classwork_file');
        $class_id =$this->request->getVar('class_name');
        $class = $ClassModel->where('class_id',$class_id)->first();
        $subject_id =$this->request->getVar('subject_name');
        $subject = $SubjectModel->where('subject_id',$subject_id)->first();
       if($file->isValid() && !$file->hasMoved()){
            $classwork_file= $file->getRandomName();
            $file->move('uploads/classworks/',$classwork_file);
        }else{
            $classwork_file = null;
        }
        $data = [
            'classwork_title'    => $this->request->getVar('classwork_title'),
            'classwork_file'     => $classwork_file,
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['admin']['admin_id'],
            'class_id'        => $class['class_id'],
            'subject_id'        => $subject['subject_id'],
            
        ];
        $ClassworkModel->insert($data);
        print_r($data);
        return $this->response->redirect(base_url('/classworks'));
    }
    }

    public function delete_classwork($id = null){
        $session = session();
        $ClassworkModel = new ClassworkModel();
        $ClassworkModel->where('classwork_id', $id)->delete($id);
        $session->setflashdata('errormsg',"Classwork deleted successfully!!!");
        if ($_SESSION['admin']){
            return $this->response->redirect(base_url('/classworks'));
        }else if ($_SESSION['teacher']){
            return $this->response->redirect(base_url('/teacher-classwork'));
        }
    }

    public function download_classwork($id = null){
        helper('download');
        $ClassworkModel = new ClassworkModel();
        $classwork = $ClassworkModel->where('classwork_id', $id)->first();
       // return $response->download('writable/uploads/20220515/1652603221_21dbcbc5f646c7c8f37b.jpeg',NULL);
        return $this->response->download('uploads/classworks/'.$classwork['classwork_file'], null);
        //return $this->response->redirect(base_url('/notices'));
    }
    //-----------------------------TEACHER PANEL----------------------------------------

    public function teacher_index(){
        session();
        $ClassworkModel = new ClassworkModel;
        //$data['classworks']= $ClassworkModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll() ;
        $data['classworks']= $ClassworkModel->where('class_id',$_SESSION['teacher']['class_id'])->findAll() ;
        return view('teacher_classwork/teacher_manage_classwork',$data);
    }

    public function teacher_view_add_classwork()
    {
        session();
        $ClassModel = new ClassModel();
        $ClassworkModel = new ClassworkModel();
        $SubjectModel = new SubjectModel();
        $data['subjects']= $SubjectModel->where('class_id',$_SESSION['teacher']['class_id'])->findAll();
        $data['classes']= $ClassModel->where('class_id',$_SESSION['teacher']['class_id'])->findAll();
        return view('teacher_classwork/teacher_add_classwork',$data);
    }


    public function teacher_add_classwork(){
    
        session();
        $date = date('d-m-y h:i:s');
        $ClassModel = new ClassModel();
        $SubjectModel = new SubjectModel();
        $ClassworkModel = new ClassworkModel();
        //$data['classes']= $ClassworkModel->findAll();
        $file = $this->request->getFile('classwork_file');
       // $class_id =$this->request->getVar('class_name');
       // $class = $ClassModel->where('class_id',$class_id)->first();
        $subject_id =$this->request->getVar('subject_id');
       if($file->isValid() && !$file->hasMoved()){
            $classwork_file= $file->getRandomName();
            $file->move('uploads/classworks/',$classwork_file);
        }else{
            $classwork_file = null;
        }
        $data = [
            'classwork_title'    => $this->request->getVar('classwork_title'),
            'classwork_file'     => $classwork_file,
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['teacher']['admin_id'],
            'class_id'        => $_SESSION['teacher']['class_id'],
            'subject_id'        => $subject_id,
            
        ];
        $ClassworkModel->insert($data);
        print_r($data);
        return $this->response->redirect(base_url('/teacher-classwork'));
    }

    //-----------------------------STUDENT PANEL------------------------------

    public function student_index(){
        session();
        $ClassworkModel = new ClassworkModel;
        //$data['classworks']= $ClassworkModel->where('admin_id',$_SESSION['student']['admin_id'])->findAll() ;
        $data['classworks']= $ClassworkModel->where('class_id',$_SESSION['student']['class_id'])->findAll() ;
        return view('student_classwork/view_classwork',$data);
    }

    public function student_view_classwork()
    {
        session();
        $ClassModel = new ClassModel();
        $ClassworkModel = new ClassworkModel();
        $SubjectModel = new SubjectModel();
        $data['subjects']= $SubjectModel->where('class_id',$_SESSION['student']['class_id'])->findAll();
        $data['classes']= $ClassModel->where('class_id',$_SESSION['student']['class_id'])->findAll();
        return view('student_classwork/student_view_classwork',$data);
    }
}