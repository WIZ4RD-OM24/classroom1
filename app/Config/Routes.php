<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



//-------------------------DASHBOARD------------------------------
$routes->get('/admin-dashboard', 'AdminController::index',['filter' => 'authGuard']);
$routes->get('/student-dashboard','StudentController::student_dashboard');
$routes->get('/teacher-dashboard','TeacherController::teacher_dashboard');



//-----------------ADMIN ADMIN ROUTES------------------------
$routes->get('/xyz', 'AdminController::signup');
$routes->get('/signin', 'AdminController::signin');
$routes->get('/logout','AdminController::logout');
$routes->get('/admin-profile','AdminController::view_admin');
$routes->get('/view-edit-admin-profile','AdminController::view_edit_admin_profile');
$routes->post('/edit-admin-profile','AdminController::edit_profile');


//-----------------ADMIN CLASS ROUTES------------------------
$routes->get('/classes','ClassController::index',['filter' => 'authGuard']);
$routes->get('/add-class','ClassController::add_class');
$routes->get('/view-add-class',function(){session(); return view('class/add_class');});
$routes->post('/update-class', 'ClassController::update_class');
$routes->get('/delete-class/(:num)', 'ClassController::delete_class/$1');
$routes->get('/edit-class/(:num)', 'ClassController::singleClass/$1');
//$routes->get('/edit-class)', function(){return view('class/edit_class',$data);});


//-----------------ADMIN STUDENT ROUTES------------------------
$routes->get('/students','StudentController::index',['filter' => 'authGuard']);
$routes->get('/add-student','StudentController::add_student');
$routes->post('/add-bulk-student', 'StudentController::add_bulk_student');
$routes->get('/view-add-student','StudentController::view_add_student');
$routes->get('/view-add-bulk-student','StudentController::view_add_bulk_student');
$routes->post('/update-student', 'StudentController::update_student');
$routes->get('/view-student/(:num)', 'StudentController::singleStudent/$1');
$routes->get('/delete-student/(:num)', 'StudentController::delete_student/$1');
$routes->get('/view-student',function(){session(); return view('student/view_student_profile_by_admin');});
          //------------------STUDENT - STUDENT ROUTES ---------------------------
            
            $routes->get('/student-profile','StudentController::view_student');
            $routes->get('/view-edit-student-profile','StudentController::view_edit_student_profile');
            $routes->post('/edit-student-profile','studentController::edit_profile');

            $routes->get('/classmates', 'StudentController::classmates');
             //-----------------TEACHER - STUDENT ROUTES ----------------------------
             $routes->get('/teacher-studentlist','StudentController::student');




//-----------------ADMIN SUBJECTS ROUTES------------------------
$routes->get('/subjects','SubjectController::index',['filter' => 'authGuard']);
$routes->get('/view-add-subject','SubjectController::view_add_subject',['filter' => 'authGuard']);
$routes->get('/delete-subject/(:num)', 'SubjectController::delete_subject/$1');
$routes->get('/edit-subject/(:num)', 'SubjectController::singleSubject/$1');

 
//-----------------ADMIN ASSIGNMENT ROUTES----------------------
$routes->get('/assignments','AssignmentController::index',['filter' => 'authGuard']);
$routes->get('/view-post-assignment','AssignmentController::view_post_assignment',['filter' => 'authGuard']);
$routes->post('/post-assignment','AssignmentController::post_assignment');
$routes->get('/view-assignment/(:num)', 'AssignmentController::edit_assignment/$1');
$routes->get('/delete-assignment/(:num)', 'AssignmentController::delete_assignment/$1');
    //-----------------STUDENT - ASSIGNMENT ROUTES----------------------
    $routes->get('/student-assignments','AssignmentController::view_assignments');
    $routes->get('/view-upload-assignment/(:num)','AssignmentController::view_upload_assignment');

