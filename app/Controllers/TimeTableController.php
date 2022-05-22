<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\ClassModel;
use App\Models\TimeTableModel;
use App\Models\TeacherModel;
use App\Models\AdminModel;
 

class TimeTableController extends Controller
{
    public function index(){
        session();
        $TimeTableModel = new TimeTableModel();
        $data['timetables'] = $TimeTableModel->orderBy('created_at', 'DESC')->findAll();
        return view('timetable/manage_timetable',$data);
    }
    public function add_timetable()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => 'uploaded[userfile]'
                    . '|ext_in[file,xls]',
                    
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_flleinfo' => new File($filepath)];

            return view('upload_success', $data);
        } else {
            $data = ['errors' => 'The file has already been moved.'];

            return view('upload_form', $data);
        }
    }
}