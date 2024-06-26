<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User_info;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use App\Mail\Sendemail;
use App\Models\Benefits;
use App\Models\Classification;
use App\Models\Competencies;
use App\Models\Contents;
use App\Models\Images;
use App\Models\Programs;
use App\Models\Qualifications;
use App\Models\ScoreCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Exports\StudentsExport;
use App\Exports\FilterExport;
use App\Models\Partners;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;




class AdminController extends Controller
{
    public function settings(){
        $id = auth()->user()->id;
        $adminData = User_info::find($id);
        return view("pages.adminSetting", ["dataAdmin"=> $adminData]);
    }

    public function register_student(){
        $students = Students::orderBy('id', 'desc')->paginate(10);
        $programs = Programs::all();
        return view("pages.adminRegisterStudent", ['students'=>$students, 'programs'=>$programs, 'isAll'=>true]);
    }




    public function filter(Request $request){
        $filter = $request->validate([
            'course'=>['required'],
            'status'=>['required'],
            'start_date'=>['required','date'],
            'end_date'=>['required', 'date']
        ]);
        $start_date = date('Y-m-d H:i:s',strtotime($filter['start_date']));
        $end_date = date('Y-m-d H:i:s',strtotime($filter['end_date']));
        $students = Students::where('id_course','=',$filter['course'])->where('status','=',(bool)$filter['status'])->whereBetween('created_at',[$start_date, $end_date])->paginate(10);
        $programs = Programs::all();
        return view("pages.adminRegisterStudent", ['students'=>$students, 'programs'=>$programs, 'isAll'=>false, 'filter'=>['id_course'=>$filter['course'], 'status'=>$filter['status'], 'start_date'=> $filter['start_date'], 'end_date'=>$filter['end_date']]]);
    }

