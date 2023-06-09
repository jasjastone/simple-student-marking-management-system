<?php
require "../../php/connection.php";
require "../../php/globalfunction.php";
require "../../modules/fpdf184/fpdf.php";
require "../pdf.php";
if (!isset($_GET['id'])) {
    reload(headerroutepathfile: "../../index.php?route=/home", header: true, routename: "Dashboard");
}
$request = $connection->query("SELECT * FROM requests WHERE id='" . $_GET['id'] . "'")->fetch_array();
$student = $connection->query("SELECT * FROM users WHERE id='" . $request['student_id'] . "'")->fetch_array();
$course = $connection->query("SELECT * FROM courses WHERE id=" . $student['course_id'])->fetch_array();
$level = $connection->query("SELECT * FROM levels WHERE id=" . $student['level_id'])->fetch_array();
$departments = $connection->query("SELECT * FROM departments WHERE id=" . $student['department_id'])->fetch_array();
$hod = $connection->query("SELECT * FROM users WHERE id=" . $request['hod_id']);
if ($hod === false) {
    $hod = "Not Available";
} else {
    $hod = $hod->fetch_array();
    $hod = $hod['fname'] . " " . $hod['mname'] . " " . $hod['lname'];
}
$rector = $connection->query("SELECT * FROM users WHERE id=" . $request['rector_id']);
if ($rector === false) {
    $rector = "Not Available";
} else {
    $rector = $rector->fetch_array();
    $rector = $rector['fname'] . " " . $rector['mname'] . " " . $rector['lname'];
}
$deputyRector = $connection->query("SELECT * FROM users WHERE id=" . $request['deputy_rector_id']);
if ($deputyRector === false) {
    $deputyRector = "Not Available";
} else {
    $deputyRector = $deputyRector->fetch_array();
    $deputyRector = $deputyRector['fname'] . " " . $deputyRector['mname'] . " " . $deputyRector['lname'];
}
$registar = $connection->query("SELECT * FROM users WHERE id=" . $request['registar_id']);
if ($registar === false) {
    $registar = "Not Available";
} else {
    $registar = $registar->fetch_array();
    $registar = $registar['fname'] . " " . $registar['mname'] . " " . $registar['lname'];
}
class Approve extends PDF
{

