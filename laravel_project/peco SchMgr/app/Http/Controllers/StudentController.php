<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index($date = '')
    {
        $date = !empty($date) ? $date : date('Y', strtotime('today'));
        //var_dump($date);
        $students = Student::where([
            ['session', '=', date('Y', strtotime($date . '-01-01'))],
            ['status', 1],
        ])
            ->orderby('updated_at', 'desc')
            ->simplePaginate('50');

        return view('admin/students', ['students' => $students, 'date' => $date]);
    }

    public function add()
    {
        return view('admin\add_student');
    }

    public function store(Request $data)
    {

        $this->validate($data, [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'exam.*' => ['required', 'min:1', 'integer'],

            'phone_no' => ['required', 'max:15'],

        ]);

        //var_dump($_POST['phone_no']);die();
        $exam = implode(';', $data->exam);

        $new = Student::create([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'exam' => $exam,
            'status' => 0,
            'session' => $data['session'],
        ]);

        //var_dump($data->exam); die(); date('Y',strtotime('today')),
        // create() is for mass filling
        $data->session()->flash('message', 'Successful, Thanks for your interest!<br> You will hear from us shortly ');
        $data->session()->flash('alert-class', 'alert-success');

        if ($data['reg'] == 'admin') {
            $this->confirm_pay($new->id);
            return redirect()->route('students');
        } else {
            return back();
        }

    }

    public function confirm_pay(int $student_id)
    {

        $code = random_int(111999, 999999);
        $result = DB::table('students')->where('id', $student_id)->update(['payment_status' => 1, 'status' => 1, 'access_code' => $code]);

        $student = Student::where('id', $student_id)->get();

        $subj1 = ' PECO - ONLINE:  CBT ACCESS CODE';
        $msgs = '';
        $msgs .= '
            Dear ' . $student[0]->name . '<br>Thanks for joining us @ Pacesetters Educational Center, Onitsha. <br> Your payments have been confirmed, here is your cbt arena access code:
                <br>
            <ul style="list-style: none;">

			<li><strong> ' . $code . '</strong></li>



			</ul>
<p> tYou are eligible to access our CBT examination practice for any exams of your choice </p>
			<p> Thanks! <br><br> Accounting Officier, <br> Pacesetters Educational Center, Onitsha, Anambra State </p>
            ';

        $subj = $subj1 . ' @ ' . $_SERVER['SERVER_NAME'];
        $headers = array(
            'FROM: "PECO - ONLINE" <engine@' . $_SERVER['SERVER_NAME'] . '>',
            'Reply-To: "DO-NOT-REPLY" <noreply@' . $_SERVER['SERVER_NAME'] . '>',
            'X-Mailer: PHP/' . phpversion(),
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=utf-8',
            'Content-Transfer-Encoding: 7bit',

        );
        $headers = implode("\r\n", $headers);

        $messagebody = $msgs;
        $message = '';

        $message .= $messagebody . "\r\n";

        $mailsent = mail($student[0]->email, $subj, $message, $headers);

    }

    public function pending()
    {
        $pros = Student::where([
            ['session', date('Y', strtotime('today'))],
            ['status', 0],
        ])
            ->orderby('id', 'desc')
            ->simplePaginate(50);

        return view('admin/prospective_students', ['students' => $pros]);
    }

    public function code(Request $request, Student $student)
    {
        //$id = $request->input('search');

        $id = $request->search;
        $yr = date('Y', strtotime('today'));
        if (is_numeric($id)) {
            $student = Student::where([
                ['phone_no', $id],
                ['session', $yr],
            ])
                ->first();

        } else {
            $student = Student::where([
                ['email', $id],
                ['session', $yr],
            ])
                ->first();
        }

        return redirect('/dash/students/'.$student->id);
        //return redirect()->route('showStudent')->with(['student' => $student]);
    }

    public function update(Request $request, Student $student = null)
    {

        $duty = $request->req;
        if ($duty == 'accept') {
            $i = 0;
            foreach (($request->student_id) as $value) {
                $this->confirm_pay($value);
                $i += 1;
            }
            $request->session()->flash('message', 'Confirmation Successful: ' . $i . ' Student(s) Confirmed');
            $request->session()->flash('alert-class', 'alert-success');
            return redirect('/dash/students/all');

        } elseif ($duty == 'suspend') {
            $delete = Student::where('id', $request->student_id)->update(['status' => 2]);

            $request->session()->flash('message', 'Successfully!');
            $request->session()->flash('alert-class', 'alert-success');

            return redirect('/dash/students/' . $request->student_id);

        } elseif ($duty == 'edit') {
            // this shhows the students edit form pagge

            return redirect('/dash/students/edit/' . $request->student_id);
        } else {
            // this update the student details

            $this->validate($request, [
                'name' => ['required', 'max:255', 'string'],
                'email' => ['required', 'email', 'string', 'max:255'],
                'exam.*' => ['required', 'min:1'],
                'phone_no' => ['required', 'max:15'],
            ]);

            $exam = implode(';', $request->exam);

            $upd = Student::where('id', $student->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_no' => $request->phone_no,
                    'exam' => $exam,
                ]);
            return redirect('/dash/students/' . $student->id);

        }

    }

    public function show(Student $student)
    {
        //var_dump($student);die();
        return view('admin/student', ['student' => $student]);
    }

    public function edit(Student $student)
    {
        return view('admin.edit_student', compact('student', $student));
    }

}
