<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
use App\Models\NoticeModel;




class AdminController extends Controller
{
    protected $helpers = ['form'];

    public function index(){
        session(); 
        $AdminModel = new AdminModel();
        $ClassModel = new ClassModel();
        $StudentModel = new StudentModel();
        $SubjectModel = new SubjectModel();
        $TeacherModel = new TeacherModel();
        $NoticeModel = new NoticeModel;
        $data['notices']= $NoticeModel->where('admin_id',$_SESSION['admin']['admin_id'])->orderBy('created_at','DESC')->findAll() ;
        $data['class_count']= $ClassModel->where('admin_id',$_SESSION['admin']['admin_id'])->countAllResults();
        $data['student_count']= $StudentModel->where('admin_id',$_SESSION['admin']['admin_id'])->countAllResults();
        $data['subject_count']= $SubjectModel->where('admin_id',$_SESSION['admin']['admin_id'])->countAllResults();
        $data['teacher_count']= $TeacherModel->where('admin_id',$_SESSION['admin']['admin_id'])->countAllResults();
        return view('admin_dashboard',$data);

    }


    public function signup()
    {
        helper(['form']);
        $data = [];
        echo view('admin_signup', $data);
    }
    //add detail to register
    public function add_admin()
    {
        helper(['form']);
        $rules = [
            'admin_name'  => 'required|min_length[5]|max_length[50]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[admin.email]',
            'password'  => 'required|min_length[8]|max_length[50]',
            'confirm_password'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $AdminModel = new AdminModel();
            $date = date('d-m-y h:i:s');
            $data = [
                'admin_name'     => $this->request->getVar('admin_name'),
                'admin_mobile'          => $this->request->getVar('admin_mobile'),
                'admin_designation'   => $this->request->getVar('admin_designation'),
                'admin_organisation' =>  $this->request->getVar('admin_organisation'), 
                'email'    => $this->request->getVar('admin_email'),
                'password' => password_hash($this->request->getVar('admin_password'), PASSWORD_DEFAULT),
                'created_at'       => $date,
                'updated_at'       => $date
            ];
            print_r($data);
           $AdminModel->save($data);
           return $this->response->redirect(base_url('/signin'));
        }else{
            $data['validation'] = $this->validator;
            return view('admin_signup',$data);
        }
          
    }

    public function signin()
    {
        helper(['form']);
        return view('signin');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $AdminModel = new AdminModel();
        $StudentModel = new StudentModel();
        $TeacherModel = new TeacherModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        if($AdminModel->where('email',$email)->first()){  
            $data= $AdminModel->where('email',$email)->first();   
        }elseif($TeacherModel->where('email',$email)->first()){
            $data = $TeacherModel->where('email',$email)->first();
        }elseif($StudentModel->where('email',$email)->first()){
            $data = $StudentModel->where('email',$email)->first();
        }
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['admin_id'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                if ($data['user_type']=="admin"){
                    $_SESSION['admin']= $data;
                   //echo "admin dashboard";
                    return $this->response->redirect(base_url('/admin-dashboard'));
                }elseif($data['user_type']=="teacher"){
                    $_SESSION['teacher']= $data;
                   // echo "teacher dashboard";
                    return $this->response->redirect(base_url('/teacher-dashboard'));
                   // $_SESSION['admin']= $AdminModel->where('admin_id',$_SESSION['teacher']['admin_id'])->first();
                    
                }elseif($data['user_type']=="student"){
                    $_SESSION['student']= $data;
                    return $this->response->redirect(base_url('/student-dashboard'));
                    //echo "student dashboard";                    
                }
                echo "<pre>";
                print_r($_SESSION);
                $session->set($ses_data);
                print_r($ses_data);
                //return $this->response->redirect(base_url());
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return view('signin');
                //return $this->response->redirect(base_url('/signin'));
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return $this->response->redirect(base_url('/signin'));
        }



        /*$data = $AdminModel->where('admin_email', $email)->first();
        
        if($data){
            $pass = $data['admin_password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['admin_id'],
                    'name' => $data['admin_name'],
                    'email' => $data['admin_email'],
                    'isLoggedIn' => TRUE
                ];
                $_SESSION['admin'] = $data;
                $session->set($ses_data);
                //print_r($ses_data);
                return $this->response->redirect(base_url());
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return view('signin');
                //return $this->response->redirect(base_url('/signin'));
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return $this->response->redirect(base_url('/signin'));
        }*/
    }
    public function logout()
    {   session();
        session_destroy();
        return $this->response->redirect(base_url('/signin'));
    }
    public function view_admin()
    {
        session();
        $AdminModel = new AdminModel();
        $id = $_SESSION['admin']['admin_id'];
        $data['admin']= $AdminModel->where('admin_id',$id)->first();
        //echo WRITEPATH;
        //print_r($data);
        return view('view_admin_profile',$data);
    }
    public function view_edit_admin_profile(){
        helper(['form']);
        session();
        $AdminModel = new AdminModel();
        $id = $_SESSION['admin']['admin_id'];
        $data['admin']= $AdminModel->where('admin_id',$id)->first();
        //print_r($data['admin']);
        return view('edit_admin_profile',$data);
    }
    
    //edit admin profile
    public function edit_profile(){
     session();
     $AdminModel = new AdminModel();
     $date = date('d-m-y h:i:s');
     $id = $this->request->getVar('admin_id');
     $admin = $AdminModel->find($id);
    
     //print_r($data);
 
        $img = $this->request->getFile('admin_image');
        
       if($img->isValid() && !$img->hasMoved()){
           if(!$admin['admin_image']==" " && file_exists('uploads/'.$admin['admin_image'])){
               unlink('uploads/pfp/'.$admin['admin_image']);
           }
            $admin_image= $img->getRandomName();
            $img->move('uploads/',$admin_image);

        }else{
            $admin_image = $admin['admin_image'];
        }
      //  $img->move(WRITEPATH.'public/uploads');
       // $filepath = WRITEPATH . 'public/uploads/' . $img->store();
        //echo $filepath;
       $data = [
        'admin_name'           => $this->request->getVar('admin_name'),
        'admin_mobile'         => $this->request->getVar('admin_mobile'),
        'admin_image'          => $admin_image,
        'admin_designation'    => $this->request->getVar('admin_designation'),
        'admin_orgnisation'    => $this->request->getVar('admin_organisation'),
        'updated_at'           =>$date
     ];
       // $data = ['uploaded_flleinfo' => new File($filepath)];
        //echo "<pre>";
        //print_r($data);
        $AdminModel->update($id, $data);
        $data['admin']= $AdminModel->where('admin_id',$id)->first();
        return $this->response->redirect(base_url('/admin-profile'));
     
}
    
}