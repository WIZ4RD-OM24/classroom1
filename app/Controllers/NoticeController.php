<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
use App\Models\NoticeModel;
use TCPDF;



class NoticeController extends Controller
{  
    public function index(){
        session();
        $NoticeModel = new NoticeModel;
        $data['notices']= $NoticeModel->where('admin_id',$_SESSION['admin']['admin_id'])->orderBy('created_at','DESC')->findAll() ;
        return view('notice/manage_notice',$data);
    }

    public function view_add_notice()
    {
        session();
        $ClassModel = new ClassModel();
        $NoticeModel = new NoticeModel();
        $data['classes']= $ClassModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll();
        return view('notice/add_notice',$data);
    }
    public function add_notice(){
    {
        session();
        $date = date('d-m-y h:i:s');
        $ClassModel = new ClassModel();
        $NoticeModel = new NoticeModel();
        //$data['classes']= $NoticeModel->findAll();
        $file = $this->request->getFile('notice_file');
        $class_id =$this->request->getVar('class_id');
        //$class = $ClassModel->where('class_id',$class_id)->first();
       if($file->isValid() && !$file->hasMoved()){
            $notice_content= $file->getRandomName();
            $file->move('uploads/notices/',$notice_content);
        }else{
            $notice_content = null;
        }
        $data = [
            'notice_title'    => $this->request->getVar('notice_title'),
            'notice_content'  => $this->request->getVar('notice_content'),
            'notice_file'     => $notice_content,
            'created_at'      => $date,
            'updated_at'      => $date,
            'admin_id'        => $_SESSION['admin']['admin_id'],
            'class_id'        => $class_id,
            
        ];
        $NoticeModel->insert($data);
        //echo "<pre>";print_r($data);
        return $this->response->redirect(base_url('/notices'));
    }
    }

    public function delete_notice($id = null){
        $session = session();
        $NoticeModel = new NoticeModel();
        $NoticeModel->where('notice_id', $id)->delete($id);
        $session->setflashdata('errormsg',"subject deleted successfully!!!");
        return $this->response->redirect(base_url('/notices'));
    }

    public function view_notice($id = null){
        $NoticeModel = new NoticeModel();
        $notice = $NoticeModel->where('notice_id', $id)->first();
        helper('download');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->writeHTML($notice['notice_content'], true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output($notice['notice_title'], 'I');
       // return $response->download('writable/uploads/20220515/1652603221_21dbcbc5f646c7c8f37b.jpeg',NULL);
       // return $this->response->download('uploads/notices/'.$notice[''], null)->setFileName($notice['notice_title']);
    }

    public function download_notice($id = null){
        helper('download');
        $NoticeModel = new NoticeModel();
        $notice = $NoticeModel->where('notice_id', $id)->first();
       // return $response->download('writable/uploads/20220515/1652603221_21dbcbc5f646c7c8f37b.jpeg',NULL);
        return $this->response->download('uploads/notices/'.$notice['notice_file'], null);
        //return $this->response->redirect(base_url('/notices'));
    }

      //-----------------------------TEACHER PANEL---------------------------------------


      public function teacher_notice(){
        session();
        $NoticeModel = new NoticeModel;
        $AdminModel=   new    AdminModel;
       // $data['notices']= $NoticeModel->where('teacher_id',$_SESSION['teacher']['teacher_id'])->findAll() ;
       // $data['notices']= $NoticeModel->where('admin_id',$_SESSION['admin']['admin_id'])->findAll() ;
        $data['notices']= $NoticeModel->where('class_id',$_SESSION['teacher']['class_id'])->findAll() ;
        return view('teacher_notice/teacher_manage_notice',$data);
    }

    public function teacher_view_add_notice(){
    
        session();
        return view('teacher_notice/teacher_add_notice');
    }
    public function teacher_add_notice(){
    
        session();
        $date = date('d-m-y h:i:s');
        $NoticeModel = new NoticeModel();
        //$data['classes']= $NoticeModel->findAll();
        $file = $this->request->getFile('notice_file');
       if($file->isValid() && !$file->hasMoved()){
            $notice_content= $file->getRandomName();
            $file->move('uploads/notices/',$notice_content);
        }else{
            $notice_content = null;
        }
        $data = [
            'notice_title'    => $this->request->getVar('notice_title'),
            'notice_content'  => $this->request->getVar('notice_content'),
            'notice_file'     => $notice_content,
            'created_at'      => $date,
            'updated_at'      => $date,
            'teacher_id'        => $_SESSION['teacher']['teacher_id'],
            'class_id'        => $_SESSION['teacher']['class_id'],
            'admin_id'        => $_SESSION['teacher']['admin_id'],
            
        ];
        $NoticeModel->insert($data);
        //print_r($data);
        return $this->response->redirect(base_url('/teacher-notice'));
    }
    

    public  function teacher_delete_notice($id = null){
     
        $session = session();
        $NoticeModel = new NoticeModel();
        $NoticeModel->where('notice_id', $id)->delete($id);
        $session->setflashdata('errormsg',"subject deleted successfully!!!");
        return $this->response->redirect(base_url('/teacher-notice'));
    }


    //------------------------STUDENT PANEL--------------------------------
    public function student_index(){
        session();
        $NoticeModel = new NoticeModel;
        $data['notices']= $NoticeModel->where('class_id',$_SESSION['student']['class_id'])->orderBy('created_at','DESC')->findAll() ;
        return view('student_notice/view_notice',$data);
    }

}