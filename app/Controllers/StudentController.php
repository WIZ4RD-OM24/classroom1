<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
use App\Models\AssignmentPostModel;



class StudentController extends Controller
{  
    
    public function index()
    {
        session();
        $StudentModel = new StudentModel();
        $data['students'] = $StudentModel->orderBy('student_id', 'DESC')->findAll();
        return view('student/manage_student',$data);
    }
    public function view_add_student(){
        session();
        $ClassModel = new ClassModel();
        $data['classes'] = $ClassModel->findAll();
        return view('student/add_student',$data);
    }

    public function add_student() 
        {
            session();
            $date = date('d-m-y h:i:s');
            $StudentModel = new StudentModel();
            $data = [
                'student_roll_no' => $this->request->getVar('student_roll_no'),
                'student_name' => $this->request->getVar('student_name'),
                'password' => password_hash("student@123", PASSWORD_DEFAULT),
                'email'  => $this->request->getVar('student_email'),
                'created_at'      => $date,
                'updated_at' =>$date,
                'admin_id' => $_SESSION['admin']['admin_id'],
                'class_id' => $this->request->getVar('class_id')
                
            ];
           // print_r($data);
            $StudentModel->insert($data);
           // $session->setflashdata('successmsg',"Student added successfully!");
            return $this->response->redirect(base_url('/students'));
            
        }
        public function view_add_bulk_student(){
            session();
            $ClassModel = new ClassModel();
            $data['classes'] = $ClassModel->findAll();
            return view('student/add_bulk_student',$data);
        }
        public function add_bulk_student()
        {
            session();
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
            ]);
            if (!$input) {
                $data['validation'] = $this->validator;
                return view('index', $data); 
            }else{
                if($file = $this->request->getFile('file')) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csv', $newName);
                    $file = fopen('../public/csv/'.$newName,'r');
                    $i = 0;
                    $numberOfFields = 3;
                    $csvArr = array();
                    
                    while (($filedata = fgetcsv($file,1000, ',')) !== FALSE) {
                       // echo "<pre>";
                       // print_r($filedata);
                       $date = date('d-m-y h:i:s');
                        $num = count($filedata);
                        //echo $num;
                        if($i > 0 && $num == $numberOfFields){ 
                            $csvArr[$i]['student_roll_no'] = $filedata[0];
                            $csvArr[$i]['student_name'] = $filedata[1];
                            $csvArr[$i]['email'] = $filedata[2];
                            $csvArr[$i]['password'] = password_hash("student@123", PASSWORD_DEFAULT);
                            $csvArr[$i]['admin_id'] = $_SESSION['admin']['admin_id'];
                            $csvArr[$i]['created_at'] = $date;
                            $csvArr[$i]['updated_at'] =$date;
                            $csvArr[$i]['class_id'] =$this->request->getVar('class_id');
                           // echo "<pre>";
                            //print_r($csvArr[$i]);
                        }
                        $i++;
                    }
                    fclose($file);
                    $count = 0;
                    foreach($csvArr as $userdata){
                       // echo "<pre>";
                        //print_r($userdata);
                        $students = new StudentModel();
                        $findRecord = $students->where('student_roll_no', $userdata['student_roll_no'])->countAllResults();
                        //echo $findRecord;
                        if($findRecord == 0){
                            if($students->insert($userdata)){
                            $count++;
                            }
                        }
                        echo $count;
                    }
                    session()->setFlashdata('message', $count.' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                }
                else{
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
                }else{
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
                }
            }
            return $this->response->redirect(base_url('/students'));
            //return redirect()->route('/students');         
        } 
        // delete user
        public function delete_student($student_id = null)
        {
        $session = session();
        $StudentModel = new StudentModel();
        $data['student'] = $StudentModel->where('student_id', $student_id)->delete($student_id);
        $session->setflashdata('errormsg',"Student deleted successfully!");
        echo "<pre>";
        print_r($data['student_obj']);
        return $this->response->redirect(base_url('/students'));

        }
        // update student data
        public function edit_student(){
        $StudentModel = new StudentModel();
        $student_id = $this->request->getVar('student_id');
        $data = [
            'roll_no' => $this->request->getVar('roll_no'),
            'first_name' => $this->request->getVar('fname'),
            'last_name' => $this->request->getVar('lname'),
            'created_at'      => $date,
            'updated_at' =>$date
            
        ];
        $StudentModel->update($student_id, $data);
        return $this->response->redirect(base_url('/students'));
    }
    // show single user
    public function singleStudent($student_id = null){
        $StudentModel = new StudentModel();
        $data['student'] = $StudentModel->where('student_id', $student_id)->first();
        return view('student/view_student_profile_by_admin', $data);
    }

    public function view_assignments(){
        $AssignmentPostModel = new AssignmentPostModel();
        $assignments=$AssignmentPostModel->findAll();
        $data['my_assignments']= $AssignmentPostModel->findAll();
        echo "<pre>";

        $currentdate=date('Y-m-d');

        $i=0;        foreach($data['my_assignments'] as $val)
        {
            $val['assignment_post_due_date'];
            
         //   echo "<br>";
   if($val['assignment_post_due_date'] > $currentdate ||  $val['assignment_post_due_date'] == $currentdate)
   {
      $data1['my_assignments'][$i] = $val;
   }
            $i++;
        } 
 print_r($data1);

    }

  //----------------------------------------TEACHER PANEL------------------------------