    public const MAX_CHAR_REASON_QN2 = 450;
    /**
     * @param string $name
     * @param string $department
     * @param string $semister,
     * @param string $admissionNumber
     * @param string $course
     * @param string $academicYear
     * @param string $email
     * @param string $signature
     * @param string $phone
     * @param string $ntaLevel
     */
    public function Qn1(
        $name,
        $department,
        $semister,
        $admissionNumber,
        $course,
        $academicYear,
        $email,
        $date,
        $signature,
        $phone,
        $ntaLevel
    ) {
        //1.1
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, $this->lineHeight, '1. Student Particulars', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('1.1   Name of the Student'), 10, '1.1   Name of the Student:');
        $this->SetX($this->GetStringWidth('1.1   Name of the Student') + 12);
        $this->drawDots($name, 10);
        $this->SetY(54);
        $this->SetX($this->GetStringWidth('1.1   Name of the Student') + 12);
        $this->Cell($this->GetStringWidth($name), 10, $name, ln: 1);
        //next line 2
        $this->Cell($this->GetStringWidth("1.2   Admission No."), $this->lineHeight, "1.2   Admission No.");
        $this->SetX(43);
        $this->drawDots($admissionNumber);
        $this->SetY(63);
        $this->SetX(45);
        $this->Cell($this->GetStringWidth($admissionNumber), $this->lineHeight, $admissionNumber);
        $this->SetX($this->GetStringWidth("1.2   Admission No.") + $this->GetStringWidth($admissionNumber) + 23);
        $this->Cell($this->GetStringWidth("Programme Registered for"), $this->lineHeight, "Programme Registered for");
        $this->SetX($this->GetStringWidth("1.2   Admission No.") + $this->GetStringWidth($admissionNumber) + $this->GetStringWidth("Programme Registered for") + 25);
        $this->drawDots($course);
        $this->SetY(62);
        $this->SetX($this->GetStringWidth("1.2   Admission No.") + $this->GetStringWidth($admissionNumber) + $this->GetStringWidth("Programme Registered for") + 25);
        $this->Cell($this->GetStringWidth($course), $this->lineHeight, $course, ln: 1);
        //next line 3
        $this->Cell($this->GetStringWidth("1.3   Academic Year:"), $this->lineHeight, "1.3   Academic Year:");
        $this->SetX($this->GetStringWidth("1.3   Academic Year:") + 12);
        $this->drawDots($academicYear);
        $this->SetY(71);
        $this->SetX($this->GetStringWidth("1.3   Academic Year:") + 12);
        $this->Cell($this->GetStringWidth($academicYear), $this->lineHeight, $academicYear);
        $this->SetX(80);
        $this->Cell($this->GetStringWidth("Semester:"), $this->lineHeight, "Semester:");
        $this->SetX($this->GetStringWidth("Semester:") + $this->GetStringWidth("1.3   Academic Year:") + $this->GetStringWidth($academicYear) + 28);
        $this->drawDots($semister);
        $this->SetY(70);
        $this->SetX($this->GetStringWidth("Semester:") + $this->GetStringWidth("1.3   Academic Year:") + $this->GetStringWidth($academicYear) + 37);
        $this->Cell($this->GetStringWidth($semister), $this->lineHeight, $semister, ln: 1);
        //next lin 4
        $this->Cell($this->GetStringWidth("1.4   Department:"), $this->lineHeight, "1.4   Department:");
        $this->SetX(40);
        $this->drawDots($department);
        $this->SetY(79);
        $this->SetX(40);
        $this->Cell($this->GetStringWidth($department), $this->lineHeight, $department);
        $this->SetX(120);
        $this->Cell($this->GetStringWidth("NTA Level:"), $this->lineHeight, "NTA Level:");
        $this->SetX(120 + $this->GetStringWidth("NTA Level:") + 2);
        $this->drawDots($ntaLevel);
        $this->SetY(78);
        $this->SetX(120 + $this->GetStringWidth("NTA Level:") + 2);
        $this->Cell($this->GetStringWidth($ntaLevel), $this->lineHeight, $ntaLevel, ln: 1);
        //next lin 5
        $this->Cell($this->GetStringWidth("1.5   Mobile Phone No:"), $this->lineHeight, "1.5   Mobile Phone No:");
        $this->SetX($this->GetStringWidth("1.5   Mobile Phone No:") + 12);
        $this->drawDots($phone);
        $this->SetY(87);
        $this->SetX($this->GetStringWidth("1.5   Mobile Phone No:") + 12);
        $this->Cell($this->GetStringWidth($phone), $this->lineHeight, $phone);
        $this->SetX(80);
        $this->Cell($this->GetStringWidth("Email Address:"), $this->lineHeight, "Email Address:");
        $this->SetX(80 + $this->GetStringWidth("Email Address:") + 2);
        $this->drawDots($email);
        $this->SetY(86);
        $this->SetX(80 + $this->GetStringWidth("Email Address:") + 2);
        $this->Cell($this->GetStringWidth($email), $this->lineHeight, $email, ln: 1);
        //next lin 6
        $this->Cell($this->GetStringWidth("1.6   Date:"), $this->lineHeight, "1.6 Date:");
        $this->SetDash();
        $this->SetX($this->GetStringWidth("1.5   Date:") + 12);
        $this->drawDots($date);
        $this->SetY(95);
        $this->SetX($this->GetStringWidth("1.6   Date:") + 12);
        $this->Cell($this->GetStringWidth($date), $this->lineHeight, $date);
        $this->SetX(80);
        $this->Cell($this->GetStringWidth("Signature:"), $this->lineHeight, "Signature:");
        $this->SetX(80 + $this->GetStringWidth("Signature:") + 2);
        $this->drawDots($email);
        $this->SetY(94);
        $this->SetX(80 + $this->GetStringWidth("Signature:") + 2);
        $this->Cell($this->GetStringWidth($signature), $this->lineHeight, $signature, ln: 1);
    }

    public function Qn2($option21aorb, $otherreason, $amountPaid22a, $partAmountPaid22b, $expectResume)
    {

        //first line
        $this->Ln(2);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, $this->lineHeight, '2.   Reasons for Postponement of Studies', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, '2.1   What is the reason for postponement of your studies (tick)', ln: 1);
        $this->SetX(17);
        if ($option21aorb == 'a') {
            $this->Cell(0, $this->lineHeight, 'a)   Sickness (attach official documents)');
            $this->SetTextColor(0, 0, 200);
            $this->SetX($this->GetStringWidth('a)   Sickness (attach official documents)') + 20);
            $this->Cell(0, $this->lineHeight, 'Yes', ln: 1);
            $this->SetTextColor(0, 0, 0);
        } else {
            $this->Cell(0, $this->lineHeight, 'a)   Sickness (attach official documents)', ln: 1);
        }
        $this->SetX(17);
        if ($option21aorb == 'b') {
            $this->Cell(0, $this->lineHeight, 'b)   Fee payment issues');
            $this->SetTextColor(0, 0, 200);
            $this->SetX($this->GetStringWidth('b)   Fee payment issues') + 20);
            $this->Cell(0, $this->lineHeight, 'Yes', ln: 1);
            $this->SetTextColor(0, 0, 0);
        } else {
            $this->Cell(0, $this->lineHeight, 'b)   Fee payment issues', ln: 1);
        }
        $this->SetX(17);
        if ($option21aorb == 'c') {
            $this->Cell(0, $this->lineHeight, 'c)   Other reason (please explain)');
            $this->SetTextColor(0, 0, 200);
            $this->SetX($this->GetStringWidth('c)   Other reason (please explain)') + 20);
            $this->Cell(0, $this->lineHeight, 'Yes', ln: 1);
            $this->SetTextColor(0, 0, 0);
        } else {
            $this->Cell(0, $this->lineHeight, 'c)   Other reason (please explain)', ln: 1);
        }
        $this->SetX(17);
        $this->SetTextColor(0, 0, 255);
        if($otherreason != "NULL"){
            $this->writeParagrahMultCell($otherreason);
        }
        $this->SetTextColor(0, 0, 0);
        $this->SetY(185);
        //2.2a

        $this->Cell(0, $this->lineHeight, "2.2   Have you paid all prescribed fee prior for this desicion? (Tick)");
        $this->SetY(195);
        $this->SetX(17);
        $this->Cell(0, $this->lineHeight, "a)   Yes I have paid Fees Tsh .................................................. (attach receipts as evidence)", ln: 1);
        $this->SetY(194);
        $this->SetX($this->GetStringWidth("a)   Yes I have paid Fees Tsh .................................................. (attach receipts as evidence)") / 2);
        $this->Cell(0, $this->lineHeight, $amountPaid22a, ln: 1);
        //2.2b
        $this->SetX(17);
        $this->Cell(0, $this->lineHeight, "b)   Yes I have paid only part of fee Tsh .................................................. (attach receipts as evidence)");
        $this->SetX($this->GetStringWidth("b)   Yes I have paid only part of fee Tsh .................................................. (attach receipts as evidence)") / 2 + 12);
        $this->Cell(0, $this->lineHeight, $partAmountPaid22b);
        //2.2c
        $this->Ln();
        $this->SetX(17);
        $this->Cell(0, $this->lineHeight, "c)   Not at all", ln: 1);
        //2.3
        $this->Cell(0, $this->lineHeight, "2.3.   When do you expect to resume studies ...........................................................................................");
        $this->SetX($this->GetStringWidth("2.3.   When do you expect to resume studies ...........................................................................................") / 2);
        $this->Cell(0, $this->lineHeight, $expectResume);
        $this->Ln();
    }
    public function Qn3($haspaid, $accountofficerstamp, $date)
    {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, $this->lineHeight, '3.   Account Office', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('    The above student'), $this->lineHeight, '    The above student');
        $this->SetFont('Times', 'B', 12);
        if ($haspaid == false && $haspaid != null) {
            $this->Cell($this->GetStringWidth('has paid'), $this->lineHeight, ' has paid');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->cellStringThrough('not paid ');
        } else {
            $this->cellStringThrough(' has paid');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->Cell($this->GetStringWidth("not paid "), $this->lineHeight, 'not paid ');
        }
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, ' all fees and other College payments. His/her', ln: 1);
        $this->SetX(14);
        $this->Cell(0, $this->lineHeight, 'outstanding balance is .............................', ln: 1);
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '    Signature ..................................');
        $this->writeTextAboveText(y:1,x:40,txt:$date);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn4($hod, $hodrejected, $hodrejectedreason , $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
    {
        $this->AddPage('P');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, $this->lineHeight, '4.   Approval Process', ln: 1);
        $this->Cell(0, $this->lineHeight, '4.1  HOD of Department', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('     I '), $this->lineHeight, '     I ');
        if ($hodrejected == true && $hodrejected != null) {
            $this->Cell($this->GetStringWidth('accept'), $this->lineHeight, 'accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->cellStringThrough('reject ');
        } else {
            $this->cellStringThrough('accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->Cell($this->GetStringWidth("reject "), $this->lineHeight, 'reject ');
        }
        $this->SetFont('Times', 'B', 12);
        $this->Cell($this->GetStringWidth($hod), $this->lineHeight, "$hod");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies",ln:1);
        if($hodrejected){
            $this->drawDotsMultCell('sad');
        }
        else{
            $this->writeParagrahMultCell('     if rejected reasons'.$hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y:1,x:40,txt:$hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn5($hod, $hodrejected, $hodrejectedreason , $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
    {
        $this->SetFont('Times', 'B', 12);
        $this->Ln();
        $this->Cell(0, $this->lineHeight, '4.2  Registar', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('     I '), $this->lineHeight, '     I ');
        if ($hodrejected == true && $hodrejected != null) {
            $this->Cell($this->GetStringWidth('accept'), $this->lineHeight, 'accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->cellStringThrough('reject ');
        } else {
            $this->cellStringThrough('accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->Cell($this->GetStringWidth("reject "), $this->lineHeight, 'reject ');
        }
        $this->SetFont('Times', 'B', 12);
        $this->Cell($this->GetStringWidth($hod), $this->lineHeight, "$hod");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies",ln:1);
        if($hodrejected){
            $this->drawDotsMultCell('sad');
        }
        else{
            $this->writeParagrahMultCell('     if rejected reasons '.$hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y:1,x:40,txt:$hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn6($hod, $hodrejected, $hodrejectedreason , $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
    {
        $this->SetFont('Times', 'B', 12);
        $this->Ln();
        $this->Cell(0, $this->lineHeight, '4.3  DR - ARC', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('     I '), $this->lineHeight, '     I ');
        if ($hodrejected == true && $hodrejected != null) {
            $this->Cell($this->GetStringWidth('accept'), $this->lineHeight, 'accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->cellStringThrough('reject ');
        } else {
            $this->cellStringThrough('accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->Cell($this->GetStringWidth("reject "), $this->lineHeight, 'reject ');
        }
        $this->SetFont('Times', 'B', 12);
        $this->Cell($this->GetStringWidth($hod), $this->lineHeight, "$hod");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies",ln:1);
        if($hodrejected){
            $this->drawDotsMultCell('sad');
        }
        else{
            $this->writeParagrahMultCell('     if rejected reasons'.$hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y:1,x:40,txt:$hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn7($hod, $hodrejected, $hodrejectedreason , $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
    {
        $this->SetFont('Times', 'B', 12);
        $this->Ln();
        $this->Cell(0, $this->lineHeight, '4.4  Rector', ln: 1);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth('     I '), $this->lineHeight, '     I ');
        if ($hodrejected == true && $hodrejected != null) {
            $this->Cell($this->GetStringWidth('accept'), $this->lineHeight, 'accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->cellStringThrough('reject ');
        } else {
            $this->cellStringThrough('accept');
            $this->Cell($this->GetStringWidth(' / '), $this->lineHeight, ' / ');
            $this->Cell($this->GetStringWidth("reject "), $this->lineHeight, 'reject ');
        }
        $this->SetFont('Times', 'B', 12);
        $this->Cell($this->GetStringWidth($hod), $this->lineHeight, "$hod");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies",ln:1);
        if($hodrejected){
            $this->drawDotsMultCell('sad');
        }
        else{
            $this->writeParagrahMultCell('     if rejected reasons'.$hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y:1,x:40,txt:$hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
}
// // variables for testing qn 1
// $studentName = "James M Laizer";
// $studentAdmissionNumber = "19041102040";
// $studentCourse = "Laboratory and Science Technology";
// $academicYear = "2021/2022";
// $semister = "2 semester";
// $department = "GENERAL STUDIES";
// $NTALevel = "06";
// $MobileNo = "074564537";
// $email = "lucianambilike6@gmail.com";
// $date = "04 april 2022";
// $signature = "MySignature";
// //variables for testing qn 2
// $option21aorb = "a|b";

// $otherreason = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut possimus dignissimos ducimus debitis id perferendis beatae corrupti quia? Facilis fugiat consequatur enim nostrum doloribus, ad autem. Quo dolorum exercitationem aperiam?Lorem";
// $amountPaid22a = "200,000";
// $partAmountPaid22b = "255,000";
// $notPaid = "yes";
// $expectResume = "At the begining of this end of semister";
$studentName = $student['fname'] . " " . $student['mname'] . " " . $student['lname'];
$studentAdmissionNumber = $student['admission_number'];
$studentCourse = $course['course'];
$academicYear = $student['academic_year'];
$semister = $student['semister'];
$department = $departments['name'];
$NTALevel = $level['level'];
$MobileNo = $student['phone_number'];
$email = $student['email'];
$date = $request['date'];
$signature = "";

//variables for testing qn 2
$option21aorb = 'c';

$otherreason = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut possimus dignissimos ducimus debitis id perferendis beatae corrupti quia? Facilis fugiat consequatur enim nostrum doloribus, ad autem. Quo dolorum exercitationem aperiam?Lorem";
$amountPaid22a = $request['paid_tution_fee_amount'];
$partAmountPaid22b = $request['paid_half_fee_amount'];
$notPaid = $request['not_paid_at_all'];
$expectResume = $request['resume_expected'];
$otherreason = $request['other_reason_text'];

//variables for testing
$approve = new Approve();
$approve->title = "POSTPONDMENT OF STUDIES REQUEST FORM";
$approve->image = "../../files/systemimages/logo.png";
$approve->AddPage('P');
$approve->AliasNbPages();
$approve->SetFont('Times', 'B', 12);
$approve->Qn1($studentName, $department, $semister, $studentAdmissionNumber, $studentCourse, $academicYear, $email, $date, $signature, $MobileNo, $NTALevel);
$approve->Qn2($option21aorb, $otherreason, $amountPaid22a, $partAmountPaid22b, $expectResume);
$approve->Qn3("Officer", "This is the stamp", "2020-01-12");
$approve->Qn4($hod,$request['hod_rejected'],$request['hod_rejected_reason'],$request['hod_date'],$registar,$request['registar_rejected'],$request['registar_rejected_reason'],$request['registar_date'],$deputyRector,$request['deputy_rector_rejected'],$request['deputy_rector_rejected_reason'],$request['deputy_rector_date'],$rector,$request['rector_rejected'],$request['rector_rejected_reason'],$request['rector_date']);
$approve->Qn5($registar,$request['hod_rejected'],$request['hod_rejected_reason'],$request['hod_date'],$registar,$request['registar_rejected'],$request['registar_rejected_reason'],$request['registar_date'],$deputyRector,$request['deputy_rector_rejected'],$request['deputy_rector_rejected_reason'],$request['deputy_rector_date'],$rector,$request['rector_rejected'],$request['rector_rejected_reason'],$request['rector_date']);
$approve->Qn6($deputyRector,$request['hod_rejected'],$request['hod_rejected_reason'],$request['hod_date'],$registar,$request['registar_rejected'],$request['registar_rejected_reason'],$request['registar_date'],$deputyRector,$request['deputy_rector_rejected'],$request['deputy_rector_rejected_reason'],$request['deputy_rector_date'],$rector,$request['rector_rejected'],$request['rector_rejected_reason'],$request['rector_date']);
$approve->Qn7($rector,$request['rector_rejected'],$request['rector_rejected_reason'],$request['rector_date'],$registar,$request['rector_rejected'],$request['rector_rejected_reason'],$request['registar_date'],$deputyRector,$request['deputy_rector_rejected'],$request['deputy_rector_rejected_reason'],$request['deputy_rector_date'],$rector,$request['rector_rejected'],$request['rector_rejected_reason'],$request['rector_date']);

$approve->Output();