//-----------------ADMIN - TEACHER ROUTES------------------------
$routes->get('/teachers','TeacherController::index',['filter' => 'authGuard']);
$routes->get('/add-teacher','TeacherController::add_teacher');
$routes->get('/view-add-teacher',function(){session(); return view('teacher/add_teacher');},['filter' => 'authGuard']);
$routes->post('/update-teacher', 'TeacherController::update_teacher');
$routes->get('/view-teacher/(:num)', 'TeacherController::singleTeacher/$1');
$routes->get('/delete-teacher/(:num)', 'TeacherController::delete_teacher/$1');
$routes->get('/view-teacher',function(){session(); return view('teacher/view_teacher_profile_by_admin');});
        //-----------------STUDENT - TEACHER ROUTES-----------------------
        $routes->get('/student-faculty', 'TeacherController::student_faculty');  
        //-----------------TEACHER - TEACHER ROUTES------------------------
        $routes->get('/teacher-profile','TeacherController::view_teacher');
        $routes->get('/view-edit-teacher-profile','TeacherController::view_edit_teacher_profile');
        $routes->post('/edit-teacher-profile','TeacherController::edit_profile');
        $routes->get('/teacher-faculty','TeacherController::teacher_faculty');        




$routes->get('/stud_view', 'CsvController::index');


//-----------------ADMIN-NOTICE ROUTES------------------------
$routes->get('/notices','NoticeController::index',['filter' => 'authGuard']);
$routes->get('/view-add-notice','NoticeController::view_add_notice',['filter' => 'authGuard']);
$routes->post('/add-notice','NoticeController::add_notice');
$routes->get('/delete-notice/(:num)', 'NoticeController::delete_notice/$1');
$routes->get('/view-notice/(:num)', 'NoticeController::view_notice/$1');
$routes->get('/download-notice/(:num)', 'NoticeController::download_notice/$1');
        //-----------------TEACHER - NOTICE ROUTES------------------------
        $routes->get('/teacher-notice','NoticeController::teacher_notice');//['filter' => 'authGuard']);
        $routes->get('/teacher-view-add-notice','NoticeController::teacher_view_add_notice');
        $routes->post('/teacher-add-notice','NoticeController::teacher_add_notice');
        $routes->get('/teacher-delete-notice/(:num)', 'NoticeController::teacher_delete_notice/$1');
        //------------------STUDENT-  NOTICE ROUTES---------------------------
        $routes->get('/view-student-notice','NoticeController::student_index',['filter' => 'authGuard']);






//-----------------ADMIN CLASSWORK ROUTES------------------------
$routes->get('/classworks','ClassworkController::index',['filter' => 'authGuard']);
$routes->get('/view-add-classwork','ClassworkController::view_add_classwork',['filter' => 'authGuard']);
$routes->post('/add-classwork','ClassworkController::add_classwork');
$routes->get('/delete-classwork/(:num)', 'ClassworkController::delete_classwork/$1');
$routes->get('/download-classwork/(:num)', 'ClassworkController::download_classwork/$1');
$routes->get('/viewassignment','StudentController::view_assignments');
        //------------STUDENT CLASSWORK ROUTES------------------
        $routes->get('/view-classwork','ClassworkController::student_index',['filter' => 'authGuard']);
        $routes->get('/download-classwork/(:num)', 'ClassworkController::download_classwork/$1');
        //-----------TEACHER CLASSWORK ROUTES--------------------
$routes->get('/teacher-classwork','ClassworkController::teacher_index',['filter' => 'authGuard']);
$routes->get('/teacher-view-add-classwork','ClassworkController::teacher_view_add_classwork',['filter' => 'authGuard']);
$routes->post('/teacher-add-classwork','ClassworkController::teacher_add_classwork');


//-----------------ADMIN TIMETABLE ROUTES------------------------
$routes->get('/timetables','TimeTableController::index',['filter' => 'authGuard']);
$routes->get('/view-add-timetable','TimeTableController::view_add_timetable',['filter' => 'authGuard']);
$routes->post('/add-timetable','TimeTableController::add_timetable');
$routes->get('/delete-timetable/(:num)', 'TimeTableController::delete_timetable/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
