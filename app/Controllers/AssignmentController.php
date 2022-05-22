<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\AssignmentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
use App\Models\AssignmentPostModel;



class AssignmentController extends Controller
{
    public function index()
    {   
        session();
        $AssignmentPostModel = new AssignmentPostModel();
        $data['assignments'] = $AssignmentPostModel->orderBy('assignment_post_id', 'DESC')->findAll();
        return view('assignment/manage_assignment',$data);
    }

    public function view_post_assignment(){
        session();
        $ClassModel = new ClassModel();
        $SubjectModel = new SubjectModel();
        $data['classes'] = $ClassModel->orderBy('class_id', 'DESC')->findAll();
        $data['subjects'] = $SubjectModel->orderBy('subject_id', 'DESC')->findAll();
        return view('assignment/post_assignment',$data);
    }
    public function post_assignment(){
        session();
        $date = date('d-m-y h:i:s');
        $AssignmentPostModel = new AssignmentPostModel();
        $file = $this->request->getFile('file');
       if($file->isValid() && !$file->hasMoved()){
            $post_file= $file->getRandomName();
            $file->move('uploads/assignments/',$post_file);
        }else{
            $post_file = null;
        }
        $data = [
            'assignment_post_title'    => $this->request->getVar('title'),
            'assignment_post_description'  => $this->request->getVar('description'),
            'assignment_post_file'     => $post_file,
            'assignment_post_due_date'  => $this->request->getVar('due_date'),
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['admin']['admin_id'],
            'class_id'        =>$this->request->getVar('class_id'),
            'subject_id'        =>$this->request->getVar('subject_id'),
        ];
        $AssignmentPostModel->insert($data);
        echo "<pre>";
        print_r($data);
        return $this->response->redirect(base_url('/assignments'));
    }

    public function delete_assignment($assignment_id = null)
        {
        $session = session();
        $AssignmentPostModel = new AssignmentPostModel();
        $data['assignment'] = $AssignmentPostModel->where('assignment_post_id', $assignment_id)->delete($assignment_id);
       // echo "<pre>";
        //print_r($data['teacher']);
        $session->setflashdata('errormsg',"Assignment deleted successfully!");
        return $this->response->redirect(base_url('/assignments'));

        }

        //---------------------------------TEACHER PANEL----------------------------------

    public function teacher_index()
    {   
        session();
        $AssignmentPostModel = new AssignmentPostModel();
        $data['assignments'] = $AssignmentPostModel->orderBy('assignment_post_id', 'DESC')->findAll();
        return view('teacher_assignment/teacher_manage_assignment',$data);
    }

    public function teacher_view_post_assignment(){
        session();
        //$ClassModel = new ClassModel();
        $SubjectModel = new SubjectModel();
        //$data['classes'] = $ClassModel->orderBy('class_id', 'DESC')->findAll();
        $data['subjects'] = $SubjectModel->findAll();
        return view('teacher_assignment/teacher_post_assignment',$data);
    }

    
    public function teacher_post_assignment(){
        session();
       // $_SESSION['class']['class_id'] = "12";
        $date = date('d-m-y h:i:s');
        $AssignmentPostModel = new AssignmentPostModel();
        $file = $this->request->getFile('file');
       if($file->isValid() && !$file->hasMoved()){
            $post_file= $file->getRandomName();
            $file->move('uploads/assignments/',$post_file);
        }else{
            $post_file = null;
        }
        $data = [
            'assignment_post_title'    => $this->request->getVar('title'),
            'assignment_post_description'  => $this->request->getVar('description'),
            'assignment_post_file'     => $post_file,
            'assignment_post_due_date'  => $this->request->getVar('due_date'),
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['admin']['admin_id'],
            'class_id'        => $_SESSION['class']['class_id'],
            'subject_id'      => $this->request->getVar('subject_id'),
        ];
        $AssignmentPostModel->insert($data);
        echo "<pre>";
        print_r($data);
        return $this->response->redirect(base_url('/teacher-assignments'));
    }

    public function teacher_delete_assignment($assignment_id = null)
        {
        $session = session();
        $AssignmentPostModel = new AssignmentPostModel();
        $data['assignment'] = $AssignmentPostModel->where('assignment_post_id', $assignment_id)->delete($assignment_id);
       // echo "<pre>";
        //print_r($data['teacher']);
        $session->setflashdata('errormsg',"Assignment deleted successfully!");
        return $this->response->redirect(base_url('/teacher-assignments'));

        }

//---------------------------------Student PANEL----------------------------------

    /*public function student_index()
    {   
        session();
        $_SESSION['student']['student_id'] = "15";
        $AssignmentPostModel = new AssignmentPostModel();
        $data['assignments'] = $AssignmentPostModel->orderBy('assignment_post_id', 'DESC')->findAll();
        return view('studnet_assignment/student_assignment',$data);
    }*/

    public function view_assignments(){
        session();
        $AssignmentPostModel = new AssignmentPostModel();
         //$assignments = $AssignmentPostModel->where('class_id',$_SESSION['student']['class_id'])->findAll();
        $data['assignments']= $AssignmentPostModel->where('class_id',$_SESSION['student']['class_id'])->findAll();
       //echo "<pre>";
       //print_r($data['assignments']);
        $currentdate=date('Y-m-d');
        $i=0;        
        foreach($data['assignments'] as $val)
        {
            $val['assignment_post_due_date'];
            //   echo "<br>";
            if($val['assignment_post_due_date'] > $currentdate ||  $val['assignment_post_due_date'] == $currentdate){
                $data1['assignments'][$i] = $val;
            }
            $i++;
              //print_r($data1);
        }
        return view('student_assignment/student_view_assignments',$data1);
        
    }

    public function view_upload_assignment($id = null){
        session();
        $AssignmentPostModel = new AssignmentPostModel();
         
        $data2['assignment']= $AssignmentPostModel->find($id);
       // echo "<pre>";print_r($assignment);
       return view('student_assignment/upload_assignment',$data2);
    }

    
    public function upload_assignment(){
        session();
       // $_SESSION['class']['class_id'] = "12";
       // $_SESSION['teacher']['teacher_id'] = "15";
        $date = date('d-m-y h:i:s');
        $AssignmentUploadModel = new AssignmentUploadModel();
        $file = $this->request->getFile('file');
       if($file->isValid() && !$file->hasMoved()){
            $upload_file= $file->getRandomName();
            $file->move('uploads/uploaded_assignments/',$upload_file);
        }else{
            $upload_file = null;
        }
        $data = [
            'assignment_upload_title'    => $this->request->getVar('title'),
            'assignment_upload_description'  => $this->request->getVar('description'),
            'assignment_upload_due_date'  => $this->request->getVar('due_date'),
            'assignment_upload_file'     => $upload_file,
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['admin']['admin_id'],
            'class_id'        => $_SESSION['class']['class_id'],
            'subject_id'      => $_SESSION['subject']['subject_id'],
        ];
        $AssignmentUploadModel->insert($data);
        echo "<pre>";
        print_r($data);
        return $this->response->redirect(base_url('/student-assignments'));
    }

}