public function student(){
    session();
    $StudentModel = new StudentModel();
    $data['students'] = $StudentModel->where('class_id',$_SESSION['teacher']['class_id'])->orderBy('student_id', 'DESC')->findAll();
   // echo "<pre>";
   // print_r($data);
    return view('teacher_panel/teacher_studentlist',$data);
 }


        
//-----------------------------------------Student Panel---------------------------------------------------

        public function student_dashboard() 
        {
            session(); 
        $AdminModel = new AdminModel();
        $ClassModel = new ClassModel();
        $StudentModel = new StudentModel();
        $SubjectModel = new SubjectModel();
        $TeacherModel = new TeacherModel();
        $data['class_name'] = $ClassModel->where('class_id',$_SESSION['student']['class_id'])->findColumn('class_name');
        //print_r($data['class_name']);
        $data['student_count']= $StudentModel->where('class_id',$_SESSION['student']['class_id'])->countAllResults();
        $data['subject_count']= $SubjectModel->where('class_id',$_SESSION['student']['class_id'])->countAllResults();
        $data['teacher_count']= $TeacherModel->where('class_id',$_SESSION['student']['class_id'])->countAllResults();
            //print_r($data);
            return view('student_panel/student_dashboard',$data);
        }

        public function view_student(){
            session();
            $StudentModel = new StudentModel();
            $id = $_SESSION['student']['student_id'];
            $data['student']= $StudentModel->where('student_id',$id)->first();
            //echo WRITEPATH;
            //print_r($data);
            return view('student_panel/view_student_profile', $data);
        } 

        public function view_edit_student_profile(){
            helper(['form']);
            session();
            $StudentModel = new StudentModel();
            $id = $_SESSION['student']['student_id'];
            $data['student']= $StudentModel->where('student_id',$id)->first();
            //print_r($data['student']);
            return view('student_panel/edit_student_profile',$data);
        }

        //edit student profile
    public function edit_profile(){
        session();
        $StudentModel = new StudentModel();
        $date = date('d-m-y h:i:s');
        $id = $_SESSION['student']['student_id'];
        //$id = $this->request->getVar('student_id');
        $student = $StudentModel->find($id);
       
       // print_r($student);
    
        $img = $this->request->getFile('student_image');
           
          if($img->isValid() && !$img->hasMoved()){
              if(!$student['student_image']== NULL && file_exists('uploads/pfp/'.$student['student_image'])){
                  unlink('uploads/pfp/'.$student['student_image']);
              }
               $student_image= $img->getRandomName();
               $img->move('uploads/pfp/',$student_image);
   
           }else{
               $student_image = $student['student_image'];
           }
         //  $img->move(WRITEPATH.'public/uploads');
          // $filepath = WRITEPATH . 'public/uploads/' . $img->store();
           //echo $filepath;
          $data = [
           'student_image'          => $student_image,
           'student_roll_no'        => $this->request->getVar('student_roll_no'),
           'student_name'           => $this->request->getVar('student_name'),
         //  'student_email'          => $this->request->getVar('student_email'),           
           'student_mobile'         => $this->request->getVar('student_mobile'),
           'updated_at'             =>$date
        ];
          // $data = ['uploaded_flleinfo' => new File($filepath)];
           //echo "<pre>";
           //print_r($data);
           $StudentModel->update($id, $data);
           $data['student']= $StudentModel->where('student_id',$id)->first();
           return $this->response->redirect(base_url('/student-profile'));
        
         }

         public function classmates(){
                   session();
                   $StudentModel = new StudentModel();
                   $data['students'] = $StudentModel->orderBy('student_id', 'DESC')->findAll();
                   return view('student_panel/classmates',$data);
                }    

        public function assignment_index(){
            return view('assignment');
        }

        public function logout()
        {   session();
            session_destroy();
            return $this->response->redirect(base_url('/signin'));
        }
}