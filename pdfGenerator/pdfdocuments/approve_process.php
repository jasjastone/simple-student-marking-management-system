<?php
require "../../php/connection.php";
require "../../php/globalfunction.php";
require "../../modules/fpdf184/fpdf.php";
require "./request.php";
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
        $ntaLevel,
        $registar,
    ) {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, $this->lineHeight, "ATC/187/Vol. V1/44                                            Date: " . $date, ln: 1);
        $this->Cell(0, $this->lineHeight, $name . "(Admin. No." . $admissionNumber . "),", ln: 1);
        $this->Cell(0, $this->lineHeight, $department . " Department-ATC,", ln: 1);
        $this->Cell(0, $this->lineHeight, "P.O.Box 296,", ln: 1);
        $this->underline = true;
        $this->Cell(0, $this->lineHeight, "ARUSHA,",ln:1);
        $this->underline = false;
        $x = $this->GetX();
        $this->SetX(70);
        $this->Cell(0,$this->lineHeight,"RE: postponement OF STUDIES", align:"c", ln:1);
        $this->SetX($x);
        $this->SetFont('Times', '', 12);
        $this->Cell($this->GetStringWidth("Please refer to your request with reference number "),$this->lineHeight,"Please refer to your request with reference number ");
        $this->SetFont('Times', 'B', 12);
        $this->Cell($this->GetStringWidth("ATC/187/Vol. V1/22"),$this->lineHeight,"ATC/187/Vol. V1/22");
        $this->SetFont('Times', '', 12);
        $this->Cell(0,$this->lineHeight," of ".$date.".",ln:1);
        $this->SetX(20);
        $this->MultiCell(0,$this->lineHeight,'2. I would like to inform you that your request to postponement of studies has been approved by the Collge. However, please NOTE the followings  as per Section 6.13 (a-c) of ATC Examination Requlations:');
        $this->SetX(25);
        $this->MultiCell(0,$this->lineHeight,'(a)The maximum period a student is allowed to postpone studies is TWO (02) academic years. At the end of the first year of postponement ('.$academicYear.') you will be required to request for the extension of postponement if there is a need');
        $this->SetX(25);
        $this->MultiCell(0,$this->lineHeight,'(b)Upon re-admission in the academic year ('.(intval($academicYear) + 1).') you will be required to request to complete \'RESUMING OF STUDIES REQUEST FORM (ATC/ROST/1)\' available at ATC official website. Please be advised that the request to resume studies must be done not later than six weeks before the start of new academic year. Requests made after that time may be subject to delays due to processing time, which could cause delays in notification of approval to resume studies.');
        $this->SetX(25);
        $this->MultiCell(0,$this->lineHeight,'(c)All outstanding fee and any other College payments must be cleared before the resuming request is further considered for processing.');
        $this->SetX(20);
        $this->Cell(0,$this->lineHeight,'3. Sincerely yours',ln:1);
        $this->Cell(0,$this->lineHeight,$registar,align:"C",ln:1);
        $this->SetY(-33);
        $this->underline = true;
        $this->Cell(0,$this->lineHeight,"Admission officer",align:"C",ln:1);
        $this->underline = false;

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
        $this->writeParagrahMultCell($otherreason);
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
        $this->writeTextAboveText(y: 1, x: 40, txt: $date);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn4($hod, $hodrejected, $hodrejectedreason, $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
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
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies", ln: 1);
        if ($hodrejected) {
            $this->drawDotsMultCell('sad');
        } else {
            $this->writeParagrahMultCell('     if rejected reasons' . $hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y: 1, x: 40, txt: $hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn5($hod, $hodrejected, $hodrejectedreason, $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
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
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies", ln: 1);
        if ($hodrejected) {
            $this->drawDotsMultCell('sad');
        } else {
            $this->writeParagrahMultCell('     if rejected reasons ' . $hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y: 1, x: 40, txt: $hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn6($hod, $hodrejected, $hodrejectedreason, $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
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
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies", ln: 1);
        if ($hodrejected) {
            $this->drawDotsMultCell('sad');
        } else {
            $this->writeParagrahMultCell('     if rejected reasons' . $hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y: 1, x: 40, txt: $hoddate);
        $this->Cell($this->GetStringWidth('    Date & Stamp ..................................'), $this->lineHeight, '    Date & Stamp ..................................');
    }
    public function Qn7($hod, $hodrejected, $hodrejectedreason, $hoddate, $registar, $registarrejected, $registarrejectedreason, $registardate, $deputyrector, $deputyrectorrejected, $deputyrectorrejectedreason, $deputyrectordate, $rector, $rectorrejected, $rectorrejectedreason, $rectordate)
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
        $this->Cell(0, $this->lineHeight, " request to postpone his/her studies", ln: 1);
        if ($hodrejected) {
            $this->drawDotsMultCell('sad');
        } else {
            $this->writeParagrahMultCell('     if rejected reasons' . $hodrejectedreason);
        }
        $this->Cell($this->GetStringWidth("Signature .................................."), $this->lineHeight, '     Signature ..................................');
        $this->writeTextAboveText(y: 1, x: 40, txt: $hoddate);
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
$approve->image = "../../files/systemimages/logo.png";
$approve->j = "../../files/systemimages/j.jpeg";
$approve->AddPage('P');
$approve->AliasNbPages();
$approve->SetFont('Times', 'B', 12);
$approve->Qn1($studentName, $department, $semister, $studentAdmissionNumber, $studentCourse, $academicYear, $email, $date, $signature, $MobileNo, $NTALevel,$registar);
$approve->Output();
