<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;

 

class TeacherController extends Controller
{
    public function index(){
        session();
        $TeacherModel = new TeacherModel();
        $data['teachers'] = $TeacherModel->orderBy('teacher_id', 'DESC')->findAll();
        return view('teacher/manage_teacher',$data);
    }

    
     
    public function add_teacher() 
        {
            helper(['form']);
            $rules = [
            'teacher_name'  => 'required|min_length[5]|max_length[50]',
            'teacher_email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[teacher.email]',
        ];
        if($this->validate($rules)){   
            session();
            $date = date('d-m-y h:i:s');
            $TeacherModel = new TeacherModel();
            $data = [
                'teacher_name'  => $this->request->getVar('teacher_name'),
                'email' => $this->request->getVar('teacher_email'),
                'password' => password_hash("teacher@123", PASSWORD_DEFAULT),
                'created_at'    => $date,
                'updated_at'    =>$date,
                'admin_id' => $_SESSION['admin']['admin_id'],
                'teacher_organisation'=> $_SESSION['admin']['admin_organisation']             
            ];
           // print_r($data);
            $TeacherModel->insert($data);
            session()->setflashdata('successmsg',"User added successfully!");
            //return view('teacher/manage_teacher');
            return $this->response->redirect(base_url('/teachers'));
        }else{
            $data['validation'] = $this->validator;
            //return view('teacher/add_teacher',$data);
            return $this->response->redirect(base_url('/view-add-teacher'));
        }
              
            
        }
        // delete user
        public function delete_teacher($teacher_id = null)
        {
        $session = session();
        $TeacherModel = new TeacherModel();
        $data['teacher'] = $TeacherModel->where('teacher_id', $teacher_id)->delete($teacher_id);
        //echo "<pre>";
        //print_r($data['teacher']);
        $session->setflashdata('errormsg',"Teacher deleted successfully!");
        return $this->response->redirect(base_url('/teachers'));

        }
        // update student data
         public function edit_student(){
        //$StudentModel = new StudentModel();
        $student_id = $this->request->getVar('student_id');
        $data = [
            'roll_no' => $this->request->getVar('roll_no'),
            'first_name' => $this->request->getVar('fname'),
            'last_name' => $this->request->getVar('lname'),
            'created_at'      => $date,
            'updated_at' =>$date
            
        ];
        $StudentModel->update($student_id, $data);
        return $this->response->redirect(base_url('/manage_student'));
    }
    // show single user
    public function singleTeacher($teacher_id = null){
        $TeacherModel = new TeacherModel();
        $data['teacher'] = $TeacherModel->where('teacher_id', $teacher_id)->first();
        //return $this->response->redirect(base_url('/view-teacher'),$data);
        return view('teacher/view_teacher_profile_by_admin',$data);
    }

    //---------------------------TEACHER PANEL-----------------------------------

public function teacher_dashboard(){
    $helpers = ['form'];

   session(); 
   $_SESSION['teacher']['teacher_id']="12";
   $AdminModel = new AdminModel();
   $ClassModel = new ClassModel();
   $StudentModel = new StudentModel();
   $SubjectModel = new SubjectModel();
   $TeacherModel = new TeacherModel();
   $data['class_name'] = $ClassModel->where('class_id',$_SESSION['teacher']['class_id'])->findColumn('class_name');
   $data['student_count']= $StudentModel->where('class_id',$_SESSION['teacher']['class_id'])->countAllResults();
        $data['subject_count']= $SubjectModel->where('class_id',$_SESSION['teacher']['class_id'])->countAllResults();
        $data['teacher_count']= $TeacherModel->where('class_id',$_SESSION['teacher']['class_id'])->countAllResults();
   return view('teacher_panel/teacher_dashboard',$data);

}
public function view_teacher()
    {
        session();
        $_SESSION['teacher']['teacher_id']="12";
        
        $TeacherModel = new TeacherModel();
        $id = $_SESSION['teacher']['teacher_id'];
        $data['teacher']= $TeacherModel->where('teacher_id',$id)->first();
        //echo WRITEPATH;
        //print_r($data);
        return view('teacher_panel/view_teacher_profile',$data);
    }
    public function view_edit_teacher_profile(){
        helper(['form']);
        session();
        $_SESSION['teacher']['teacher_id']="12";
        $TeacherModel = new TeacherModel();
        $id = $_SESSION['teacher']['teacher_id'];
        $data['teacher']= $TeacherModel->where('teacher_id',$id)->first();
        //print_r($data['admin']);
        return view('teacher_panel/edit_teacher_profile',$data);
    }
    public function edit_profile(){
        session();
        $_SESSION['teacher']['teacher_id']="12";
        
        $TeacherModel = new TeacherModel();
        $date = date('d-m-y h:i:s');
        $id = $this->request->getVar('teacher_id');
        $teacher = $TeacherModel->find($id);
       
        //print_r($data);
   
           $img = $this->request->getFile('teacher_image');
           
          if($img->isValid() && !$img->hasMoved()){
              if(!$teacher['teacher_image']==NULL && file_exists('uploads/pfp'.$teacher['teacher_image'])){
                  unlink('uploads/pfp/'.$teacher['teacher_image']);
              }
               $teacher_image= $img->getRandomName();
               $img->move('uploads/pfp',$teacher_image);
   
           }else{
               $teacher_image = $teacher['teacher_image'];
           }
         //  $img->move(WRITEPATH.'public/uploads');
          // $filepath = WRITEPATH . 'public/uploads/' . $img->store();
           //echo $filepath;
          $data = [
           'teacher_name'           => $this->request->getVar('teacher_name'),
           'teacher_mobile'         => $this->request->getVar('teacher_mobile'),
           'teacher_image'          => $teacher_image,
           
           'teacher_orgnisation'    => $this->request->getVar('teacher_organisation'),
           'updated_at'             =>$date
        ];
          // $data = ['uploaded_flleinfo' => new File($filepath)];
           //echo "<pre>";
           //print_r($data);
           $TeacherModel->update($id, $data);
           $data['teacher']= $TeacherModel->where('teacher_id',$id)->first();
           return $this->response->redirect(base_url('/teacher-profile'));
        
   }
            public function teacher_faculty(){
            session();
            $TeacherModel = new TeacherModel();
            $SubjectModel = new SubjectModel();
            $data['teachers'] = $TeacherModel->where('class_id',$_SESSION['teacher']['class_id'])->orderBy('teacher_id', 'DESC')->findAll();
            $data['subjects'] = $SubjectModel->where('class_id',$_SESSION['teacher']['class_id'])->orderBy('subject_id', 'DESC')->findAll();
       
            //print_r($data);
            return view('teacher_panel/teacher_faculty',$data);
    }
  
    //---------------------------------STUDENT PANEL---------------------------------------


    public function student_faculty(){
        session();    
        $TeacherModel = new TeacherModel();
        $ClassModel = new ClassModel();
        $StudentModel = new StudentModel();
        $SubjectModel = new SubjectModel();
        
            $SubjectModel = new SubjectModel();
            $data['teachers'] = $TeacherModel->where('class_id',$_SESSION['student']['class_id'])->orderBy('teacher_id', 'DESC')->findAll();
            $data['subjects'] = $SubjectModel->where('class_id',$_SESSION['student']['class_id'])->orderBy('subject_id', 'DESC')->findAll();
           // echo "<pre>";
            //print_r($data);
            return view('/student_panel/student_faculty',$data);
        }
}