    function export(Request $request){

        $start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
        $end_date = date('Y-m-d H:i:s',strtotime($request->end_date));
        $fileExt = 'xls';
        $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        $filename = "nolitc-exported-data".date('d-m-Y').".".$fileExt;

        return Excel::download(new FilterExport($request->course, $request->status, $start_date, $end_date), $filename, $exportFormat);
    }
    function export_excel(){
        $fileExt = 'xls';
        $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        $filename = "nolitc-exported-data".date('d-m-Y').".".$fileExt;
        return Excel::download(new StudentsExport, $filename, $exportFormat);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            "fname"=> ['required'],
            "lname"=> ['required'],
            "email"=> ['required', 'email', Rule::unique('users')->ignore($id)],
            "username"=> ["required"],
            "password"=> 'required|confirmed',
        ]);
        $adminData = User_info::find($id);
        $adminData->fname = $data['fname'];
        $adminData->lname = $data['lname'];
        $adminData->email = $data['email'];
        $adminData->username = $data['username'];
        $adminData->decrypt = $data['password'];
        $adminData->password = bcrypt($data['password']);

        $adminData->save();
        return redirect()->back()->with('success','Update success');
    }

    public function student_profile($id){
        $student = Students::find($id);
        $student['birthdate'] = date("M-d-Y", strtotime($student['birthdate']));
        return view('pages.adminuser_profile', ['student'=>$student]);
    }
    public function deleteApplicant(Request $request){
        $data = array(
            'message'=> '
            Thank you for your interest in the Negros Occidental Language and Information Technology Center (NOLITC). We appreciate the time you took to complete the registration form.'."
            \n".
            'After careful consideration, we regret to inform you that we are unable to offer you a place in the course at this time. The selection process was highly competitive, and we received many strong registrations.'."
            \n".
            'We encourage you to apply again in the future and wish you the best in your educational and professional endeavors. If you have any questions, please feel free to contact us at:'."
            \n",
            'telephone' => "(034) 435 6092",
            'email'=> "nolitc@gmail.com"
        );
        $student = Students::find($request->student_id);
        Mail::to($student->email)->send(new Sendemail($data));
        $student->delete();
        return redirect()->route('register_admin');
    }

    public function acceptApplicant(Request $request){
        $user_id = $request->student_id;
        $student = Students::find($user_id);
        $data = array(
            'message'=> '
            We are pleased to inform you that your registration form has been approved, and you are now eligible to take the examination via the provided link '.$student->program->exam_link.' . The outcome of this examination will play a significant role in determining your acceptance into Negros Occidental Language and Information Technology Center (NOLITC).'."
            \n".
            'We look forward to your participation in the course and are confident that you will find it both challenging and rewarding.'."
            \n".
            'If you have any questions or need further information, do not hesitate to contact us at:'."
            \n",
            'telephone' => "(034) 435 6092",
            'email'=> "nolitc@gmail.com"
        );
        Mail::to($student->email)->send(new Sendemail($data));
        $student['status'] = true;
        $student->save();
        return redirect()->route('register_admin');
    }


    public function downloadPdf($id){
        $student = Students::find($id);
        $student['birthdate'] = date("M-d-Y", strtotime($student['birthdate']));
        $data = [
            'title' => 'student profile',
            'student' =>  $student
        ];

        $pdf = Pdf::loadView('pdf.downloadPdf', ['data'=>$data])->setPaper('a4', 'portrait');
        return $pdf->download($student->fname." ".$student->lname.".pdf");
    }

    public function upload_welcome(){
        $content = Contents::find(1);

        if($content!=null){
            return view("pages.adminwelcome", ['image'=>$content->images['0']]);
        }else{
            return view("pages.adminwelcome", ['image'=>'default.jpg']);
        }
    }

    public function upload_cover(Request $request){
        $filename = '';

        if($request->hasFile("image_upload")){
            $request->validate([
                'image_upload'=>'mimes:jpeg,png,bmp,tiff |max:4094',
            ]);
            $database = time().'.'.$request->image_upload->extension() ;
            $filename = $request->getSchemeAndHttpHost(). '/assets/img/'.$database;
            $request->image_upload->move(public_path('/assets/img/'), $filename);
            $content = Images::where('contents_id','=','1')->first();
            $content['image'] = $database;
            $content->save();
            // $content_img = Contents::find(1);
            return redirect()->back()->with('success','Update cover photo success');
            // return view("pages.adminwelcome", ['image'=>$content_img->images['0']])->with('success', 'Update cover photo success');
        }
    }

    public function program_management(){
        return view('pages.adminprogrammanagemant');
    }

    public function program_management_form(){
        $programs = Programs::orderBy('id', 'DESC')->get();
        return view('pages.adminprogramsform', ['programs'=>$programs]);
    }

    public function programs_addform(){
        return view('pages.adminprogramsinsertform');
    }

    public function addTesdaQualification(Request $request){
        $data = $request->validate([
            'course_name'=> 'required',
            'hours'=> 'required|numeric',
            'exampleLink'=>'required',
            'course_caption'=> 'required',
            'qualification'=> 'required|array',
            'benefits'=> 'required|array',
            'competencies'=> 'required|array',
            'image'=>'mimes:jpeg,png,bmp,tiff |max:4094',
        ]);
        $database = time().'.'.$data['image']->extension() ;
        $filename = $request->getSchemeAndHttpHost(). '/assets/img/'.$database;
        $data['image']->move(public_path('/assets/img/'), $filename);


        $lastest_id = DB::table('programs')->latest('created_at')->first();

       Programs::create([
        'id'=>$lastest_id->id+1,
        'name'=> $data['course_name'],
        'exam_link'=> $data['exampleLink'],
        'hours'=> $data['hours'],
        'caption'=> $data['course_caption'],
        'img_name' => $database,
       ]);

       $lastest_id = DB::table('programs')->latest('updated_at')->first();

       foreach($data['qualification'] as $qualification){
            Qualifications::create([
                'programs_id'=>$lastest_id->id,
                'qualification'=>$qualification
            ]);
       }

       foreach($data['benefits'] as $benefit){
            Benefits::create([
                'programs_id'=>$lastest_id->id,
                'benefit'=>$benefit
            ]);
       }

       foreach($data['competencies'] as $competencies){
            Competencies::create([
                'programs_id'=>$lastest_id->id,
                'competencie'=>$competencies
            ]);
       }

       return redirect('program-management/form')->with('success','Add Success');

    }

    public function program_qualification($id){
        $program = Programs::find($id);
        return view('pages.adminprogramsContent', ['program'=>$program]);
    }

    public function update_program($id){
        $program = Programs::find($id);
        return view('pages.adminprogramsupdateform', ['program'=>$program]);
    }

    public function updateContent_program(Request $request, $id){
        $data = $request->validate([
            'course_name'=> 'required',
            'hours'=> 'required|numeric',
            'exampleLink'=>'required',
            'course_caption'=> 'required',
            'qualification'=> 'required|array',
            'benefits'=> 'required|array',
            'competencies'=> 'required|array',
            'image'=>'mimes:jpeg,png,bmp,tiff |max:4094',
        ]);

        $program = Programs::find($id);
        $program->exam_link = $data['exampleLink'];
        $program->name = $data['course_name'];
        $program->hours = $data['hours'];
        $program->caption = $data['course_caption'];
        if($request->image!==null){
            if($data['image']!==null){
                $database = time().'.'.$data['image']->extension() ;
                $filename = $request->getSchemeAndHttpHost(). '/assets/img/'.$database;
                $data['image']->move(public_path('/assets/img/'), $filename);
                $program->img_name = $database;
            }
        }
        $program->save();

        Qualifications::where('programs_id','=',$id)->delete();
        Competencies::where('programs_id','=',$id)->delete();
        Benefits::where('programs_id','=',$id)->delete();

        foreach ($data['qualification'] as $qualification){
            Qualifications::create([
                'programs_id'=>$id,
                'qualification'=>$qualification
            ]);
        }

        foreach ($data['competencies'] as $competencies){
            Competencies::create([
                'programs_id'=>$id,
                'competencie'=>$competencies
            ]);
        }

        foreach ($data['benefits'] as $benefits){
            Benefits::create([
                'programs_id'=>$id,
                'benefit'=>$benefits
            ]);
        }

        return redirect()->back()->with('success','Update success');

    }


    public function delete_program(Request $request){
       Programs::where('id','=',$request->delete_id)->delete();
       return redirect('program-management/form')->with('success','Add Success');
    }

    public function showScoreCard()
    {
        $scoreCard = ScoreCard::first(); // Fetch all score cards
        return view('pages.score_card', ['scoreCard' => $scoreCard]); // Pass the score cards to the view
    }

    public function updateScoreCards(Request $request, $id){
        $data = $request->validate([
            'number_of_graduates'=> 'required|numeric',
            'number_of_employed'=> 'required|numeric',
            'employment_rate'=> 'required|numeric'
        ]);
        $scoreCards = ScoreCard::find($id);
        $scoreCards->number_of_graduates = $data['number_of_graduates'];
        $scoreCards->number_of_employed = $data['number_of_employed'];
        $scoreCards->employment_rate = $data['employment_rate'];
        $scoreCards->save();
        return redirect()->back()->with('success','Update success');
    }


    public function managePartners(){
        $partners = Partners::orderBy('id', 'ASC')->paginate(10);
        return view('pages.adminManagePartner', ['partners'=>$partners]);
    }

    public function add_partners(Request $request){
        $data = $request->validate([
            'image'=> 'mimes:jpeg,png,bmp,tiff |max:4094',
            'link'=> 'required'
        ]);

        $database = time().'.'.$data['image']->extension() ;
        $filename = $request->getSchemeAndHttpHost(). 'assets/partners_logo/'.$database;
        $data['image']->move(public_path('assets/partners_logo/'), $filename);
        Partners::create([
            'logo'=>$database,
            'link'=>$data['link']
        ]);

        return redirect()->back()->with('success','Add success');
    }

    public function delete_partners(Request $request){
        DB::table('partners')->where('id', '=', $request->partners_id)->delete();
        return redirect()->back()->with('success','Delete success');
    }



}

